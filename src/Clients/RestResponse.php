<?php

declare(strict_types=1);

namespace Shopify\Clients;

class RestResponse extends HttpResponse
{
    /** @var PageInfo|null */
    private $pageInfo = null;

    /**
     * {@inheritDoc}
     */
    public function __construct(
        $status = 200,
        array $headers = [],
        $body = null,
        $version = '1.1',
        $reason = null,
        ?PageInfo $pageInfo = null
    ) {
        parent::__construct($status, $headers, $body, $version, $reason);
        $this->pageInfo = $pageInfo;
    }

    /**
     * @return \Shopify\Clients\PageInfo|null Pagination Information
     */
    public function getPageInfo(): ?PageInfo
    {
        return $this->pageInfo;
    }
}
