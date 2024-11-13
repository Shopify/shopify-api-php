<?php

declare(strict_types=1);

namespace Shopify\Clients;

use Shopify\Exception\HttpRequestException;
use Psr\Http\Client\ClientExceptionInterface;
use Shopify\Exception\UninitializedContextException;
use Shopify\Context;
use Shopify\Exception\MissingArgumentException;

class Graphql
{
    private readonly Http $client;
    protected ?string $token;

    /**
     * GraphQL Client constructor.
     *
     * @param string      $domain
     * @param string|null $token
     *
     * @throws MissingArgumentException
     */
    public function __construct(
        string $domain,
        ?string $token = null
    ) {
        if (!Context::$IS_PRIVATE_APP && empty($token)) {
            throw new MissingArgumentException('Missing access token when creating GraphQL client');
        }
        $this->client = new Http($domain);
        $this->token = $token;
    }

    /**
     * Sends a GraphQL query to this client's domain.
     *
     * @param string|array   $data         Query to be posted to endpoint
     * @param array          $query        Parameters on a query to be added to the URL
     * @param array          $extraHeaders Any extra headers to send along with the request
     * @param int|null       $tries        How many times to attempt the request
     *
     * @return HttpResponse
     * @throws HttpRequestException
     * @throws MissingArgumentException
     */
    public function query(
        $data,
        array $query = [],
        array $extraHeaders = [],
        ?int $tries = null
    ): HttpResponse {
        if (empty($data)) {
            throw new MissingArgumentException('Query missing');
        }

        list($accessTokenHeader, $accessToken) = $this->getAccessTokenHeader();
        $extraHeaders[$accessTokenHeader] = $accessToken;

        if (is_array($data)) {
            $data = json_encode($data);
        } else {
            $data = json_encode([ "query" => $data ]);
        }

        return $this->client->post(
            $this->getApiPath(),
            $data,
            $extraHeaders,
            $query,
            $tries,
        );
    }

    /**
     * Proxy string query to this client's domain.
     *
     * @param string   $data         Query to be posted to endpoint
     * @param array    $extraHeaders Any extra headers to send along with the request
     * @param int|null $tries        How many times to attempt the request
     *
     * @return HttpResponse
     * @throws ClientExceptionInterface
     * @throws MissingArgumentException
     * @throws UninitializedContextException
     */
    public function proxy(
        string $data,
        array $extraHeaders = [],
        ?int $tries = null
    ): HttpResponse {
        if (empty($data)) {
            throw new MissingArgumentException('Query missing');
        }

        list($accessTokenHeader, $accessToken) = $this->getAccessTokenHeader();
        $extraHeaders[$accessTokenHeader] = $accessToken;

        return $this->client->post(
            $this->getApiPath(),
            $data,
            $extraHeaders,
            [],
            $tries,
            Http::DATA_TYPE_JSON,
        );
    }

    /**
     * Fetches the URL path to be used for API requests.
     *
     * @return string
     */
    protected function getApiPath(): string
    {
        return 'admin/api/' . Context::$API_VERSION . '/graphql.json';
    }

    /**
     * Fetches the access token header and value to be used for API requests.
     *
     * @return array [$accessTokenHeader, $accessToken]
     */
    protected function getAccessTokenHeader(): array
    {
        $accessToken = Context::$IS_PRIVATE_APP ? Context::$API_SECRET_KEY : $this->token;
        return [HttpHeaders::X_SHOPIFY_ACCESS_TOKEN, $accessToken];
    }
}
