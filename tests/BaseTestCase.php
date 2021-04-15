<?php

declare(strict_types=1);

namespace ShopifyTest;

use PHPUnit\Framework\TestCase;
use Shopify\Clients\Http;
use Shopify\Clients\Transport;
use Shopify\Context;
use Shopify\Exception\HttpRequestException;
use ShopifyTest\Auth\MockSessionStorage;
use ShopifyTest\Clients\MockRequest;

define('RUNNING_SHOPIFY_TESTS', 1);

class BaseTestCase extends TestCase
{
    protected string $domain = 'test-shop.myshopify.io';
    protected array $requestDetails;
    protected int $lastCheckedRequest;
    protected string $version;

    public function setUp(): void
    {
        // Initialize Context before each test
        Context::initialize(
            apiKey: 'ash',
            apiSecretKey: 'steffi',
            scopes: ['sleepy', 'kitty'],
            hostName: 'www.my-friends-cats.com',
            sessionStorage: new MockSessionStorage(),
            apiVersion: 'unstable',
            isEmbeddedApp: true,
            isPrivateApp: false,
            userAgentPrefix: '',
        );
        Context::$TRANSPORT = $this->createMock(Transport::class);
        Context::$RETRY_TIME_IN_SECONDS = 0;
        $this->version = require dirname(__FILE__) . '/../src/version.php';
    }

    /**
     * Builds a mock HTTP response that can optionally also validate the parameters of the cURL call.
     *
     * @param int|null          $statusCode The HTTP status code to return
     * @param string|array|null $body       The body of the HTTP response
     * @param array             $headers    The headers expected in the response
     * @param string            $dataType   The data type of the response
     * @param string|null       $error      The cURL error message to return
     *
     * @return array
     */
    protected function buildMockHttpResponse(
        int $statusCode = null,
        string | array $body = null,
        array $headers = [],
        string $dataType = Http::DATA_TYPE_JSON,
        string $error = null
    ): array {
        if ($body && !is_string($body)) {
            switch ($dataType) {
                case Http::DATA_TYPE_JSON:
                    $body = json_encode($body);
                    break;
                case Http::DATA_TYPE_URL_ENCODED:
                    $body = http_build_query($body);
                    break;
            }
        }

        return [
            'statusCode' => $statusCode,
            'body' => $body,
            'headers' => $headers,
            'error' => $error,
        ];
    }

    /**
     * Sets up a transport layer mock that expects the given requests to happen.
     *
     * @param MockRequest[] $requests
     */
    public function mockTransportRequests(array $requests): void
    {
        $mock = $this->createMock(Transport::class);

        $urls = [];
        $methods = [];
        $userAgents = [];
        $headers = [];
        $bodies = [];
        $responses = [];
        foreach ($requests as $request) {
            $urls[] = [$request->url];
            $methods[] = [$request->method];

            // We only need to know if the actual user agent contains the string we expect
            $userAgents[] = [$this->matchesRegularExpression("/$request->userAgent/")];

            // We only want to check that the values we're expecting are there, without caring about others
            if ($request->allowOtherHeaders) {
                $headers[] = [$this->containsEqual(...$request->headers)];
            } else {
                $headers[] = [$request->headers];
            }

            if ($request->body) {
                $bodies[] = [$request->body];
            }

            $responses[] = $request->error ? 'TEST EXCEPTION' : $request->response;
        }

        $mock->expects($this->exactly(count($urls)))
            ->method('initializeRequest')
            ->withConsecutive(...$urls);

        $mock->expects($this->exactly(count($methods)))
            ->method('setMethod')
            ->withConsecutive(...$methods);

        $mock->expects($this->exactly(count($userAgents)))
            ->method('setUserAgent')
            ->withConsecutive(...$userAgents);

        $mock->expects($this->exactly(count($headers)))
            ->method('setHeader')
            ->withConsecutive(...$headers);

        $mock->expects($this->exactly(count($bodies)))
            ->method('setBody')
            ->withConsecutive(...$bodies);

        $i = 0;
        $mock->expects($this->exactly(count($responses)))
            ->method('sendRequest')
            ->willReturnCallback(function () use (&$i, $responses) {
                $response = $responses[$i++];

                if ($response === 'TEST EXCEPTION') {
                    throw new HttpRequestException();
                } else {
                    return $response;
                }
            });

        Context::$TRANSPORT = $mock;
    }

    /**
     * @param string      $url       Requested URL
     * @param string      $method    HTTP Method `PUT`, `POST`, `GET`, and `DELETE` supported
     * @param string      $userAgent User Agent
     * @param array       $headers   HTTP Headers
     * @param array       $response  Associative array with keys `body`, `error`, `headers`, and `error`
     * @param string|null $body      Request body
     * @param string|null $error     Error
     */
    public function mockTransportWithExpectations(
        string $url,
        string $method,
        string $userAgent,
        array $headers,
        array $response,
        ?string $body = null,
        ?string $error = null
    ): void {
        Context::$TRANSPORT = $this->createMock(Transport::class);

        Context::$TRANSPORT->expects($this->once())
            ->method('initializeRequest')
            ->with($this->equalTo($url));

        Context::$TRANSPORT->expects($this->once())
            ->method('setMethod')
            ->with($this->equalTo($method));

        Context::$TRANSPORT->expects($this->once())
            ->method('setUserAgent')
            ->with($this->equalTo($userAgent));

        Context::$TRANSPORT->expects($this->once())
            ->method('setHeader')
            ->with($this->equalTo($headers));

        if ($body) {
            Context::$TRANSPORT->expects($this->once())
                ->method('setBody')
                ->with($this->equalTo($body));
        } else {
            Context::$TRANSPORT->expects($this->never())
                ->method('setBody');
        }

        if ($error) {
            Context::$TRANSPORT->expects($this->once())
                ->method('sendRequest')
                ->will($this->throwException(new HttpRequestException()));
        } else {
            Context::$TRANSPORT->expects($this->once())
                ->method('sendRequest')
                ->willReturn($response);
        }
    }

    /**
     * @param string $url       Requested URL
     * @param string $method    HTTP Method `PUT`, `POST`, `GET`, and `DELETE` supported
     * @param string $userAgent User Agent
     * @param array  $headers   HTTP Headers
     * @param array  $responses And array of associative arrays with keys `body`, `error`, `headers`, and `error`
     */
    public function mockTransportWithExpectationsWithoutBodyWithMultipleResponses(
        string $url,
        string $method,
        string $userAgent,
        array $headers,
        array $responses
    ): void {
        Context::$TRANSPORT = $this->createMock(Transport::class);

        Context::$TRANSPORT->expects($this->once())
            ->method('initializeRequest')
            ->with($this->equalTo($url));

        Context::$TRANSPORT->expects($this->once())
            ->method('setMethod')
            ->with($this->equalTo($method));

        Context::$TRANSPORT->expects($this->once())
            ->method('setUserAgent')
            ->with($this->equalTo($userAgent));

        Context::$TRANSPORT->expects($this->once())
            ->method('setHeader')
            ->with($this->equalTo($headers));

        Context::$TRANSPORT->expects($this->never())
            ->method('setBody');

        Context::$TRANSPORT->expects($this->exactly(count($responses)))
            ->method('sendRequest')
            ->willReturnOnConsecutiveCalls(...$responses);
    }
}
