<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class UtilsTest extends TestCase
{
    public function testValidShops()
    {
        $this->assertEquals(true, Shopify\Utils::validateShopDomain('example.myshopify.com'));
        $this->assertEquals(true, Shopify\Utils::validateShopDomain('asdf.myshopify.com'));
    }

    public function testInvalidShops()
    {
        $this->assertEquals(false, Shopify\Utils::validateShopDomain('myshopify.com'));
        $this->assertEquals(false, Shopify\Utils::validateShopDomain('.myshopify.com'));
        $this->assertEquals(false, Shopify\Utils::validateShopDomain('@#$%.myshopify.com'));
    }

    public function testInvalidHmac()
    {
        $callbackUrl = 'https://123456.ngrok.io/auth/shopify/callback?code=0907a61c0c8d55e99db179b68161bc00&hmac=654619d4b5a4f54795c3f40db18e4ed8b825f0abce16d1d75ab57e10c5e09490&shop=some-shop.myshopify.com&state=0.6784241404160823&timestamp=1337178173';
        var_dump(parse_str(parse_url($callbackUrl, PHP_URL_QUERY), $params));
        $this->assertEquals(false, Shopify\Utils::validateHmac(
            $params,
            'hush'
        ));
    }
}
