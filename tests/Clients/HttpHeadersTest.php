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
                'content-type' => 'application/json',
                'x-custom-header' => '1234',
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

    public function testAddRawHeaderWillParseEachHeaderIntoItsKeyAndValue()
    {
        $builder = new HttpHeaders();
        $builder->addRawHeader('x-request-id: 5023c4c7-2639-4a5a-aa28-1bdcbc0c5925');
        $builder->addRawHeader('x-permitted-cross-domain-policies: none');
        $this->assertEquals(
            [
                'x-request-id' => '5023c4c7-2639-4a5a-aa28-1bdcbc0c5925',
                'x-permitted-cross-domain-policies' => 'none'
            ],
            $builder->toArray()
        );
    }

    public function testAddRawHeaderTurnsHeadersShowingMultipleTimesToAnArray()
    {
        $builder = new HttpHeaders();
        $builder->addRawHeader('set-cookie: _y=bdc37ee4-ab06-49...');
        $builder->addRawHeader('set-cookie: _s=18d48dd0-a164-4b...');
        $builder->addRawHeader('set-cookie: _shopify_y=bdc37ee4...');
        $this->assertEquals(
            [
                'set-cookie' => ['_y=bdc37ee4-ab06-49...', '_s=18d48dd0-a164-4b...', '_shopify_y=bdc37ee4...']
            ],
            $builder->toArray()
        );
    }

    public function testAddRawHeaderReturnsHeaderLength()
    {
        $builder = new HttpHeaders();
        $this->assertEquals(34, $builder->addRawHeader('set-cookie: _y=bdc37ee4-ab06-49...'));
    }

    /**
     * Bad formatted header, is a header that doesn't have `:`
     */
    public function testAddRawHeaderIgnoresBadFormattedHeadersAndReturnItsLength()
    {
        $builder = new HttpHeaders();
        $this->assertEquals(10, $builder->addRawHeader('set-cookie'));
        $this->assertEmpty($builder->toArray());
    }

    public function tesAddRawHeadertOnlyConsiderFirstColonWhenSplittingRawHeader()
    {
        $builder = new HttpHeaders();
        $builder->addRawHeader('set-cookie: something:other thing');
        $this->assertEquals(['set-cookie' => 'something:other thing'], $builder->toArray());
    }
}
