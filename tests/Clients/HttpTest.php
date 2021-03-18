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
        $this->assertCurlOptions([CURLOPT_HTTPHEADER => ['X-Test-Header: test_value']], $this->curlOptions[0]);
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
        $this->assertCurlOptions(
            [
                CURLOPT_HTTPHEADER => [
                    'X-Test-Header: test_value',
                    'Content-Type: application/json',
                    "Content-Length: $bodyLength",
                ],
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => json_encode($this->product1),
            ],
            $this->curlOptions[0]
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
        $this->assertCurlOptions(
            [
                CURLOPT_HTTPHEADER => ['X-Test-Header: test_value'],
                CURLOPT_CUSTOMREQUEST => "PUT",
                CURLOPT_POSTFIELDS => json_encode($this->product1),
            ],
            $this->curlOptions[0]
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
        $this->assertCurlOptions(
            [
                CURLOPT_HTTPHEADER => ['X-Test-Header: test_value'],
                CURLOPT_CUSTOMREQUEST => "DELETE",
            ],
            $this->curlOptions[0]
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
        $this->assertCurlOptions(
            [
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $body,
            ],
            $this->curlOptions[0]
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
        $this->assertCurlOptions(
            [
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $body,
            ],
            $this->curlOptions[0]
        );
    }

    public function testUserAgent()
    {
        $version = require_once dirname(__FILE__) . '/../../src/version.php';
        $client = $this->getHttpClientWithMocks([
            $this->buildMockHttpResponse(200, $this->successResponse),
            $this->buildMockHttpResponse(200, $this->successResponse),
        ]);

        $client->get(path: 'test/path');
        $this->assertCurlOptions(
            [CURLOPT_USERAGENT => "Shopify Admin API Library for PHP v{$version}"],
            $this->curlOptions[0]
        );

        $client->get(path: 'test/path', headers: ['User-Agent' => "Extra user agent"]);
        $this->assertCurlOptions(
            [CURLOPT_USERAGENT => "Extra user agent | Shopify Admin API Library for PHP v{$version}"],
            $this->curlOptions[1]
        );
    }

    public function testEmptyResponseThrowsError()
    {
        $client = $this->getHttpClientWithMocks($this->buildMockHttpResponse(200, ''));

        $this->expectException('\Shopify\Exception\HttpRequestException');
        $client->get(path: 'test/path');
    }
}
