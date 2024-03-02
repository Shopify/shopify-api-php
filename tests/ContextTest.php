<?php

declare(strict_types=1);

namespace ShopifyTest;

use Shopify\Exception\MissingArgumentException;
use Shopify\Exception\UninitializedContextException;
use Shopify\Exception\PrivateAppException;
use Exception;
use Shopify\Exception\InvalidArgumentException;
use Psr\Log\LogLevel;
use ReflectionClass;
use Shopify\ApiVersion;
use Shopify\Auth\Scopes;
use Shopify\Context;
use Shopify\Exception\FeatureDeprecatedException;
use Shopify\Utils;
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
        );

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
        $this->expectException(MissingArgumentException::class);
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
        $reflectedIsInitialized->setValue(null, false);

        $this->expectException(UninitializedContextException::class);
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
            apiVersion: 'unstable',
            isPrivateApp: true,
        );
        $this->expectException(PrivateAppException::class);
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

    public function testLogHelper()
    {
        $testLogger = new LogMock();
        Context::$LOGGER = $testLogger;

        Context::logDebug('Debug log');
        $this->assertTrue($testLogger->hasDebug('Debug log'));

        Context::logInfo('Info log');
        $this->assertTrue($testLogger->hasInfo('Info log'));

        Context::logNotice('Notice log');
        $this->assertTrue($testLogger->hasNotice('Notice log'));

        Context::logWarning('Warning log');
        $this->assertTrue($testLogger->hasWarning('Warning log'));

        Context::logError('Err log');
        $this->assertTrue($testLogger->hasError('Err log'));

        Context::logCritical('Crit log');
        $this->assertTrue($testLogger->hasCritical('Crit log'));

        Context::logAlert('Alert log');
        $this->assertTrue($testLogger->hasAlert('Alert log'));

        Context::logEmergency('Emerg log');
        $this->assertTrue($testLogger->hasEmergency('Emerg log'));
    }

    public function testLogDeprecation()
    {
        $testLogger = new LogMock();
        Context::$LOGGER = $testLogger;

        Context::logDeprecation('9999.8888.7777', 'This message should be logged.');
        $this->assertTrue($testLogger->hasWarning('This message should be logged.'));

        $record = $testLogger->recordsByLevel[LogLevel::WARNING][0];

        $this->assertArrayHasKey('context', $record);
        $this->assertArrayHasKey('current_version', $record['context']);
        $this->assertArrayHasKey('deprecated_from', $record['context']);
        $this->assertEquals(Utils::getVersion(), $record['context']['current_version']);
        $this->assertEquals('9999.8888.7777', $record['context']['deprecated_from']);
    }

    public function testLogDeprecationFeatureDeprecatedExceptionText()
    {
        $this->expectException(FeatureDeprecatedException::class);
        $this->expectExceptionMessage('Feature was deprecated in version 1.0.0');

        Context::logDeprecation('1.0.0', 'This message should not be logged because we trigger an exception first.');
    }

    public function testLogDeprecationVersionExceptionText()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Encountered an invalid version: "abc"');

        Context::logDeprecation('abc', 'This message should not be logged.');
    }

    public function testLogDeprecationExceptionTooComplexVersion()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Encountered an invalid version: "1.2.3-RC"');

        Context::logDeprecation('1.2.3-RC', 'This message should not be logged.');
    }

    /**
     * @dataProvider canSetHostSchemeProvider
     */
    public function testCanSetHostScheme($host, $expectedScheme, $expectedHost)
    {
        Context::initialize(
            apiKey: 'ash',
            apiSecretKey: 'steffi',
            scopes: ['sleepy', 'kitty'],
            hostName: $host,
            sessionStorage: new MockSessionStorage(),
        );

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
        $this->expectException(InvalidArgumentException::class);
        Context::initialize(
            apiKey: 'ash',
            apiSecretKey: 'steffi',
            scopes: ['sleepy', 'kitty'],
            hostName: 'not-a-host-!@#$%^&*()',
            sessionStorage: new MockSessionStorage(),
        );
    }

    public function testCanSetCustomShopDomains()
    {
        $domains = ['*.special-domain-1.io', '*.special-domain-2.io'];

        Context::initialize(
            apiKey: 'ash',
            apiSecretKey: 'steffi',
            scopes: ['sleepy', 'kitty'],
            hostName: 'my-friends-cats',
            sessionStorage: new MockSessionStorage(),
            apiVersion: ApiVersion::LATEST,
            isPrivateApp: false,
            customShopDomains: $domains,
        );

        $this->assertEquals($domains, Context::$CUSTOM_SHOP_DOMAINS);
    }
}
