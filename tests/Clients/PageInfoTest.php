<?php

namespace ShopifyTest\Clients;

use Shopify\Clients\PageInfo;
use ShopifyTest\BaseTestCase;

class PageInfoTest extends BaseTestCase
{
    use PaginationTestHelper;

    public function testParsePreviousAndNextUrlsFromLinkHeaderAndFields()
    {
        $link = $this->getProductsLinkHeader(previousToken: 'previousToken', nextToken: 'nextToken');

        $pageInfo = PageInfo::fromLinkHeader($link);

        $this->assertEquals(
            new PageInfo(
                ['test1', 'test2'],
                $this->getProductsAdminApiPaginationUrl("previousToken"),
                $this->getProductsAdminApiPaginationUrl("nextToken")
            ),
            $pageInfo
        );
    }

    public function testPreviousAndNextPageQueries()
    {
        $pageInfo = new PageInfo(
            ['test1', 'test2'],
            $this->getProductsAdminApiPaginationUrl("previousToken"),
            $this->getProductsAdminApiPaginationUrl("nextToken")
        );

        $this->assertEquals(
            ["limit" => "10", "fields" => 'test1,test2', 'page_info' => 'previousToken'],
            $pageInfo->getPreviousPageQuery()
        );
        $this->assertEquals(
            ["limit" => "10", "fields" => 'test1,test2', 'page_info' => 'nextToken'],
            $pageInfo->getNextPageQuery()
        );
    }
}
