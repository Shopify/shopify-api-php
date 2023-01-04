<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Admin2023_01\Location;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class Location202301Test extends BaseTestCase
{
    /** @var Session */
    private $test_session;

    public function setUp(): void
    {
        parent::setUp();

        Context::$API_VERSION = "2023-01";

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
                  ["locations" => [["id" => 655441491, "name" => "50 Rideau Street", "address1" => "50 Rideau Street", "address2" => null, "city" => "Ottawa", "zip" => "K1N 9J7", "province" => "Ontario", "country" => "CA", "phone" => null, "created_at" => "2023-01-03T12:21:36-05:00", "updated_at" => "2023-01-03T12:21:36-05:00", "country_code" => "CA", "country_name" => "Canada", "province_code" => "ON", "legacy" => false, "active" => true, "admin_graphql_api_id" => "gid://shopify/Location/655441491", "localized_country_name" => "Canada", "localized_province_name" => "Ontario"], ["id" => 24826418, "name" => "Apple Api Shipwire", "address1" => null, "address2" => null, "city" => null, "zip" => null, "province" => null, "country" => "DE", "phone" => null, "created_at" => "2023-01-03T12:21:36-05:00", "updated_at" => "2023-01-03T12:21:36-05:00", "country_code" => "DE", "country_name" => "Germany", "province_code" => null, "legacy" => true, "active" => true, "admin_graphql_api_id" => "gid://shopify/Location/24826418", "localized_country_name" => "Germany", "localized_province_name" => null], ["id" => 844681632, "name" => "Apple Cupertino", "address1" => null, "address2" => null, "city" => null, "zip" => null, "province" => null, "country" => "US", "phone" => null, "created_at" => "2023-01-03T12:21:36-05:00", "updated_at" => "2023-01-03T12:21:36-05:00", "country_code" => "US", "country_name" => "United States", "province_code" => null, "legacy" => false, "active" => true, "admin_graphql_api_id" => "gid://shopify/Location/844681632", "localized_country_name" => "United States", "localized_province_name" => null], ["id" => 611870435, "name" => "Apple Shipwire", "address1" => null, "address2" => null, "city" => null, "zip" => null, "province" => null, "country" => "DE", "phone" => null, "created_at" => "2023-01-03T12:21:36-05:00", "updated_at" => "2023-01-03T12:21:36-05:00", "country_code" => "DE", "country_name" => "Germany", "province_code" => null, "legacy" => true, "active" => true, "admin_graphql_api_id" => "gid://shopify/Location/611870435", "localized_country_name" => "Germany", "localized_province_name" => null], ["id" => 487838322, "name" => "Fifth Avenue AppleStore", "address1" => null, "address2" => null, "city" => null, "zip" => null, "province" => null, "country" => "US", "phone" => null, "created_at" => "2023-01-03T12:21:36-05:00", "updated_at" => "2023-01-03T12:21:36-05:00", "country_code" => "US", "country_name" => "United States", "province_code" => null, "legacy" => false, "active" => true, "admin_graphql_api_id" => "gid://shopify/Location/487838322", "localized_country_name" => "United States", "localized_province_name" => null]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2023-01/locations.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Location::all(
            $this->test_session,
            [],
            [],
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
                  ["location" => ["id" => 487838322, "name" => "Fifth Avenue AppleStore", "address1" => null, "address2" => null, "city" => null, "zip" => null, "province" => null, "country" => "US", "phone" => null, "created_at" => "2023-01-03T12:21:36-05:00", "updated_at" => "2023-01-03T12:21:36-05:00", "country_code" => "US", "country_name" => "United States", "province_code" => null, "legacy" => false, "active" => true, "admin_graphql_api_id" => "gid://shopify/Location/487838322"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2023-01/locations/487838322.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Location::find(
            $this->test_session,
            487838322,
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
                  ["count" => 5]
                )),
                "https://test-shop.myshopify.io/admin/api/2023-01/locations/count.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Location::count(
            $this->test_session,
            [],
            [],
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
                  ["inventory_levels" => [["inventory_item_id" => 49148385, "location_id" => 487838322, "available" => 18, "updated_at" => "2023-01-03T12:21:36-05:00", "admin_graphql_api_id" => "gid://shopify/InventoryLevel/548380009?inventory_item_id=49148385"], ["inventory_item_id" => 808950810, "location_id" => 487838322, "available" => 9, "updated_at" => "2023-01-03T12:21:36-05:00", "admin_graphql_api_id" => "gid://shopify/InventoryLevel/548380009?inventory_item_id=808950810"], ["inventory_item_id" => 457924702, "location_id" => 487838322, "available" => 36, "updated_at" => "2023-01-03T12:21:36-05:00", "admin_graphql_api_id" => "gid://shopify/InventoryLevel/548380009?inventory_item_id=457924702"], ["inventory_item_id" => 39072856, "location_id" => 487838322, "available" => 27, "updated_at" => "2023-01-03T12:21:36-05:00", "admin_graphql_api_id" => "gid://shopify/InventoryLevel/548380009?inventory_item_id=39072856"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2023-01/locations/487838322/inventory_levels.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Location::inventory_levels(
            $this->test_session,
            487838322,
            [],
            [],
        );
    }

}
