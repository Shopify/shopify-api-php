<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Admin2022_04\InventoryItem;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class InventoryItem202204Test extends BaseTestCase
{
    /** @var Session */
    private $test_session;

    public function setUp(): void
    {
        parent::setUp();

        Context::$API_VERSION = "2022-04";

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
                  ["inventory_items" => [["id" => 39072856, "sku" => "IPOD2008GREEN", "created_at" => "2023-01-03T12:21:36-05:00", "updated_at" => "2023-01-03T12:21:36-05:00", "requires_shipping" => true, "cost" => "25.00", "country_code_of_origin" => null, "province_code_of_origin" => null, "harmonized_system_code" => null, "tracked" => true, "country_harmonized_system_codes" => [], "admin_graphql_api_id" => "gid://shopify/InventoryItem/39072856"], ["id" => 457924702, "sku" => "IPOD2008BLACK", "created_at" => "2023-01-03T12:21:36-05:00", "updated_at" => "2023-01-03T12:21:36-05:00", "requires_shipping" => true, "cost" => "25.00", "country_code_of_origin" => null, "province_code_of_origin" => null, "harmonized_system_code" => null, "tracked" => true, "country_harmonized_system_codes" => [], "admin_graphql_api_id" => "gid://shopify/InventoryItem/457924702"], ["id" => 808950810, "sku" => "IPOD2008PINK", "created_at" => "2023-01-03T12:21:36-05:00", "updated_at" => "2023-01-03T12:21:36-05:00", "requires_shipping" => true, "cost" => "25.00", "country_code_of_origin" => null, "province_code_of_origin" => null, "harmonized_system_code" => null, "tracked" => true, "country_harmonized_system_codes" => [], "admin_graphql_api_id" => "gid://shopify/InventoryItem/808950810"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/inventory_items.json?ids=808950810%2C39072856%2C457924702",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        InventoryItem::all(
            $this->test_session,
            [],
            ["ids" => "808950810,39072856,457924702"],
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
                  ["inventory_item" => ["id" => 808950810, "sku" => "IPOD2008PINK", "created_at" => "2023-01-03T12:21:36-05:00", "updated_at" => "2023-01-03T12:21:36-05:00", "requires_shipping" => true, "cost" => "25.00", "country_code_of_origin" => null, "province_code_of_origin" => null, "harmonized_system_code" => null, "tracked" => true, "country_harmonized_system_codes" => [], "admin_graphql_api_id" => "gid://shopify/InventoryItem/808950810"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/inventory_items/808950810.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        InventoryItem::find(
            $this->test_session,
            808950810,
            [],
            [],
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
                  ["inventory_item" => ["id" => 808950810, "sku" => "new sku", "created_at" => "2023-01-03T12:21:36-05:00", "updated_at" => "2023-01-03T12:38:07-05:00", "requires_shipping" => true, "cost" => "25.00", "country_code_of_origin" => null, "province_code_of_origin" => null, "harmonized_system_code" => null, "tracked" => true, "country_harmonized_system_codes" => [], "admin_graphql_api_id" => "gid://shopify/InventoryItem/808950810"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/inventory_items/808950810.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["inventory_item" => ["sku" => "new sku"]]),
            ),
        ]);

        $inventory_item = new InventoryItem($this->test_session);
        $inventory_item->id = 808950810;
        $inventory_item->sku = "new sku";
        $inventory_item->save();
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
                  ["inventory_item" => ["id" => 808950810, "sku" => "IPOD2008PINK", "created_at" => "2023-01-03T12:21:36-05:00", "updated_at" => "2023-01-03T12:21:36-05:00", "requires_shipping" => true, "cost" => "25.00", "country_code_of_origin" => null, "province_code_of_origin" => null, "harmonized_system_code" => null, "tracked" => true, "country_harmonized_system_codes" => [], "admin_graphql_api_id" => "gid://shopify/InventoryItem/808950810"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/inventory_items/808950810.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["inventory_item" => ["cost" => "25.00"]]),
            ),
        ]);

        $inventory_item = new InventoryItem($this->test_session);
        $inventory_item->id = 808950810;
        $inventory_item->cost = "25.00";
        $inventory_item->save();
    }

}
