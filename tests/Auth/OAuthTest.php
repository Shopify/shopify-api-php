<?php

declare(strict_types=1);

namespace ShopifyTest\Auth;

use Firebase\JWT\JWT;
use Shopify\Auth\OAuth;
use Shopify\Auth\Session;
use Shopify\Auth\AccessTokenOnlineUserInfo;
use Shopify\Context;
use Shopify\Exception\CookieSetException;
use Shopify\Exception\HttpRequestException;
use Shopify\Exception\InvalidOAuthException;
use Shopify\Exception\MissingArgumentException;
use Shopify\Exception\OAuthSessionNotFoundException;
use Shopify\Exception\PrivateAppException;
use Shopify\Exception\SessionStorageException;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class OAuthTest extends BaseTestCase
{
    private string $oauthSessionId = 'test_oauth_session';

    private array $codeRequestBody = [
        'client_id' => 'ash',
        'client_secret' => 'steffi',
        'code' => 'real_code',
    ];

    private array $onlineResponse = [
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

    private array $offlineResponse = [
        'access_token' => 'some access token',
        'scope' => 'read_products',
    ];

    /**
     * @dataProvider validCallbackProvider
     */
    public function testValidCallback($isOnline, $isEmbedded)
    {
        Context::$IS_EMBEDDED_APP = $isEmbedded;

        $this->createTestSession($isOnline);

        $this->mockTransportRequests([
            new MockRequest(
                response: $this->buildMockHttpResponse(200, $isOnline ? $this->onlineResponse : $this->offlineResponse),
                url: "https://test-shop.myshopify.io/admin/oauth/access_token",
                method: "POST",
                userAgent: "^Shopify Admin API Library for PHP v",
                headers: ['Content-Type: application/json'],
                body: json_encode($this->codeRequestBody),
            ),
        ]);

        $mockCookies = [OAuth::SESSION_ID_COOKIE_NAME => $this->oauthSessionId];
        $mockQuery = [
            'shop' => $this->domain,
            'state' => '1234',
            'code' => 'real_code',
            'hmac' => '0b19b6077391191829e442a97aafd7730323041e585f738415a77894c41c0a5b',
        ];
        OAuth::callback($mockCookies, $mockQuery);

        $jwtSessionId = OAuth::getJwtSessionId($this->domain, '1');

        if ($isEmbedded && $isOnline) {
            // The OAuth session should have been replaced with a JWT-based session to allow App Bridge requests
            $this->assertNull(Context::$SESSION_STORAGE->loadSession($this->oauthSessionId));

            $actualSession = Context::$SESSION_STORAGE->loadSession($jwtSessionId);
            $expectedSessionId = $jwtSessionId;
        } else {
            // There should not be a JWT session
            $this->assertNull(Context::$SESSION_STORAGE->loadSession($jwtSessionId));

            $actualSession = Context::$SESSION_STORAGE->loadSession($this->oauthSessionId);
            $expectedSessionId = $this->oauthSessionId;
        }

        $expectedSession = $this->buildExpectedSession($expectedSessionId, $isOnline);
        $this->assertEquals($expectedSession, $actualSession);
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

    public function testCallbackFailsWithoutSession()
    {
        $this->createTestSession(false);

        $mockCookies = [OAuth::SESSION_ID_COOKIE_NAME => "👋 This is not the session you're looking for"];
        $this->expectException(OAuthSessionNotFoundException::class);
        $this->expectExceptionMessage(
            'You may have taken more than 60 seconds to complete the OAuth process and the session cannot be found'
        );
        OAuth::callback($mockCookies, []);
    }

    public function testCallbackFailsWithMissingHMAC()
    {
        $this->createTestSession(false);

        $mockCookies = [OAuth::SESSION_ID_COOKIE_NAME => $this->oauthSessionId];
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

        $mockCookies = [OAuth::SESSION_ID_COOKIE_NAME => $this->oauthSessionId];
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

        $mockCookies = [OAuth::SESSION_ID_COOKIE_NAME => $this->oauthSessionId];
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

        $mockCookies = [OAuth::SESSION_ID_COOKIE_NAME => $this->oauthSessionId];
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

        $mockCookies = [OAuth::SESSION_ID_COOKIE_NAME => $this->oauthSessionId];
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

        $mockCookies = [OAuth::SESSION_ID_COOKIE_NAME => $this->oauthSessionId];
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

        $mockCookies = [OAuth::SESSION_ID_COOKIE_NAME => $this->oauthSessionId];
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

        $mockCookies = [OAuth::SESSION_ID_COOKIE_NAME => $this->oauthSessionId];
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

        $mockCookies = [OAuth::SESSION_ID_COOKIE_NAME => $this->oauthSessionId];
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
                response: $this->buildMockHttpResponse(200, $this->onlineResponse),
                url: "https://test-shop.myshopify.io/admin/oauth/access_token",
                method: "POST",
                userAgent: "^Shopify Admin API Library for PHP v",
                headers: ['Content-Type: application/json'],
                body: json_encode($this->codeRequestBody),
            ),
        ]);

        $mockCookies = [OAuth::SESSION_ID_COOKIE_NAME => $this->oauthSessionId];
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
                response: $this->buildMockHttpResponse(200, $this->onlineResponse),
                url: "https://test-shop.myshopify.io/admin/oauth/access_token",
                method: "POST",
                userAgent: "^Shopify Admin API Library for PHP v",
                headers: ['Content-Type: application/json'],
                body: json_encode($this->codeRequestBody),
            ),
        ]);

        $mockCookies = [OAuth::SESSION_ID_COOKIE_NAME => $this->oauthSessionId];
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
                response: $this->buildMockHttpResponse(500, ''),
                url: "https://test-shop.myshopify.io/admin/oauth/access_token",
                method: "POST",
                userAgent: "^Shopify Admin API Library for PHP v",
                headers: ['Content-Type: application/json'],
                body: json_encode($this->codeRequestBody),
            ),
        ]);

        $mockCookies = [OAuth::SESSION_ID_COOKIE_NAME => $this->oauthSessionId];
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

    public function testBeginFunctionReturnsProperUrlForOfflineAccess()
    {
        $wasCallbackCalled = false;
        $returnUrl = OAuth::begin(
            'shopname',
            '/redirect',
            false,
            function () use (&$wasCallbackCalled) {
                $wasCallbackCalled = true;
                return true;
            }
        );
        $this->assertTrue($wasCallbackCalled);
        $mySessionId = 'offline_shopname.myshopify.com';
        $generatedState = Context::$SESSION_STORAGE->loadSession($mySessionId)->getState();
        $this->assertEquals(
            // phpcs:ignore
            "https://shopname.myshopify.com/admin/oauth/authorize?client_id=ash&scope=sleepy%2Ckitty&redirect_uri=https%3A%2F%2Fwww.my-friends-cats.com%2Fredirect&state={$generatedState}&grant_options%5B%5D=",
            $returnUrl
        );
    }

    public function testBeginFunctionReturnsProperUrlForOnlineAccessWithNoLeadingSlashOnRedirectRoute()
    {
        $testCookieId = '';
        $returnUrl = OAuth::begin(
            'shopname',
            'redirect',
            true,
            function ($cookie) use (&$testCookieId) {
                $testCookieId = $cookie->getValue();
                return isset($testCookieId);
            }
        );
        $this->assertNotEmpty($testCookieId);

        $generatedState = Context::$SESSION_STORAGE->loadSession($testCookieId)->getState();
        $this->assertEquals(
            // phpcs:ignore
            "https://shopname.myshopify.com/admin/oauth/authorize?client_id=ash&scope=sleepy%2Ckitty&redirect_uri=https%3A%2F%2Fwww.my-friends-cats.com%2Fredirect&state={$generatedState}&grant_options%5B%5D=per-user",
            $returnUrl
        );
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
        $mockCookies = [OAuth::SESSION_ID_COOKIE_NAME => $this->oauthSessionId];

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
        $session = new Session(
            id: $this->oauthSessionId,
            shop: 'test-shop.myshopify.io',
            isOnline: $isOnline,
            state: '1234',
        );
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
        $session = new Session(
            id: $sessionId,
            shop: $this->domain,
            isOnline: $isOnline,
            state: '1234',
        );
        $session->setScope('read_products');
        $session->setAccessToken('some access token');

        if ($isOnline) {
            $session->setExpires(strtotime('+525600 seconds'));

            $onlineAccessInfo = new AccessTokenOnlineUserInfo(
                id: 1,
                firstName: 'John',
                lastName: 'Smith',
                email: 'john@example.com',
                emailVerified: true,
                accountOwner: true,
                locale: 'en',
                collaborator: true,
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
        return JWT::encode($payload, Context::$API_SECRET_KEY);
    }
}
