<?php

declare(strict_types=1);

namespace ShopifyTest\Clients;

use JsonException;
use Shopify\Clients\HttpResponse;
use ShopifyTest\BaseTestCase;

final class HttpResponseTest extends BaseTestCase
{
    public function testGetters()
    {
        $response = new HttpResponse(
            status: 200,
            headers: ['Header-1' => ['ABCD'], 'Header-2' => ['DCBA'], 'x-request-id' => ['test-request-id']],
            body: '{"name": "Shoppity Shop"}',
        );
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEqualsCanonicalizing(
            [
                'Header-1' => ['ABCD'],
                'Header-2' => ['DCBA'],
                'x-request-id' => ['test-request-id'],
            ],
            $response->getHeaders(),
        );
        $this->assertEquals(['name' => 'Shoppity Shop'], $response->getDecodedBody());
        $this->assertEquals('test-request-id', $response->getRequestId());
    }

    public function testGetRequestIdReturnsNullIfHeaderIsMissing()
    {
        $response = new HttpResponse(status: 200);
        $this->assertNull($response->getRequestId());
    }

    public function testGetDecodedBodyWillThrwoExceptionIfBodyIsNotJson()
    {
        $response = new HttpResponse(body: "not-json");

        $this->expectException(JsonException::class);
        $response->getDecodedBody();
    }
}
