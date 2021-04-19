<?php

declare(strict_types=1);

namespace ShopifyTest\Clients;

use Shopify\Clients\Http;
use Shopify\Clients\HttpResponse;
use Shopify\Clients\Rest;
use Shopify\Context;
use ShopifyTest\BaseTestCase;

class RestTest extends BaseTestCase
{

    private array $successResponse = [
        'products' => [
            'title' => 'Test Product',
            'amount' => 1,
        ],
    ];

    public function testFailsToInstantiateWithoutAccessTokenForNonPrivateApps()
    {
        $this->expectException('\Shopify\Exception\MissingArgumentException');

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
                url: "https://$this->domain/admin/api/" . Context::$API_VERSION . "/products.json",
                method: 'GET',
                userAgent: "Shopify Admin API Library for PHP v$this->version",
                headers: ["X-Test-Header: test_value", "X-Shopify-Access-Token: " . Context::$API_SECRET_KEY],
                response: $this->buildMockHttpResponse(200, $this->successResponse),
                allowOtherHeaders: false,
            ),
        ]);

        $expectedResponse = new HttpResponse(200, [], $this->successResponse);

        $response = $client->get(path: 'products', headers: $headers);

        $this->assertEquals($expectedResponse, $response);
    }

    public function testCanMakeGetRequest()
    {
        $headers = ['X-Test-Header' => 'test_value'];

        $client = new Rest($this->domain, 'dummy-token');

        $this->mockTransportRequests([
            new MockRequest(
                url: "https://$this->domain/admin/api/" . Context::$API_VERSION . "/products.json",
                method: 'GET',
                userAgent: "Shopify Admin API Library for PHP v$this->version",
                headers: ['X-Test-Header: test_value', 'X-Shopify-Access-Token: dummy-token'],
                response: $this->buildMockHttpResponse(200, $this->successResponse),
                allowOtherHeaders: false,
            ),
        ]);

        $expectedResponse = new HttpResponse(200, [], $this->successResponse);

        $response = $client->get(path: 'products', headers: $headers);

        $this->assertEquals($expectedResponse, $response);
    }

    public function testCanMakeGetRequestWithPathInQuery()
    {
        $client = new Rest($this->domain, 'dummy-token');

        $this->mockTransportRequests([
            new MockRequest(
                url: "https://$this->domain/admin/api/" . Context::$API_VERSION . "/products.json?path=some_path",
                method: 'GET',
                userAgent: "Shopify Admin API Library for PHP v$this->version",
                headers: ['X-Shopify-Access-Token: dummy-token'],
                response: $this->buildMockHttpResponse(200, $this->successResponse),
                allowOtherHeaders: false,
            ),
        ]);

        $expectedResponse = new HttpResponse(200, [], $this->successResponse);

        $response = $client->get(path: 'products', query: ["path" => "some_path"]);

        $this->assertEquals($expectedResponse, $response);
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
                url: "https://$this->domain/admin/api/" . Context::$API_VERSION . "/products.json",
                method: 'POST',
                userAgent: "Shopify Admin API Library for PHP v$this->version",
                headers: [
                    'Content-Type: application/json',
                    "Content-Length: $bodyLength",
                    'X-Shopify-Access-Token: dummy-token',
                ],
                body: $body,
                response: $this->buildMockHttpResponse(200, $this->successResponse),
                allowOtherHeaders: false,
            ),
        ]);

        $expectedResponse = new HttpResponse(200, [], $this->successResponse);

        $response = $client->post(path: 'products', body: $postData, dataType: Http::DATA_TYPE_JSON);

        $this->assertEquals($expectedResponse, $response);
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
                url: "https://$this->domain/admin/api/" . Context::$API_VERSION . "/products.json?path=some_path",
                method: 'POST',
                userAgent: "Shopify Admin API Library for PHP v$this->version",
                headers: [
                    'Content-Type: application/json',
                    "Content-Length: $bodyLength",
                    'X-Shopify-Access-Token: dummy-token',
                ],
                body: $body,
                response: $this->buildMockHttpResponse(200, $this->successResponse),
                allowOtherHeaders: false,
            ),
        ]);

        $expectedResponse = new HttpResponse(200, [], $this->successResponse);

        $response = $client->post(
            path: 'products',
            body: $postData,
            dataType: Http::DATA_TYPE_JSON,
            query: ["path" => "some_path"]
        );

        $this->assertEquals($expectedResponse, $response);
    }

    public function testCanMakePostRequestWithFormData()
    {
        $client = new Rest($this->domain, 'dummy-token');

        $postData = [
            "title" => 'Test product',
            "amount" => 10,
        ];

        $body = http_build_query($postData);
        $bodyLength = strlen($body);

        $this->mockTransportRequests([
            new MockRequest(
                url: "https://$this->domain/admin/api/" . Context::$API_VERSION . "/products.json",
                method: 'POST',
                userAgent: "Shopify Admin API Library for PHP v$this->version",
                headers: [
                    'Content-Type: application/x-www-form-urlencoded',
                    "Content-Length: $bodyLength",
                    'X-Shopify-Access-Token: dummy-token',
                ],
                body: $body,
                response: $this->buildMockHttpResponse(
                    200,
                    $this->successResponse,
                    dataType: Http::DATA_TYPE_URL_ENCODED,
                ),
                allowOtherHeaders: false,
            ),
        ]);

        $expectedResponse = new HttpResponse(200, [], $this->successResponse);

        $response = $client->post(path: 'products', body: $postData, dataType: Http::DATA_TYPE_URL_ENCODED);

        $this->assertEquals($expectedResponse, $response);
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
                url: "https://$this->domain/admin/api/" . Context::$API_VERSION . "/products/123.json?path=some_path",
                method: 'PUT',
                userAgent: "Shopify Admin API Library for PHP v$this->version",
                headers: [
                    'Content-Type: application/json',
                    "Content-Length: $bodyLength",
                    'X-Shopify-Access-Token: dummy-token',
                ],
                body: $body,
                response: $this->buildMockHttpResponse(200, $this->successResponse),
                allowOtherHeaders: false,
            ),
        ]);

        $expectedResponse = new HttpResponse(200, [], $this->successResponse);

        $response = $client->put(
            path: 'products/123',
            body: $postData,
            dataType: Http::DATA_TYPE_JSON,
            query: ["path" => "some_path"]
        );

        $this->assertEquals($expectedResponse, $response);
    }

    public function testCanMakeDeleteRequest()
    {
        $headers = ['X-Test-Header' => 'test_value'];

        $client = new Rest($this->domain, 'dummy-token');

        $this->mockTransportRequests([
            new MockRequest(
                url: "https://$this->domain/admin/api/" . Context::$API_VERSION . "/products.json?path=some_path",
                method: 'DELETE',
                userAgent: "Shopify Admin API Library for PHP v$this->version",
                headers: ['X-Test-Header: test_value', 'X-Shopify-Access-Token: dummy-token'],
                response: $this->buildMockHttpResponse(200, $this->successResponse),
                allowOtherHeaders: false,
            ),
        ]);

        $expectedResponse = new HttpResponse(200, [], $this->successResponse);

        $response = $client->delete('products', $headers, query: ["path" => "some_path"]);

        $this->assertEquals($expectedResponse, $response);
    }
}
