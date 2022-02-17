<?php

declare(strict_types=1);

namespace ShopifyTest\Clients;

use Shopify\Clients\Rest;
use Shopify\Context;
use ShopifyTest\BaseTestCase;
use ShopifyTest\HttpResponseMatcher;

class RestTest extends BaseTestCase
{
    use PaginationTestHelper;

    /** @var array */
    private $successResponse = [
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
                $this->buildMockHttpResponse(200, $this->successResponse),
                "https://$this->domain/admin/api/" . Context::$API_VERSION . "/products.json",
                'GET',
                "Shopify Admin API Library for PHP v$this->version",
                ["X-Test-Header: test_value", "X-Shopify-Access-Token: " . Context::$API_SECRET_KEY],
                null,
                null,
                false,
            ),
        ]);

        $response = $client->get('products', $headers);
        $this->assertThat($response, new HttpResponseMatcher(200, [], $this->successResponse));
    }

    public function testCanMakeGetRequest()
    {
        $headers = ['X-Test-Header' => 'test_value'];

        $client = new Rest($this->domain, 'dummy-token');

        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, $this->successResponse),
                "https://$this->domain/admin/api/" . Context::$API_VERSION . "/products.json",
                'GET',
                "Shopify Admin API Library for PHP v$this->version",
                ['X-Test-Header: test_value', 'X-Shopify-Access-Token: dummy-token'],
                null,
                null,
                false,
            ),
        ]);

        $response = $client->get('products', $headers);
        $this->assertThat($response, new HttpResponseMatcher(200, [], $this->successResponse));
    }

    public function testAllowsFullPaths()
    {
        $headers = ['X-Test-Header' => 'test_value'];

        $client = new Rest($this->domain, 'dummy-token');

        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, $this->successResponse),
                "https://$this->domain/admin/custom_path.json",
                'GET',
                "Shopify Admin API Library for PHP v$this->version",
                ['X-Test-Header: test_value', 'X-Shopify-Access-Token: dummy-token'],
                null,
                null,
                false,
            ),
        ]);

        $response = $client->get('/admin/custom_path', $headers);
        $this->assertThat($response, new HttpResponseMatcher(200, [], $this->successResponse));
    }

    public function testCanMakeGetRequestWithPathInQuery()
    {
        $client = new Rest($this->domain, 'dummy-token');

        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, $this->successResponse),
                "https://$this->domain/admin/api/" . Context::$API_VERSION . "/products.json?path=some_path",
                'GET',
                "Shopify Admin API Library for PHP v$this->version",
                ['X-Shopify-Access-Token: dummy-token'],
                null,
                null,
                false,
            ),
        ]);

        $response = $client->get('products', [], ["path" => "some_path"]);
        $this->assertThat($response, new HttpResponseMatcher(200, [], $this->successResponse));
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
                $this->buildMockHttpResponse(200, $this->successResponse),
                "https://$this->domain/admin/api/" . Context::$API_VERSION . "/products.json",
                'POST',
                "Shopify Admin API Library for PHP v$this->version",
                [
                    'Content-Type: application/json',
                    "Content-Length: $bodyLength",
                    'X-Shopify-Access-Token: dummy-token',
                ],
                $body,
                null,
                false,
            ),
        ]);

        $response = $client->post('products', $postData);
        $this->assertThat($response, new HttpResponseMatcher(200, [], $this->successResponse));
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
                $this->buildMockHttpResponse(200, $this->successResponse),
                "https://$this->domain/admin/api/" . Context::$API_VERSION . "/products.json?path=some_path",
                'POST',
                "Shopify Admin API Library for PHP v$this->version",
                [
                    'Content-Type: application/json',
                    "Content-Length: $bodyLength",
                    'X-Shopify-Access-Token: dummy-token',
                ],
                $body,
                null,
                false,
            ),
        ]);

        $response = $client->post('products', $postData, [], ["path" => "some_path"]);
        $this->assertThat($response, new HttpResponseMatcher(200, [], $this->successResponse));
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
                $this->buildMockHttpResponse(200, $this->successResponse),
                "https://$this->domain/admin/api/" . Context::$API_VERSION . "/products/123.json?path=some_path",
                'PUT',
                "Shopify Admin API Library for PHP v$this->version",
                [
                    'Content-Type: application/json',
                    "Content-Length: $bodyLength",
                    'X-Shopify-Access-Token: dummy-token',
                ],
                $body,
                null,
                false,
            ),
        ]);

        $response = $client->put('products/123', $postData, [], ["path" => "some_path"]);
        $this->assertThat($response, new HttpResponseMatcher(200, [], $this->successResponse));
    }

    public function testCanMakeDeleteRequest()
    {
        $headers = ['X-Test-Header' => 'test_value'];

        $client = new Rest($this->domain, 'dummy-token');

        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, $this->successResponse),
                "https://$this->domain/admin/api/" . Context::$API_VERSION . "/products.json?path=some_path",
                'DELETE',
                "Shopify Admin API Library for PHP v$this->version",
                ['X-Test-Header: test_value', 'X-Shopify-Access-Token: dummy-token'],
                null,
                null,
                false,
            ),
        ]);

        $response = $client->delete('products', $headers, ["path" => "some_path"]);
        $this->assertThat($response, new HttpResponseMatcher(200, [], $this->successResponse));
    }

    public function testCanRequestNextAndPreviousPagesUntilTheyRunOut()
    {
        $firstPageLinkHeader = $this->getProductsLinkHeader(null, 'middlePageToken');
        $middlePageLinkHeader = $this->getProductsLinkHeader('firstPageToken', 'lastPageToken');
        $lastPageLinkHeader = $this->getProductsLinkHeader('middlePageToken', null);

        $this->mockTransportRequests(
            [
                new MockRequest(
                    $this->buildMockHttpResponse(200, $this->successResponse, ['Link' => $firstPageLinkHeader]),
                    $this->getAdminApiUrl("products", "limit=10&fields=test1%2Ctest2"),
                    "GET",
                    "Shopify Admin API Library for PHP v",
                    ['X-Shopify-Access-Token: dummy-token'],
                ),
                new MockRequest(
                    $this->buildMockHttpResponse(200, $this->successResponse, ['Link' => $middlePageLinkHeader]),
                    $this->getProductsAdminApiPaginationUrl("middlePageToken"),
                    "GET",
                    "Shopify Admin API Library for PHP v",
                    ['X-Shopify-Access-Token: dummy-token'],
                ),
                new MockRequest(
                    $this->buildMockHttpResponse(200, $this->successResponse, ['Link' => $lastPageLinkHeader]),
                    $this->getProductsAdminApiPaginationUrl("lastPageToken"),
                    "GET",
                    "Shopify Admin API Library for PHP v",
                    ['X-Shopify-Access-Token: dummy-token'],
                ),
                new MockRequest(
                    $this->buildMockHttpResponse(200, $this->successResponse, ['Link' => $middlePageLinkHeader]),
                    $this->getProductsAdminApiPaginationUrl("middlePageToken"),
                    "GET",
                    "Shopify Admin API Library for PHP v",
                    ['X-Shopify-Access-Token: dummy-token'],
                ),
                new MockRequest(
                    $this->buildMockHttpResponse(200, $this->successResponse, ['Link' => $firstPageLinkHeader]),
                    $this->getProductsAdminApiPaginationUrl("firstPageToken"),
                    "GET",
                    "Shopify Admin API Library for PHP v",
                    ['X-Shopify-Access-Token: dummy-token'],
                ),

            ]
        );
        $client = new Rest($this->domain, 'dummy-token');

        /** @var RestResponse */
        $response = $client->get('products', [], ["limit" => "10", "fields" => 'test1,test2']);
        $this->assertNull($response->getPageInfo()->getPreviousPageUrl());

        $this->assertTrue($response->getPageInfo()->hasNextPage());
        /** @var RestResponse */
        $response = $client->get('products', [], $response->getPageInfo()->getNextPageQuery());
        /** @var RestResponse */
        $response = $client->get('products', [], $response->getPageInfo()->getNextPageQuery());
        $this->assertFalse($response->getPageInfo()->hasNextPage());
        $this->assertNull($response->getPageInfo()->getNextPageUrl());


        $this->assertTrue($response->getPageInfo()->hasPreviousPage());
        /** @var RestResponse */
        $response = $client->get('products', [], $response->getPageInfo()->getPreviousPageQuery());
        /** @var RestResponse */
        $response = $client->get('products', [], $response->getPageInfo()->getPreviousPageQuery());
        $this->assertFalse($response->getPageInfo()->hasPreviousPage());
        $this->assertNull($response->getPageInfo()->getPreviousPageUrl());
    }
}
