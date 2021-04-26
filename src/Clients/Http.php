<?php

declare(strict_types=1);

namespace Shopify\Clients;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Uri;
use GuzzleHttp\Psr7\Utils;
use Shopify\Context;

class Http
{
    public const METHOD_GET = 'GET';
    public const METHOD_POST = 'POST';
    public const METHOD_PUT = 'PUT';
    public const METHOD_DELETE = 'DELETE';

    public const DATA_TYPE_JSON = 'application/json';
    public const DATA_TYPE_GRAPHQL = 'application/graphql';

    public const X_SHOPIFY_ACCESS_TOKEN = "X-Shopify-Access-Token";
    public const USER_AGENT = 'User-Agent';

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
     * @throws \Psr\Http\Client\ClientExceptionInterface
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

        $version = require dirname(__FILE__) . '/../version.php';
        $userAgentParts = ["Shopify Admin API Library for PHP v$version"];

        if (Context::$USER_AGENT_PREFIX) {
            array_unshift($userAgentParts, Context::$USER_AGENT_PREFIX);
        }

        if (isset($headers[self::USER_AGENT])) {
            array_unshift($userAgentParts, $headers[self::USER_AGENT]);
            unset($headers[self::USER_AGENT]);
        }

        $client = Context::$HTTP_CLIENT_FACTORY->client();

        $url = (new Uri())
            ->withScheme('https')
            ->withHost($this->domain)
            ->withPath($path)
            ->withQuery(http_build_query($query));

        $request = new Request($method, $url, $headers);
        $request = $request->withHeader(header: self::USER_AGENT, value: implode(' | ', $userAgentParts));

        if ($body) {
            if (is_string($body)) {
                $bodyString = $body;
            } else {
                $bodyString = json_encode($body);
            }

            $stream = Utils::streamFor($bodyString);
            $request = $request
                ->withBody($stream)
                ->withHeader('Content-Type', $dataType)
                ->withHeader('Content-Length', mb_strlen($bodyString));
        }

        $currentTries = 0;
        do {
            $currentTries++;

            $psrResponse = $client->sendRequest($request);

            $responseBody = $psrResponse->getBody()->getContents();
            $responseBody = $responseBody ? json_decode($responseBody, true, JSON_THROW_ON_ERROR) : '';
            $response = new HttpResponse(
                $psrResponse->getStatusCode(),
                $psrResponse->getHeaders(),
                empty($responseBody) ? null : $responseBody
            );

            if (in_array($psrResponse->getStatusCode(), self::RETRIABLE_STATUS_CODES)) {
                $retryAfter = empty(
                    $psrResponse->getHeaderLine('Retry-After')
                ) ? Context::$RETRY_TIME_IN_SECONDS : $psrResponse->getHeaderLine('Retry-After');
                usleep($retryAfter * 1000000);
            } else {
                break;
            }
        } while ($currentTries < $maxTries);

        return $response;
    }
}
