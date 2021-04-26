<?php

declare(strict_types=1);

namespace ShopifyTest\Clients;

use Shopify\Clients\Http;
use Shopify\Clients\HttpResponse;
use Shopify\Context;
use ShopifyTest\BaseTestCase;

final class HttpTest extends BaseTestCase
{
    private array $product1 = [
        'title' => 'Test Product',
        'amount' => 1,
    ];
    private array $successResponse = [
        'products' => [
            'title' => 'Test Product',
            'amount' => 1,
        ],
    ];

    public function testGetRequestWithoutQuery()
    {
        $headers = ['X-Test-Header' => 'test_value'];
        $this->mockTransportRequests([
            new MockRequest(
                url: "https://$this->domain/test/path",
                method: "GET",
                userAgent: "^Shopify Admin API Library for PHP v$this->version$",
                headers: ['X-Test-Header: test_value'],
                response: $this->buildMockHttpResponse(200, $this->successResponse),
                allowOtherHeaders: false,
            ),
        ]);

        $client = new Http($this->domain);
        $expectedResponse = new HttpResponse(200, [], $this->successResponse);
        $response = $client->get(path: 'test/path', headers: $headers);
        $this->assertEquals($expectedResponse, $response);
    }

    public function testGetRequest()
    {
        $headers = ['X-Test-Header' => 'test_value'];
        $this->mockTransportRequests([
            new MockRequest(
                url: "https://$this->domain/test/path?path=some_path",
                method: "GET",
                userAgent: "^Shopify Admin API Library for PHP v$this->version$",
                headers: ['X-Test-Header: test_value'],
                response: $this->buildMockHttpResponse(200, $this->successResponse),
                allowOtherHeaders: false,
            ),
        ]);

        $client = new Http($this->domain);
        $expectedResponse = new HttpResponse(200, [], $this->successResponse);
        $response = $client->get(path: 'test/path', headers: $headers, query: ["path" => "some_path"]);
        $this->assertEquals($expectedResponse, $response);
    }

    public function testPostRequest()
    {
        $headers = ['X-Test-Header' => 'test_value'];

        $body = json_encode($this->product1);
        $bodyLength = strlen($body);

        $this->mockTransportRequests([
            new MockRequest(
                url: "https://$this->domain/test/path?path=some_path",
                method: "POST",
                userAgent: "^Shopify Admin API Library for PHP v$this->version$",
                headers: [
                    'Content-Type: application/json',
                    "Content-Length: $bodyLength",
                    'X-Test-Header: test_value',
                ],
                body: $body,
                response: $this->buildMockHttpResponse(200, $this->successResponse),
                allowOtherHeaders: false,
            ),
        ]);

        $client = new Http($this->domain);

        $expectedResponse = new HttpResponse(200, [], $this->successResponse);

        $response = $client->post(
            path: 'test/path',
            body: $this->product1,
            headers: $headers,
            query: ["path" => "some_path"]
        );
        $this->assertEquals($expectedResponse, $response);
    }


    public function testPutRequest()
    {
        $headers = ['X-Test-Header' => 'test_value'];

        $body = json_encode($this->product1);
        $bodyLength = strlen($body);

        $this->mockTransportRequests([
            new MockRequest(
                url: "https://$this->domain/test/path?path=some_path",
                method: "PUT",
                userAgent: "^Shopify Admin API Library for PHP v$this->version$",
                headers: [
                    'Content-Type: application/json',
                    "Content-Length: $bodyLength",
                    'X-Test-Header: test_value',
                ],
                body: $body,
                response: $this->buildMockHttpResponse(200, $this->successResponse),
                allowOtherHeaders: false,
            ),
        ]);

        $client = new Http($this->domain);

        $expectedResponse = new HttpResponse(200, [], $this->successResponse);

        $response = $client->put(
            path: 'test/path',
            body: $this->product1,
            headers: $headers,
            query: ["path" => "some_path"]
        );
        $this->assertEquals($expectedResponse, $response);
    }

    public function testDeleteRequest()
    {
        $headers = ['X-Test-Header' => 'test_value'];

        $this->mockTransportRequests([
            new MockRequest(
                url: "https://$this->domain/test/path?path=some_path",
                method: "DELETE",
                userAgent: "^Shopify Admin API Library for PHP v$this->version$",
                headers: ['X-Test-Header: test_value'],
                response: $this->buildMockHttpResponse(200, $this->successResponse),
                allowOtherHeaders: false,
            ),
        ]);

        $client = new Http($this->domain);

        $expectedResponse = new HttpResponse(200, [], $this->successResponse);

        $response = $client->delete(path: 'test/path', headers: $headers, query: ["path" => "some_path"]);
        $this->assertEquals($expectedResponse, $response);
    }

    public function testPostWithStringBody()
    {
        $body = json_encode($this->product1);
        $bodyLength = strlen($body);

        $this->mockTransportRequests([
            new MockRequest(
                url: "https://$this->domain/test/path",
                method: "POST",
                userAgent: "^Shopify Admin API Library for PHP v$this->version$",
                headers: [
                    'Content-Type: application/json',
                    "Content-Length: $bodyLength",
                ],
                body: $body,
                response: $this->buildMockHttpResponse(200, $this->successResponse),
                allowOtherHeaders: false,
            ),
        ]);

        $client = new Http($this->domain);

        $expectedResponse = new HttpResponse(200, [], $this->successResponse);


        $response = $client->post(path: 'test/path', body: $body);
        $this->assertEquals($expectedResponse, $response);
    }

    public function testUserAgent()
    {
        $this->mockTransportRequests([
            new MockRequest(
                url: "https://$this->domain/test/path",
                method: "GET",
                userAgent: "^Shopify Admin API Library for PHP v$this->version$",
                headers: [],
                response: $this->buildMockHttpResponse(200, $this->successResponse),
                allowOtherHeaders: false,
            ),
        ]);

        $client = new Http($this->domain);
        $client->get(path: 'test/path');

        $this->mockTransportRequests([
            new MockRequest(
                url: "https://$this->domain/test/path",
                method: "GET",
                userAgent: "^Extra user agent | Shopify Admin API Library for PHP v$this->version$",
                headers: [],
                response: $this->buildMockHttpResponse(200, $this->successResponse),
                allowOtherHeaders: false,
            ),
        ]);

        $client->get(path: 'test/path', headers: ['User-Agent' => "Extra user agent"]);

        Context::$USER_AGENT_PREFIX = 'Test default user agent';

        $this->mockTransportRequests([
            new MockRequest(
                url: "https://$this->domain/test/path",
                method: "GET",
                userAgent: "^Test default user agent | Shopify Admin API Library for PHP v$this->version$",
                headers: [],
                response: $this->buildMockHttpResponse(200, $this->successResponse),
                allowOtherHeaders: false,
            ),
        ]);

        $client->get(path: 'test/path');

        $this->mockTransportRequests([
            new MockRequest(
                url: "https://$this->domain/test/path",
                method: "GET",
                // phpcs:ignore
                userAgent: "^Extra user agent | Test default user agent | Shopify Admin API Library for PHP v$this->version$",
                headers: [],
                response: $this->buildMockHttpResponse(200, $this->successResponse),
                allowOtherHeaders: false,
            ),
        ]);

        $client->get(path: 'test/path', headers: ['User-Agent' => "Extra user agent"]);
    }

    public function testRequestThrowsErrorOnCurlFailure()
    {
        $this->mockTransportRequests([
            new MockRequest(
                url: "https://$this->domain/test/path",
                method: "GET",
                userAgent: "^Shopify Admin API Library for PHP v$this->version$",
                headers: [],
                response: $this->buildMockHttpResponse(),
                error: 'Test error!',
                allowOtherHeaders: false,
            ),
        ]);

        $client = new Http($this->domain);
        $this->expectException('\Shopify\Exception\HttpRequestException');
        $client->get(path: 'test/path');
    }

    public function testRetryLogicForAllRetriableCodes()
    {
        $this->mockTransportRequests([
            new MockRequest(
                url: "https://$this->domain/test/path",
                method: "GET",
                userAgent: "^Shopify Admin API Library for PHP v$this->version$",
                response: $this->buildMockHttpResponse(429, headers: ['Retry-After' => 0]),
            ),
            new MockRequest(
                url: "https://$this->domain/test/path",
                method: "GET",
                response: $this->buildMockHttpResponse(500),
                isRetry: true,
            ),
            new MockRequest(
                url: "https://$this->domain/test/path",
                method: "GET",
                response: $this->buildMockHttpResponse(200, $this->successResponse),
                isRetry: true,
            ),
        ]);

        $client = new Http($this->domain);

        $expectedResponse = new HttpResponse(200, [], $this->successResponse);

        $response = $client->get(path: 'test/path', tries: 3);
        $this->assertEquals($expectedResponse, $response);
    }

    public function testRetryStopsAfterReachingTheLimit()
    {
        $this->mockTransportRequests([
            new MockRequest(
                url: "https://$this->domain/test/path",
                method: "GET",
                userAgent: "^Shopify Admin API Library for PHP v$this->version$",
                response: $this->buildMockHttpResponse(500),
            ),
            new MockRequest(
                url: "https://$this->domain/test/path",
                method: "GET",
                response: $this->buildMockHttpResponse(500),
                isRetry: true,
            ),
            new MockRequest(
                url: "https://$this->domain/test/path",
                method: "GET",
                response: $this->buildMockHttpResponse(500, headers: ['X-Is-Last-Test-Request' => true]),
                isRetry: true,
            ),
        ]);

        $client = new Http($this->domain);

        $expectedResponse = new HttpResponse(500, ['X-Is-Last-Test-Request' => [true]]);

        $response = $client->get(path: 'test/path', tries: 3);
        $this->assertEquals($expectedResponse, $response);
    }

    public function testRetryStopsOnNonRetriableError()
    {
        $this->mockTransportRequests([
            new MockRequest(
                url: "https://$this->domain/test/path",
                method: "GET",
                userAgent: "^Shopify Admin API Library for PHP v$this->version$",
                response: $this->buildMockHttpResponse(500),
            ),
            new MockRequest(
                url: "https://$this->domain/test/path",
                method: "GET",
                response: $this->buildMockHttpResponse(400, headers: ['X-Is-Last-Test-Request' => true]),
                isRetry: true,
            ),
        ]);

        $client = new Http($this->domain);

        $expectedResponse = new HttpResponse(400, ['X-Is-Last-Test-Request' => [true]]);

        $response = $client->get(path: 'test/path', tries: 10);
        $this->assertEquals($expectedResponse, $response);
    }
}
