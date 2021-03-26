<?php

declare(strict_types=1);

namespace ShopifyTest;

use CurlHandle;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use Shopify\Clients\Http;

define('RUNNING_SHOPIFY_TESTS', 1);

class BaseTestCase extends TestCase
{
    protected string $domain = 'test-shop.myshopify.io';
    protected array $requestDetails;
    protected int $lastCheckedRequest;

    public function setUp(): void
    {
        $this->requestDetails = [];
        $this->lastCheckedRequest = 0;
    }

    /**
     * Sets up a mocked HTTP client. Any responses given are returned in the order they are received.
     *
     * @param array $responses Mock responses, built by buildMockHttpResponse. The test will expect the exact number of
     *                         responses that are set up, and fail if it is not accurate.
     *
     * @return Http&MockObject
     */
    protected function getHttpClientWithMocks(array $responses = [])
    {
        if (array_key_exists('statusCode', $responses)) {
            $responses = [$responses];
        }

        $mock = $this->getMockBuilder(Http::class)
            ->setConstructorArgs([$this->domain])
            ->onlyMethods(['sendCurlRequest', 'setCurlOption', 'getCurlError', 'getDefaultRetrySeconds'])
            ->getMock();

        $errorCheckResponses = [];
        foreach ($responses as &$response) {
            $error = $response['error'] ?? null;
            if ($error) {
                $errorCheckResponses[] = $error;
            } else {
                $errorCheckResponses[] = null;
            }

            unset($response['error']);
        }

        $options = $values = [];
        $mock->method('setCurlOption')
            ->with(
                $this->anything(),
                $this->callback(function ($option) use (&$options) {
                    $options[] = $option;
                    return true;
                }),
                $this->callback(function ($value) use (&$values) {
                    $values[] = $value;
                    return true;
                }),
            );


        $mock->expects($this->exactly(count($responses)))
            ->method('sendCurlRequest')
            ->with($this->callback(function (CurlHandle $ch) use (&$options, &$values) {
                $requestDetails = [
                    'url' => curl_getinfo($ch, CURLINFO_EFFECTIVE_URL),
                    'options' => [],
                ];
                for ($i = 0; $i < count($options); $i++) {
                    $requestDetails['options'][$options[$i]] = $values[$i];
                }

                $options = [];
                $values = [];
                $this->requestDetails[] = $requestDetails;
                return true;
            }))
            ->willReturnOnConsecutiveCalls(...$responses);

        $mock->method('getCurlError')
            ->willReturnOnConsecutiveCalls(...$errorCheckResponses);

        $mock->method('getDefaultRetrySeconds')
            ->willReturn(0);

        return $mock;
    }

    /**
     * Builds a mock HTTP response that can optionally also validate the parameters of the cURL call.
     *
     * @param int            $statusCode The HTTP status code to return
     * @param string|array   $body       The body of the HTTP response
     * @param array          $headers    The headers expected in the response
     * @param string         $dataType   The data type of the response
     * @param string         $error      The cURL error message to return
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
     * Asserts that a cURL request has set all of the expected options.
     *
     * @param string $address         The URL to which the request was made
     * @param array  $expectedOptions The options that should have been set for cURL
     */
    protected function assertHttpRequest(string $address, array $expectedOptions)
    {
        $actualDetails = $this->requestDetails[$this->lastCheckedRequest++];

        $expectedDetails = [
            'url' => "https://{$address}",
            'options' => $expectedOptions,
        ];

        // Reformat the HTTP headers to make it easier to see where the values might be different
        if (
            isset($expectedDetails['options'][CURLOPT_HTTPHEADER]) &&
            isset($actualDetails['options'][CURLOPT_HTTPHEADER])
        ) {
            $parseHeaderArray = function (array $array) {
                $return = [];
                foreach ($array as $header) {
                    $parts = explode(': ', $header, 2);
                    $return[$parts[0]] = $parts[1];
                }
                return $return;
            };

            $expectedDetails['options'][CURLOPT_HTTPHEADER] = $parseHeaderArray(
                $expectedDetails['options'][CURLOPT_HTTPHEADER]
            );
            $actualDetails['options'][CURLOPT_HTTPHEADER] = $parseHeaderArray(
                $actualDetails['options'][CURLOPT_HTTPHEADER]
            );

            foreach ($actualDetails['options'][CURLOPT_HTTPHEADER] as $option => $value) {
                if (!array_key_exists($option, $expectedDetails['options'][CURLOPT_HTTPHEADER])) {
                    unset($actualDetails['options'][CURLOPT_HTTPHEADER][$option]);
                }
            }
        }

        foreach ($actualDetails['options'] as $option => $value) {
            if (!array_key_exists($option, $expectedDetails['options'])) {
                unset($actualDetails['options'][$option]);
            }
        }

        $this->assertEquals($expectedDetails, $actualDetails);
    }
}
