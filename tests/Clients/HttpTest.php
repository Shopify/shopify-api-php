<?php

declare(strict_types=1);

namespace ShopifyTest\Clients;

use org\bovigo\vfs\vfsStream;
use PHPUnit\Framework\MockObject\MockObject;
use Psr\Log\Test\TestLogger;
use Shopify\Clients\Http;
use Shopify\Context;
use ShopifyTest\BaseTestCase;
use ShopifyTest\HttpResponseMatcher;

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
        $response = $client->get(path: 'test/path', headers: $headers);
        $this->assertThat($response, new HttpResponseMatcher(decodedBody: $this->successResponse));
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
        $response = $client->get(path: 'test/path', headers: $headers, query: ["path" => "some_path"]);
        $this->assertThat($response, new HttpResponseMatcher(decodedBody: $this->successResponse));
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


        $response = $client->post(
            path: 'test/path',
            body: $this->product1,
            headers: $headers,
            query: ["path" => "some_path"]
        );
        $this->assertThat($response, new HttpResponseMatcher(decodedBody: $this->successResponse));
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


        $response = $client->put(
            path: 'test/path',
            body: $this->product1,
            headers: $headers,
            query: ["path" => "some_path"]
        );
        $this->assertThat($response, new HttpResponseMatcher(decodedBody: $this->successResponse));
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

        $response = $client->delete(path: 'test/path', headers: $headers, query: ["path" => "some_path"]);
        $this->assertThat($response, new HttpResponseMatcher(decodedBody: $this->successResponse));
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

        $response = $client->post(path: 'test/path', body: $body);
        $this->assertThat($response, new HttpResponseMatcher(decodedBody: $this->successResponse));
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

        $response = $client->get(path: 'test/path', tries: 3);
        $this->assertThat($response, new HttpResponseMatcher(decodedBody: $this->successResponse));
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

        $response = $client->get(path: 'test/path', tries: 3);
        $this->assertThat($response, new HttpResponseMatcher(500, ['X-Is-Last-Test-Request' => [true]]));
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

        $response = $client->get(path: 'test/path', tries: 10);
        $this->assertThat($response, new HttpResponseMatcher(400, ['X-Is-Last-Test-Request' => [true]]));
    }

    public function testDeprecatedRequestsAreLogged()
    {
        $vfsRoot = vfsStream::setup('test');

        /** @var MockObject|Http */
        $mockedClient = $this->getMockBuilder(Http::class)
            ->setConstructorArgs([$this->domain])
            ->onlyMethods(['getApiDeprecationTimestampFilePath'])
            ->getMock();
        $mockedClient->expects($this->once())
            ->method('getApiDeprecationTimestampFilePath')
            ->willReturn(vfsStream::url('test/timestamp_file'));

        $testLogger = new TestLogger();
        Context::$LOGGER = $testLogger;

        $this->mockTransportRequests([
            new MockRequest(
                url: "https://$this->domain/test/path",
                method: "GET",
                response: $this->buildMockHttpResponse(
                    200,
                    headers: ['X-Shopify-API-Deprecated-Reason' => 'Test reason'],
                ),
            ),
        ]);

        $this->assertFalse($vfsRoot->hasChild('timestamp_file'));
        $mockedClient->get('test/path');

        $this->assertTrue($testLogger->hasWarningThatContains(
            <<<NOTICE
            API Deprecation notice:
                URL: https://test-shop.myshopify.io/test/path
                Reason: Test reason
            Stack trace:
            NOTICE
        ));
        $this->assertTrue($vfsRoot->hasChild('timestamp_file'));
    }

    public function testDeprecationLogBackoffPeriod()
    {
        vfsStream::setup('test');

        /** @var MockObject|Http */
        $mockedClient = $this->getMockBuilder(Http::class)
            ->setConstructorArgs([$this->domain])
            ->onlyMethods(['getApiDeprecationTimestampFilePath'])
            ->getMock();
        $mockedClient->expects($this->exactly(3))
            ->method('getApiDeprecationTimestampFilePath')
            ->willReturn(vfsStream::url('test/timestamp_file'));

        $testLogger = new TestLogger();
        Context::$LOGGER = $testLogger;

        $this->mockTransportRequests([
            new MockRequest(
                url: "https://$this->domain/test/path",
                method: "GET",
                response: $this->buildMockHttpResponse(
                    200,
                    headers: ['X-Shopify-API-Deprecated-Reason' => 'Test reason'],
                ),
            ),
            new MockRequest(
                url: "https://$this->domain/test/path",
                method: "GET",
                response: $this->buildMockHttpResponse(
                    200,
                    headers: ['X-Shopify-API-Deprecated-Reason' => 'Test reason'],
                ),
            ),
            new MockRequest(
                url: "https://$this->domain/test/path",
                method: "GET",
                response: $this->buildMockHttpResponse(
                    200,
                    headers: ['X-Shopify-API-Deprecated-Reason' => 'Test reason'],
                ),
            ),
        ]);

        $this->assertCount(0, $testLogger->records);

        $mockedClient->get('test/path');
        $this->assertCount(1, $testLogger->records);

        $mockedClient->get('test/path');
        $this->assertCount(1, $testLogger->records);

        // We only log once every minute, so simulate more time than having elapsed
        file_put_contents(vfsStream::url('test/timestamp_file'), time() - 70);

        $mockedClient->get('test/path');
        $this->assertCount(2, $testLogger->records);
    }
}
