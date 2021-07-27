<?php

declare(strict_types=1);

namespace Shopify\Clients;

class PageInfo
{
    private const LINK_HEADER_REGEXP = '/<([^<]+)>; rel="([^"]+)"/';

    /** @var array|null */
    private $fields;
    /** @var string|null */
    private $previousPageUrl;
    /** @var string|null */
    private $nextPageUrl;

    /**
     * PageInfo constructor.
     *
     * @param array|null  $fields          list of which fields to show in the results.
     *                                     This parameter only works for some endpoints.
     * @param string|null $previousPageUrl link to previous page of the result
     * @param string|null $nextPageUrl     link to the next page of the result
     */
    public function __construct(
        ?array $fields,
        ?string $previousPageUrl,
        ?string $nextPageUrl
    ) {
        $this->fields = $fields;
        $this->previousPageUrl = $previousPageUrl;
        $this->nextPageUrl = $nextPageUrl;
    }

    /**
     * When you send a request to a REST endpoint that supports cursor-based pagination, the response body returns the
     * first page of results, and a response header returns links to the next page and the previous page of results
     * (if applicable). You can use the links in the response header to iterate through the pages of results.
     *
     * @param string $linkHeader Pagination link header
     *
     * @return \Shopify\Clients\PageInfo
     */
    public static function fromLinkHeader(string $linkHeader): PageInfo
    {
        $linkHeaderSegments = explode(', ', $linkHeader);

        $fields = self::parseFields($linkHeaderSegments);

        list($previousUrl, $nextUrl) = self::parseUrls($linkHeaderSegments);

        return new PageInfo($fields, $previousUrl, $nextUrl);
    }

    /**
     * @param array $linkHeaderSegments Link header segments
     *
     * @return array
     */
    private static function parseFields(array $linkHeaderSegments): array
    {
        $fields = [];
        foreach ($linkHeaderSegments as $segment) {
            $parsedUrl = [];
            preg_match(self::LINK_HEADER_REGEXP, $segment, $parsedUrl);
            $linkUrl = $parsedUrl[1];
            $queryParams = self::getQueryFromUrl($linkUrl);

            if (array_key_exists('fields', $queryParams)) {
                $linkFields = $queryParams['fields'];
                $fields = explode(',', $linkFields);
            }
        }
        return $fields;
    }

    /**
     * @param array $linkHeaderSegments Link header segments
     *
     * @return array
     */
    private static function parseUrls(array $linkHeaderSegments): array
    {
        $previousUrl = null;
        $nextUrl = null;
        foreach ($linkHeaderSegments as $url) {
            $parsedLink = [];
            preg_match(self::LINK_HEADER_REGEXP, $url, $parsedLink);
            $linkRel = $parsedLink[2];
            $linkUrl = $parsedLink[1];

            switch ($linkRel) {
                case 'previous':
                    $previousUrl = $linkUrl;
                    break;
                case 'next':
                    $nextUrl = $linkUrl;
                    break;
            }
        }
        return array($previousUrl, $nextUrl);
    }

    /**
     * @return string|null Url of the previous page or null if there is no more pages
     */
    public function getPreviousPageUrl(): ?string
    {
        return $this->previousPageUrl;
    }

    /**
     * @return string|null  Url of the next page or null if there is no more pages
     */
    public function getNextPageUrl(): ?string
    {
        return $this->nextPageUrl;
    }

    /**
     * @return array|null list of which fields to show in the results. This parameter only works for some endpoints.
     */
    public function getFields(): ?array
    {
        return $this->fields;
    }

    /**
     * <code>
     *  $client->get(path: 'products', query: $response->getPageInfo()->getPreviousPageQuery());
     * </code>
     *
     * @return array Query to get the previous page
     */
    public function getPreviousPageQuery(): array
    {
        return self::getQueryFromUrl($this->getPreviousPageUrl());
    }

    /**
     * <code>
     *  $client->get(path: 'products', query: $response->getPageInfo()->getNextPageQuery());
     * </code>
     *
     * @return array Query to get the next page
     */
    public function getNextPageQuery(): array
    {
        return self::getQueryFromUrl($this->getNextPageUrl());
    }

    /**
     * @return bool false if there is no more pages
     */
    public function hasNextPage(): bool
    {
        return $this->getNextPageUrl() !== null;
    }

    /**
     * @return bool false if there is no more pages
     */
    public function hasPreviousPage(): bool
    {
        return self::getPreviousPageUrl() !== null;
    }

    private static function getQueryFromUrl(string $url): array
    {
        $queryParams = [];
        parse_str(parse_url($url, PHP_URL_QUERY), $queryParams);
        return $queryParams;
    }
}
