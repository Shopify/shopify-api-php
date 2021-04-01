<?php

declare(strict_types=1);

namespace Shopify\Clients;

use Shopify\Context;

class Http
{
    public const METHOD_GET = 'GET';
    public const METHOD_POST = 'POST';
    public const METHOD_PUT = 'PUT';
    public const METHOD_DELETE = 'DELETE';

    public const DATA_TYPE_JSON = 'application/json';
    public const DATA_TYPE_URL_ENCODED = 'application/x-www-form-urlencoded';
    public const DATA_TYPE_GRAPHQL = 'application/graphql';

    public const X_SHOPIFY_ACCESS_TOKEN = "X-Shopify-Access-Token";

    private const RETRIABLE_STATUS_CODES = [429, 500];

    public function __construct(private string $domain)
    {
    }

    /**
     * Makes a GET request to this client's domain.
     *
     * @param string        $path    The URL path to request
     * @param array         $headers Any extra headers to send along with the request
     * @param array|null    $query   Parameters on a query to be added to the URL
     * @param int|null      $tries   How many times to attempt the request
     *
     * @return HttpResponse
     * @throws \Shopify\Exception\HttpRequestException
     */
    public function get(string $path, array $headers = [], ?int $tries = null, array $query = []): HttpResponse
    {
        return $this->request(
            path: $path,
            method: self::METHOD_GET,
            headers: $headers,
            tries: $tries,
            query: $query
        );
    }

    /**
     * Makes a POST request to this client's domain.
     *
     * @param string       $path     The URL path to request
     * @param string|array $body     The body of the request
     * @param string       $dataType The data type to expect in the response
     * @param array        $headers  Any extra headers to send along with the request
     * @param array|null   $query    Parameters on a query to be added to the URL
     * @param int|null     $tries    How many times to attempt the request
     *
     * @return HttpResponse
     * @throws \Shopify\Exception\HttpRequestException
     */
    public function post(
        string $path,
        string|array $body,
        string $dataType = self::DATA_TYPE_JSON,
        array $headers = [],
        ?int $tries = null,
        array $query = []
    ): HttpResponse {
        return $this->request(
            path: $path,
            method: self::METHOD_POST,
            dataType: $dataType,
            body: $body,
            headers: $headers,
            tries: $tries,
            query: $query
        );
    }

    /**
     * Makes a PUT request to this client's domain.
     *
     * @param string       $path     The URL path to request
     * @param string|array $body     The body of the request
     * @param string       $dataType The data type to expect in the response
     * @param array        $headers  Any extra headers to send along with the request
     * @param array|null   $query    Parameters on a query to be added to the URL
     * @param int|null     $tries    How many times to attempt the request
     *
     * @return HttpResponse
     * @throws \Shopify\Exception\HttpRequestException
     */
    public function put(
        string $path,
        string|array $body,
        string $dataType = self::DATA_TYPE_JSON,
        array $headers = [],
        ?int $tries = null,
        array $query = []
    ): HttpResponse {
        return $this->request(
            path: $path,
            method: self::METHOD_PUT,
            dataType: $dataType,
            body: $body,
            headers: $headers,
            tries: $tries,
            query: $query
        );
    }

    /**
     * Makes a DELETE request to this client's domain.
     *
     * @param string        $path    The URL path to request
     * @param array         $headers Any extra headers to send along with the request
     * @param array|null    $query   Parameters on a query to be added to the URL
     * @param int|null      $tries   How many times to attempt the request
     *
     * @return HttpResponse
     * @throws \Shopify\Exception\HttpRequestException
     */
    public function delete(string $path, array $headers = [], ?int $tries = null, array $query = []): HttpResponse
    {
        return $this->request(
            path: $path,
            method: self::METHOD_DELETE,
            headers: $headers,
            tries: $tries,
            query: $query
        );
    }

    /**
     * Internally handles the logic for making requests.
     *
     * @param string     $path        The path to query
     * @param string     $method      The method to use
     * @param string     $dataType    The data type of the request
     * @param string     $body        The request body to send
     * @param array|null $query       Parameters on a query to be added to the URL
     * @param array      $headers     Any extra headers to send along with the request
     * @param int|null   $tries       How many times to attempt the request
     *
     * @return HttpResponse
     * @throws \Shopify\Exception\HttpRequestException
     */
    protected function request(
        string $path,
        string $method,
        string $dataType = self::DATA_TYPE_JSON,
        string|array $body = null,
        array $headers = [],
        ?int $tries = null,
        array $query = []
    ): HttpResponse {
        $maxTries = $tries ?? 1;

        if ($formattedQuery = http_build_query($query)) {
            $formattedQuery = "?$formattedQuery";
        }

        $url = "https://$this->domain/$path{$formattedQuery}";

        $transport = Context::$TRANSPORT_FACTORY->transport();

        $transport->initializeRequest($url);
        $transport->setMethod($method);

        $version = require dirname(__FILE__) . '/../version.php';
        $userAgentParts = ["Shopify Admin API Library for PHP v$version"];

        if (Context::$USER_AGENT_PREFIX) {
            array_unshift($userAgentParts, Context::$USER_AGENT_PREFIX);
        }

        if (isset($headers['User-Agent'])) {
            array_unshift($userAgentParts, $headers['User-Agent']);
            unset($headers['User-Agent']);
        }

        $transport->setUserAgent(implode(' | ', $userAgentParts));

        if ($body) {
            if (is_string($body)) {
                $bodyString = $body;
            } else {
                $bodyString = match ($dataType) {
                    self::DATA_TYPE_JSON => json_encode($body),
                    self::DATA_TYPE_URL_ENCODED => http_build_query($body),
                };
            }

            $transport->setBody($bodyString);

            $headers = array_merge(
                [
                    'Content-Type' => $dataType,
                    'Content-Length' => mb_strlen($bodyString),
                ],
                $headers,
            );
        }

        $headerOpts = [];
        foreach ($headers as $header => $headerValue) {
            $headerOpts[] = "$header: $headerValue";
        }
        $transport->setHeader($headerOpts);

        $currentTries = 0;
        do {
            $currentTries++;

            $curlResponse = $transport->sendRequest();

            $responseBody = $curlResponse['body'] ? json_decode($curlResponse['body'], true, JSON_THROW_ON_ERROR) : '';
            $response = new HttpResponse(
                $curlResponse['statusCode'],
                $curlResponse['headers'],
                $responseBody
            );

            if (in_array($curlResponse['statusCode'], self::RETRIABLE_STATUS_CODES)) {
                $retryAfter = $curlResponse['headers']['Retry-After'] ?? Context::$RETRY_TIME_IN_SECONDS;
                usleep($retryAfter * 1000000);
            } else {
                break;
            }
        } while ($currentTries < $maxTries);

        return $response;
    }
}
