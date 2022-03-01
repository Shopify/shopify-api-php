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
    /** @var array */
    private $product1 = [
        'title' => 'Test Product',
        'amount' => 1,
    ];
    /** @var array */
    private $successResponse = [
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
                $this->buildMockHttpResponse(200, $this->successResponse),
                "https://$this->domain/test/path",
                "GET",
                "^Shopify Admin API Library for PHP v$this->version$",
                ['X-Test-Header: test_value'],
                null,
                null,
                false,
            ),
        ]);

        $client = new Http($this->domain);
        $response = $client->get('test/path', $headers);
        $this->assertThat($response, new HttpResponseMatcher(200, [], $this->successResponse));
    }

    public function testGetRequest()
    {
        $headers = ['X-Test-Header' => 'test_value'];
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, $this->successResponse),
                "https://$this->domain/test/path?path=some_path",
                "GET",
                "^Shopify Admin API Library for PHP v$this->version$",
                ['X-Test-Header: test_value'],
                null,
                null,
                false,
            ),
        ]);

        $client = new Http($this->domain);
        $response = $client->get('test/path', $headers, ["path" => "some_path"]);
        $this->assertThat($response, new HttpResponseMatcher(200, [], $this->successResponse));
    }

    public function testGetRequestWithArrayInQuery()
    {
        $headers = ['X-Test-Header' => 'test_value'];
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, $this->successResponse),
                "https://$this->domain/test/path?array[]=value&hash[key1]=value1&hash[key2]=value2",
                "GET",
                "^Shopify Admin API Library for PHP v$this->version$",
                ['X-Test-Header: test_value'],
                null,
                null,
                false,
            ),
        ]);

        $client = new Http($this->domain);
        $response = $client->get(
            'test/path',
            $headers,
            ["array" => ["value"], "hash" => ["key1" => "value1", "key2" => "value2"]]
        );
        $this->assertThat($response, new HttpResponseMatcher(200, [], $this->successResponse));
    }

    public function testPostRequest()
    {
        $headers = ['X-Test-Header' => 'test_value'];

        $body = json_encode($this->product1);
        $bodyLength = strlen($body);

        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, $this->successResponse),
                "https://$this->domain/test/path?path=some_path",
                "POST",
                "^Shopify Admin API Library for PHP v$this->version$",
                [
                    'Content-Type: application/json',
                    "Content-Length: $bodyLength",
                    'X-Test-Header: test_value',
                ],
                $body,
                null,
                false,
            ),
        ]);

        $client = new Http($this->domain);


        $response = $client->post('test/path', $this->product1, $headers, ["path" => "some_path"]);
        $this->assertThat($response, new HttpResponseMatcher(200, [], $this->successResponse));
    }


    public function testPutRequest()
    {
        $headers = ['X-Test-Header' => 'test_value'];

        $body = json_encode($this->product1);
        $bodyLength = strlen($body);

        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, $this->successResponse),
                "https://$this->domain/test/path?path=some_path",
                "PUT",
                "^Shopify Admin API Library for PHP v$this->version$",
                [
                    'Content-Type: application/json',
                    "Content-Length: $bodyLength",
                    'X-Test-Header: test_value',
                ],
                $body,
                null,
                false,
            ),
        ]);

        $client = new Http($this->domain);


        $response = $client->put('test/path', $this->product1, $headers, ["path" => "some_path"]);
        $this->assertThat($response, new HttpResponseMatcher(200, [], $this->successResponse));
    }

    public function testDeleteRequest()
    {
        $headers = ['X-Test-Header' => 'test_value'];

        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, $this->successResponse),
                "https://$this->domain/test/path?path=some_path",
                "DELETE",
                "^Shopify Admin API Library for PHP v$this->version$",
                ['X-Test-Header: test_value'],
                null,
                null,
                false,
            ),
        ]);

        $client = new Http($this->domain);

        $response = $client->delete('test/path', $headers, ["path" => "some_path"]);
        $this->assertThat($response, new HttpResponseMatcher(200, [], $this->successResponse));
    }

    public function testPostWithStringBody()
    {
        $body = json_encode($this->product1);
        $bodyLength = strlen($body);

        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, $this->successResponse),
                "https://$this->domain/test/path",
                "POST",
                "^Shopify Admin API Library for PHP v$this->version$",
                [
                    'Content-Type: application/json',
                    "Content-Length: $bodyLength",
                ],
                $body,
                null,
                false,
            ),
        ]);

        $client = new Http($this->domain);

        $response = $client->post('test/path', $body);
        $this->assertThat($response, new HttpResponseMatcher(200, [], $this->successResponse));
    }

    public function testUserAgent()
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, $this->successResponse),
                "https://$this->domain/test/path",
                "GET",
                "^Shopify Admin API Library for PHP v$this->version$",
                [],
                null,
                null,
                false,
            ),
        ]);

        $client = new Http($this->domain);
        $client->get('test/path');

        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, $this->successResponse),
                "https://$this->domain/test/path",
                "GET",
                "^Extra user agent | Shopify Admin API Library for PHP v$this->version$",
                [],
                null,
                null,
                false,
            ),
        ]);

        $client->get('test/path', ['User-Agent' => "Extra user agent"]);

        Context::$USER_AGENT_PREFIX = 'Test default user agent';

        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, $this->successResponse),
                "https://$this->domain/test/path",
                "GET",
                "^Test default user agent | Shopify Admin API Library for PHP v$this->version$",
                [],
                null,
                null,
                false,
            ),
        ]);

        $client->get('test/path');

        $userAgent = "^Extra user agent | Test default user agent | Shopify Admin API Library for PHP v$this->version$";
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, $this->successResponse),
                "https://$this->domain/test/path",
                "GET",
                $userAgent,
                [],
                null,
                null,
                false,
            ),
        ]);

        $client->get('test/path', ['User-Agent' => "Extra user agent"]);
    }

    public function testRequestThrowsErrorOnRequestFailure()
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(),
                "https://$this->domain/test/path",
                "GET",
                "^Shopify Admin API Library for PHP v$this->version$",
                [],
                null,
                'Test error!',
                false,
            ),
        ]);

        $client = new Http($this->domain);
        $this->expectException(\Shopify\Exception\HttpRequestException::class);
        $client->get('test/path');
    }

    public function testRetryAfterCanBeFloat()
    {
        $this->mockTransportRequests([
            new MockRequest(
                // 1ms sleep time so we don't affect test run times
                $this->buildMockHttpResponse(429, null, ['Retry-After' => 0.001]),
                "https://$this->domain/test/path",
                "GET",
                "^Shopify Admin API Library for PHP v$this->version$",
            ),
            new MockRequest(
                $this->buildMockHttpResponse(200, $this->successResponse),
                "https://$this->domain/test/path",
                "GET",
                null,
                [],
                null,
                null,
                true,
                true,
            ),
        ]);

        $client = new Http($this->domain);

        $response = $client->get('test/path', [], [], 2);
        $this->assertThat($response, new HttpResponseMatcher(200, [], $this->successResponse));
    }

    public function testRetryLogicForAllRetriableCodes()
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(429, null, ['Retry-After' => 0]),
                "https://$this->domain/test/path",
                "GET",
                "^Shopify Admin API Library for PHP v$this->version$",
            ),
            new MockRequest(
                $this->buildMockHttpResponse(500),
                "https://$this->domain/test/path",
                "GET",
                null,
                [],
                null,
                null,
                true,
                true,
            ),
            new MockRequest(
                $this->buildMockHttpResponse(200, $this->successResponse),
                "https://$this->domain/test/path",
                "GET",
                null,
                [],
                null,
                null,
                true,
                true,
            ),
        ]);

        $client = new Http($this->domain);

        $response = $client->get('test/path', [], [], 3);
        $this->assertThat($response, new HttpResponseMatcher(200, [], $this->successResponse));
    }

    public function testRetryStopsAfterReachingTheLimit()
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(500),
                "https://$this->domain/test/path",
                "GET",
                "^Shopify Admin API Library for PHP v$this->version$",
            ),
            new MockRequest(
                $this->buildMockHttpResponse(500),
                "https://$this->domain/test/path",
                "GET",
                null,
                [],
                null,
                null,
                true,
                true,
            ),
            new MockRequest(
                $this->buildMockHttpResponse(500, null, ['X-Is-Last-Test-Request' => true]),
                "https://$this->domain/test/path",
                "GET",
                null,
                [],
                null,
                null,
                true,
                true,
            ),
        ]);

        $client = new Http($this->domain);

        $response = $client->get('test/path', [], [], 3);
        $this->assertThat($response, new HttpResponseMatcher(500, ['X-Is-Last-Test-Request' => [true]]));
    }

    public function testRetryStopsOnNonRetriableError()
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(500),
                "https://$this->domain/test/path",
                "GET",
                "^Shopify Admin API Library for PHP v$this->version$",
            ),
            new MockRequest(
                $this->buildMockHttpResponse(400, null, ['X-Is-Last-Test-Request' => true]),
                "https://$this->domain/test/path",
                "GET",
                null,
                [],
                null,
                null,
                true,
                true,
            ),
        ]);

        $client = new Http($this->domain);

        $response = $client->get('test/path', [], [], 10);
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
                $this->buildMockHttpResponse(200, null, ['X-Shopify-API-Deprecated-Reason' => 'Test reason']),
                "https://$this->domain/test/path",
                "GET",
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
                $this->buildMockHttpResponse(200, null, ['X-Shopify-API-Deprecated-Reason' => 'Test reason']),
                "https://$this->domain/test/path",
                "GET",
            ),
            new MockRequest(
                $this->buildMockHttpResponse(200, null, ['X-Shopify-API-Deprecated-Reason' => 'Test reason']),
                "https://$this->domain/test/path",
                "GET",
            ),
            new MockRequest(
                $this->buildMockHttpResponse(200, null, ['X-Shopify-API-Deprecated-Reason' => 'Test reason']),
                "https://$this->domain/test/path",
                "GET",
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
