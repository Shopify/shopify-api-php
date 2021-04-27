<?php

namespace Shopify\Clients;

class RestResponse extends HttpResponse
{

    /**
     * {@inheritDoc}
     */
    public function __construct(
        $status = 200,
        array $headers = [],
        $body = null,
        $version = '1.1',
        $reason = null,
        private PageInfo|null $pageInfo = null
    ) {
        parent::__construct($status, $headers, $body, $version, $reason);
    }

    /**
     * @return \Shopify\Clients\PageInfo|null Pagination Information
     */
    public function getPageInfo(): ?PageInfo
    {
        return $this->pageInfo;
    }
}
