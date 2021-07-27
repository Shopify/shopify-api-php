<?php

declare(strict_types=1);

namespace ShopifyTest\Auth;

use Shopify\Auth\OAuthCookie;
use ShopifyTest\BaseTestCase;

final class OAuthCookieTest extends BaseTestCase
{
    public function testGetters()
    {
        $cookie = new OAuthCookie('Test value', 'Test cookie', 1234, true, true);
        $this->assertEquals('Test cookie', $cookie->getName());
        $this->assertEquals('Test value', $cookie->getValue());
        $this->assertEquals(1234, $cookie->getExpire());
        $this->assertTrue($cookie->isSecure());
        $this->assertTrue($cookie->isHttpOnly());
    }
}
