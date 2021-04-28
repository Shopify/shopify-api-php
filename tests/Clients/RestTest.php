<?php

declare(strict_types=1);

namespace ShopifyTest\Clients;

use Shopify\Clients\Http;
use Shopify\Clients\Rest;
use Shopify\Context;
use ShopifyTest\BaseTestCase;
use ShopifyTest\HttpResponseMatcher;

class RestTest extends BaseTestCase
{
    use PaginationTestHelper;

    private array $successResponse = [
        'products' => [
            'title' => 'Test Product',
            'amount' => 1,
        ],
    ];

    public function testFailsToInstantiateWithoutAccessTokenForNonPrivateApps()
    {
        $this->expectException(\Shopify\Exception\MissingArgumentException::class);

        new Rest($this->domain);
    }

    public function testInstantiateWithoutAccessTokenForPrivateApps()
    {
        Context::$IS_PRIVATE_APP = true;

        $client = new Rest($this->domain);
        $this->assertNotNull($client);
    }

    public function testPrivateAppsUseApiSecretKeyAsAccessToken()
    {
        Context::$IS_PRIVATE_APP = true;

        $headers = ['X-Test-Header' => 'test_value'];

        $client = new Rest($this->domain, 'dummy-token');

        $this->mockTransportRequests([
            new MockRequest(
                response: $this->buildMockHttpResponse(200, $this->successResponse),
                url: "https://$this->domain/admin/api/" . Context::$API_VERSION . "/products.json",
                method: 'GET',
                userAgent: "Shopify Admin API Library for PHP v$this->version",
                headers: ["X-Test-Header: test_value", "X-Shopify-Access-Token: " . Context::$API_SECRET_KEY],
                allowOtherHeaders: false,
            ),
        ]);

        $response = $client->get(path: 'products', headers: $headers);
        $this->assertThat($response, new HttpResponseMatcher(decodedBody: $this->successResponse));
    }

    public function testCanMakeGetRequest()
    {
        $headers = ['X-Test-Header' => 'test_value'];

        $client = new Rest($this->domain, 'dummy-token');

        $this->mockTransportRequests([
            new MockRequest(
                response: $this->buildMockHttpResponse(200, $this->successResponse),
                url: "https://$this->domain/admin/api/" . Context::$API_VERSION . "/products.json",
                method: 'GET',
                userAgent: "Shopify Admin API Library for PHP v$this->version",
                headers: ['X-Test-Header: test_value', 'X-Shopify-Access-Token: dummy-token'],
                allowOtherHeaders: false,
            ),
        ]);

        $response = $client->get(path: 'products', headers: $headers);
        $this->assertThat($response, new HttpResponseMatcher(decodedBody: $this->successResponse));
    }

    public function testCanMakeGetRequestWithPathInQuery()
    {
        $client = new Rest($this->domain, 'dummy-token');

        $this->mockTransportRequests([
            new MockRequest(
                response: $this->buildMockHttpResponse(200, $this->successResponse),
                url: "https://$this->domain/admin/api/" . Context::$API_VERSION . "/products.json?path=some_path",
                method: 'GET',
                userAgent: "Shopify Admin API Library for PHP v$this->version",
                headers: ['X-Shopify-Access-Token: dummy-token'],
                allowOtherHeaders: false,
            ),
        ]);

        $response = $client->get(path: 'products', query: ["path" => "some_path"]);
        $this->assertThat($response, new HttpResponseMatcher(decodedBody: $this->successResponse));
    }

    public function testCanMakePostRequestWithJsonData()
    {
        $client = new Rest($this->domain, 'dummy-token');

        $postData = [
            "title" => 'Test product',
            "amount" => 10,
        ];

        $body = json_encode($postData);
        $bodyLength = strlen($body);

        $this->mockTransportRequests([
            new MockRequest(
                response: $this->buildMockHttpResponse(200, $this->successResponse),
                url: "https://$this->domain/admin/api/" . Context::$API_VERSION . "/products.json",
                method: 'POST',
                userAgent: "Shopify Admin API Library for PHP v$this->version",
                headers: [
                    'Content-Type: application/json',
                    "Content-Length: $bodyLength",
                    'X-Shopify-Access-Token: dummy-token',
                ],
                body: $body,
                allowOtherHeaders: false,
            ),
        ]);

        $response = $client->post(path: 'products', body: $postData, dataType: Http::DATA_TYPE_JSON);
        $this->assertThat($response, new HttpResponseMatcher(decodedBody: $this->successResponse));
    }

    public function testCanMakePostRequestWithJsonDataAndPathInQuery()
    {
        $client = new Rest($this->domain, 'dummy-token');

        $postData = [
            "title" => 'Test product',
            "amount" => 10,
        ];

        $body = json_encode($postData);
        $bodyLength = strlen($body);

        $this->mockTransportRequests([
            new MockRequest(
                response: $this->buildMockHttpResponse(200, $this->successResponse),
                url: "https://$this->domain/admin/api/" . Context::$API_VERSION . "/products.json?path=some_path",
                method: 'POST',
                userAgent: "Shopify Admin API Library for PHP v$this->version",
                headers: [
                    'Content-Type: application/json',
                    "Content-Length: $bodyLength",
                    'X-Shopify-Access-Token: dummy-token',
                ],
                body: $body,
                allowOtherHeaders: false,
            ),
        ]);

        $response = $client->post(
            path: 'products',
            body: $postData,
            dataType: Http::DATA_TYPE_JSON,
            query: ["path" => "some_path"]
        );
        $this->assertThat($response, new HttpResponseMatcher(decodedBody: $this->successResponse));
    }

    public function testCanMakePutRequestWithJsonData()
    {
        $client = new Rest($this->domain, 'dummy-token');

        $postData = [
            "title" => 'Test product',
            "amount" => 10,
        ];

        $body = json_encode($postData);
        $bodyLength = strlen($body);

        $this->mockTransportRequests([
            new MockRequest(
                response: $this->buildMockHttpResponse(200, $this->successResponse),
                url: "https://$this->domain/admin/api/" . Context::$API_VERSION . "/products/123.json?path=some_path",
                method: 'PUT',
                userAgent: "Shopify Admin API Library for PHP v$this->version",
                headers: [
                    'Content-Type: application/json',
                    "Content-Length: $bodyLength",
                    'X-Shopify-Access-Token: dummy-token',
                ],
                body: $body,
                allowOtherHeaders: false,
            ),
        ]);

        $response = $client->put(
            path: 'products/123',
            body: $postData,
            dataType: Http::DATA_TYPE_JSON,
            query: ["path" => "some_path"]
        );
        $this->assertThat($response, new HttpResponseMatcher(decodedBody: $this->successResponse));
    }

    public function testCanMakeDeleteRequest()
    {
        $headers = ['X-Test-Header' => 'test_value'];

        $client = new Rest($this->domain, 'dummy-token');

        $this->mockTransportRequests([
            new MockRequest(
                response: $this->buildMockHttpResponse(200, $this->successResponse),
                url: "https://$this->domain/admin/api/" . Context::$API_VERSION . "/products.json?path=some_path",
                method: 'DELETE',
                userAgent: "Shopify Admin API Library for PHP v$this->version",
                headers: ['X-Test-Header: test_value', 'X-Shopify-Access-Token: dummy-token'],
                allowOtherHeaders: false,
            ),
        ]);

        $response = $client->delete('products', $headers, query: ["path" => "some_path"]);
        $this->assertThat($response, new HttpResponseMatcher(decodedBody: $this->successResponse));
    }

    public function testCanRequestNextAndPreviousPagesUntilTheyRunOut()
    {
        $firstPageLinkHeader = $this->getProductsLinkHeader(nextToken: 'middlePageToken');

        $middlePageLinkHeader = $this->getProductsLinkHeader(
            previousToken: 'firstPageToken',
            nextToken: 'lastPageToken'
        );

        $lastPageLinkHeader = $this->getProductsLinkHeader(previousToken: 'middlePageToken');

        $this->mockTransportRequests(
            [
                new MockRequest(
                    response: $this->buildMockHttpResponse(
                        statusCode: 200,
                        body: $this->successResponse,
                        headers: ['Link' => $firstPageLinkHeader]
                    ),
                    url: $this->getAdminApiUrl("products", "limit=10&fields=test1%2Ctest2"),
                    method: "GET",
                    userAgent: "Shopify Admin API Library for PHP v",
                    headers: ['X-Shopify-Access-Token: dummy-token'],
                ),
                new MockRequest(
                    response: $this->buildMockHttpResponse(
                        statusCode: 200,
                        body: $this->successResponse,
                        headers: ['Link' => $middlePageLinkHeader]
                    ),
                    url: $this->getProductsAdminApiPaginationUrl("middlePageToken"),
                    method: "GET",
                    userAgent: "Shopify Admin API Library for PHP v",
                    headers: ['X-Shopify-Access-Token: dummy-token'],
                ),
                new MockRequest(
                    response: $this->buildMockHttpResponse(
                        statusCode: 200,
                        body: $this->successResponse,
                        headers: ['Link' => $lastPageLinkHeader]
                    ),
                    url: $this->getProductsAdminApiPaginationUrl("lastPageToken"),
                    method: "GET",
                    userAgent: "Shopify Admin API Library for PHP v",
                    headers: ['X-Shopify-Access-Token: dummy-token'],
                ),
                new MockRequest(
                    response: $this->buildMockHttpResponse(
                        statusCode: 200,
                        body: $this->successResponse,
                        headers: ['Link' => $middlePageLinkHeader]
                    ),
                    url: $this->getProductsAdminApiPaginationUrl("middlePageToken"),
                    method: "GET",
                    userAgent: "Shopify Admin API Library for PHP v",
                    headers: ['X-Shopify-Access-Token: dummy-token'],
                ),
                new MockRequest(
                    response: $this->buildMockHttpResponse(
                        statusCode: 200,
                        body: $this->successResponse,
                        headers: ['Link' => $firstPageLinkHeader]
                    ),
                    url: $this->getProductsAdminApiPaginationUrl("firstPageToken"),
                    method: "GET",
                    userAgent: "Shopify Admin API Library for PHP v",
                    headers: ['X-Shopify-Access-Token: dummy-token'],
                ),

            ]
        );
        $client = new Rest($this->domain, 'dummy-token');


        $response = $client->get(path: 'products', query: ["limit" => "10", "fields" => 'test1,test2']);
        $this->assertNull($response->getPageInfo()->getPreviousPageUrl());

        $this->assertTrue($response->getPageInfo()->hasNextPage());
        $response = $client->get(path: 'products', query: $response->getPageInfo()->getNextPageQuery());
        $response = $client->get(path: 'products', query: $response->getPageInfo()->getNextPageQuery());
        $this->assertFalse($response->getPageInfo()->hasNextPage());
        $this->assertNull($response->getPageInfo()->getNextPageUrl());


        $this->assertTrue($response->getPageInfo()->hasPreviousPage());
        $response = $client->get(path: 'products', query: $response->getPageInfo()->getPreviousPageQuery());
        $response = $client->get(path: 'products', query: $response->getPageInfo()->getPreviousPageQuery());
        $this->assertFalse($response->getPageInfo()->hasPreviousPage());
        $this->assertNull($response->getPageInfo()->getPreviousPageUrl());
    }
}
