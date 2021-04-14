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

    public function testGetRequest()
    {
        $headers = ['X-Test-Header' => 'test_value'];
        $this->mockTransportWithExpectations(
            url: "https://$this->domain/test/path",
            method: "GET",
            userAgent: "Shopify Admin API Library for PHP v$this->version",
            headers: ['X-Test-Header: test_value'],
            response: $this->buildMockHttpResponse(200, $this->successResponse)
        );

        $client = new Http($this->domain);
        $expectedResponse = new HttpResponse();
        $expectedResponse->statusCode = 200;
        $expectedResponse->headers = [];
        $expectedResponse->body = $this->successResponse;
        $response = $client->get(path: 'test/path', headers: $headers);
        $this->assertEquals($expectedResponse, $response);
    }


    public function testPostRequest()
    {
        $headers = ['X-Test-Header' => 'test_value'];

        $body = json_encode($this->product1);
        $bodyLength = strlen($body);

        $this->mockTransportWithExpectations(
            url: "https://$this->domain/test/path",
            method: "POST",
            userAgent: "Shopify Admin API Library for PHP v$this->version",
            headers: ['Content-Type: application/json',
                "Content-Length: $bodyLength",
                'X-Test-Header: test_value'
            ],
            response: $this->buildMockHttpResponse(200, $this->successResponse),
            body: $body
        );

        $client = new Http($this->domain);

        $expectedResponse = new HttpResponse();
        $expectedResponse->statusCode = 200;
        $expectedResponse->headers = [];
        $expectedResponse->body = $this->successResponse;

        $response = $client->post(path: 'test/path', body: $this->product1, headers: $headers);
        $this->assertEquals($expectedResponse, $response);
    }


    public function testPutRequest()
    {
        $headers = ['X-Test-Header' => 'test_value'];

        $body = json_encode($this->product1);
        $bodyLength = strlen($body);

        $this->mockTransportWithExpectations(
            url: "https://$this->domain/test/path",
            method: "PUT",
            userAgent: "Shopify Admin API Library for PHP v$this->version",
            headers: ['Content-Type: application/json',
                "Content-Length: $bodyLength",
                'X-Test-Header: test_value'
            ],
            response: $this->buildMockHttpResponse(200, $this->successResponse),
            body: $body
        );

        $client = new Http($this->domain);

        $expectedResponse = new HttpResponse();
        $expectedResponse->statusCode = 200;
        $expectedResponse->headers = [];
        $expectedResponse->body = $this->successResponse;

        $response = $client->put(path: 'test/path', body: $this->product1, headers: $headers);
        $this->assertEquals($expectedResponse, $response);
    }

    public function testDeleteRequest()
    {
        $headers = ['X-Test-Header' => 'test_value'];

        $this->mockTransportWithExpectations(
            url: "https://$this->domain/test/path",
            method: "DELETE",
            userAgent: "Shopify Admin API Library for PHP v$this->version",
            headers: ['X-Test-Header: test_value'],
            response: $this->buildMockHttpResponse(200, $this->successResponse)
        );

        $client = new Http($this->domain);

        $expectedResponse = new HttpResponse();
        $expectedResponse->statusCode = 200;
        $expectedResponse->headers = [];
        $expectedResponse->body = $this->successResponse;

        $response = $client->delete(path: 'test/path', headers: $headers);
        $this->assertEquals($expectedResponse, $response);
    }

    public function testPostWithStringBody()
    {
        $body = json_encode($this->product1);
        $bodyLength = strlen($body);

        $this->mockTransportWithExpectations(
            url: "https://$this->domain/test/path",
            method: "POST",
            userAgent: "Shopify Admin API Library for PHP v$this->version",
            headers: ['Content-Type: application/json',
                "Content-Length: $bodyLength"
            ],
            response: $this->buildMockHttpResponse(200, $this->successResponse),
            body: $body
        );

        $client = new Http($this->domain);

        $expectedResponse = new HttpResponse();
        $expectedResponse->statusCode = 200;
        $expectedResponse->headers = [];
        $expectedResponse->body = $this->successResponse;

        $response = $client->post(path: 'test/path', body: $body);
        $this->assertEquals($expectedResponse, $response);
    }

    public function testPostWithUrlEncodedBody()
    {
        $body = http_build_query($this->product1);

        $bodyLength = strlen($body);

        $this->mockTransportWithExpectations(
            url: "https://$this->domain/test/path",
            method: "POST",
            userAgent: "Shopify Admin API Library for PHP v$this->version",
            headers: ['Content-Type: application/x-www-form-urlencoded',
                "Content-Length: $bodyLength"
            ],
            response: $this->buildMockHttpResponse(200, $this->successResponse, dataType: Http::DATA_TYPE_URL_ENCODED),
            body: $body
        );

        $client = new Http($this->domain);

        $expectedResponse = new HttpResponse();
        $expectedResponse->statusCode = 200;
        $expectedResponse->headers = [];
        $expectedResponse->body = $this->successResponse;

        $response = $client->post(path: 'test/path', body: $this->product1, dataType: Http::DATA_TYPE_URL_ENCODED);
        $this->assertEquals($expectedResponse, $response);
    }

    public function testUserAgent()
    {
        $this->mockTransportWithExpectations(
            url: "https://$this->domain/test/path",
            method: "GET",
            userAgent: "Shopify Admin API Library for PHP v$this->version",
            headers: [],
            response: $this->buildMockHttpResponse(200, $this->successResponse)
        );

        $client = new Http($this->domain);

        $client->get(path: 'test/path');


        $this->mockTransportWithExpectations(
            url: "https://$this->domain/test/path",
            method: "GET",
            userAgent: "Extra user agent | Shopify Admin API Library for PHP v$this->version",
            headers: [],
            response: $this->buildMockHttpResponse(200, $this->successResponse)
        );

        $client = new Http($this->domain);

        $client->get(path: 'test/path', headers: ['User-Agent' => "Extra user agent"]);

        Context::$USER_AGENT_PREFIX = 'Test default user agent';

        $this->mockTransportWithExpectations(
            url: "https://$this->domain/test/path",
            method: "GET",
            userAgent: "Test default user agent | Shopify Admin API Library for PHP v$this->version",
            headers: [],
            response: $this->buildMockHttpResponse(200, $this->successResponse)
        );
        $client = new Http($this->domain);

        $client->get(path: 'test/path');

        $this->mockTransportWithExpectations(
            url: "https://$this->domain/test/path",
            method: "GET",
            userAgent: "Extra user agent | Test default user agent | Shopify Admin API Library for PHP v$this->version",
            headers: [],
            response: $this->buildMockHttpResponse(200, $this->successResponse)
        );
        $client = new Http($this->domain);

        $client->get(path: 'test/path', headers: ['User-Agent' => "Extra user agent"]);
    }

    public function testRequestThrowsErrorOnCurlFailure()
    {
        $this->mockTransportWithExpectations(
            url: "https://$this->domain/test/path",
            method: "GET",
            userAgent: "Shopify Admin API Library for PHP v$this->version",
            headers: [],
            response: $this->buildMockHttpResponse(),
            error: 'Test error!'
        );
        $client = new Http($this->domain);

        $this->expectException('\Shopify\Exception\HttpRequestException');
        $client->get(path: 'test/path');
    }

    public function testRetryLogicForAllRetriableCodes()
    {

        $this->mockTransportWithExpectationsWithoutBodyWithMultipleResponses(
            "https://$this->domain/test/path",
            "GET",
            "Shopify Admin API Library for PHP v$this->version",
            [],
            [
                $this->buildMockHttpResponse(429, headers: ['Retry-After' => 0]),
                $this->buildMockHttpResponse(500),
                $this->buildMockHttpResponse(200, $this->successResponse),
            ]
        );

        $client = new Http($this->domain);

        $expectedResponse = new HttpResponse();
        $expectedResponse->statusCode = 200;
        $expectedResponse->headers = [];
        $expectedResponse->body = $this->successResponse;

        $response = $client->get(path: 'test/path', tries: 3);
        $this->assertEquals($expectedResponse, $response);
    }

    public function testRetryStopsAfterReachingTheLimit()
    {
        $this->mockTransportWithExpectationsWithoutBodyWithMultipleResponses(
            "https://$this->domain/test/path",
            "GET",
            "Shopify Admin API Library for PHP v$this->version",
            [],
            [
                $this->buildMockHttpResponse(500),
                $this->buildMockHttpResponse(500),
                $this->buildMockHttpResponse(500, headers: ['X-Is-Last-Test-Request' => true]),
            ]
        );

        $client = new Http($this->domain);

        $expectedResponse = new HttpResponse();
        $expectedResponse->statusCode = 500;
        $expectedResponse->headers = ['X-Is-Last-Test-Request' => true];
        $expectedResponse->body = null;

        $response = $client->get(path: 'test/path', tries: 3);
        $this->assertEquals($expectedResponse, $response);
    }

    public function testRetryStopsOnNonRetriableError()
    {
        $this->mockTransportWithExpectationsWithoutBodyWithMultipleResponses(
            "https://$this->domain/test/path",
            "GET",
            "Shopify Admin API Library for PHP v$this->version",
            [],
            [
                $this->buildMockHttpResponse(500),
                $this->buildMockHttpResponse(400, headers: ['X-Is-Last-Test-Request' => true]),
            ]
        );

        $client = new Http($this->domain);

        $expectedResponse = new HttpResponse();
        $expectedResponse->statusCode = 400;
        $expectedResponse->headers = ['X-Is-Last-Test-Request' => true];
        $expectedResponse->body = null;

        $response = $client->get(path: 'test/path', tries: 10);
        $this->assertEquals($expectedResponse, $response);
    }
}
