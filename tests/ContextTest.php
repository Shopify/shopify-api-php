<?php

declare(strict_types=1);

namespace ShopifyTest;

use Psr\Log\LogLevel;
use ReflectionClass;
use Shopify\ApiVersion;
use Shopify\Auth\Scopes;
use Shopify\Context;
use ShopifyTest\Auth\MockSessionStorage;

final class ContextTest extends BaseTestCase
{
    public function testCanCreateContext()
    {
        Context::initialize('ash', 'steffi', ['sleepy', 'kitty'], 'my-friends-cats', new MockSessionStorage());

        $this->assertEquals('ash', Context::$API_KEY);
        $this->assertEquals('steffi', Context::$API_SECRET_KEY);
        $this->assertEquals(new Scopes(['sleepy', 'kitty']), Context::$SCOPES);
        $this->assertEquals('my-friends-cats', Context::$HOST_NAME);
        $this->assertEquals('https', Context::$HOST_SCHEME);

        // This should not trigger the exception
        Context::throwIfUninitialized();

        // This should not trigger the exception
        Context::throwIfPrivateApp('Not supposed to happen!');
    }

    // Context with different values has been set up in BaseTestCase
    public function testCanUpdateContext()
    {
        Context::initialize('tuck', 'rocky', ['silly', 'doggo'], 'yay-for-doggos', new MockSessionStorage());

        $this->assertEquals('tuck', Context::$API_KEY);
        $this->assertEquals('rocky', Context::$API_SECRET_KEY);
        $this->assertEquals(new Scopes(['silly', 'doggo']), Context::$SCOPES);
        $this->assertEquals('yay-for-doggos', Context::$HOST_NAME);
    }

    public function testThrowsIfMissingArguments()
    {
        $this->expectException(\Shopify\Exception\MissingArgumentException::class);
        $this->expectExceptionMessage(
            'Cannot initialize Shopify API Library. Missing values for: apiKey, apiSecretKey, scopes, hostName'
        );
        Context::initialize('', '', [], '', new MockSessionStorage());
    }

    public function testThrowsIfUninitialized()
    {
        // ReflectionClass is used in this test as IS_INITIALIZED is a private static variable,
        // which would have been set as true due to previous tests
        $reflectedContext = new ReflectionClass('Shopify\Context');
        $reflectedIsInitialized = $reflectedContext->getProperty('IS_INITIALIZED');
        $reflectedIsInitialized->setAccessible(true);
        $reflectedIsInitialized->setValue(false);

        $this->expectException(\Shopify\Exception\UninitializedContextException::class);
        Context::throwIfUninitialized();
    }

    public function testThrowsIfPrivateApp()
    {
        Context::initialize(
            'ash',
            'steffi',
            ['sleepy', 'kitty'],
            'my-friends-cats',
            new MockSessionStorage(),
            'unstable',
            true,
            true,
        );
        $this->expectException(\Shopify\Exception\PrivateAppException::class);
        $this->expectExceptionMessage('BOOOOOO');
        Context::throwIfPrivateApp('BOOOOOO');
    }

    public function testCanAddOverrideLogger()
    {
        $testLogger = new LogMock();

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

    /**
     * @dataProvider canSetHostSchemeProvider
     */
    public function testCanSetHostScheme($host, $expectedScheme, $expectedHost)
    {
        Context::initialize('ash', 'steffi', ['sleepy', 'kitty'], $host, new MockSessionStorage());

        $this->assertEquals($expectedHost, Context::$HOST_NAME);
        $this->assertEquals($expectedScheme, Context::$HOST_SCHEME);
    }

    public function canSetHostSchemeProvider()
    {
        return [
            ['my-friends-cats.io', 'https', 'my-friends-cats.io'],
            ['https://my-friends-cats.io', 'https', 'my-friends-cats.io'],
            ['http://my-friends-cats.io', 'http', 'my-friends-cats.io'],
            ['http://localhost', 'http', 'localhost'],
            ['http://localhost:1234', 'http', 'localhost:1234'],
        ];
    }

    public function testFailsOnInvalidHost()
    {
        $this->expectException(\Shopify\Exception\InvalidArgumentException::class);
        Context::initialize('ash', 'steffi', ['sleepy', 'kitty'], 'not-a-host-!@#$%^&*()', new MockSessionStorage());
    }

    public function testCanSetCustomShopDomains()
    {
        $domains = ['*.special-domain-1.io', '*.special-domain-2.io'];

        Context::initialize(
            'ash',
            'steffi',
            ['sleepy', 'kitty'],
            'my-friends-cats',
            new MockSessionStorage(),
            ApiVersion::LATEST,
            true,
            false,
            null,
            '',
            null,
            $domains
        );

        $this->assertEquals($domains, Context::$CUSTOM_SHOP_DOMAINS);
    }
}
