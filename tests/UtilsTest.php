<?php

declare(strict_types=1);

namespace ShopifyTest;

use DateTime;
use Firebase\JWT\JWT;
use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Utils;

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
        $this->assertEquals(null, Utils::sanitizeShopDomain('myshop.com'));
        $this->assertEquals(null, Utils::sanitizeShopDomain('myshopify.com'));
        $this->assertEquals(null, Utils::sanitizeShopDomain('shopify.com'));
        $this->assertEquals(null, Utils::sanitizeShopDomain('my shop'));
        $this->assertEquals(null, Utils::sanitizeShopDomain('store.myshopify.com.evil.com'));
        $this->assertEquals(null, Utils::sanitizeShopDomain('/foo/bar'));
        $this->assertEquals(null, Utils::sanitizeShopDomain('/foo.myshopify.io.evil.ru'));
        $this->assertEquals(null, Utils::sanitizeShopDomain('%0a123.myshopify.io'));
        $this->assertEquals(null, Utils::sanitizeShopDomain('foo.bar.myshopify.io'));
        $this->assertEquals(null, Utils::sanitizeShopDomain('https://my-shop.myshopify.com', 'myshopify.io'));
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

    public function testValidHmac()
    {
        // phpcs:ignore
        $url = 'https://123456.ngrok.io/auth/shopify/callback?code=0907a61c0c8d55e99db179b68161bc00&hmac=654619d4b5a4f54795c3f40db18e4ed8b825f0abce16d1d75ab57e10c5e09490&shop=some-shop.myshopify.com&state=0.6784241404160823&timestamp=1337178173';
        $params = Utils::getQueryParams($url);
        $this->assertEquals(false, Utils::validateHmac(
            $params,
            'hush'
        ));
    }

    public function testInvalidHmac()
    {
        // phpcs:ignore
        $url = 'https://123456.ngrok.io/auth/shopify/callback?code=0907a61c0c8d55e99db179b68161bc00&hmac=asdf&shop=some-shop.myshopify.com&state=0.6784241404160823&timestamp=1337178173';
        $params = Utils::getQueryParams($url);
        $this->assertEquals(false, Utils::validateHmac(
            $params,
            'asdf'
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

        $this->expectException('Shopify\\Exception\\InvalidArgumentException');
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

        $this->assertNull(Utils::loadOfflineSession($this->domain, includeExpired: false));
    }

    public function testLoadCurrentSession()
    {
        $token = $this->encodeJwtPayload();
        $headers = ['Authorization' => "Bearer $token"];
        $sessionId = 'exampleshop.myshopify.com_42';
        $session = new Session(
            id: $sessionId,
            shop: 'test-shop.myshopify.io',
            isOnline: true,
            state: '1234',
        );

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
        $jwt = JWT::encode($payload, Context::$API_SECRET_KEY);
        $actualPayload = Utils::decodeSessionToken($jwt);
        $this->assertEquals($payload, $actualPayload);
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
