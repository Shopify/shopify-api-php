<?php

declare(strict_types=1);

namespace ShopifyTest;

use Shopify\Context;
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
        );

        $this->assertEquals('ash', Context::$API_KEY);
        $this->assertEquals('steffi', Context::$API_SECRET_KEY);
        $this->assertEquals(['sleepy', 'kitty'], Context::$SCOPES);
        $this->assertEquals('my-friends-cats', Context::$HOST_NAME);
    }

    // Context with different values has been set up in BaseTestCase
    public function testCanUpdateContext()
    {
        Context::initialize(
            apiKey: 'tuck',
            apiSecretKey: 'rocky',
            scopes: ['silly', 'doggo'],
            hostName: 'yay-for-doggos',
        );

        $this->assertEquals('tuck', Context::$API_KEY);
        $this->assertEquals('rocky', Context::$API_SECRET_KEY);
        $this->assertEquals(['silly', 'doggo'], Context::$SCOPES);
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
            isPrivateApp: true,
        );
        $this->expectException('\Shopify\Exception\PrivateAppException');
        $this->expectExceptionMessage('BOOOOOO');
        Context::throwIfPrivateApp('BOOOOOO');
    }
}
