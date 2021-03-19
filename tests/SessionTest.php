<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class SessionTest extends TestCase
{
    public function testSessionFunctions()
    {
        $session = new Shopify\Session('my-shop.myshopify.com', '12345');
        $this->assertEquals('my-shop.myshopify.com', $session->getShop());
        $this->assertEquals('12345', $session->getAccessToken());
    }
}
