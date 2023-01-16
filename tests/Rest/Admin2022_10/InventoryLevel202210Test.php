<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Admin2022_10\InventoryLevel;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class InventoryLevel202210Test extends BaseTestCase
{
    /** @var Session */
    private $test_session;

    public function setUp(): void
    {
        parent::setUp();

        Context::$API_VERSION = "2022-10";

        $this->test_session = new Session("session_id", "test-shop.myshopify.io", true, "1234");
        $this->test_session->setAccessToken("this_is_a_test_token");
    }

    /**

     *
     * @return void
     */
    public function test_1(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["inventory_levels" => [["inventory_item_id" => 49148385, "location_id" => 655441491, "available" => 2, "updated_at" => "2023-01-03T12:56:35-05:00", "admin_graphql_api_id" => "gid://shopify/InventoryLevel/655441491?inventory_item_id=49148385"], ["inventory_item_id" => 808950810, "location_id" => 655441491, "available" => 1, "updated_at" => "2023-01-03T12:56:35-05:00", "admin_graphql_api_id" => "gid://shopify/InventoryLevel/655441491?inventory_item_id=808950810"], ["inventory_item_id" => 457924702, "location_id" => 655441491, "available" => 4, "updated_at" => "2023-01-03T12:56:35-05:00", "admin_graphql_api_id" => "gid://shopify/InventoryLevel/655441491?inventory_item_id=457924702"], ["inventory_item_id" => 39072856, "location_id" => 655441491, "available" => 3, "updated_at" => "2023-01-03T12:56:35-05:00", "admin_graphql_api_id" => "gid://shopify/InventoryLevel/655441491?inventory_item_id=39072856"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-10/inventory_levels.json?location_ids=655441491",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        InventoryLevel::all(
            $this->test_session,
            [],
            ["location_ids" => "655441491"],
        );
    }

    /**

     *
     * @return void
     */
    public function test_2(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["inventory_levels" => [["inventory_item_id" => 808950810, "location_id" => 487838322, "available" => 9, "updated_at" => "2023-01-03T12:56:35-05:00", "admin_graphql_api_id" => "gid://shopify/InventoryLevel/548380009?inventory_item_id=808950810"], ["inventory_item_id" => 808950810, "location_id" => 655441491, "available" => 1, "updated_at" => "2023-01-03T12:56:35-05:00", "admin_graphql_api_id" => "gid://shopify/InventoryLevel/655441491?inventory_item_id=808950810"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-10/inventory_levels.json?inventory_item_ids=808950810",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        InventoryLevel::all(
            $this->test_session,
            [],
            ["inventory_item_ids" => "808950810"],
        );
    }

    /**

     *
     * @return void
     */
    public function test_3(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["inventory_levels" => [["inventory_item_id" => 808950810, "location_id" => 487838322, "available" => 9, "updated_at" => "2023-01-03T12:56:35-05:00", "admin_graphql_api_id" => "gid://shopify/InventoryLevel/548380009?inventory_item_id=808950810"], ["inventory_item_id" => 39072856, "location_id" => 487838322, "available" => 27, "updated_at" => "2023-01-03T12:56:35-05:00", "admin_graphql_api_id" => "gid://shopify/InventoryLevel/548380009?inventory_item_id=39072856"], ["inventory_item_id" => 808950810, "location_id" => 655441491, "available" => 1, "updated_at" => "2023-01-03T12:56:35-05:00", "admin_graphql_api_id" => "gid://shopify/InventoryLevel/655441491?inventory_item_id=808950810"], ["inventory_item_id" => 39072856, "location_id" => 655441491, "available" => 3, "updated_at" => "2023-01-03T12:56:35-05:00", "admin_graphql_api_id" => "gid://shopify/InventoryLevel/655441491?inventory_item_id=39072856"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-10/inventory_levels.json?inventory_item_ids=808950810%2C39072856&location_ids=655441491%2C487838322",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        InventoryLevel::all(
            $this->test_session,
            [],
            ["inventory_item_ids" => "808950810,39072856", "location_ids" => "655441491,487838322"],
        );
    }

    /**

     *
     * @return void
     */
    public function test_4(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["inventory_level" => ["inventory_item_id" => 808950810, "location_id" => 655441491, "available" => 6, "updated_at" => "2023-01-03T13:03:33-05:00", "admin_graphql_api_id" => "gid://shopify/InventoryLevel/655441491?inventory_item_id=808950810"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-10/inventory_levels/adjust.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["location_id" => 655441491, "inventory_item_id" => 808950810, "available_adjustment" => 5]),
            ),
        ]);

        $inventory_level = new InventoryLevel($this->test_session);

        $inventory_level->adjust(
            [],
            ["location_id" => 655441491, "inventory_item_id" => 808950810, "available_adjustment" => 5],
        );
    }

    /**

     *
     * @return void
     */
    public function test_5(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  []
                )),
                "https://test-shop.myshopify.io/admin/api/2022-10/inventory_levels.json?inventory_item_id=808950810&location_id=655441491",
                "DELETE",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        InventoryLevel::delete(
            $this->test_session,
            [],
            ["inventory_item_id" => "808950810", "location_id" => "655441491"],
        );
    }

    /**

     *
     * @return void
     */
    public function test_6(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["inventory_level" => ["inventory_item_id" => 457924702, "location_id" => 844681632, "available" => 0, "updated_at" => "2023-01-03T13:03:42-05:00", "admin_graphql_api_id" => "gid://shopify/InventoryLevel/844681632?inventory_item_id=457924702"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-10/inventory_levels/connect.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["location_id" => 844681632, "inventory_item_id" => 457924702]),
            ),
        ]);

        $inventory_level = new InventoryLevel($this->test_session);

        $inventory_level->connect(
            [],
            ["location_id" => 844681632, "inventory_item_id" => 457924702],
        );
    }

    /**

     *
     * @return void
     */
    public function test_7(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["inventory_level" => ["inventory_item_id" => 808950810, "location_id" => 655441491, "available" => 42, "updated_at" => "2023-01-03T13:03:52-05:00", "admin_graphql_api_id" => "gid://shopify/InventoryLevel/655441491?inventory_item_id=808950810"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-10/inventory_levels/set.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["location_id" => 655441491, "inventory_item_id" => 808950810, "available" => 42]),
            ),
        ]);

        $inventory_level = new InventoryLevel($this->test_session);

        $inventory_level->set(
            [],
            ["location_id" => 655441491, "inventory_item_id" => 808950810, "available" => 42],
        );
    }

}
