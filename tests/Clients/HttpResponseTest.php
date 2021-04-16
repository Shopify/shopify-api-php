<?php

declare(strict_types=1);

namespace ShopifyTest\Clients;

use Shopify\Clients\HttpResponse;
use ShopifyTest\BaseTestCase;

final class HttpResponseTest extends BaseTestCase
{
    public function testGetters()
    {
        $response = new HttpResponse(
            statusCode: 1234,
            headers: ['Header-1: ABCD', 'Header-2: DCBA'],
            body: 'This is a response!',
        );
        $this->assertEquals(1234, $response->getStatusCode());
        $this->assertEquals(['Header-1: ABCD', 'Header-2: DCBA'], $response->getHeaders());
        $this->assertEquals('This is a response!', $response->getBody());
    }
}
