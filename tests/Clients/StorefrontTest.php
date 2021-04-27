<?php

declare(strict_types=1);

namespace ShopifyTest\Clients;

use Shopify\Clients\HttpHeaders;
use Shopify\Clients\Storefront;
use Shopify\Context;
use ShopifyTest\BaseTestCase;

final class StorefrontTest extends BaseTestCase
{
    private string $query =
    <<<QUERY
    {
        shop {
            name
        }
    }
    QUERY;

    private array $successResponse = [
        'data' => [
            'shop' => [
                'name' => 'Shoppity Shop',
            ],
        ],
    ];

    public function testCanMakeRequest()
    {
        $this->mockTransportRequests([
            new MockRequest(
                response: $this->buildMockHttpResponse(
                    statusCode: 200,
                    body: $this->successResponse,
                    headers: [HttpHeaders::X_REQUEST_ID => 'request_id'],
                ),
                url: "https://$this->domain/api/" . Context::$API_VERSION . '/graphql.json',
                method: 'POST',
                headers: [
                    'Content-Type: application/graphql',
                    'X-Shopify-Storefront-Access-Token: test_token',
                ],
                body: $this->query,
            )
        ]);

        $client = new Storefront($this->domain, 'test_token');

        $response = $client->query(data: $this->query);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals($this->successResponse, $response->getBody());
        $this->assertEquals('request_id', $response->getRequestId());
    }

    public function testCanMakeRequestForPrivateApp()
    {
        Context::$IS_PRIVATE_APP = true;
        Context::$PRIVATE_APP_STOREFRONT_ACCESS_TOKEN = 'private_token';

        $this->mockTransportRequests([
            new MockRequest(
                response: $this->buildMockHttpResponse(
                    statusCode: 200,
                    body: $this->successResponse,
                    headers: [HttpHeaders::X_REQUEST_ID => 'request_id'],
                ),
                url: "https://$this->domain/api/" . Context::$API_VERSION . '/graphql.json',
                method: 'POST',
                headers: [
                    'Content-Type: application/graphql',
                    'X-Shopify-Storefront-Access-Token: private_token',
                ],
                body: $this->query,
            )
        ]);

        $client = new Storefront($this->domain);

        $response = $client->query(data: $this->query);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals($this->successResponse, $response->getBody());
        $this->assertEquals('request_id', $response->getRequestId());
    }

    public function testCanUseTokenForPrivateAppRequest()
    {
        Context::$IS_PRIVATE_APP = true;

        $this->mockTransportRequests([
            new MockRequest(
                response: $this->buildMockHttpResponse(
                    statusCode: 200,
                    body: $this->successResponse,
                    headers: [HttpHeaders::X_REQUEST_ID => 'request_id'],
                ),
                url: "https://$this->domain/api/" . Context::$API_VERSION . '/graphql.json',
                method: 'POST',
                headers: [
                    'Content-Type: application/graphql',
                    'X-Shopify-Storefront-Access-Token: test_token',
                ],
                body: $this->query,
            )
        ]);

        $client = new Storefront($this->domain, 'test_token');

        $response = $client->query(data: $this->query);
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals($this->successResponse, $response->getBody());
        $this->assertEquals('request_id', $response->getRequestId());
    }
}
