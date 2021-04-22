<?php

declare(strict_types=1);

namespace Shopify\Clients;

use Shopify\Context;
use Shopify\Exception\MissingArgumentException;

class Rest extends Http
{

    /**
     * Rest Client constructor.
     *
     * @param string      $domain
     * @param string|null $accessToken
     *
     * @throws \Shopify\Exception\MissingArgumentException
     */
    public function __construct(string $domain, private ?string $accessToken = null)
    {
        parent::__construct($domain);
        if (!Context::$IS_PRIVATE_APP && !$this->accessToken) {
            throw new MissingArgumentException('Missing access token when creating REST client');
        }
    }

    /**
     * {@inheritDoc}
     */
    protected function request(
        string $path,
        string $method,
        string $dataType = self::DATA_TYPE_JSON,
        string|array $body = null,
        array $headers = [],
        ?int $tries = null,
        array $query = []
    ): RestResponse {
        $headers[HttpHeaders::X_SHOPIFY_ACCESS_TOKEN] =
            Context::$IS_PRIVATE_APP ? Context::$API_SECRET_KEY : $this->accessToken;

        $response = parent::request(
            path: $this->getRestPath($path),
            method: $method,
            dataType: $dataType,
            body: $body,
            headers: $headers,
            tries: $tries,
            query: $query
        );

        return new RestResponse(
            $response->getStatusCode(),
            $response->getHeaders(),
            $response->getBody(),
            $this->getPageInfo($response)
        );
    }


    private function getRestPath(string $path): string
    {
        $apiVersion = Context::$API_VERSION;
        return "admin/api/$apiVersion/$path.json";
    }

    /**
     * @param \Shopify\Clients\HttpResponse $response
     *
     * @return \Shopify\Clients\PageInfo|null
     */
    private function getPageInfo(HttpResponse $response): ?PageInfo
    {
        $pageInfo = null;

        if ($response->getHeaders()->has('link')) {
            $pageInfo = PageInfo::fromLinkHeader($response->getHeaders()->get('link'));
        }
        return $pageInfo;
    }
}
