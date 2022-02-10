<?php

declare(strict_types=1);

namespace Shopify\Clients;

use Shopify\Context;
use Shopify\Exception\MissingArgumentException;

class Rest extends Http
{
    /** @var string */
    private $accessToken;

    /**
     * Rest Client constructor.
     *
     * @param string      $domain
     * @param string|null $accessToken
     *
     * @throws \Shopify\Exception\MissingArgumentException
     */
    public function __construct(string $domain, ?string $accessToken = null)
    {
        parent::__construct($domain);
        $this->accessToken = $accessToken;

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
        $body = null,
        array $headers = [],
        array $query = [],
        ?int $tries = null,
        string $dataType = self::DATA_TYPE_JSON
    ): RestResponse {
        $headers[HttpHeaders::X_SHOPIFY_ACCESS_TOKEN] =
            Context::$IS_PRIVATE_APP ? Context::$API_SECRET_KEY : $this->accessToken;

        $response = parent::request($path, $method, $body, $headers, $query, $tries, $dataType);

        return new RestResponse(
            $response->getStatusCode(),
            $response->getHeaders(),
            $response->getBody(),
            $response->getProtocolVersion(),
            $response->getReasonPhrase(),
            $this->getPageInfo($response)
        );
    }

    protected function getRequestPath(string $path): string
    {
        $path = parent::getRequestPath($path);
        $path = preg_replace("/\.json$/", "", $path) . ".json";

        $apiVersion = Context::$API_VERSION;
        if (strpos($path, "/admin") !== 0) {
            $path = "/admin/api/$apiVersion$path";
        }

        return $path;
    }

    /**
     * @param \Shopify\Clients\HttpResponse $response
     *
     * @return \Shopify\Clients\PageInfo|null
     */
    private function getPageInfo(HttpResponse $response): ?PageInfo
    {
        $pageInfo = null;
        if ($response->hasHeader(HttpHeaders::PAGINATION_HEADER)) {
            $pageInfo = PageInfo::fromLinkHeader($response->getHeaderLine(HttpHeaders::PAGINATION_HEADER));
        }
        return $pageInfo;
    }
}
