<?php

declare(strict_types=1);

namespace ShopifyTest\Auth;

use DateTime;
use Shopify\Auth\AccessTokenOnlineUserInfo;
use Shopify\Auth\Scopes;
use Shopify\Auth\Session;
use Shopify\Context;
use ShopifyTest\BaseTestCase;

final class SessionTest extends BaseTestCase
{
    public function testSessionGetterAndSetterFunctions()
    {
        $session = new Session('12345', 'my-shop.myshopify.io', true, 'asdf1234');
        $session->setScope('read_products');
        $session->setExpires('January 25, 2021');
        $session->setAccessToken('24ssdf243u2ohfd21');

        $onlineAccessInfo = new AccessTokenOnlineUserInfo(
            1,
            'John',
            'Smith',
            'john@example.com',
            true,
            true,
            'en',
            true,
        );
        $session->setOnlineAccessInfo($onlineAccessInfo);

        $this->assertEquals('12345', $session->getId());
        $this->assertEquals('my-shop.myshopify.io', $session->getShop());
        $this->assertEquals('asdf1234', $session->getState());
        $this->assertEquals('read_products', $session->getScope());
        $this->assertEquals('2021-01-25', $session->getExpires()->format('Y-m-d'));
        $this->assertTrue($session->isOnline());
        $this->assertEquals('24ssdf243u2ohfd21', $session->getAccessToken());
        $this->assertEquals($onlineAccessInfo, $session->getOnlineAccessInfo());
    }

    public function testSetExpiresValues()
    {
        $date = new DateTime('@' . strtotime('+1 day'));
        $session = new Session('12345', 'my-shop.myshopify.io', true, 'asdf1234');

        $session->setExpires((int)$date->format('U'));
        $this->assertEquals($date, $session->getExpires());

        $session->setExpires($date->format('c'));
        $this->assertEquals($date, $session->getExpires());

        $session->setExpires($date);
        $this->assertEquals($date, $session->getExpires());
    }

    public function testClone()
    {
        $session = new Session('12345', 'my-shop.myshopify.io', true, 'asdf1234');
        $session->setScope('read_products');
        $session->setExpires('January 25, 2021');
        $session->setAccessToken('24ssdf243u2ohfd21');

        $onlineAccessInfo = new AccessTokenOnlineUserInfo(
            1,
            'John',
            'Smith',
            'john@example.com',
            true,
            true,
            'en',
            true,
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

    public function testIsValidReturnsTrue()
    {
        Context::$SCOPES = new Scopes('read_products');

        $session = new Session('12345', 'my-shop.myshopify.io', true, '1234');
        $session->setScope('read_products');
        $session->setExpires(strtotime('+10 minutes'));
        $session->setAccessToken('totally_real_token');

        $this->assertTrue($session->isValid());
    }

    public function testIsValidReturnsFalseIfScopesHaveChanged()
    {
        Context::$SCOPES = new Scopes('read_products,write_orders');

        $session = new Session('12345', 'my-shop.myshopify.io', true, '1234');
        $session->setScope('read_products');
        $session->setExpires(strtotime('+10 minutes'));
        $session->setAccessToken('totally_real_token');

        $this->assertFalse($session->isValid());
    }

    public function testIsValidReturnsFalseIfExpired()
    {
        Context::$SCOPES = new Scopes('read_products');

        $session = new Session('12345', 'my-shop.myshopify.io', true, '1234');
        $session->setScope('read_products');
        $session->setExpires(strtotime('-10 minutes'));
        $session->setAccessToken('totally_real_token');

        $this->assertFalse($session->isValid());
    }

    public function testIsValidReturnsFalseIfNoAccessToken()
    {
        Context::$SCOPES = new Scopes('read_products');

        $session = new Session('12345', 'my-shop.myshopify.io', true, '1234');
        $session->setScope('read_products');
        $session->setExpires(strtotime('+10 minutes'));

        $this->assertFalse($session->isValid());
    }
}
