<?php

declare(strict_types=1);

namespace ShopifyTest;

use Shopify\Clients\Transport;
use Shopify\Auth\Scopes;
use Shopify\Context;
use ShopifyTest\Auth\MockSessionStorage;
use ShopifyTest\BaseTestCase;

final class ContextTest extends BaseTestCase
{
    public function testCanCreateContext()
    {
        Context::initialize(
            apiKey: 'ash',
            apiSecretKey: 'steffi',
            scopes: ['sleepy', 'kitty'],
            hostName: 'my-friends-cats',
            sessionStorage: new MockSessionStorage(),
            isPrivateApp: false,
        );

        $this->assertEquals('ash', Context::$API_KEY);
        $this->assertEquals('steffi', Context::$API_SECRET_KEY);
        $this->assertEquals(new Scopes(['sleepy', 'kitty']), Context::$SCOPES);
        $this->assertEquals('my-friends-cats', Context::$HOST_NAME);

        // This should not trigger the exception
        Context::throwIfUninitialized();

        // This should not trigger the exception
        Context::throwIfPrivateApp('Not supposed to happen!');
    }

    // Context with different values has been set up in BaseTestCase
    public function testCanUpdateContext()
    {
        Context::initialize(
            apiKey: 'tuck',
            apiSecretKey: 'rocky',
            scopes: ['silly', 'doggo'],
            hostName: 'yay-for-doggos',
            sessionStorage: new MockSessionStorage(),
        );

        $this->assertEquals('tuck', Context::$API_KEY);
        $this->assertEquals('rocky', Context::$API_SECRET_KEY);
        $this->assertEquals(new Scopes(['silly', 'doggo']), Context::$SCOPES);
        $this->assertEquals('yay-for-doggos', Context::$HOST_NAME);
    }

    public function testThrowsIfMissingArguments()
    {
        $this->expectException('\Shopify\Exception\MissingArgumentException');
        $this->expectExceptionMessage(
            'Cannot initialize Shopify API Library. Missing values for: apiKey, apiSecretKey, scopes, hostName'
        );
        Context::initialize(
            apiKey: '',
            apiSecretKey: '',
            scopes: [],
            hostName: '',
            sessionStorage: new MockSessionStorage(),
        );
    }

    public function testThrowsIfUninitialized()
    {
        // ReflectionClass is used in this test as IS_INITIALIZED is a private static variable,
        // which would have been set as true due to previous tests
        $reflectedContext = new \ReflectionClass('Shopify\Context');
        $reflectedIsInitialized = $reflectedContext->getProperty('IS_INITIALIZED');
        $reflectedIsInitialized->setAccessible(true);
        $reflectedIsInitialized = $reflectedIsInitialized->setValue(false);

        $this->expectException('\Shopify\Exception\UninitializedContextException');
        Context::throwIfUninitialized();
    }

    public function testThrowsIfPrivateApp()
    {
        Context::initialize(
            apiKey: 'ash',
            apiSecretKey: 'steffi',
            scopes: ['sleepy', 'kitty'],
            hostName: 'my-friends-cats',
            sessionStorage: new MockSessionStorage(),
            isPrivateApp: true,
        );
        $this->expectException('\Shopify\Exception\PrivateAppException');
        $this->expectExceptionMessage('BOOOOOO');
        Context::throwIfPrivateApp('BOOOOOO');
    }
}
