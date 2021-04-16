<?php

namespace Shopify\Clients;

class RestResponse extends HttpResponse
{

    /**
     * RestResponse constructor.
     *
     * @param int                            $statusCode
     * @param array                          $headers
     * @param array|string|null              $body
     * @param \Shopify\Clients\PageInfo|null $pageInfo
     */
    public function __construct(
        int $statusCode,
        array $headers = [],
        array|string|null $body = null,
        private PageInfo|null $pageInfo = null
    ) {
        parent::__construct($statusCode, $headers, $body);
    }

    /**
     * @return \Shopify\Clients\PageInfo|null Pagination Information
     */
    public function getPageInfo(): ?PageInfo
    {
        return $this->pageInfo;
    }
}
