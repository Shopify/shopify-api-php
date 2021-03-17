<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class ShopValidatorTest extends TestCase
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
}
