<?php

declare(strict_types=1);

namespace ShopifyTest\Auth;

use Shopify\Auth\AccessTokenOnlineResponse;
use Shopify\Auth\AccessTokenOnlineUserInfo;
use ShopifyTest\BaseTestCase;

final class AccessTokenOnlineResponseTest extends BaseTestCase
{
    public function testGetters()
    {
        $user = new AccessTokenOnlineUserInfo(1234, 'John', 'Doe', 'john.doe@nowhere', true, true, 'en', true);
        $this->assertEquals(1234, $user->getId());
        $this->assertEquals('John', $user->getFirstName());
        $this->assertEquals('Doe', $user->getLastName());
        $this->assertEquals('john.doe@nowhere', $user->getEmail());
        $this->assertTrue($user->isEmailVerified());
        $this->assertTrue($user->isAccountOwner());
        $this->assertEquals('en', $user->getLocale());
        $this->assertTrue($user->isCollaborator());

        $response = new AccessTokenOnlineResponse('test_token', 'test_scope', 1234, 'user_scope', $user);
        $this->assertEquals('test_token', $response->getAccessToken());
        $this->assertEquals('test_scope', $response->getScope());
        $this->assertEquals(1234, $response->getExpiresIn());
        $this->assertEquals('user_scope', $response->getAssociatedUserScope());
        $this->assertEquals($user, $response->getAssociatedUser());
    }
}
