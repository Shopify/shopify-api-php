<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use DateTime;

final class SessionTest extends TestCase
{
    public function testSessionFunctions()
    {
        $session = new Shopify\Session('12345');
        $session->setShop('my-shop.myshopify.com');
        $session->setState('asdf1234');
        $session->setScope('read_products');
        $session->setExpires('January 25, 2021');
        $session->setIsOnline(true);
        $session->setAccessToken('24ssdf243u2ohfd21');
        $this->assertEquals('my-shop.myshopify.com', $session->getShop());
        $this->assertEquals('asdf1234', $session->getState());
        $this->assertEquals('read_products', $session->getScope());
        $this->assertEquals(new DateTime('January 25, 2021'), $session->getExpires());
        $this->assertEquals(true, $session->getIsOnline());
        $this->assertEquals('24ssdf243u2ohfd21', $session->getAccessToken());
    }
}
