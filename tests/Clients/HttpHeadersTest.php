<?php

declare(strict_types=1);

namespace ShopifyTest\Webhooks;

use Shopify\Clients\HttpHeaders;
use ShopifyTest\BaseTestCase;

final class HttpHeadersTest extends BaseTestCase
{
    /** @var array */
    private $rawHeaders = [
        'Content-Type' => 'application/json',
        'X-Custom-Header' => 1234,
        'X-Array-Header' => [1234, 4321],
    ];

    public function testHeadersAreNormalized()
    {
        $headers = new HttpHeaders($this->rawHeaders);
        $this->assertSame(
            [
                'content-type' => ['application/json'],
                'x-custom-header' => ['1234'],
                'x-array-header' => ['1234', '4321'],
            ],
            $headers->toArray(),
        );
    }

    public function testHasIsCaseInsensitive()
    {
        $headers = new HttpHeaders($this->rawHeaders);

        $this->assertTrue($headers->has('Content-Type'));
        $this->assertTrue($headers->has('content-type'));

        $this->assertTrue($headers->has('X-Custom-Header'));
        $this->assertTrue($headers->has('x-custom-header'));

        $this->assertFalse($headers->has('not-there'));
    }

    public function testHasAcceptsStrings()
    {
        $headers = new HttpHeaders($this->rawHeaders);

        $this->assertTrue($headers->has('Content-Type'));
        $this->assertTrue($headers->has('content-type'));

        $this->assertTrue($headers->has('Content-Type', false));
        $this->assertTrue($headers->has('content-type', false));
    }

    public function testHasAcceptsEmptyStrings()
    {
        $rawHeaders = ['Test-header' => ''];
        $headers = new HttpHeaders($rawHeaders);

        $this->assertTrue($headers->has('Test-header'));
        $this->assertTrue($headers->has('test-header'));
    }

    public function testHasDoesNotAcceptEmptyStrings()
    {
        $rawHeaders = ['Test-header' => ''];
        $headers = new HttpHeaders($rawHeaders);

        $this->assertFalse($headers->has('Test-header', false));
        $this->assertFalse($headers->has('test-header', false));
    }

    public function testDiff()
    {
        $headers = new HttpHeaders($this->rawHeaders);

        $this->assertEquals([], $headers->diff(['Content-Type']));
        $this->assertEquals([], $headers->diff(['content-type']));

        $this->assertEquals(['Not-there'], $headers->diff(['Not-there']));
        $this->assertEquals(
            ['Not-there-1', 'Not-there-2'],
            $headers->diff(['Not-there-1', 'Not-there-2', 'content-type', 'Content-Type'])
        );
    }

    public function testDiffAllowsEmptyParam()
    {
        $rawHeaders = ['Test-header' => ''];
        $headers = new HttpHeaders($rawHeaders);

        $this->assertEquals([], $headers->diff(['Test-header']));
        $this->assertEquals([], $headers->diff(['test-header']));

        $this->assertEquals(['Test-header'], $headers->diff(['Test-header'], false));
        $this->assertEquals(['test-header'], $headers->diff(['test-header'], false));
    }

    public function testDiffMultipleValues()
    {
        $rawHeaders = ['Test-header' => '', 'Test-header-2' => 'Value'];
        $headers = new HttpHeaders($rawHeaders);

        $this->assertEquals([], $headers->diff(['Test-header', 'Test-header-2']));
        $this->assertEquals([], $headers->diff(['test-header', 'test-header-2']));

        $this->assertEquals(['Test-header'], $headers->diff(['Test-header', 'Test-header-2'], false));
        $this->assertEquals(['test-header'], $headers->diff(['test-header', 'test-header-2'], false));
    }

    public function testGetIsCaseInsensitiveAndReturnsStrings()
    {
        $headers = new HttpHeaders($this->rawHeaders);

        $this->assertEquals('application/json', $headers->get('Content-Type'));
        $this->assertEquals('application/json', $headers->get('content-type'));

        $this->assertEquals('1234', $headers->get('X-Custom-Header'));
        $this->assertEquals('1234', $headers->get('x-custom-header'));

        $this->assertEquals('1234,4321', $headers->get('X-Array-Header'));
        $this->assertEquals('1234,4321', $headers->get('x-array-header'));

        $this->assertNull($headers->get('not-there'));
    }
}
