<?php

declare(strict_types=1);

namespace ShopifyTest;

use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientInterface;
use Shopify\Clients\Http;
use Shopify\Clients\HttpClientFactory;
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
            logger: null,
        );
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
        string|array $body = null,
        array $headers = [],
        string $dataType = Http::DATA_TYPE_JSON,
        string $error = null
    ): array {
        if ($body && !is_string($body)) {
            $body = json_encode($body);
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
        $requestMatchers = [];
        $newResponses = [];
        foreach ($requests as $request) {
            $matcher = new HttpRequestMatcher(
                $request->url,
                $request->method,
                "/$request->userAgent/",
                $request->headers,
                $request->body ?? ""
            );

            $requestMatchers[] = [$matcher];

            $newResponses[] = $request->error ? 'TEST EXCEPTION' : new Response(
                status: $request->response['statusCode'],
                headers: $request->response['headers'],
                body: $request->response['body']
            );
        }

        $client = $this->createMock(ClientInterface::class);

        $i = 0;
        $client->expects($this->exactly(count($requestMatchers)))
            ->method('sendRequest')
            ->withConsecutive(...$requestMatchers)
            ->willReturnCallback(
                function () use (&$i, $newResponses) {
                    $response = $newResponses[$i++];
                    if ($response === 'TEST EXCEPTION') {
                        throw new HttpRequestException();
                    } else {
                        return $response;
                    }
                }
            );

        $factory = $this->createMock(HttpClientFactory::class);

        $factory->expects($this->any())
            ->method('client')
            ->willReturn($client);

        Context::$HTTP_CLIENT_FACTORY = $factory;
    }
}
