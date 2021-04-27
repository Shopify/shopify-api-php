<?php

declare(strict_types=1);

namespace ShopifyTest\Auth;

use Shopify\Auth\Session;
use ShopifyTest\BaseTestCase;

final class SessionStorageTest extends BaseTestCase
{
    private string $sessionId = 'test_session';
    private Session $session;

    public function setUp(): void
    {
        $this->session = new Session(
            id: $this->sessionId,
            shop: 'test-shop.myshopify.io',
            isOnline: true,
            state: '1234',
        );
        $this->session->setScope('read_products');
        $this->session->setExpires(strtotime('+1 day'));
        $this->session->setAccessToken('totally_real_access_token');
    }

    public function testStoreLoadDeleteSession()
    {
        $storage = new MockSessionStorage();

        $this->assertEquals(null, $storage->loadSession($this->sessionId));
        $this->assertTrue($storage->storeSession($this->session));
        $this->assertEquals($this->session, $storage->loadSession($this->sessionId));
        $this->assertTrue($storage->deleteSession($this->sessionId));
        $this->assertEquals(
            [
                ['load',   $this->sessionId],
                ['store',  $this->session],
                ['load',   $this->sessionId],
                ['delete', $this->sessionId],
            ],
            $storage->getCalls()
        );
    }
}
