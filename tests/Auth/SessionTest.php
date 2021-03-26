<?php

declare(strict_types=1);

namespace ShopifyTest\Auth;

use DateTime;
use Shopify\Auth\Session;
use ShopifyTest\BaseTestCase;

final class SessionTest extends BaseTestCase
{
    public function testSessionGetterAndSetterFunctions()
    {
        $session = new Session('12345');
        $session->setShop('my-shop.myshopify.com');
        $session->setState('asdf1234');
        $session->setScope('read_products');
        $session->setExpires('January 25, 2021');
        $session->setIsOnline(true);
        $session->setAccessToken('24ssdf243u2ohfd21');

        $this->assertEquals('12345', $session->getId());
        $this->assertEquals('my-shop.myshopify.com', $session->getShop());
        $this->assertEquals('asdf1234', $session->getState());
        $this->assertEquals('read_products', $session->getScope());
        $this->assertEquals(new DateTime('January 25, 2021'), $session->getExpires());
        $this->assertEquals(true, $session->getIsOnline());
        $this->assertEquals('24ssdf243u2ohfd21', $session->getAccessToken());
    }

    public function testSessionDefaultValues()
    {
        $session = new Session('12345');
        $this->assertEquals(null, $session->getExpires());
        $this->assertEquals(false, $session->getIsOnline());
        $this->assertEquals(null, $session->getAccessToken());
    }

    public function testSetExpiresValues()
    {
        $date = new DateTime('@' . strtotime('+1 day'));
        $session = new Session('12345');

        $session->setExpires((int)$date->format('U'));
        $this->assertEquals($date, $session->getExpires());

        $session->setExpires($date->format('c'));
        $this->assertEquals($date, $session->getExpires());

        $session->setExpires($date);
        $this->assertEquals($date, $session->getExpires());
    }
}
