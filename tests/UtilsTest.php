<?php

declare(strict_types=1);

namespace ShopifyTest;

use DateTime;
use Firebase\JWT\JWT;
use Shopify\Context;
use Shopify\Utils;
use Shopify\Auth\OAuth;
use Shopify\Auth\Session;
use Shopify\Exception\SessionNotFoundException;
use ShopifyTest\Clients\MockRequest;

final class UtilsTest extends BaseTestCase
{
    public function testSanitizeShopDomainOnGoodShopDomains()
    {
        $this->assertEquals('my-shop.myshopify.com', Utils::sanitizeShopDomain('my-shop'));
        $this->assertEquals('my-shop.myshopify.com', Utils::sanitizeShopDomain('MY-SHOP'));
        $this->assertEquals('my-shop.myshopify.com', Utils::sanitizeShopDomain('   My-ShOp   '));
        $this->assertEquals('my-shop.myshopify.com', Utils::sanitizeShopDomain('my-shop.myshopify.com'));
        $this->assertEquals('my-shop.myshopify.com', Utils::sanitizeShopDomain('http://my-shop.myshopify.com'));
        $this->assertEquals('my-shop.myshopify.com', Utils::sanitizeShopDomain('https://my-shop.myshopify.com'));
    }

    public function testSanitizeShopDomainOnBadShopDomains()
    {
        $this->assertNull(Utils::sanitizeShopDomain('myshop.com'));
        $this->assertNull(Utils::sanitizeShopDomain('myshopify.com'));
        $this->assertNull(Utils::sanitizeShopDomain('shopify.com'));
        $this->assertNull(Utils::sanitizeShopDomain('my shop'));
        $this->assertNull(Utils::sanitizeShopDomain('store.myshopify.com.evil.com'));
        $this->assertNull(Utils::sanitizeShopDomain('/foo/bar'));
        $this->assertNull(Utils::sanitizeShopDomain('/foo.myshopify.io.evil.ru'));
        $this->assertNull(Utils::sanitizeShopDomain('%0a123.myshopify.io'));
        $this->assertNull(Utils::sanitizeShopDomain('foo.bar.myshopify.io'));
        $this->assertNull(Utils::sanitizeShopDomain('https://my-shop.myshopify.com', 'myshopify.io'));
    }

    public function testSanitizeShopDomainOnCustomShopDomains()
    {
        $this->assertEquals('my-shop.myshopify.io', Utils::sanitizeShopDomain('my-shop', 'myshopify.io'));
        $this->assertEquals('my-shop.myshopify.io', Utils::sanitizeShopDomain('my-shop.myshopify.io', 'myshopify.io'));
        $this->assertEquals('my-shop.myshopify.io', Utils::sanitizeShopDomain(
            'http://my-shop.myshopify.io',
            'myshopify.io'
        ));
        $this->assertEquals('my-shop.myshopify.io', Utils::sanitizeShopDomain(
            'https://my-shop.myshopify.io',
            'myshopify.io'
        ));
        $this->assertEquals('my-shop.myshopify.io', Utils::sanitizeShopDomain(
            'https://my-shop.myshopify.io',
            'myshopify.io'
        ));
        $this->assertEquals('my-shop.myshopify.io', Utils::sanitizeShopDomain(' MY-SHOP ', 'myshopify.io'));
    }

    /**
     * @dataProvider sanitizeShopWithCustomDomainsProvider
     */
    public function testSanitizeShopWithCustomDomains($domains, $test, $expected)
    {
        Context::$CUSTOM_SHOP_DOMAINS = $domains;

        $this->assertEquals($expected, Utils::sanitizeShopDomain($test));
    }

    public function sanitizeShopWithCustomDomainsProvider()
    {
        return [
            [
                ['*.special-domain-1.io', '.special-domain-2.io'],
                'my-shop.special-domain-1.io',
                'my-shop.special-domain-1.io'
            ],
            [
                ['*.special-domain-1.io', '.special-domain-2.io'],
                'my-shop.special-domain-2.io',
                'my-shop.special-domain-2.io'
            ],
            [['.special-domain-1.io'], 'my-shop.special-domain-1.io', 'my-shop.special-domain-1.io'],
            [['special-domain-1.io'], 'my-shop.special-domain-1.io', 'my-shop.special-domain-1.io'],
            [['*.special-domain-1.io', '.special-domain-2.io'], 'my-shop.special-domain-3.io', null],
        ];
    }

    public function testValidHmac()
    {
        // phpcs:ignore
        $url = 'https://123456.ngrok.io/auth/shopify/callback?code=0907a61c0c8d55e99db179b68161bc00&&shop=some-shop.myshopify.com&state=0.6784241404160823&timestamp=1337178173';
        $params = Utils::getQueryParams($url);
        $secret = 'test-secret';
        $params['hmac'] = hash_hmac('sha256', http_build_query($params), $secret);

        $this->assertEquals(true, Utils::validateHmac(
            $params,
            $secret
        ));
    }

    public function testInvalidHmac()
    {
        // phpcs:ignore
        $url = 'https://123456.ngrok.io/auth/shopify/callback?code=0907a61c0c8d55e99db179b68161bc00&&shop=some-shop.myshopify.com&state=0.6784241404160823&timestamp=1337178173';
        $params = Utils::getQueryParams($url);
        $secret = 'test-secret';
        $params['hmac'] = hash_hmac('sha256', http_build_query($params), $secret);

        // Check with a wrong secret
        $this->assertEquals(false, Utils::validateHmac(
            $params,
            $secret . 'wrong'
        ));

        // Check with the correct secret but with an altered request
        $params['foo'] = 'bar';
        $this->assertEquals(false, Utils::validateHmac(
            $params,
            $secret
        ));
    }

    public function testGetValidQueryParams()
    {
        $params = [
            "abc" => "def",
            "code" => 1234,
            "name" => "joe",
            "foo" => "bar"
        ];
        $this->assertEquals($params, Utils::getQueryParams('www.google.ca?abc=def&code=1234&name=joe&foo=bar'));
    }

    public function testGetBadQueryParams()
    {
        $this->assertEquals([], Utils::getQueryParams('google'));
        $this->assertEquals([], Utils::getQueryParams('www.google.ca'));
        $this->assertEquals(['asdf' => ''], Utils::getQueryParams('www.google.ca?asdf'));
    }

    public function testIsApiVersionCompatible()
    {
        Context::$API_VERSION = 'unstable';
        $this->assertTrue(Utils::isApiVersionCompatible('2020-10'));

        Context::$API_VERSION = 'unversioned';
        $this->assertTrue(Utils::isApiVersionCompatible('2020-10'));

        Context::$API_VERSION = '2021-04';
        $this->assertTrue(Utils::isApiVersionCompatible('2021-04'));
        $this->assertTrue(Utils::isApiVersionCompatible('2020-10'));
        $this->assertFalse(Utils::isApiVersionCompatible('2021-07'));

        $this->expectException(\Shopify\Exception\InvalidArgumentException::class);
        $this->assertTrue(Utils::isApiVersionCompatible('not_a_version'));
    }

    public function testGetOfflineSessionReturnsSession()
    {
        $offlineSession = new Session("offline_$this->domain", $this->domain, false, 'state');
        $offlineSession->setScope(Context::$SCOPES->toString());
        $offlineSession->setAccessToken('vatican_cameos');
        Context::$SESSION_STORAGE->storeSession($offlineSession);

        $this->assertEquals($offlineSession, Utils::loadOfflineSession($this->domain));
    }

    public function testGetOfflineSessionWithExpiredReturnsSession()
    {
        $offlineSession = new Session("offline_$this->domain", $this->domain, false, 'state');
        $offlineSession->setScope(Context::$SCOPES->toString());
        $offlineSession->setAccessToken('vatican_cameos');
        $offlineSession->setExpires(new DateTime());
        Context::$SESSION_STORAGE->storeSession($offlineSession);

        $this->assertEquals($offlineSession, Utils::loadOfflineSession($this->domain, true));
    }

    public function testGetOfflineSessionReturnsNullIfNoSession()
    {
        $this->assertNull(Utils::loadOfflineSession($this->domain, true));

        new Session("offline_$this->domain", $this->domain, false, 'state');
        $this->assertNull(Utils::loadOfflineSession($this->domain));
    }

    public function testGetOfflineSessionReturnsNullIfSessionIsExpired()
    {
        $offlineSession = new Session("offline_$this->domain", $this->domain, false, 'state');
        $offlineSession->setScope(Context::$SCOPES->toString());
        $offlineSession->setAccessToken('vatican_cameos');
        $offlineSession->setExpires(new \DateTime());
        Context::$SESSION_STORAGE->storeSession($offlineSession);

        $this->assertNull(Utils::loadOfflineSession($this->domain, false));
    }

    public function testLoadCurrentSession()
    {
        $token = $this->encodeJwtPayload();
        $headers = ['Authorization' => "Bearer $token"];
        $sessionId = 'exampleshop.myshopify.com_42';
        $session = new Session($sessionId, 'test-shop.myshopify.io', true, '1234');

        $this->assertTrue(Context::$SESSION_STORAGE->storeSession($session));
        $this->assertEquals($session, Context::$SESSION_STORAGE->loadSession('exampleshop.myshopify.com_42'));

        $currentSession = Utils::loadCurrentSession($headers, [], true);
        $this->assertEquals($currentSession, $session);
    }

    public function testDecodeSessionToken()
    {
        $payload = [
            'iss' => 'test-shop.myshopify.io/admin',
            'dest' => 'test-shop.myshopify.io',
            'aud' => Context::$API_KEY,
            'sub' => '1',
            'exp' => strtotime('+5 minutes'),
            'nbf' => 1234,
            'iat' => 1234,
            'jti' => '4321',
            'sid' => 'abc123'
        ];
        $jwt = JWT::encode($payload, Context::$API_SECRET_KEY, 'HS256');
        $actualPayload = Utils::decodeSessionToken($jwt);
        $this->assertEquals($payload, $actualPayload);
    }

    public function testDecodeExpiredSessionTokenFails()
    {
        $payload = [
            'iss' => 'test-shop.myshopify.io/admin',
            'dest' => 'test-shop.myshopify.io',
            'aud' => Context::$API_KEY,
            'sub' => '1',
            'exp' => strtotime('-7 seconds'),
            'nbf' => 1234,
            'iat' => 1234,
            'jti' => '4321',
            'sid' => 'abc123'
        ];
        $jwt = JWT::encode($payload, Context::$API_SECRET_KEY, 'HS256');

        // Within leeway period - should still work
        $actualPayload = Utils::decodeSessionToken($jwt);
        $this->assertEquals($payload, $actualPayload);

        $payload['exp'] = strtotime('-1 minute');
        $jwt = JWT::encode($payload, Context::$API_SECRET_KEY, 'HS256');

        // Outside of leeway period - should throw an exception
        $this->expectException(\Firebase\JWT\ExpiredException::class);
        Utils::decodeSessionToken($jwt);
    }

    public function testGraphqlProxyFailsWithNoSession()
    {
        $token = $this->encodeJwtPayload();
        $headers = ['Authorization' => "Bearer $token"];

        $this->expectException(SessionNotFoundException::class);
        Utils::graphqlProxy($headers, [], $this->testGraphqlQuery);
    }

    public function testGraphqlProxyFailsWithJWTForNonEmbeddedApps()
    {
        $sessionId = 'exampleshop.myshopify.com_42';
        $session = new Session($sessionId, 'test-shop.myshopify.io', true, '1234');
        $session->setAccessToken('token');

        $this->assertTrue(Context::$SESSION_STORAGE->storeSession($session));

        $token = $this->encodeJwtPayload();
        $headers = ['Authorization' => "Bearer $token"];
        $cookies = [
            OAuth::SESSION_ID_SIG_COOKIE_NAME => hash_hmac('sha256', 'cookie_id', Context::$API_SECRET_KEY),
            OAuth::SESSION_ID_COOKIE_NAME => 'cookie_id',
        ];

        // The session is valid and can be loaded from the headers
        Context::$IS_EMBEDDED_APP = true;
        $this->assertEquals($session, Utils::loadCurrentSession($headers, [], true));

        Context::$IS_EMBEDDED_APP = false;
        $this->expectException(SessionNotFoundException::class);
        Utils::graphqlProxy([], $cookies, $this->testGraphqlQuery);
    }

    public function testGraphqlProxyFailsWithCookiesForEmbeddedApps()
    {
        $sessionId = 'cookie_id';
        $session = new Session($sessionId, 'test-shop.myshopify.io', true, '1234');
        $session->setAccessToken('token');

        $this->assertTrue(Context::$SESSION_STORAGE->storeSession($session));

        $token = $this->encodeJwtPayload();
        $headers = ['Authorization' => "Bearer $token"];
        $cookies = [
            OAuth::SESSION_ID_SIG_COOKIE_NAME => hash_hmac('sha256', 'cookie_id', Context::$API_SECRET_KEY),
            OAuth::SESSION_ID_COOKIE_NAME => 'cookie_id',
        ];

        // The session is valid and can be loaded from the cookies
        Context::$IS_EMBEDDED_APP = false;
        $this->assertEquals($session, Utils::loadCurrentSession([], $cookies, true));

        Context::$IS_EMBEDDED_APP = true;
        $this->expectException(SessionNotFoundException::class);
        Utils::graphqlProxy($headers, [], $this->testGraphqlQuery);
    }

    public function testGraphqlProxyFetchesDataWithJWT()
    {
        Context::$IS_EMBEDDED_APP = true;

        $sessionId = 'exampleshop.myshopify.com_42';
        $session = new Session($sessionId, 'test-shop.myshopify.io', true, '1234');
        $session->setAccessToken('token');

        $this->assertTrue(Context::$SESSION_STORAGE->storeSession($session));
        $this->assertEquals($session, Context::$SESSION_STORAGE->loadSession('exampleshop.myshopify.com_42'));

        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, $this->testGraphqlResponse),
                "https://$this->domain/admin/api/" . Context::$API_VERSION . '/graphql.json',
                'POST',
                null,
                [
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($this->testGraphqlQuery),
                    'X-Shopify-Access-Token: token',
                ],
                $this->testGraphqlQuery,
            )
        ]);

        $token = $this->encodeJwtPayload();
        $headers = ['Authorization' => "Bearer $token"];
        $response = Utils::graphqlProxy($headers, [], $this->testGraphqlQuery);

        $this->assertThat($response, new HttpResponseMatcher(200, [], $this->testGraphqlResponse));
    }

    public function testGraphqlProxyFetchesDataWithCookies()
    {
        Context::$IS_EMBEDDED_APP = false;

        $sessionId = 'exampleshop.myshopify.com_42';
        $session = new Session($sessionId, 'test-shop.myshopify.io', true, '1234');
        $session->setAccessToken('token');

        $this->assertTrue(Context::$SESSION_STORAGE->storeSession($session));
        $this->assertEquals($session, Context::$SESSION_STORAGE->loadSession('exampleshop.myshopify.com_42'));

        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, $this->testGraphqlResponse),
                "https://$this->domain/admin/api/" . Context::$API_VERSION . '/graphql.json',
                'POST',
                null,
                [
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($this->testGraphqlQuery),
                    'X-Shopify-Access-Token: token',
                ],
                $this->testGraphqlQuery,
            )
        ]);

        $cookies = [
            OAuth::SESSION_ID_COOKIE_NAME => $sessionId,
            OAuth::SESSION_ID_SIG_COOKIE_NAME => hash_hmac('sha256', $sessionId, Context::$API_SECRET_KEY),
        ];
        $response = Utils::graphqlProxy([], $cookies, $this->testGraphqlQuery);

        $this->assertThat($response, new HttpResponseMatcher(200, [], $this->testGraphqlResponse));
    }

    public function testGetEmbeddedAppUrlThrowsOnEmptyHost()
    {
        $this->expectException(\Shopify\Exception\InvalidArgumentException::class);
        Utils::getEmbeddedAppUrl("");
    }

    public function testGetEmbeddedAppUrlThrowsOnInvalidHost()
    {
        $this->expectException(\Shopify\Exception\InvalidArgumentException::class);
        Utils::getEmbeddedAppUrl("!@#$%^&*()");
    }

    public function testGetEmbeddedAppUrlReturnsTheCorrectURL()
    {
        Context::$API_KEY = "my-app-key";
        $url = "my-app-url.io/path";

        $this->assertEquals("https://$url/apps/my-app-key", Utils::getEmbeddedAppUrl(base64_encode($url)));
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

    /** @var string */
    private $testGraphqlQuery = <<<QUERY
    {
      shop {
        name
      }
    }
    QUERY;

    /** @var array */
    private $testGraphqlResponse = [
        "data" => [
            "shop" => [
                "name" => "Shoppity Shop",
            ],
        ],
    ];
}
