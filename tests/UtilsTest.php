<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class UtilsTest extends TestCase
{
    public function testSanitizeShopDomainOnGoodShopDomains()
    {
        $this->assertEquals('my-shop.myshopify.com', Shopify\Utils::sanitizeShopDomain('my-shop'));
        $this->assertEquals('my-shop.myshopify.com', Shopify\Utils::sanitizeShopDomain('MY-SHOP'));
        $this->assertEquals('my-shop.myshopify.com', Shopify\Utils::sanitizeShopDomain('   My-ShOp   '));
        $this->assertEquals('my-shop.myshopify.com', Shopify\Utils::sanitizeShopDomain('my-shop.myshopify.com'));
        $this->assertEquals('my-shop.myshopify.com', Shopify\Utils::sanitizeShopDomain('http://my-shop.myshopify.com'));
        $this->assertEquals('my-shop.myshopify.com', Shopify\Utils::sanitizeShopDomain('https://my-shop.myshopify.com'));
    }

    public function testSanitizeShopDomainOnBadShopDomains()
    {
        $this->assertEquals(null, Shopify\Utils::sanitizeShopDomain('myshop.com'));
        $this->assertEquals(null, Shopify\Utils::sanitizeShopDomain('myshopify.com'));
        $this->assertEquals(null, Shopify\Utils::sanitizeShopDomain('shopify.com'));
        $this->assertEquals(null, Shopify\Utils::sanitizeShopDomain('my shop'));
        $this->assertEquals(null, Shopify\Utils::sanitizeShopDomain('store.myshopify.com.evil.com'));
        $this->assertEquals(null, Shopify\Utils::sanitizeShopDomain('/foo/bar'));
        $this->assertEquals(null, Shopify\Utils::sanitizeShopDomain('/foo.myshopify.io.evil.ru'));
        $this->assertEquals(null, Shopify\Utils::sanitizeShopDomain('%0a123.myshopify.io'));
        $this->assertEquals(null, Shopify\Utils::sanitizeShopDomain('foo.bar.myshopify.io'));
    }

    public function testSanitizeShopDomainOnCustomShopDomains()
    {
        $this->assertEquals('my-shop.myshopify.io', Shopify\Utils::sanitizeShopDomain('my-shop', 'myshopify.io'));
        $this->assertEquals('my-shop.myshopify.io', Shopify\Utils::sanitizeShopDomain('my-shop.myshopify.io', 'myshopify.io'));
        $this->assertEquals('my-shop.myshopify.io', Shopify\Utils::sanitizeShopDomain('http://my-shop.myshopify.io', 'myshopify.io'));
        $this->assertEquals('my-shop.myshopify.io', Shopify\Utils::sanitizeShopDomain('https://my-shop.myshopify.io', 'myshopify.io'));
        $this->assertEquals('my-shop.myshopify.io', Shopify\Utils::sanitizeShopDomain('https://my-shop.myshopify.io', 'myshopify.io'));
        $this->assertEquals('my-shop.myshopify.io', Shopify\Utils::sanitizeShopDomain(' MY-SHOP ', 'myshopify.io'));
    }

    public function testValidHmac()
    {
        $url = 'https://123456.ngrok.io/auth/shopify/callback?code=0907a61c0c8d55e99db179b68161bc00&hmac=654619d4b5a4f54795c3f40db18e4ed8b825f0abce16d1d75ab57e10c5e09490&shop=some-shop.myshopify.com&state=0.6784241404160823&timestamp=1337178173';
        $params = Shopify\Utils::getQueryParams($url);
        $this->assertEquals(false, Shopify\Utils::validateHmac(
            $params,
            'hush'
        ));
    }

    public function testInvalidHmac()
    {
        $url = 'https://123456.ngrok.io/auth/shopify/callback?code=0907a61c0c8d55e99db179b68161bc00&hmac=asdf&shop=some-shop.myshopify.com&state=0.6784241404160823&timestamp=1337178173';
        $params = Shopify\Utils::getQueryParams($url);
        $this->assertEquals(false, Shopify\Utils::validateHmac(
            $params,
            'asdf'
        ));
    }

    public function testGetQueryParams()
    {
        $params = array(
            "abc" => "def",
            "code" => 1234,
            "name" => "joe",
            "foo" => "bar"
        );
        $url = 'www.google.ca?abc=def&code=1234&name=joe&foo=bar';
        $this->assertEquals($params, Shopify\Utils::getQueryParams($url));
    }


    public function testGetNonexistentQueryParams()
    {
        $url = 'www.google.ca';
        $this->assertEquals(array(), Shopify\Utils::getQueryParams($url));
    }
}
