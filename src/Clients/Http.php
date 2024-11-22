<?php

declare(strict_types=1);

namespace Shopify\Clients;

use Psr\Http\Client\ClientExceptionInterface;
use Shopify\Exception\UninitializedContextException;
use Exception;
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

    private const RETRIABLE_STATUS_CODES = [429, 500];
    private const DEPRECATION_ALERT_SECONDS = 3600;

    private readonly string $domain;

    private int $lastApiDeprecationWarning = 0;

    public function __construct(string $domain)
    {
        $this->domain = $domain;
    }

    /**
     * Makes a GET request to this client's domain.
     *
     * @param string   $path    The URL path to request
     * @param array    $headers Any extra headers to send along with the request
     * @param array    $query   Parameters on a query to be added to the URL
     * @param int|null $tries   How many times to attempt the request
     *
     * @return HttpResponse
     * @throws ClientExceptionInterface
     * @throws UninitializedContextException
     */
    public function get(string $path, array $headers = [], array $query = [], ?int $tries = null): HttpResponse
    {
        return $this->request(
            path: $path,
            method: self::METHOD_GET,
            headers: $headers,
            query: $query,
            tries: $tries,
        );
    }

    /**
     * Makes a POST request to this client's domain.
     *
     * @param string       $path     The URL path to request
     * @param string|array $body     The body of the request
     * @param array        $headers  Any extra headers to send along with the request
     * @param array        $query    Parameters on a query to be added to the URL
     * @param int|null     $tries    How many times to attempt the request
     * @param string       $dataType The data type to expect in the response
     *
     * @return HttpResponse
     * @throws ClientExceptionInterface
     * @throws UninitializedContextException
     */
    public function post(
        string $path,
        $body,
        array $headers = [],
        array $query = [],
        ?int $tries = null,
        string $dataType = self::DATA_TYPE_JSON
    ): HttpResponse {
        return $this->request(
            path: $path,
            method: self::METHOD_POST,
            body: $body,
            headers: $headers,
            query: $query,
            tries: $tries,
            dataType: $dataType,
        );
    }

    /**
     * Makes a PUT request to this client's domain.
     *
     * @param string       $path     The URL path to request
     * @param string|array $body     The body of the request
     * @param array        $headers  Any extra headers to send along with the request
     * @param array        $query    Parameters on a query to be added to the URL
     * @param int|null     $tries    How many times to attempt the request
     * @param string       $dataType The data type to expect in the response
     *
     * @return HttpResponse
     * @throws ClientExceptionInterface
     * @throws UninitializedContextException
     */
    public function put(
        string $path,
        $body,
        array $headers = [],
        array $query = [],
        ?int $tries = null,
        string $dataType = self::DATA_TYPE_JSON
    ): HttpResponse {
        return $this->request(
            path: $path,
            method: self::METHOD_PUT,
            body: $body,
            headers: $headers,
            query: $query,
            tries: $tries,
            dataType: $dataType,
        );
    }

    /**
     * Makes a DELETE request to this client's domain.
     *
     * @param string   $path    The URL path to request
     * @param array    $headers Any extra headers to send along with the request
     * @param array    $query   Parameters on a query to be added to the URL
     * @param int|null $tries   How many times to attempt the request
     *
     * @return HttpResponse
     * @throws ClientExceptionInterface
     * @throws UninitializedContextException
     */
    public function delete(string $path, array $headers = [], array $query = [], ?int $tries = null): HttpResponse
    {
        return $this->request(
            path: $path,
            method: self::METHOD_DELETE,
            headers: $headers,
            query: $query,
            tries: $tries,
        );
    }

    /**
     * Internally handles the logic for making requests.
     *
     * @param string            $path     The path to query
     * @param string            $method   The method to use
     * @param string|array|null $body     The request body to send
     * @param array             $headers  Any extra headers to send along with the request
     * @param array             $query    Parameters on a query to be added to the URL
     * @param int|null          $tries    How many times to attempt the request
     * @param string            $dataType The data type of the request
     *
     * @return HttpResponse
     * @throws ClientExceptionInterface
     * @throws UninitializedContextException
     */
    protected function request(
        string $path,
        string $method,
        $body = null,
        array $headers = [],
        array $query = [],
        ?int $tries = null,
        string $dataType = self::DATA_TYPE_JSON
    ) {
        $maxTries = $tries ?? 1;

        $version = require dirname(__FILE__) . '/../version.php';
        $userAgentParts = ["Shopify Admin API Library for PHP v$version"];

        if (Context::$USER_AGENT_PREFIX) {
            array_unshift($userAgentParts, Context::$USER_AGENT_PREFIX);
        }

        if (isset($headers[HttpHeaders::USER_AGENT])) {
            array_unshift($userAgentParts, $headers[HttpHeaders::USER_AGENT]);
            unset($headers[HttpHeaders::USER_AGENT]);
        }

        $client = Context::$HTTP_CLIENT_FACTORY->client();

        $query = preg_replace("/%5B[0-9]+%5D/", "%5B%5D", http_build_query($query));

        $url = (new Uri())
            ->withScheme('https')
            ->withHost($this->domain)
            ->withPath($this->getRequestPath($path))
            ->withQuery($query);

        $request = new Request($method, $url, $headers);
        $request = $request->withHeader(HttpHeaders::USER_AGENT, implode(' | ', $userAgentParts));

        if ($body) {
            if (is_string($body)) {
                $bodyString = $body;
            } else {
                $bodyString = json_encode($body);
            }

            $stream = Utils::streamFor($bodyString);
            $request = $request
                ->withBody($stream)
                ->withHeader(HttpHeaders::CONTENT_TYPE, $dataType)
                ->withHeader(HttpHeaders::CONTENT_LENGTH, mb_strlen($bodyString));
        }

        $currentTries = 0;
        do {
            $currentTries++;

            $response = HttpResponse::fromResponse($client->sendRequest($request));

            if (in_array($response->getStatusCode(), self::RETRIABLE_STATUS_CODES)) {
                $retryAfter = $response->hasHeader(HttpHeaders::RETRY_AFTER)
                    ? $response->getHeaderLine(HttpHeaders::RETRY_AFTER)
                    : Context::$RETRY_TIME_IN_SECONDS;

                usleep((int)($retryAfter * 1000000));
            } else {
                break;
            }
        } while ($currentTries < $maxTries);

        if ($response->hasHeader(HttpHeaders::X_SHOPIFY_API_DEPRECATED_REASON)) {
            $this->logApiDeprecation(
                $url->__toString(),
                $response->getHeaderLine(HttpHeaders::X_SHOPIFY_API_DEPRECATED_REASON)
            );
        }

        return $response;
    }

    protected function getRequestPath(string $path): string
    {
        if (strpos($path, '/') !== 0) {
            $path = "/$path";
        }

        return $path;
    }

    /**
     * Logs an API deprecation for the given URL to the app's logged, if one was given.
     *
     * @param string $url    The URL that used a deprecated resource
     * @param string $reason The deprecation reason
     * @throws UninitializedContextException
     */
    private function logApiDeprecation(string $url, string $reason): void
    {
        if (!$this->shouldLogApiDeprecation()) {
            return;
        }

        $e = new Exception();
        $stackTrace = str_replace("\n", "\n    ", $e->getTraceAsString());

        Context::logWarning('API Deprecation notice', [
            'url' => $url,
            'reason' => $reason,
            'stack trace' => $stackTrace
        ]);
    }

    /**
     * Determines whether to log an API deprecation based on last logged time
     *
     * @return bool
     */
    private function shouldLogApiDeprecation(): bool
    {
        if (function_exists('apcu_enabled') && apcu_enabled()) {
            $apcuKey = 'shopify/shopify-api/last-api-deprecation-warning';
        } else {
            $apcuKey = null;
        }

        if ($this->lastApiDeprecationWarning === 0 && $apcuKey) {
            $this->lastApiDeprecationWarning = (int) apcu_fetch($apcuKey);
        }

        $secondsSinceLastAlert = time() - $this->lastApiDeprecationWarning;
        if ($secondsSinceLastAlert < self::DEPRECATION_ALERT_SECONDS) {
            return false;
        }

        $this->lastApiDeprecationWarning = time();

        if ($apcuKey) {
            apcu_store($apcuKey, $this->lastApiDeprecationWarning, self::DEPRECATION_ALERT_SECONDS);
        }

        return true;
    }

    /**
     * Fetches the path to the file holding the timestamp of the last API deprecation warning we logged.
     *
     * @codeCoverageIgnore This is mocked in tests so we don't use real files
     * @deprecated 5.4.1 This method is no longer used internally.
     */
    public function getApiDeprecationTimestampFilePath(): string
    {
        $filename = '.last_api_deprecation_warning';

        return join(DIRECTORY_SEPARATOR, [
            rtrim(sys_get_temp_dir(), DIRECTORY_SEPARATOR),
            ltrim($filename, DIRECTORY_SEPARATOR),
        ]);
    }
}
