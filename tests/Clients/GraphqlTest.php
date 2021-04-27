<?php

declare(strict_types=1);

namespace ShopifyTest\Clients;

use Shopify\Clients\Graphql;
use Shopify\Clients\HttpResponse;
use Shopify\Context;
use ShopifyTest\BaseTestCase;

final class GraphqlTest extends BaseTestCase
{
    private string $testQueryString = <<<QUERY
    {
      shop {
        name
      }
    }
    QUERY;

    private array $testQueryArray = [
        [
          'shop' => [
            'name'
          ]
        ]
    ];

    private string $successResponse = <<<RESPONSE
    {
      "data": {
        "shop": {
          "name": "Shoppity Shop"
        }
      }
    }
    RESPONSE;

    public function testPublicAppThrowsWithoutToken()
    {
        $this->expectException('\Shopify\Exception\MissingArgumentException');
        $client = new Graphql('domain.myshopify.com');
    }

    public function testThrowsIfQueryMissing()
    {
        $client = new Graphql('domain.myshopify.com', 'token');
        $this->expectException('\Shopify\Exception\MissingArgumentException');
        $client->query(data: '');
    }

    public function testCanQueryWithDataString()
    {
        $client = new Graphql($this->domain, 'token');

        $this->mockTransportRequests([
            new MockRequest(
                url: "https://$this->domain/admin/api/" . Context::$API_VERSION . '/graphql.json',
                method: 'POST',
                userAgent: "Shopify Admin API Library for PHP v$this->version",
                headers: [
                    'Content-Type: application/graphql',
                    'Content-Length: ' . strlen($this->testQueryString),
                    'X-Shopify-Access-Token: token'
                ],
                response: $this->buildMockHttpResponse(200, json_decode($this->successResponse, true)),
                body: $this->testQueryString
            )
        ]);

        $expectedResponse = new HttpResponse(
            statusCode: 200,
            headers: [],
            body: json_decode($this->successResponse, true)
        );

        $response = $client->query(data: $this->testQueryString);

        $this->assertEquals($expectedResponse, $response);
    }

    public function testCanQueryWithDataArray()
    {
        $client = new Graphql($this->domain, 'token');

        $this->mockTransportRequests([
            new MockRequest(
                url: "https://$this->domain/admin/api/" . Context::$API_VERSION . '/graphql.json',
                method: 'POST',
                userAgent: "Shopify Admin API Library for PHP v$this->version",
                headers: [
                         'Content-Type: application/json',
                         'Content-Length: ' . strlen(json_encode($this->testQueryArray)),
                         'X-Shopify-Access-Token: token'
                     ],
                response: $this->buildMockHttpResponse(200, json_decode($this->successResponse, true)),
                body: json_encode($this->testQueryArray)
            )
        ]);

        $expectedResponse = new HttpResponse(
            statusCode: 200,
            headers: [],
            body: json_decode($this->successResponse, true)
        );

        $response = $client->query(data: $this->testQueryArray);

        $this->assertEquals($expectedResponse, $response);
    }

    public function testCanQueryWithExtraHeaders()
    {
        $extraHeaders = ['Extra-Extra' => 'hear_all_about_it'];
        $client = new Graphql($this->domain, 'token');

        $this->mockTransportRequests([
            new MockRequest(
                url: "https://$this->domain/admin/api/" . Context::$API_VERSION . '/graphql.json',
                method: 'POST',
                userAgent: "Shopify Admin API Library for PHP v$this->version",
                headers: [
                         'Content-Type: application/graphql',
                         'Content-Length: ' . strlen($this->testQueryString),
                         'Extra-Extra: hear_all_about_it',
                         'X-Shopify-Access-Token: token'
                     ],
                response: $this->buildMockHttpResponse(200, json_decode($this->successResponse, true)),
                body: $this->testQueryString
            )
        ]);

        $expectedResponse = new HttpResponse(
            statusCode: 200,
            headers: [],
            body: json_decode($this->successResponse, true)
        );

        $response = $client->query(data: $this->testQueryString, extraHeaders: $extraHeaders);

        $this->assertEquals($expectedResponse, $response);
    }
}
