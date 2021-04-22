<?php

declare(strict_types=1);

namespace ShopifyTest\Webhooks;

use Shopify\Clients\HttpHeaders;
use ShopifyTest\BaseTestCase;

final class HttpHeadersTest extends BaseTestCase
{
    private $rawHeaders = [
        'Content-Type' => 'application/json',
        'X-Custom-Header' => 1234,
    ];

    public function testHeadersAreNormalized()
    {
        $headers = new HttpHeaders($this->rawHeaders);
        $this->assertSame(
            [
                'content-type' => ['application/json'],
                'x-custom-header' => ['1234'],
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

    public function testGetIsCaseInsensitiveAndReturnsStrings()
    {
        $headers = new HttpHeaders($this->rawHeaders);

        $this->assertEquals('application/json', $headers->get('Content-Type'));
        $this->assertEquals('application/json', $headers->get('content-type'));

        $this->assertEquals('1234', $headers->get('X-Custom-Header'));
        $this->assertEquals('1234', $headers->get('x-custom-header'));

        $this->assertNull($headers->get('not-there'));
    }
}
