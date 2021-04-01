<?php

declare(strict_types=1);

namespace Shopify\Clients;

use Shopify\Context;
use Shopify\Clients\Http;
use Shopify\Exception\MissingArgumentException;

class Graphql
{
    private Http $client;

    /**
     * GraphQL Client constructor.
     *
     * @param string      $domain
     * @param string|null $token
     *
     * @throws \Shopify\Exception\MissingArgumentException
     */
    public function __construct(
        string $domain,
        private ?string $token = null,
    ) {
        if (!Context::$IS_PRIVATE_APP && empty($token)) {
            throw new MissingArgumentException('Missing access token when creating GraphQL client');
        }
        $this->client = new Http($domain);
    }

    /**
     * Sends a GraphQL query to this client's domain.
     *
     * @param string|array  $data          Query to be posted to endpoint
     * @param array         $query         Parameters on a query to be added to the URL
     * @param array         &$extraHeaders Any extra headers to send along with the request
     * @param int|null      $tries         How many times to attempt the request
     *
     * @return HttpResponse
     * @throws \Shopify\Exception\MissingArgumentException
     */
    public function query(
        string | array $data,
        array $query = [],
        array &$extraHeaders = [],
        ?int $tries = null
    ): HttpResponse {
        if (empty($data)) {
            throw new MissingArgumentException('Query missing');
        }

        $accessToken = Context::$IS_PRIVATE_APP ? Context::$API_SECRET_KEY : $this->token;
        $extraHeaders[Http::X_SHOPIFY_ACCESS_TOKEN] = $accessToken;
        $path = 'admin/api/' . Context::$API_VERSION . '/graphql.json';

        if (is_array($data)) {
            $dataType = Http::DATA_TYPE_JSON;
            $data = json_encode($data);
        } else {
            $dataType = Http::DATA_TYPE_GRAPHQL;
        }

        return $this->client->post(
            path: $path,
            body: $data,
            dataType: $dataType,
            headers: $extraHeaders,
            query: $query,
            tries: $tries,
        );
    }
}
