<?php

declare(strict_types=1);

namespace ShopifyTest;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use Shopify\Clients\Http;

define('RUNNING_SHOPIFY_TESTS', 1);

class BaseTestCase extends TestCase
{
    protected string $domain = 'test-shop.myshopify.io';
    protected array $curlOptions;

    public function setUp(): void
    {
        $this->curlOptions = [];
    }

    /**
     * Sets up a mocked HTTP client. Any responses given are returned in the order they are received.
     *
     * @param array $responses Mock responses, built by buildMockHttpResponse
     *
     * @return Http&MockObject
     */
    protected function getHttpClientWithMocks(array $responses = [])
    {
        $mock = $this->getMockBuilder(Http::class)
            ->setConstructorArgs([$this->domain])
            ->onlyMethods(['sendCurlRequest', 'setCurlOption'])
            ->getMock();

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

        if (count($responses)) {
            if (array_key_exists('statusCode', $responses)) {
                $responses = [$responses];
            }

            $stub = $mock->expects($this->exactly(count($responses)))
                ->method('sendCurlRequest')
                ->with($this->callback(function () use (&$options, &$values) {
                    $curlOptions = [];
                    for ($i = 0; $i < count($options); $i++) {
                        $curlOptions[$options[$i]] = $values[$i];
                    }

                    $options = [];
                    $values = [];
                    $this->curlOptions[] = $curlOptions;
                    return true;
                }));

            foreach ($responses as $response) {
                $returnValue = [
                    'statusCode' => $response['statusCode'],
                    'headers' => $response['headers'],
                    'body' => $response['body'],
                ];

                $stub->willReturn($returnValue);
            }
        }

        return $mock;
    }

    /**
     * Builds a mock HTTP response that can optionally also validate the parameters of the cURL call.
     *
     * @param int            $statusCode The HTTP status code to return
     * @param string|array   $body       The body of the HTTP response
     * @param array          $headers    The headers expected in the response
     * @param string         $dataType   The data type of the response
     *
     * @return array
     */
    protected function buildMockHttpResponse(
        int $statusCode,
        string | array $body,
        array $headers = [],
        string $dataType = Http::DATA_TYPE_JSON,
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
        ];
    }

    /**
     * Asserts that a cURL request has set all of the expected options.
     *
     * @param array $expectedOptions The options that should have been set for cURL
     * @param array $actualOptions   The options that were actually set for cURL
     */
    protected function assertCurlOptions(array $expectedOptions, array $actualOptions)
    {
        $this->cleanUpCurlOptions($expectedOptions, $actualOptions);
        $this->assertEquals($expectedOptions, $actualOptions);
    }

    /**
     * Recursively cleans up the curl options array to make sure we can compare them.
     *
     * @param array $expectedOptions The options that should have been set for cURL
     * @param array $actualOptions   The options that were actually set for cURL
     */
    private function cleanUpCurlOptions(array &$expectedOptions, array &$actualOptions)
    {
        // Reformat the HTTP headers to make it easier to see where the values might be different
        if (isset($expectedOptions[CURLOPT_HTTPHEADER]) && isset($actualOptions[CURLOPT_HTTPHEADER])) {
            $parseHeaderArray = function (array $array) {
                $return = [];
                foreach ($array as $header) {
                    $parts = explode(': ', $header, 2);
                    $return[$parts[0]] = $parts[1];
                }
                return $return;
            };

            $expectedOptions[CURLOPT_HTTPHEADER] = $parseHeaderArray($expectedOptions[CURLOPT_HTTPHEADER]);
            $actualOptions[CURLOPT_HTTPHEADER] = $parseHeaderArray($actualOptions[CURLOPT_HTTPHEADER]);

            $this->cleanUpCurlOptions($expectedOptions[CURLOPT_HTTPHEADER], $actualOptions[CURLOPT_HTTPHEADER]);
        }

        foreach ($actualOptions as $option => $value) {
            if (!array_key_exists($option, $expectedOptions)) {
                unset($actualOptions[$option]);
            }
        }
    }
}
