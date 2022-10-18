<?php

declare(strict_types=1);

namespace ShopifyTest\Auth;

use Firebase\JWT\JWT;
use Shopify\Auth\OAuth;
use Shopify\Auth\Session;
use Shopify\Auth\AccessTokenOnlineUserInfo;
use Shopify\Auth\OAuthCookie;
use Shopify\Context;
use Shopify\Exception\CookieSetException;
use Shopify\Exception\HttpRequestException;
use Shopify\Exception\InvalidArgumentException;
use Shopify\Exception\InvalidOAuthException;
use Shopify\Exception\MissingArgumentException;
use Shopify\Exception\OAuthSessionNotFoundException;
use Shopify\Exception\PrivateAppException;
use Shopify\Exception\SessionStorageException;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class OAuthTest extends BaseTestCase
{
    /** @var string */
    private $oauthSessionId = 'test_oauth_session';

    /** @var array */
    private $codeRequestBody = [
        'client_id' => 'ash',
        'client_secret' => 'steffi',
        'code' => 'real_code',
    ];

    /** @var array */
    private $onlineResponse = [
        'access_token' => 'some access token',
        'scope' => 'read_products',
        'expires_in' => 525600,
        'associated_user_scope' => 'user_scope',
        'associated_user' => [
            'id' => 1,
            'first_name' => 'John',
            'last_name' => 'Smith',
            'email' => 'john@example.com',
            'email_verified' => true,
            'account_owner' => true,
            'locale' => 'en',
            'collaborator' => true,
        ],
    ];

    /** @var array */
    private $offlineResponse = [
        'access_token' => 'some access token',
        'scope' => 'read_products',
    ];

    /**
     * @dataProvider validBeginProvider
     */
    public function testValidBegin($isOnline, $hostScheme)
    {
        Context::$HOST_SCHEME = $hostScheme;

        /** @var OAuthCookie[] */
        $cookiesSet = [];
        $cookieCallback = function (OAuthCookie $cookie) use (&$cookiesSet) {
            $cookiesSet[$cookie->getName()] = $cookie;
            return !empty($cookie->getValue());
        };

        $returnUrl = OAuth::begin(
            'shopname',
            '/redirect',
            $isOnline,
            $cookieCallback,
        );
        $this->assertNotEmpty($cookiesSet[OAuth::SESSION_ID_COOKIE_NAME]->getValue());
        $this->assertEquals(
            hash_hmac('sha256', $cookiesSet[OAuth::SESSION_ID_COOKIE_NAME]->getValue(), Context::$API_SECRET_KEY),
            $cookiesSet[OAuth::SESSION_ID_SIG_COOKIE_NAME]->getValue()
        );

        if ($isOnline) {
            $grantOptions = 'per-user';
        } else {
            $grantOptions = '';
        }

        $cookieSessionId = $cookiesSet[OAuth::SESSION_ID_COOKIE_NAME]->getValue();
        $generatedState = Context::$SESSION_STORAGE->loadSession($cookieSessionId)->getState();
        $this->assertEquals(
            // phpcs:ignore
            "https://shopname.myshopify.com/admin/oauth/authorize?client_id=ash&scope=sleepy%2Ckitty&redirect_uri=$hostScheme%3A%2F%2Fwww.my-friends-cats.com%2Fredirect&state={$generatedState}&grant_options%5B%5D=$grantOptions",
            $returnUrl
        );
    }

    public function validBeginProvider(): array
    {
        return [
            'Online, HTTPS'  => [true, 'https'],
            'Online, HTTP'  => [true, 'http'],
            'Offline, HTTPS' => [false, 'https'],
            'Offline, HTTP' => [false, 'http'],
        ];
    }

    /**
     * @dataProvider validCallbackProvider
     */
    public function testValidCallback($isOnline, $isEmbedded)
    {
        Context::$IS_EMBEDDED_APP = $isEmbedded;

        /** @var OAuthCookie[] */
        $cookiesSet = [];
        $cookieCallback = function (OAuthCookie $cookie) use (&$cookiesSet) {
            $cookiesSet[$cookie->getName()] = $cookie;
            return !empty($cookie->getValue());
        };

        $this->createTestSession($isOnline);

        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, $isOnline ? $this->onlineResponse : $this->offlineResponse),
                "https://test-shop.myshopify.io/admin/oauth/access_token",
                "POST",
                "^Shopify Admin API Library for PHP v",
                ['Content-Type: application/json'],
                json_encode($this->codeRequestBody),
            ),
        ]);

        $mockCookies = [
            OAuth::SESSION_ID_SIG_COOKIE_NAME => hash_hmac('sha256', $this->oauthSessionId, Context::$API_SECRET_KEY),
            OAuth::SESSION_ID_COOKIE_NAME => $this->oauthSessionId,
        ];
        $mockQuery = [
            'shop' => $this->domain,
            'state' => '1234',
            'code' => 'real_code',
            'hmac' => '0b19b6077391191829e442a97aafd7730323041e585f738415a77894c41c0a5b',
        ];
        $actualSession = OAuth::callback($mockCookies, $mockQuery, $cookieCallback);
        $this->assertEquals($this->oauthSessionId, $cookiesSet[OAuth::SESSION_ID_COOKIE_NAME]->getValue());
        $this->assertEquals(
            hash_hmac('sha256', $cookiesSet[OAuth::SESSION_ID_COOKIE_NAME]->getValue(), Context::$API_SECRET_KEY),
            $cookiesSet[OAuth::SESSION_ID_SIG_COOKIE_NAME]->getValue()
        );

        $jwtSessionId = OAuth::getJwtSessionId($this->domain, '1');

        if ($isEmbedded && $isOnline) {
            // The OAuth session should have been replaced with a JWT-based session to allow App Bridge requests
            $this->assertNull(Context::$SESSION_STORAGE->loadSession($this->oauthSessionId));
            $expectedSessionId = $jwtSessionId;
        } else {
            // There should not be a JWT session
            $this->assertNull(Context::$SESSION_STORAGE->loadSession($jwtSessionId));
            $expectedSessionId = $this->oauthSessionId;
        }

        $expectedSession = $this->buildExpectedSession($expectedSessionId, $isOnline);
        $this->assertEquals($expectedSession, $actualSession);

        $cookieExpiration = $cookiesSet[OAuth::SESSION_ID_COOKIE_NAME]->getExpire();
        if ($isEmbedded) {
            $this->assertLessThanOrEqual(1, abs(time() - $cookieExpiration)); // 1 second grace period
        } elseif ($isOnline) {
            $this->assertEquals($expectedSession->getExpires()->format('U'), $cookieExpiration);
        } else {
            $this->assertNull($cookieExpiration);
        }
    }

    public function validCallbackProvider(): array
    {
        return [
            'Online, embedded'      => [true,  true],
            'Online, non-embedded'  => [true,  false],
            'Offline, embedded'     => [false, true],
            'Offline, non-embedded' => [false, false],
        ];
    }

    public function testCallbackFailsWithoutCookie()
    {
        $this->createTestSession(false);

        $this->expectException(\Shopify\Exception\CookieNotFoundException::class);
        $this->expectExceptionMessage('Could not find the current session id in the cookies');
        OAuth::callback([], []);
    }

    public function testCallbackFailsWithInvalidSignature()
    {
        $this->createTestSession(false);

        $mockCookies = [
            OAuth::SESSION_ID_SIG_COOKIE_NAME => "Not the right signature",
            OAuth::SESSION_ID_COOKIE_NAME => $this->oauthSessionId,
        ];
        $this->expectException(\Shopify\Exception\CookieNotFoundException::class);
        $this->expectExceptionMessage('Could not find the current session id in the cookies');
        OAuth::callback($mockCookies, []);
    }

    public function testCallbackFailsWithoutSession()
    {
        $this->createTestSession(false);

        $sessionId = "👋 This is not the session you're looking for";
        $mockCookies = [
            OAuth::SESSION_ID_SIG_COOKIE_NAME => hash_hmac('sha256', $sessionId, Context::$API_SECRET_KEY),
            OAuth::SESSION_ID_COOKIE_NAME => $sessionId,
        ];
        $this->expectException(OAuthSessionNotFoundException::class);
        $this->expectExceptionMessage(
            'You may have taken more than 60 seconds to complete the OAuth process and the session cannot be found'
        );
        OAuth::callback($mockCookies, []);
    }

    public function testCallbackFailsWithMissingHMAC()
    {
        $this->createTestSession(false);

        $mockCookies = [
            OAuth::SESSION_ID_SIG_COOKIE_NAME => hash_hmac('sha256', $this->oauthSessionId, Context::$API_SECRET_KEY),
            OAuth::SESSION_ID_COOKIE_NAME => $this->oauthSessionId,
        ];
        $mockQuery = [
            'shop' => $this->domain,
            'state' => '1234',
            'code' => 'real_code',
        ];
        $this->expectException(InvalidOAuthException::class);
        $this->expectExceptionMessage('Invalid OAuth callback.');
        OAuth::callback($mockCookies, $mockQuery);
    }

    public function testCallbackFailsWithInvalidHMAC()
    {
        $this->createTestSession(false);

        $mockCookies = [
            OAuth::SESSION_ID_SIG_COOKIE_NAME => hash_hmac('sha256', $this->oauthSessionId, Context::$API_SECRET_KEY),
            OAuth::SESSION_ID_COOKIE_NAME => $this->oauthSessionId,
        ];
        $mockQuery = [
            'shop' => $this->domain,
            'state' => '1234',
            'code' => 'real_code',
            'hmac' => 'Not the right hash',
        ];
        $this->expectException(InvalidOAuthException::class);
        $this->expectExceptionMessage('Invalid OAuth callback.');
        OAuth::callback($mockCookies, $mockQuery);
    }

    public function testCallbackFailsWithMissingShop()
    {
        $this->createTestSession(false);

        $mockCookies = [
            OAuth::SESSION_ID_SIG_COOKIE_NAME => hash_hmac('sha256', $this->oauthSessionId, Context::$API_SECRET_KEY),
            OAuth::SESSION_ID_COOKIE_NAME => $this->oauthSessionId,
        ];
        $mockQuery = [
            'state' => '1234',
            'hmac' => '0b19b6077391191829e442a97aafd7730323041e585f738415a77894c41c0a5b',
        ];
        $this->expectException(InvalidOAuthException::class);
        $this->expectExceptionMessage('Invalid OAuth callback.');
        OAuth::callback($mockCookies, $mockQuery);
    }

    public function testCallbackFailsWithInvalidShop()
    {
        $this->createTestSession(false);

        $mockCookies = [
            OAuth::SESSION_ID_SIG_COOKIE_NAME => hash_hmac('sha256', $this->oauthSessionId, Context::$API_SECRET_KEY),
            OAuth::SESSION_ID_COOKIE_NAME => $this->oauthSessionId,
        ];
        $mockQuery = [
            'shop' => 'not-a-valid.domain',
            'state' => '1234',
            'code' => 'real_code',
            'hmac' => '0b19b6077391191829e442a97aafd7730323041e585f738415a77894c41c0a5b',
        ];
        $this->expectException(InvalidOAuthException::class);
        $this->expectExceptionMessage('Invalid OAuth callback.');
        OAuth::callback($mockCookies, $mockQuery);
    }

    public function testCallbackFailsWithMissingState()
    {
        $this->createTestSession(false);

        $mockCookies = [
            OAuth::SESSION_ID_SIG_COOKIE_NAME => hash_hmac('sha256', $this->oauthSessionId, Context::$API_SECRET_KEY),
            OAuth::SESSION_ID_COOKIE_NAME => $this->oauthSessionId,
        ];
        $mockQuery = [
            'shop' => $this->domain,
            'code' => 'real_code',
            'hmac' => '0b19b6077391191829e442a97aafd7730323041e585f738415a77894c41c0a5b',
        ];
        $this->expectException(InvalidOAuthException::class);
        $this->expectExceptionMessage('Invalid OAuth callback.');
        OAuth::callback($mockCookies, $mockQuery);
    }

    public function testCallbackFailsWithInvalidState()
    {
        $this->createTestSession(false);

        $mockCookies = [
            OAuth::SESSION_ID_SIG_COOKIE_NAME => hash_hmac('sha256', $this->oauthSessionId, Context::$API_SECRET_KEY),
            OAuth::SESSION_ID_COOKIE_NAME => $this->oauthSessionId,
        ];
        $mockQuery = [
            'shop' => $this->domain,
            'state' => '4321',
            'code' => 'real_code',
            'hmac' => '0b19b6077391191829e442a97aafd7730323041e585f738415a77894c41c0a5b',
        ];
        $this->expectException(InvalidOAuthException::class);
        $this->expectExceptionMessage('Invalid OAuth callback.');
        OAuth::callback($mockCookies, $mockQuery);
    }

    public function testCallbackFailsWithMissingCode()
    {
        $this->createTestSession(false);

        $mockCookies = [
            OAuth::SESSION_ID_SIG_COOKIE_NAME => hash_hmac('sha256', $this->oauthSessionId, Context::$API_SECRET_KEY),
            OAuth::SESSION_ID_COOKIE_NAME => $this->oauthSessionId,
        ];
        $mockQuery = [
            'shop' => $this->domain,
            'state' => '1234',
            'hmac' => '0b19b6077391191829e442a97aafd7730323041e585f738415a77894c41c0a5b',
        ];
        $this->expectException(InvalidOAuthException::class);
        $this->expectExceptionMessage('Invalid OAuth callback.');
        OAuth::callback($mockCookies, $mockQuery);
    }

    public function testCallbackFailsWithInvalidCode()
    {
        $this->createTestSession(false);

        $mockCookies = [
            OAuth::SESSION_ID_SIG_COOKIE_NAME => hash_hmac('sha256', $this->oauthSessionId, Context::$API_SECRET_KEY),
            OAuth::SESSION_ID_COOKIE_NAME => $this->oauthSessionId,
        ];
        $mockQuery = [
            'shop' => $this->domain,
            'state' => '1234',
            'code' => 'not_the_real_code',
            'hmac' => '0b19b6077391191829e442a97aafd7730323041e585f738415a77894c41c0a5b',
        ];
        $this->expectException(InvalidOAuthException::class);
        $this->expectExceptionMessage('Invalid OAuth callback.');
        OAuth::callback($mockCookies, $mockQuery);
    }

    public function testFailsForPrivateApp()
    {
        $this->createTestSession(false);

        Context::$IS_PRIVATE_APP = true;

        $mockCookies = [
            OAuth::SESSION_ID_SIG_COOKIE_NAME => hash_hmac('sha256', $this->oauthSessionId, Context::$API_SECRET_KEY),
            OAuth::SESSION_ID_COOKIE_NAME => $this->oauthSessionId,
        ];
        $mockQuery = [
            'shop' => $this->domain,
            'state' => '1234',
            'code' => 'real_code',
            'hmac' => '0b19b6077391191829e442a97aafd7730323041e585f738415a77894c41c0a5b',
        ];
        $this->expectException(PrivateAppException::class);
        OAuth::callback($mockCookies, $mockQuery);
    }

    public function testThrowsIfSessionDeleteFails()
    {
        $storage = new MockSessionStorage();
        Context::$SESSION_STORAGE = $storage;

        $this->createTestSession(true);

        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, $this->onlineResponse),
                "https://test-shop.myshopify.io/admin/oauth/access_token",
                "POST",
                "^Shopify Admin API Library for PHP v",
                ['Content-Type: application/json'],
                json_encode($this->codeRequestBody),
            ),
        ]);

        $mockCookies = [
            OAuth::SESSION_ID_SIG_COOKIE_NAME => hash_hmac('sha256', $this->oauthSessionId, Context::$API_SECRET_KEY),
            OAuth::SESSION_ID_COOKIE_NAME => $this->oauthSessionId,
        ];
        $mockQuery = [
            'shop' => $this->domain,
            'state' => '1234',
            'code' => 'real_code',
            'hmac' => '0b19b6077391191829e442a97aafd7730323041e585f738415a77894c41c0a5b',
        ];

        $storage->failNextCalls('delete');
        $this->expectException(SessionStorageException::class);

        OAuth::callback($mockCookies, $mockQuery);
    }

    public function testThrowsIfSessionStoreFails()
    {
        $storage = new MockSessionStorage();
        Context::$SESSION_STORAGE = $storage;

        $this->createTestSession(true);

        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, $this->onlineResponse),
                "https://test-shop.myshopify.io/admin/oauth/access_token",
                "POST",
                "^Shopify Admin API Library for PHP v",
                ['Content-Type: application/json'],
                json_encode($this->codeRequestBody),
            ),
        ]);

        $mockCookies = [
            OAuth::SESSION_ID_SIG_COOKIE_NAME => hash_hmac('sha256', $this->oauthSessionId, Context::$API_SECRET_KEY),
            OAuth::SESSION_ID_COOKIE_NAME => $this->oauthSessionId,
        ];
        $mockQuery = [
            'shop' => $this->domain,
            'state' => '1234',
            'code' => 'real_code',
            'hmac' => '0b19b6077391191829e442a97aafd7730323041e585f738415a77894c41c0a5b',
        ];

        $storage->failNextCalls('store');
        $this->expectexception(SessionStorageException::class);

        OAuth::callback($mockCookies, $mockQuery);
    }

    public function testFailsIfTokenFetchFails()
    {
        $this->createTestSession(false);

        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(500, ''),
                "https://test-shop.myshopify.io/admin/oauth/access_token",
                "POST",
                "^Shopify Admin API Library for PHP v",
                ['Content-Type: application/json'],
                json_encode($this->codeRequestBody),
            ),
        ]);

        $mockCookies = [
            OAuth::SESSION_ID_SIG_COOKIE_NAME => hash_hmac('sha256', $this->oauthSessionId, Context::$API_SECRET_KEY),
            OAuth::SESSION_ID_COOKIE_NAME => $this->oauthSessionId,
        ];
        $mockQuery = [
            'shop' => $this->domain,
            'state' => '1234',
            'code' => 'real_code',
            'hmac' => '0b19b6077391191829e442a97aafd7730323041e585f738415a77894c41c0a5b',
        ];
        $this->expectexception(HttpRequestException::class);
        OAuth::callback($mockCookies, $mockQuery);
    }

    public function testBeginFailsOnPrivateApp()
    {
        Context::$IS_PRIVATE_APP = true;

        $this->expectexception(PrivateAppException::class);
        OAuth::begin('shopname', '/redirect', true);
    }

    public function testBeginThrowsOnEmptyShop()
    {
        $this->expectexception(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid shop domain: shopname.shop.ca');
        OAuth::begin('shopname.shop.ca', '/redirect', true);
    }

    public function testBeginRaisesErrorIfCookieNotSet()
    {
        $this->expectexception(CookieSetException::class);

        $wasCallbackCalled = false;
        OAuth::begin(
            'shopname',
            '/redirect',
            false,
            function () use (&$wasCallbackCalled) {
                $wasCallbackCalled = true;
                return false;
            }
        );
        $this->assertTrue($wasCallbackCalled);
    }

    public function testBeginWithoutSetCookieFunction()
    {
        $storage = new MockSessionStorage();
        Context::$SESSION_STORAGE = $storage;
        $storage->failNextCalls('store');
        $this->expectexception(SessionStorageException::class);

        $returnUrl = OAuth::begin(
            'shopname',
            '/redirect',
            false,
            function () {
                return true;
            },
        );
        $mySessionId = 'offline_shopname';
        $generatedState = Context::$SESSION_STORAGE->loadSession($mySessionId)->getState();
        $this->assertEquals(
            // phpcs:ignore
            "https://shopname/admin/oauth/authorize?client_id=ash&scope=sleepy%2Ckitty&redirect_uri=https%3A%2F%2Fwww.my-friends-cats.com%2Fredirect&state={$generatedState}&grant_options%5B%5D=",
            $returnUrl
        );
    }

    public function testGetCurrentSessionIdRaisesCookieNotFoundException()
    {
        Context::$IS_EMBEDDED_APP = false;
        $this->expectException(\Shopify\Exception\CookieNotFoundException::class);
        $this->expectExceptionMessage('Could not find the current session id in the cookies');

        OAuth::getCurrentSessionId([], [], true);
    }

    public function testGetCurrentSessionIdNonEmbeddedApp()
    {
        Context::$IS_EMBEDDED_APP = false;
        $mockCookies = [
            OAuth::SESSION_ID_SIG_COOKIE_NAME => hash_hmac('sha256', $this->oauthSessionId, Context::$API_SECRET_KEY),
            OAuth::SESSION_ID_COOKIE_NAME => $this->oauthSessionId,
        ];

        $currentSessionId = OAuth::getCurrentSessionId([], $mockCookies, true);
        $this->assertEquals('test_oauth_session', $currentSessionId);
    }

    public function testGetCurrentSessionIdRaisesMissingArgumentException()
    {
        $this->expectException(MissingArgumentException::class);
        $this->expectExceptionMessage('Missing Authorization key in headers array');

        OAuth::getCurrentSessionId(['auth' => 'Bearer 123.456.789'], [], true);
    }

    public function testGetCurrentSessionIdRaisesAnotherMissingArgumentException()
    {
        $this->expectException(MissingArgumentException::class);
        $this->expectExceptionMessage('Missing Bearer token in authorization header');

        OAuth::getCurrentSessionId(['Authorization' => 'Bear 123.456.789'], [], true);
    }

    public function testGetCurrentSessionIdForOnlineShop()
    {
        $token = $this->encodeJwtPayload();

        $currentSessionId = OAuth::getCurrentSessionId(['Authorization' => "Bearer $token"], [], true);
        $this->assertEquals('exampleshop.myshopify.com_42', $currentSessionId);
    }

    public function testGetCurrentSessionIdForOfflineShop()
    {
        $token = $this->encodeJwtPayload();

        $currentSessionId = OAuth::getCurrentSessionId(['Authorization' => "Bearer $token"], [], false);
        $this->assertEquals('offline_exampleshop.myshopify.com', $currentSessionId);
    }

    public function testGetCurrentSessionIdForEmbeddedAppMissingHeaders()
    {
        $this->expectException(MissingArgumentException::class);
        $this->expectExceptionMessage('Missing headers argument for embedded app');
        $currentSessionId = OAuth::getCurrentSessionId([], [], false);
        $this->assertEquals('offline_exampleshop.myshopify.com', $currentSessionId);
    }

    /**
     * Creates a session with default values for testing, and stores it.
     *
     * @param bool $isOnline Whether we're testing OAuth for an online token
     *
     * @return Session
     */
    private function createTestSession(bool $isOnline): Session
    {
        $session = new Session($this->oauthSessionId, 'test-shop.myshopify.io', $isOnline, '1234');
        Context::$SESSION_STORAGE->storeSession($session);

        return $session;
    }

    /**
     * Creates a session with all the default expected values
     *
     * @param string $sessionId The id of the session
     * @param bool   $isOnline  Whether the expected session is online
     *
     * @return \Shopify\Auth\Session
     * @throws \Exception
     */
    private function buildExpectedSession(string $sessionId, bool $isOnline = true): Session
    {
        $session = new Session($sessionId, $this->domain, $isOnline, '1234');
        $session->setScope('read_products');
        $session->setAccessToken('some access token');

        if ($isOnline) {
            $session->setExpires(strtotime('+525600 seconds'));

            $onlineAccessInfo = new AccessTokenOnlineUserInfo(
                1,
                'John',
                'Smith',
                'john@example.com',
                true,
                true,
                'en',
                true,
            );
            $session->setOnlineAccessInfo($onlineAccessInfo);
        }

        return $session;
    }

    private function encodeJwtPayload(): string
    {
        $payload = [
            "iss" => "https://exampleshop.myshopify.com/admin",
            "dest" => "https://exampleshop.myshopify.com",
            "aud" => "api-key-123",
            "sub" => "42",
            "exp" => strtotime('+5 minutes'),
            "nbf" => 1591764998,
            "iat" => 1591764998,
            "jti" => "f8912129-1af6-4cad-9ca3-76b0f7621087",
            "sid" => "aaea182f2732d44c23057c0fea584021a4485b2bd25d3eb7fd349313ad24c685"
        ];
        return JWT::encode($payload, Context::$API_SECRET_KEY, 'HS256');
    }
}
