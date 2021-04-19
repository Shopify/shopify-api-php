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
        $user = new AccessTokenOnlineUserInfo(
            id: 1234,
            firstName: 'John',
            lastName: 'Doe',
            email: 'john.doe@nowhere',
            emailVerified: true,
            accountOwner: true,
            locale: 'en',
            collaborator: true,
        );
        $this->assertEquals(1234, $user->getId());
        $this->assertEquals('John', $user->getFirstName());
        $this->assertEquals('Doe', $user->getLastName());
        $this->assertEquals('john.doe@nowhere', $user->getEmail());
        $this->assertEquals(true, $user->isEmailVerified());
        $this->assertEquals(true, $user->isAccountOwner());
        $this->assertEquals('en', $user->getLocale());
        $this->assertEquals(true, $user->isCollaborator());

        $response = new AccessTokenOnlineResponse(
            accessToken: 'test_token',
            scope: 'test_scope',
            expiresIn: 1234,
            associatedUserScope: 'user_scope',
            associatedUser: $user,
        );
        $this->assertEquals('test_token', $response->getAccessToken());
        $this->assertEquals('test_scope', $response->getScope());
        $this->assertEquals(1234, $response->getExpiresIn());
        $this->assertEquals('user_scope', $response->getAssociatedUserScope());
        $this->assertEquals($user, $response->getAssociatedUser());
    }
}
