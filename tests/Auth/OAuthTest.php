<?php

declare(strict_types=1);

namespace ShopifyTest\Auth;

use Shopify\Auth\OAuth;
use Shopify\Auth\Session;
use Shopify\Auth\AccessTokenOnlineUserInfo;
use Shopify\Auth\OAuthCookie;
use PHPUnit\Framework\MockObject\MockObject;
use Shopify\Context;
use ShopifyTest\BaseTestCase;
use Ramsey\Uuid\Uuid;

final class OAuthTest extends BaseTestCase
{
    private string $oauthSessionId = 'test_oauth_session';
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

        $mockedOAuth = $this->prepareOAuthMock($isOnline);

        $mockCookies = [OAuth::SESSION_ID_COOKIE_NAME => $this->oauthSessionId];
        $mockQuery = [
            'shop' => $this->domain,
            'state' => '1234',
            'code' => 'real_code',
            'hmac' => '0b19b6077391191829e442a97aafd7730323041e585f738415a77894c41c0a5b',
        ];
        $mockedOAuth->callback($mockCookies, $mockQuery);
        $this->assertHttpRequest("{$this->domain}/" . OAuth::ACCESS_TOKEN_POST_PATH, [CURLOPT_POST => true]);

        $jwtSessionId = $mockedOAuth->getJwtSessionId($this->domain, '1');

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
        $oauth = new OAuth();
        $oauth->callback($mockCookies, []);
    }

    public function testCallbackFailsWithoutSession()
    {
        $this->createTestSession(false);

        $mockCookies = [OAuth::SESSION_ID_COOKIE_NAME => "👋 This is not the session you're looking for"];
        $this->expectException('Shopify\Exception\OAuthSessionNotFoundException');
        $oauth = new OAuth();
        $oauth->callback($mockCookies, []);
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
        $oauth = new OAuth();
        $oauth->callback($mockCookies, $mockQuery);
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
        $oauth = new OAuth();
        $oauth->callback($mockCookies, $mockQuery);
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
        $oauth = new OAuth();
        $oauth->callback($mockCookies, $mockQuery);
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
        $oauth = new OAuth();
        $oauth->callback($mockCookies, $mockQuery);
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
        $oauth = new OAuth();
        $oauth->callback($mockCookies, $mockQuery);
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
        $oauth = new OAuth();
        $oauth->callback($mockCookies, $mockQuery);
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
        $oauth = new OAuth();
        $oauth->callback($mockCookies, $mockQuery);
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
        $oauth = new OAuth();
        $oauth->callback($mockCookies, $mockQuery);
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
        $oauth = new OAuth();
        $oauth->callback($mockCookies, $mockQuery);
    }

    public function testThrowsIfSessionDeleteFails()
    {
        $storage = new MockSessionStorage();
        Context::$SESSION_STORAGE = $storage;
        Context::$IS_EMBEDDED_APP = true;

        $this->createTestSession(true);

        $mockedOAuth = $this->prepareOAuthMock(true);

        $mockCookies = [OAuth::SESSION_ID_COOKIE_NAME => $this->oauthSessionId];
        $mockQuery = [
            'shop' => $this->domain,
            'state' => '1234',
            'code' => 'real_code',
            'hmac' => '0b19b6077391191829e442a97aafd7730323041e585f738415a77894c41c0a5b',
        ];

        $storage->failNextCalls('delete');
        $this->expectException('Shopify\Exception\SessionStorageException');

        $mockedOAuth->callback($mockCookies, $mockQuery);
        $this->assertHttpRequest("{$this->domain}/" . OAuth::ACCESS_TOKEN_POST_PATH, [CURLOPT_POST => true]);
    }

    public function testThrowsIfSessionStoreFails()
    {
        $storage = new MockSessionStorage();
        Context::$SESSION_STORAGE = $storage;
        Context::$IS_EMBEDDED_APP = true;

        $this->createTestSession(true);

        $mockedOAuth = $this->prepareOAuthMock(true);

        $mockCookies = [OAuth::SESSION_ID_COOKIE_NAME => $this->oauthSessionId];
        $mockQuery = [
            'shop' => $this->domain,
            'state' => '1234',
            'code' => 'real_code',
            'hmac' => '0b19b6077391191829e442a97aafd7730323041e585f738415a77894c41c0a5b',
        ];

        $storage->failNextCalls('store', amount: 1);
        $this->expectException('Shopify\Exception\SessionStorageException');

        $mockedOAuth->callback($mockCookies, $mockQuery);
        $this->assertHttpRequest("{$this->domain}/" . OAuth::ACCESS_TOKEN_POST_PATH, [CURLOPT_POST => true]);
    }

    public function testFailsIfTokenFetchFails()
    {
        $this->createTestSession(false);

        $mockedOAuth = $this->prepareOAuthMock(failRequest: true);

        $mockCookies = [OAuth::SESSION_ID_COOKIE_NAME => $this->oauthSessionId];
        $mockQuery = [
            'shop' => $this->domain,
            'state' => '1234',
            'code' => 'real_code',
            'hmac' => '0b19b6077391191829e442a97aafd7730323041e585f738415a77894c41c0a5b',
        ];
        $this->expectException('Shopify\Exception\HttpRequestException');
        $mockedOAuth->callback($mockCookies, $mockQuery);
        $this->assertHttpRequest("{$this->domain}/" . OAuth::ACCESS_TOKEN_POST_PATH, [CURLOPT_POST => true]);
    }

    public function testBeginFailsOnPrivateApp(){
        Context::$IS_PRIVATE_APP = true;

        $this->expectException('Shopify\Exception\PrivateAppException');
        $oauth = new OAuth();
        $oauth->begin('shopname', '/redirect', true);
    }

    public function testBeginFunctionReturnSProperUrlForOfflineAccess(){
        $oauth = new OAuth();

        $wasCallbackCalled = false;
        $returnUrl = $oauth->begin(
            'shopname',
            '/redirect',
            false,
            function () use (&$wasCallbackCalled) {
                $wasCallbackCalled = true;
                return true;
            }
        );
        $this->assertTrue($wasCallbackCalled);
        $mySessionId = 'offline_shopname';
        $generatedState = Context::$SESSION_STORAGE->loadSession($mySessionId)->getState();
        $this->assertEquals(
            "https://shopname/admin/oauth/authorize?client_id=ash&scope=sleepy%2Ckitty&redirect_uri=https%3A%2F%2Fwww.my-friends-cats.com%2Fredirect&state={$generatedState}&grant_options%5B%5D=",
            $returnUrl
        );
    }

    public function testBeginFunctionReturnSProperUrlForOnlineAccess(){
        $oauth = new OAuth();
        $this->cookie = new OAuthCookie(
            name: 'shopify_session_id',
            value: Uuid::uuid4()->toString(),
            expire: strtotime('+1 minute'),
            secure: true,
            httpOnly: true
        );

        $returnUrl = $oauth->begin(
            'shopname',
            '/redirect',
            true,
            function ($cookie) use (&$testCookieId) {
                $testCookieId = $cookie->getValue();
                return isset($testCookieId);
            }
        );
        $this->assertTrue(isset($testCookieId));

        $generatedState = Context::$SESSION_STORAGE->loadSession($testCookieId)->getState();
        $this->assertEquals(
            "https://shopname/admin/oauth/authorize?client_id=ash&scope=sleepy%2Ckitty&redirect_uri=https%3A%2F%2Fwww.my-friends-cats.com%2Fredirect&state={$generatedState}&grant_options%5B%5D=per-user",
            $returnUrl
        );
    }

    public function testBeginRaisesErrorIfCookieNotSet(){
        $oauth = new OAuth();
        $this->expectException('Shopify\Exception\CookieSetException');

        $wasCallbackCalled = false;
        $oauth->begin(
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

    public function testBeginWithoutsetCookieFunction(){
        $oauth = new OAuth();
        $storage = new MockSessionStorage();
        Context::$SESSION_STORAGE = $storage;
        $storage->failNextCalls('store');
        $this->expectException('Shopify\Exception\SessionStorageException');

        $returnUrl = $oauth->begin(
            'shopname',
            '/redirect',
            false,
            function() {return true;}
        );
        $mySessionId = 'offline_shopname';
        $generatedState = Context::$SESSION_STORAGE->loadSession($mySessionId)->getState();
        $this->assertEquals(
            "https://shopname/admin/oauth/authorize?client_id=ash&scope=sleepy%2Ckitty&redirect_uri=https%3A%2F%2Fwww.my-friends-cats.com%2Fredirect&state={$generatedState}&grant_options%5B%5D=",
            $returnUrl
        );
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
     * Creates an OAuth object which is stubbed to not make real HTTP requests
     *
     * @param bool $isOnline    Whether the expected session is online
     * @param bool $failRequest Whether the access token fetch request should fail
     */
    private function prepareOAuthMock(bool $isOnline = true, bool $failRequest = false): OAuth
    {
        if ($failRequest) {
            $mockResponse = $this->buildMockHttpResponse(500, '');
        } else {
            $mockResponse = $this->buildMockHttpResponse(
                200,
                $isOnline ? $this->onlineResponse : $this->offlineResponse
            );
        }
        $mockClient = $this->getHttpClientWithMocks([$mockResponse]);

        /** @var MockObject|OAuth */
        $mockedOAuth = $this->getMockBuilder(OAuth::class)
            ->onlyMethods(['requestAccessToken'])
            ->getMock();

        $mockedOAuth->expects($this->once())
            ->method('requestAccessToken')
            ->with($this->anything(), $this->anything())
            ->willReturnCallback(function ($realClient, $body) use ($mockClient) {
                return $mockClient->post(path: OAuth::ACCESS_TOKEN_POST_PATH, body: $body);
            });

        return $mockedOAuth;
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
