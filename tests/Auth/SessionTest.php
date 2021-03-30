<?php

declare(strict_types=1);

namespace ShopifyTest\Auth;

use DateTime;
use Shopify\Auth\AccessTokenOnlineUserInfo;
use Shopify\Auth\Session;
use ShopifyTest\BaseTestCase;

final class SessionTest extends BaseTestCase
{
    public function testSessionGetterAndSetterFunctions()
    {
        $session = new Session(
            id: '12345',
            shop: 'my-shop.myshopify.io',
            state: 'asdf1234',
            isOnline: true,
        );
        $session->setScope('read_products');
        $session->setExpires('January 25, 2021');
        $session->setAccessToken('24ssdf243u2ohfd21');

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

        $this->assertEquals('12345', $session->getId());
        $this->assertEquals('my-shop.myshopify.io', $session->getShop());
        $this->assertEquals('asdf1234', $session->getState());
        $this->assertEquals('read_products', $session->getScope());
        $this->assertEquals(new DateTime('January 25, 2021'), $session->getExpires());
        $this->assertEquals(true, $session->isOnline());
        $this->assertEquals('24ssdf243u2ohfd21', $session->getAccessToken());
        $this->assertEquals($onlineAccessInfo, $session->getOnlineAccessInfo());
    }

    public function testSetExpiresValues()
    {
        $date = new DateTime('@' . strtotime('+1 day'));
        $session = new Session(
            id: '12345',
            shop: 'my-shop.myshopify.io',
            state: 'asdf1234',
            isOnline: true,
        );

        $session->setExpires((int)$date->format('U'));
        $this->assertEquals($date, $session->getExpires());

        $session->setExpires($date->format('c'));
        $this->assertEquals($date, $session->getExpires());

        $session->setExpires($date);
        $this->assertEquals($date, $session->getExpires());
    }

    public function testClone()
    {
        $session = new Session(
            id: '12345',
            shop: 'my-shop.myshopify.io',
            state: 'asdf1234',
            isOnline: true,
        );
        $session->setScope('read_products');
        $session->setExpires('January 25, 2021');
        $session->setAccessToken('24ssdf243u2ohfd21');

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

        $newSession = $session->clone('54321');
        $this->assertNotEquals($session->getId(), $newSession->getId());
        $this->assertEquals($session->getShop(), $newSession->getShop());
        $this->assertEquals($session->getState(), $newSession->getState());
        $this->assertEquals($session->getScope(), $newSession->getScope());
        $this->assertEquals($session->isOnline(), $newSession->isOnline());
        $this->assertEquals($session->getExpires(), $newSession->getExpires());
        $this->assertEquals($session->getAccessToken(), $newSession->getAccessToken());
        $this->assertEquals($session->getOnlineAccessInfo(), $newSession->getOnlineAccessInfo());
    }
}
