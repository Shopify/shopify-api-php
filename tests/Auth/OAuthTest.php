<?php

declare(strict_types=1);

namespace ShopifyTest\Auth;

use Shopify\Exception\CookieNotFoundException;
use Exception;
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
use Shopify\Exception\PrivateAppException;
use Shopify\Exception\SessionStorageException;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class OAuthTest extends BaseTestCase
{
    /** @var string */
    private $offlineSessionId = 'offline_test-shop.myshopify.io';
    /** @var string */
    private $state = '1234';

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
        $this->assertNotEmpty($cookiesSet[OAuth::STATE_COOKIE_NAME]->getValue());
        $this->assertEquals(
            hash_hmac('sha256', $cookiesSet[OAuth::STATE_COOKIE_NAME]->getValue(), Context::$API_SECRET_KEY),
            $cookiesSet[OAuth::STATE_SIG_COOKIE_NAME]->getValue()
        );

        if ($isOnline) {
            $grantOptions = 'per-user';
        } else {
            $grantOptions = '';
        }

        $generatedState = $cookiesSet[OAuth::STATE_COOKIE_NAME]->getValue();
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
        $storage = new MockSessionStorage();
        Context::$SESSION_STORAGE = $storage;
        Context::$IS_EMBEDDED_APP = $isEmbedded;

        /** @var OAuthCookie[] */
        $cookiesSet = [];
        $cookieCallback = function (OAuthCookie $cookie) use (&$cookiesSet) {
            $cookiesSet[$cookie->getName()] = $cookie;
            return !empty($cookie->getValue());
        };

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
            OAuth::STATE_SIG_COOKIE_NAME => hash_hmac('sha256', $this->state, Context::$API_SECRET_KEY),
            OAuth::STATE_COOKIE_NAME => $this->state,
        ];
        $mockQuery = [
            'shop' => $this->domain,
            'state' => '1234',
            'code' => 'real_code',
            'hmac' => '0b19b6077391191829e442a97aafd7730323041e585f738415a77894c41c0a5b',
        ];
        $actualSession = OAuth::callback($mockCookies, $mockQuery, $cookieCallback);

        $cookieSessionId = $cookiesSet[OAuth::SESSION_ID_COOKIE_NAME]->getValue();
        if ($isOnline) {
            // UUID
            $this->assertNotEmpty($cookieSessionId);
        } else {
            $this->assertEquals($this->offlineSessionId, $cookieSessionId);
        }

        $this->assertEquals(
            hash_hmac('sha256', $cookieSessionId, Context::$API_SECRET_KEY),
            $cookiesSet[OAuth::SESSION_ID_SIG_COOKIE_NAME]->getValue()
        );

        if ($isEmbedded && $isOnline) {
            $expectedSessionId = OAuth::getJwtSessionId($this->domain, '1');
        } elseif ($isOnline) {
            $expectedSessionId = $cookieSessionId;
        } else {
            $expectedSessionId = $this->offlineSessionId;
        }

        // The OAuth process should only ever result in a single session being stored
        $this->assertCount(1, $storage->getAllSessions());
        $this->assertNotNull($storage->loadSession($actualSession->getId()));

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
        $this->expectException(CookieNotFoundException::class);
        $this->expectExceptionMessage(
            'You may have taken more than 60 seconds to complete the OAuth process and need to start over'
        );
        OAuth::callback([], []);
    }

    public function testCallbackFailsWithInvalidSignature()
    {
        $mockCookies = [
            OAuth::STATE_SIG_COOKIE_NAME => "Not the right signature",
            OAuth::STATE_COOKIE_NAME => $this->state,
        ];
        $this->expectException(CookieNotFoundException::class);
        $this->expectExceptionMessage(
            'You may have taken more than 60 seconds to complete the OAuth process and need to start over'
        );
        OAuth::callback($mockCookies, []);
    }

    public function testCallbackFailsWithMissingHMAC()
    {
        $mockCookies = [
            OAuth::STATE_SIG_COOKIE_NAME => hash_hmac('sha256', $this->state, Context::$API_SECRET_KEY),
            OAuth::STATE_COOKIE_NAME => $this->state,
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
        $mockCookies = [
            OAuth::STATE_SIG_COOKIE_NAME => hash_hmac('sha256', $this->state, Context::$API_SECRET_KEY),
            OAuth::STATE_COOKIE_NAME => $this->state,
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
        $mockCookies = [
            OAuth::STATE_SIG_COOKIE_NAME => hash_hmac('sha256', $this->state, Context::$API_SECRET_KEY),
            OAuth::STATE_COOKIE_NAME => $this->state,
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
        $mockCookies = [
            OAuth::STATE_SIG_COOKIE_NAME => hash_hmac('sha256', $this->state, Context::$API_SECRET_KEY),
            OAuth::STATE_COOKIE_NAME => $this->state,
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
        $mockCookies = [
            OAuth::STATE_SIG_COOKIE_NAME => hash_hmac('sha256', $this->state, Context::$API_SECRET_KEY),
            OAuth::STATE_COOKIE_NAME => $this->state,
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
        $mockCookies = [
            OAuth::STATE_SIG_COOKIE_NAME => hash_hmac('sha256', $this->state, Context::$API_SECRET_KEY),
            OAuth::STATE_COOKIE_NAME => $this->state,
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
        $mockCookies = [
            OAuth::STATE_SIG_COOKIE_NAME => hash_hmac('sha256', $this->state, Context::$API_SECRET_KEY),
            OAuth::STATE_COOKIE_NAME => $this->state,
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
        $mockCookies = [
            OAuth::STATE_SIG_COOKIE_NAME => hash_hmac('sha256', $this->state, Context::$API_SECRET_KEY),
            OAuth::STATE_COOKIE_NAME => $this->state,
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
        Context::$IS_PRIVATE_APP = true;

        $mockCookies = [
            OAuth::STATE_SIG_COOKIE_NAME => hash_hmac('sha256', $this->state, Context::$API_SECRET_KEY),
            OAuth::STATE_COOKIE_NAME => $this->state,
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

    public function testThrowsIfSessionStoreFails()
    {
        $storage = new MockSessionStorage();
        Context::$SESSION_STORAGE = $storage;

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
            OAuth::STATE_SIG_COOKIE_NAME => hash_hmac('sha256', $this->state, Context::$API_SECRET_KEY),
            OAuth::STATE_COOKIE_NAME => $this->state,
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
            OAuth::STATE_SIG_COOKIE_NAME => hash_hmac('sha256', $this->state, Context::$API_SECRET_KEY),
            OAuth::STATE_COOKIE_NAME => $this->state,
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

    public function testGetCurrentSessionIdRaisesCookieNotFoundException()
    {
        Context::$IS_EMBEDDED_APP = false;
        $this->expectException(CookieNotFoundException::class);
        $this->expectExceptionMessage('Could not find the current session id in the cookies');

        OAuth::getCurrentSessionId([], [], true);
    }

    public function testGetCurrentSessionIdNonEmbeddedApp()
    {
        Context::$IS_EMBEDDED_APP = false;
        $mockCookies = [
            OAuth::SESSION_ID_SIG_COOKIE_NAME => hash_hmac('sha256', $this->offlineSessionId, Context::$API_SECRET_KEY),
            OAuth::SESSION_ID_COOKIE_NAME => $this->offlineSessionId,
        ];

        $currentSessionId = OAuth::getCurrentSessionId([], $mockCookies, true);
        $this->assertEquals($this->offlineSessionId, $currentSessionId);
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
     * Creates a session with all the default expected values
     *
     * @param string $sessionId The id of the session
     * @param bool   $isOnline  Whether the expected session is online
     *
     * @return Session
     * @throws Exception
     */
    private function buildExpectedSession(string $sessionId, bool $isOnline = true): Session
    {
        $session = new Session($sessionId, $this->domain, $isOnline, '');
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
