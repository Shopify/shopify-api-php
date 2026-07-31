<?php

declare(strict_types=1);

namespace ShopifyTest\Auth;

use Shopify\Auth\AccessTokenResponse;
use ShopifyTest\BaseTestCase;

final class AccessTokenResponseTest extends BaseTestCase
{
    public function testGettersForNonExpiringToken()
    {
        $response = new AccessTokenResponse('test_token', 'test_scope');
        $this->assertEquals('test_token', $response->getAccessToken());
        $this->assertEquals('test_scope', $response->getScope());
        $this->assertNull($response->getExpiresIn());
        $this->assertNull($response->getRefreshToken());
        $this->assertNull($response->getRefreshTokenExpiresIn());
    }

    public function testGettersForExpiringToken()
    {
        $response = new AccessTokenResponse('test_token', 'test_scope', 3600, 'test_refresh_token', 7776000);
        $this->assertEquals('test_token', $response->getAccessToken());
        $this->assertEquals('test_scope', $response->getScope());
        $this->assertEquals(3600, $response->getExpiresIn());
        $this->assertEquals('test_refresh_token', $response->getRefreshToken());
        $this->assertEquals(7776000, $response->getRefreshTokenExpiresIn());
    }
}
