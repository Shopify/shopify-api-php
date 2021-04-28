<?php

declare(strict_types=1);

namespace ShopifyTest;

use Psr\Log\LogLevel;
use Psr\Log\Test\TestLogger;
use ReflectionClass;
use Shopify\Auth\Scopes;
use Shopify\Context;
use ShopifyTest\Auth\MockSessionStorage;

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
        $reflectedContext = new ReflectionClass('Shopify\Context');
        $reflectedIsInitialized = $reflectedContext->getProperty('IS_INITIALIZED');
        $reflectedIsInitialized->setAccessible(true);
        $reflectedIsInitialized->setValue(false);

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

    public function testCanAddOverrideLogger()
    {
        $testLogger = new TestLogger();

        Context::log('Logging something!', LogLevel::DEBUG);
        $this->assertEmpty($testLogger->records);

        Context::$LOGGER = $testLogger;

        Context::log('Defaults to info');
        $this->assertTrue($testLogger->hasInfo('Defaults to info'));

        Context::log('Debug log', LogLevel::DEBUG);
        $this->assertTrue($testLogger->hasDebug('Debug log'));

        Context::log('Info log', LogLevel::INFO);
        $this->assertTrue($testLogger->hasInfo('Info log'));

        Context::log('Notice log', LogLevel::NOTICE);
        $this->assertTrue($testLogger->hasNotice('Notice log'));

        Context::log('Warning log', LogLevel::WARNING);
        $this->assertTrue($testLogger->hasWarning('Warning log'));

        Context::log('Err log', LogLevel::ERROR);
        $this->assertTrue($testLogger->hasError('Err log'));

        Context::log('Crit log', LogLevel::CRITICAL);
        $this->assertTrue($testLogger->hasCritical('Crit log'));

        Context::log('Alert log', LogLevel::ALERT);
        $this->assertTrue($testLogger->hasAlert('Alert log'));

        Context::log('Emerg log', LogLevel::EMERGENCY);
        $this->assertTrue($testLogger->hasEmergency('Emerg log'));
    }
}
