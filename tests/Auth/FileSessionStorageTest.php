<?php

declare(strict_types=1);

namespace ShopifyTest\Auth;

use Shopify\Auth\Session;
use Shopify\Auth\FileSessionStorage;
use ShopifyTest\BaseTestCase;

final class FileSessionStorageTest extends BaseTestCase
{
    private string $sessionId = 'test_session';
    private Session $session;
    private FileSessionStorage $storage;

    public function setUp(): void
    {
        $this->session = new Session($this->sessionId);
        $this->session->setShop('test-shop.myshopify.io');
        $this->session->setState('1234');
        $this->session->setScope('read_products');
        $this->session->setExpires(strtotime('+1 day'));
        $this->session->setIsOnline(true);
        $this->session->setAccessToken('totally_real_access_token');
    }

    public function testStoreSession()
    {
        $this->storage = new FileSessionStorage();
        $this->assertEquals(true, $this->storage->storeSession($this->session));
    }

    public function testDeleteSession()
    {
        $this->storage = new FileSessionStorage();
        $this->assertEquals(true, $this->storage->deleteSession($this->sessionId));
    }
}
