<?php

declare(strict_types=1);

namespace ShopifyTest\Clients;

use Shopify\Clients\Graphql;
use Shopify\Context;
use ShopifyTest\BaseTestCase;
use ShopifyTest\HttpResponseMatcher;

final class GraphqlTest extends BaseTestCase
{
    /** @var string */
    private $testQueryString = <<<QUERY
        {
            shop {
                name
            }
        }
    QUERY;

    /** @var array */
    private $testQueryArray = [
          [
              'shop' => 'name',
          ],
    ];

    /** @var string */
    private $querySuccessResponse = <<<RESPONSE
        {
            "data": {
                "shop": {
                    "name": "Shoppity Shop"
                }
            }
        }
    RESPONSE;

    /** @var string */
    private $testQueryUsingVariables = <<<QUERY
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

    /** @var string */
    private $testVariables = <<<VARIABLES
        {
            "input": {
                "firstName": "Display",
                "lastName": "Name",
                "email": "displayname@teleworm.us"
            }
        }
    VARIABLES;

    /** @var string */
    private $mutationSuccessResponse = <<<RESPONSE
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
        $client->query('');
    }

    public function testCanQueryWithDataString()
    {
        $client = new Graphql($this->domain, 'token');

        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_decode($this->querySuccessResponse, true)),
                "https://$this->domain/admin/api/" . Context::$API_VERSION . '/graphql.json',
                'POST',
                "Shopify Admin API Library for PHP v$this->version",
                [
                    'Content-Type: application/graphql',
                    'Content-Length: ' . strlen($this->testQueryString),
                    'X-Shopify-Access-Token: token'
                ],
                $this->testQueryString
            )
        ]);

        $response = $client->query($this->testQueryString);
        $this->assertThat(
            $response,
            new HttpResponseMatcher(200, [], json_decode($this->querySuccessResponse, true))
        );
    }

    public function testCanQueryWithDataArray()
    {
        $client = new Graphql($this->domain, 'token');

        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_decode($this->querySuccessResponse, true)),
                "https://$this->domain/admin/api/" . Context::$API_VERSION . '/graphql.json',
                'POST',
                "Shopify Admin API Library for PHP v$this->version",
                [
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen(json_encode($this->testQueryArray)),
                    'X-Shopify-Access-Token: token'
                ],
                json_encode($this->testQueryArray)
            )
        ]);

        $response = $client->query($this->testQueryArray);
        $this->assertThat(
            $response,
            new HttpResponseMatcher(200, [], json_decode($this->querySuccessResponse, true))
        );
    }

    public function testCanQueryWithVariables()
    {
        $client = new Graphql($this->domain, 'token');
        $query = ['query' => $this->testQueryUsingVariables, 'variables' => $this->testVariables];

        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_decode($this->mutationSuccessResponse, true)),
                "https://$this->domain/admin/api/" . Context::$API_VERSION . '/graphql.json',
                'POST',
                "Shopify Admin API Library for PHP v$this->version",
                [
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen(json_encode($query)),
                    'X-Shopify-Access-Token: token'
                ],
                json_encode($query)
            )
        ]);

        $response = $client->query($query);

        $this->assertThat(
            $response,
            new HttpResponseMatcher(200, [], json_decode($this->mutationSuccessResponse, true))
        );
    }

    public function testCanQueryWithExtraHeaders()
    {
        $extraHeaders = ['Extra-Extra' => 'hear_all_about_it'];
        $client = new Graphql($this->domain, 'token');

        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_decode($this->querySuccessResponse, true)),
                "https://$this->domain/admin/api/" . Context::$API_VERSION . '/graphql.json',
                'POST',
                "Shopify Admin API Library for PHP v$this->version",
                [
                    'Content-Type: application/graphql',
                    'Content-Length: ' . strlen($this->testQueryString),
                    'Extra-Extra: hear_all_about_it',
                    'X-Shopify-Access-Token: token'
                ],
                $this->testQueryString
            )
        ]);

        $response = $client->query($this->testQueryString, [], $extraHeaders);
        $this->assertThat(
            $response,
            new HttpResponseMatcher(200, [], json_decode($this->querySuccessResponse, true))
        );
    }

    public function testProxyForwardsBodyAsJsonType()
    {
        $queryToProxy = <<<QUERY
        {
          "variables": {},
          "query": "{\nshop {\n    name\n    __typename\n  }\n}"
        }
        QUERY;

        $extraHeaders = ['Extra-Extra' => 'hear_all_about_it'];
        $client = new Graphql($this->domain, 'token');

        $this->mockTransportRequests(
            [
                new MockRequest(
                    $this->buildMockHttpResponse(200, json_decode($this->querySuccessResponse, true)),
                    "https://$this->domain/admin/api/" . Context::$API_VERSION . '/graphql.json',
                    'POST',
                    "Shopify Admin API Library for PHP v$this->version",
                    [
                        'Content-Type: application/json',
                        'Content-Length: ' . strlen($queryToProxy),
                        'Extra-Extra: hear_all_about_it',
                        'X-Shopify-Access-Token: token'
                    ],
                    $queryToProxy
                )
            ]
        );

        $response = $client->proxy($queryToProxy, $extraHeaders);
        $this->assertThat(
            $response,
            new HttpResponseMatcher(200, [], json_decode($this->querySuccessResponse, true))
        );
    }
}
