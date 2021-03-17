<?php

declare(strict_types=1);
require_once("./src/utils/shopValidator.php");
use PHPUnit\Framework\TestCase;
use function Shopify\Utils\validateShopDomain;

final class ShopValidatorTest extends TestCase
{
    public function testValidShops()
    {
        $this->assertEquals(true, validateShopDomain('example.myshopify.com'));
    }
}
