<?php

declare(strict_types=1);

namespace ShopifyTest\Auth;

use Shopify\Auth\OAuth;
use Shopify\Auth\Session;
use Shopify\Auth\AccessTokenOnlineUserInfo;
use Shopify\Context;
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
                url: "https://test-shop.myshopify.io/admin/oauth/access_token",
                method: "POST",
                userAgent: "^Shopify Admin API Library for PHP v",
                headers: ['Content-Type: application/json'],
                body: json_encode($this->codeRequestBody),
                response: $this->buildMockHttpResponse(200, $isOnline ? $this->onlineResponse : $this->offlineResponse),
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

    public function validCallbackProvider()
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

        $mockCookies = [];
        $this->expectException('Shopify\Exception\OAuthCookieNotFoundException');
        OAuth::callback($mockCookies, []);
    }

    public function testCallbackFailsWithoutSession()
    {
        $this->createTestSession(false);

        $mockCookies = [OAuth::SESSION_ID_COOKIE_NAME => "👋 This is not the session you're looking for"];
        $this->expectException('Shopify\Exception\OAuthSessionNotFoundException');
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
        $this->expectException('Shopify\Exception\InvalidOAuthException');
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
        $this->expectException('Shopify\Exception\InvalidOAuthException');
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
        $this->expectException('Shopify\Exception\InvalidOAuthException');
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
        $this->expectException('Shopify\Exception\InvalidOAuthException');
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
        $this->expectException('Shopify\Exception\InvalidOAuthException');
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
        $this->expectException('Shopify\Exception\InvalidOAuthException');
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
        $this->expectException('Shopify\Exception\InvalidOAuthException');
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
        $this->expectException('Shopify\Exception\InvalidOAuthException');
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
        $this->expectException('Shopify\Exception\PrivateAppException');
        OAuth::callback($mockCookies, $mockQuery);
    }

    public function testThrowsIfSessionDeleteFails()
    {
        $storage = new MockSessionStorage();
        Context::$SESSION_STORAGE = $storage;

        $this->createTestSession(true);

        $this->mockTransportRequests([
            new MockRequest(
                url: "https://test-shop.myshopify.io/admin/oauth/access_token",
                method: "POST",
                userAgent: "^Shopify Admin API Library for PHP v",
                headers: ['Content-Type: application/json'],
                body: json_encode($this->codeRequestBody),
                response: $this->buildMockHttpResponse(200, $this->onlineResponse),
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
        $this->expectException('Shopify\Exception\SessionStorageException');

        OAuth::callback($mockCookies, $mockQuery);
    }

    public function testThrowsIfSessionStoreFails()
    {
        $storage = new MockSessionStorage();
        Context::$SESSION_STORAGE = $storage;

        $this->createTestSession(true);

        $this->mockTransportRequests([
            new MockRequest(
                url: "https://test-shop.myshopify.io/admin/oauth/access_token",
                method: "POST",
                userAgent: "^Shopify Admin API Library for PHP v",
                headers: ['Content-Type: application/json'],
                body: json_encode($this->codeRequestBody),
                response: $this->buildMockHttpResponse(200, $this->onlineResponse),
            ),
        ]);

        $mockCookies = [OAuth::SESSION_ID_COOKIE_NAME => $this->oauthSessionId];
        $mockQuery = [
            'shop' => $this->domain,
            'state' => '1234',
            'code' => 'real_code',
            'hmac' => '0b19b6077391191829e442a97aafd7730323041e585f738415a77894c41c0a5b',
        ];

        $storage->failNextCalls('store', amount: 1);
        $this->expectException('Shopify\Exception\SessionStorageException');

        OAuth::callback($mockCookies, $mockQuery);
    }

    public function testFailsIfTokenFetchFails()
    {
        $this->createTestSession(false);

        $this->mockTransportRequests([
            new MockRequest(
                url: "https://test-shop.myshopify.io/admin/oauth/access_token",
                method: "POST",
                userAgent: "^Shopify Admin API Library for PHP v",
                headers: ['Content-Type: application/json'],
                body: json_encode($this->codeRequestBody),
                response: $this->buildMockHttpResponse(500, ''),
            ),
        ]);

        $mockCookies = [OAuth::SESSION_ID_COOKIE_NAME => $this->oauthSessionId];
        $mockQuery = [
            'shop' => $this->domain,
            'state' => '1234',
            'code' => 'real_code',
            'hmac' => '0b19b6077391191829e442a97aafd7730323041e585f738415a77894c41c0a5b',
        ];
        $this->expectException('Shopify\Exception\HttpRequestException');
        OAuth::callback($mockCookies, $mockQuery);
    }

    public function testBeginFailsOnPrivateApp()
    {
        Context::$IS_PRIVATE_APP = true;

        $this->expectException('Shopify\Exception\PrivateAppException');
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

    public function testBeginFunctionReturnsProperUrlForOnlineAccess()
    {
        $testCookieId = '';
        $returnUrl = OAuth::begin(
            'shopname',
            '/redirect',
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
        $this->expectException('Shopify\Exception\CookieSetException');

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
        $this->expectException('Shopify\Exception\SessionStorageException');

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

    public function testGetCurrentSessionIdRaisesMissingArgumentException()
    {
        $oauth = new OAuth();
        $this->expectException(\Shopify\Exception\MissingArgumentException::class);
        $this->expectExceptionMessage(
            'Missing Authorization key in headers array'
        );

        $oauth->getCurrentSessionId(['auth'=> 'Bearer 123.456.789'], [], true);
    }

    public function testGetCurrentSessionIdRaisesAnotherMissingArgumentException()
    {
        $oauth = new OAuth();
        $this->expectException(\Shopify\Exception\MissingArgumentException::class);
        $this->expectExceptionMessage('Missing Bearer token in authorization header');

        $oauth->getCurrentSessionId(['Authorization'=> 'Bear 123.456.789'], [], true);
    }

    public function testGetCurrentSessionIdForOnlineShop()
    {
        $oauth = new OAuth();
        // phpcs:ignore
        $token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJodHRwczovL2V4YW1wbGVzaG9wLm15c2hvcGlmeS5jb20vYWRtaW4iLCJkZXN0IjoiaHR0cHM6Ly9leGFtcGxlc2hvcC5teXNob3BpZnkuY29tIiwiYXVkIjoiYXBpLWtleS0xMjMiLCJzdWIiOiI0MiIsImV4cCI6MjU5MTc2NTA1OCwibmJmIjoxNTkxNzY0OTk4LCJpYXQiOjE1OTE3NjQ5OTgsImp0aSI6ImY4OTEyMTI5LTFhZjYtNGNhZC05Y2EzLTc2YjBmNzYyMTA4NyIsInNpZCI6ImFhZWExODJmMjczMmQ0NGMyMzA1N2MwZmVhNTg0MDIxYTQ0ODViMmJkMjVkM2ViN2ZkMzQ5MzEzYWQyNGM2ODUifQ.x8DC5FvzbrBOFU8gFZTd84XPs1kvDrxON3p5vp86V1U';
        $headers = ['Authorization'=> "Bearer $token"];

        $currentSessionId = $oauth->getCurrentSessionId($headers, [], true);
        $this->assertEquals($currentSessionId, 'exampleshop.myshopify.com_42');
    }

    public function testGetCurrentSessionForOfflineShop()
    {
        $oauth = new OAuth();
        // phpcs:ignore
        $token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJodHRwczovL2V4YW1wbGVzaG9wLm15c2hvcGlmeS5jb20vYWRtaW4iLCJkZXN0IjoiaHR0cHM6Ly9leGFtcGxlc2hvcC5teXNob3BpZnkuY29tIiwiYXVkIjoiYXBpLWtleS0xMjMiLCJzdWIiOiI0MiIsImV4cCI6MjU5MTc2NTA1OCwibmJmIjoxNTkxNzY0OTk4LCJpYXQiOjE1OTE3NjQ5OTgsImp0aSI6ImY4OTEyMTI5LTFhZjYtNGNhZC05Y2EzLTc2YjBmNzYyMTA4NyIsInNpZCI6ImFhZWExODJmMjczMmQ0NGMyMzA1N2MwZmVhNTg0MDIxYTQ0ODViMmJkMjVkM2ViN2ZkMzQ5MzEzYWQyNGM2ODUifQ.x8DC5FvzbrBOFU8gFZTd84XPs1kvDrxON3p5vp86V1U';
        $headers = ['Authorization'=> "Bearer $token"];

        $currentSessionId = $oauth->getCurrentSessionId(
            $headers, [], false
        );
        $this->assertEquals($currentSessionId, 'offline_exampleshop.myshopify.com');
    }

    public function testGetCurrentSessionForEmbeddedAppMissingHeaders()
    {
        $oauth = new OAuth();
        $this->expectException(\Shopify\Exception\MissingArgumentException::class);
        $this->expectExceptionMessage(
            'Missing headers argument for embedded app'
        );
        $currentSessionId = $oauth->getCurrentSessionId(
            [], [], false
        );
        $this->assertEquals($currentSessionId, 'offline_exampleshop.myshopify.com');
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
            state: '1234',
            isOnline: $isOnline,
        );
        Context::$SESSION_STORAGE->storeSession($session);

        return $session;
    }

    /**
     * Creates a session with all the default expected values
     *
     * @param string $sessionId The id of the session
     * @param bool   $isOnline  Whether the expected session is online
     */
    private function buildExpectedSession(string $sessionId, bool $isOnline = true): Session
    {
        $session = new Session(
            id: $sessionId,
            shop: $this->domain,
            state: '1234',
            isOnline: $isOnline,
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
}
