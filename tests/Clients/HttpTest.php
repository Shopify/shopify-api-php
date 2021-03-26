<?php

declare(strict_types=1);

namespace ShopifyTest\Clients;

use Shopify\Clients\Http;
use Shopify\Clients\HttpResponse;
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
        $client = $this->getHttpClientWithMocks($this->buildMockHttpResponse(200, $this->successResponse));

        $expectedResponse = new HttpResponse();
        $expectedResponse->statusCode = 200;
        $expectedResponse->headers = [];
        $expectedResponse->body = $this->successResponse;

        $response = $client->get(path: 'test/path', headers: $headers);
        $this->assertEquals($expectedResponse, $response);
        $this->assertHttpRequest("{$this->domain}/test/path", [CURLOPT_HTTPHEADER => ['X-Test-Header: test_value']]);
    }

    public function testPostRequest()
    {
        $headers = ['X-Test-Header' => 'test_value'];
        $client = $this->getHttpClientWithMocks($this->buildMockHttpResponse(200, $this->successResponse));

        $expectedResponse = new HttpResponse();
        $expectedResponse->statusCode = 200;
        $expectedResponse->headers = [];
        $expectedResponse->body = $this->successResponse;

        $bodyLength = strlen(json_encode($this->product1));
        $response = $client->post(path: 'test/path', body: $this->product1, headers: $headers);
        $this->assertEquals($expectedResponse, $response);
        $this->assertHttpRequest(
            "{$this->domain}/test/path",
            [
                CURLOPT_HTTPHEADER => [
                    'X-Test-Header: test_value',
                    'Content-Type: application/json',
                    "Content-Length: $bodyLength",
                ],
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => json_encode($this->product1),
            ]
        );
    }

    public function testPutRequest()
    {
        $headers = ['X-Test-Header' => 'test_value'];
        $client = $this->getHttpClientWithMocks($this->buildMockHttpResponse(200, $this->successResponse));

        $expectedResponse = new HttpResponse();
        $expectedResponse->statusCode = 200;
        $expectedResponse->headers = [];
        $expectedResponse->body = $this->successResponse;

        $response = $client->put(path: 'test/path', body: $this->product1, headers: $headers);
        $this->assertEquals($expectedResponse, $response);
        $this->assertHttpRequest(
            "{$this->domain}/test/path",
            [
                CURLOPT_HTTPHEADER => ['X-Test-Header: test_value'],
                CURLOPT_CUSTOMREQUEST => "PUT",
                CURLOPT_POSTFIELDS => json_encode($this->product1),
            ]
        );
    }

    public function testDeleteRequest()
    {
        $headers = ['X-Test-Header' => 'test_value'];
        $client = $this->getHttpClientWithMocks($this->buildMockHttpResponse(200, $this->successResponse));

        $expectedResponse = new HttpResponse();
        $expectedResponse->statusCode = 200;
        $expectedResponse->headers = [];
        $expectedResponse->body = $this->successResponse;

        $response = $client->delete(path: 'test/path', headers: $headers);
        $this->assertEquals($expectedResponse, $response);
        $this->assertHttpRequest(
            "{$this->domain}/test/path",
            [
                CURLOPT_HTTPHEADER => ['X-Test-Header: test_value'],
                CURLOPT_CUSTOMREQUEST => "DELETE",
            ]
        );
    }

    public function testPostWithStringBody()
    {
        $body = json_encode($this->product1);
        $client = $this->getHttpClientWithMocks($this->buildMockHttpResponse(200, $this->successResponse));

        $expectedResponse = new HttpResponse();
        $expectedResponse->statusCode = 200;
        $expectedResponse->headers = [];
        $expectedResponse->body = $this->successResponse;

        $response = $client->post(path: 'test/path', body: $body);
        $this->assertEquals($expectedResponse, $response);
        $this->assertHttpRequest(
            "{$this->domain}/test/path",
            [
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $body,
            ]
        );
    }

    public function testPostWithUrlEncodedBody()
    {
        $body = http_build_query($this->product1);
        $client = $this->getHttpClientWithMocks(
            $this->buildMockHttpResponse(200, $this->successResponse, dataType: Http::DATA_TYPE_URL_ENCODED)
        );

        $expectedResponse = new HttpResponse();
        $expectedResponse->statusCode = 200;
        $expectedResponse->headers = [];
        $expectedResponse->body = $this->successResponse;

        $response = $client->post(path: 'test/path', body: $this->product1, dataType: Http::DATA_TYPE_URL_ENCODED);
        $this->assertEquals($expectedResponse, $response);
        $this->assertHttpRequest(
            "{$this->domain}/test/path",
            [
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $body,
            ]
        );
    }

    public function testUserAgent()
    {
        $version = require dirname(__FILE__) . '/../../src/version.php';
        $client = $this->getHttpClientWithMocks([
            $this->buildMockHttpResponse(200, $this->successResponse),
            $this->buildMockHttpResponse(200, $this->successResponse),
        ]);

        $client->get(path: 'test/path');
        $this->assertHttpRequest(
            "{$this->domain}/test/path",
            [CURLOPT_USERAGENT => "Shopify Admin API Library for PHP v{$version}"]
        );

        $client->get(path: 'test/path', headers: ['User-Agent' => "Extra user agent"]);
        $this->assertHttpRequest(
            "{$this->domain}/test/path",
            [CURLOPT_USERAGENT => "Extra user agent | Shopify Admin API Library for PHP v{$version}"]
        );
    }

    public function testRequestThrowsErrorOnCurlFailure()
    {
        $client = $this->getHttpClientWithMocks($this->buildMockHttpResponse(error: 'Test error!'));

        $this->expectException('\Shopify\Exception\HttpRequestException');
        $client->get(path: 'test/path');
    }

    public function testRetryLogicForAllRetriableCodes()
    {
        $client = $this->getHttpClientWithMocks([
            $this->buildMockHttpResponse(429, headers: ['Retry-After' => 0]),
            $this->buildMockHttpResponse(500),
            $this->buildMockHttpResponse(200, $this->successResponse),
        ]);

        $expectedResponse = new HttpResponse();
        $expectedResponse->statusCode = 200;
        $expectedResponse->headers = [];
        $expectedResponse->body = $this->successResponse;

        $response = $client->get(path: 'test/path', tries: 3);
        $this->assertEquals($expectedResponse, $response);
    }

    public function testRetryStopsAfterReachingTheLimit()
    {
        $client = $this->getHttpClientWithMocks([
            $this->buildMockHttpResponse(500),
            $this->buildMockHttpResponse(500),
            $this->buildMockHttpResponse(500, headers: ['X-Is-Last-Test-Request' => true]),
        ]);

        $expectedResponse = new HttpResponse();
        $expectedResponse->statusCode = 500;
        $expectedResponse->headers = ['X-Is-Last-Test-Request' => true];
        $expectedResponse->body = null;

        $response = $client->get(path: 'test/path', tries: 3);
        $this->assertEquals($expectedResponse, $response);
    }

    public function testRetryStopsOnNonRetriableError()
    {
        $client = $this->getHttpClientWithMocks([
            $this->buildMockHttpResponse(500),
            $this->buildMockHttpResponse(400, headers: ['X-Is-Last-Test-Request' => true]),
        ]);

        $expectedResponse = new HttpResponse();
        $expectedResponse->statusCode = 400;
        $expectedResponse->headers = ['X-Is-Last-Test-Request' => true];
        $expectedResponse->body = null;

        $response = $client->get(path: 'test/path', tries: 10);
        $this->assertEquals($expectedResponse, $response);
    }

    public function testDefaultWaitTime()
    {
        $client = new Http($this->domain);
        $this->assertEquals(1, $client->getDefaultRetrySeconds());
    }
}
