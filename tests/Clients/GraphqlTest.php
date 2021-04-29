<?php

declare(strict_types=1);

namespace ShopifyTest\Clients;

use Shopify\Clients\Graphql;
use Shopify\Context;
use ShopifyTest\BaseTestCase;
use ShopifyTest\HttpResponseMatcher;

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
              'shop' => 'name'
          ]
    ];

    private string $querySuccessResponse = <<<RESPONSE
        {
            "data": {
                "shop": {
                    "name": "Shoppity Shop"
                }
            }
        }
    RESPONSE;

    private string $testQueryUsingVariables = <<<QUERY
        mutation (\$input: CustomerInput!) {
            customerCreate(input: \$input)
            {
                customer {
                    id
                    displayName
                }
            }
        }
    QUERY;

    private string $testVariables = <<<VARIABLES
        {
            "input": {
                "firstName": "Display",
                "lastName": "Name",
                "email": "displayname@teleworm.us"
            }
        }
    VARIABLES;

    private string $mutationSuccessResponse = <<<RESPONSE
        {
            "data": {
                "customerCreate": {
                    "customer": {
                        "id": "gid://shopify/Customer/1234567890",
                        "displayName": "Display Name"
                    }
                }
            }
        }
    RESPONSE;

    public function testPublicAppThrowsWithoutToken()
    {
        $this->expectException(\Shopify\Exception\MissingArgumentException::class);
        new Graphql('domain.myshopify.com');
    }

    public function testThrowsIfQueryMissing()
    {
        $client = new Graphql('domain.myshopify.com', 'token');
        $this->expectException(\Shopify\Exception\MissingArgumentException::class);
        $client->query(data: '');
    }

    public function testCanQueryWithDataString()
    {
        $client = new Graphql($this->domain, 'token');

        $this->mockTransportRequests([
            new MockRequest(
                response: $this->buildMockHttpResponse(200, json_decode($this->querySuccessResponse, true)),
                url: "https://$this->domain/admin/api/" . Context::$API_VERSION . '/graphql.json',
                method: 'POST',
                userAgent: "Shopify Admin API Library for PHP v$this->version",
                headers: [
                    'Content-Type: application/graphql',
                    'Content-Length: ' . strlen($this->testQueryString),
                    'X-Shopify-Access-Token: token'
                ],
                body: $this->testQueryString
            )
        ]);

        $response = $client->query(data: $this->testQueryString);
        $this->assertThat(
            $response,
            new HttpResponseMatcher(decodedBody: json_decode($this->querySuccessResponse, true))
        );
    }

    public function testCanQueryWithDataArray()
    {
        $client = new Graphql($this->domain, 'token');

        $this->mockTransportRequests([
            new MockRequest(
                response: $this->buildMockHttpResponse(200, json_decode($this->querySuccessResponse, true)),
                url: "https://$this->domain/admin/api/" . Context::$API_VERSION . '/graphql.json',
                method: 'POST',
                userAgent: "Shopify Admin API Library for PHP v$this->version",
                headers: [
                         'Content-Type: application/json',
                         'Content-Length: ' . strlen(json_encode($this->testQueryArray)),
                         'X-Shopify-Access-Token: token'
                     ],
                body: json_encode($this->testQueryArray)
            )
        ]);

        $response = $client->query(data: $this->testQueryArray);
        $this->assertThat(
            $response,
            new HttpResponseMatcher(decodedBody: json_decode($this->querySuccessResponse, true))
        );
    }

    public function testCanQueryWithVariables()
    {
        $client = new Graphql($this->domain, 'token');
        $query = ['query' => $this->testQueryUsingVariables, 'variables' => $this->testVariables];

        $this->mockTransportRequests([
            new MockRequest(
                url: "https://$this->domain/admin/api/" . Context::$API_VERSION . '/graphql.json',
                method: 'POST',
                userAgent: "Shopify Admin API Library for PHP v$this->version",
                headers: [
                         'Content-Type: application/json',
                         'Content-Length: ' . strlen(json_encode($query)),
                         'X-Shopify-Access-Token: token'
                     ],
                response: $this->buildMockHttpResponse(200, json_decode($this->mutationSuccessResponse, true)),
                body: json_encode($query)
            )
        ]);

        $response = $client->query(data: $query);

        $this->assertThat(
            $response,
            new HttpResponseMatcher(decodedBody: json_decode($this->mutationSuccessResponse, true))
        );
    }

    public function testCanQueryWithExtraHeaders()
    {
        $extraHeaders = ['Extra-Extra' => 'hear_all_about_it'];
        $client = new Graphql($this->domain, 'token');

        $this->mockTransportRequests([
            new MockRequest(
                response: $this->buildMockHttpResponse(200, json_decode($this->querySuccessResponse, true)),
                url: "https://$this->domain/admin/api/" . Context::$API_VERSION . '/graphql.json',
                method: 'POST',
                userAgent: "Shopify Admin API Library for PHP v$this->version",
                headers: [
                         'Content-Type: application/graphql',
                         'Content-Length: ' . strlen($this->testQueryString),
                         'Extra-Extra: hear_all_about_it',
                         'X-Shopify-Access-Token: token'
                     ],
                body: $this->testQueryString
            )
        ]);

        $response = $client->query(data: $this->testQueryString, extraHeaders: $extraHeaders);
        $this->assertThat(
            $response,
            new HttpResponseMatcher(decodedBody: json_decode($this->querySuccessResponse, true))
        );
    }
}
