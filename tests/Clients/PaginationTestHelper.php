<?php

namespace ShopifyTest\Clients;

use Shopify\Context;

trait PaginationTestHelper
{
    /** @var string */
    protected $domain = 'test-shop.myshopify.io';

    /**
     * @param string $path Rest resource. e.g. `products`
     * @param string $queryString Query string `e.g. "limit=10&fields=test1%2Ctest2"`
     *
     * @return string
     */
    protected function getAdminApiUrl(string $path, string $queryString): string
    {
        return "https://$this->domain/admin/api/" . Context::$API_VERSION . "/$path.json?$queryString";
    }

    /**
     * Products URL link headers with fields: `limit=10&fields=test1%2Ctest2` and appends the token
     * @param string|null $previousToken A unique ID used to access previous page
     * @param string|null $nextToken A unique ID used to access next page
     *
     * @return string
     */
    protected function getProductsLinkHeader(?string $previousToken = null, ?string $nextToken = null): string
    {
        $headers = [];
        if ($previousToken) {
            $previousPageUrl = $this->getProductsAdminApiPaginationUrl($previousToken);
            array_push($headers, "<$previousPageUrl>; rel=\"previous\"");
        }
        if ($nextToken) {
            $nextPageUrl = $this->getProductsAdminApiPaginationUrl($nextToken);
            array_push($headers, "<$nextPageUrl>; rel=\"next\"");
        }
        return (implode(', ', $headers));
    }

    /**
     * Products next or previous page URL with fields: `limit=10&fields=test1%2Ctest2` and appends the token
     * @param string $token  A unique ID used to access previous or next page
     *
     * @return string
     */
    protected function getProductsAdminApiPaginationUrl(string $token): string
    {
        return "https://$this->domain/admin/api/"
            . Context::$API_VERSION
            . "/products.json?limit=10&fields=test1%2Ctest2&page_info=$token";
    }
}
