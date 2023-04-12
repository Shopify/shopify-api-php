<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Admin2023_04\ShippingZone;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class ShippingZone202304Test extends BaseTestCase
{
    /** @var Session */
    private $test_session;

    public function setUp(): void
    {
        parent::setUp();

        Context::$API_VERSION = "2023-04";

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
                  ["shipping_zones" => [["id" => 44570466, "name" => "Downtown Ottawa", "profile_id" => "gid://shopify/DeliveryProfile/690933842", "location_group_id" => "gid://shopify/DeliveryLocationGroup/694323328", "admin_graphql_api_id" => "gid://shopify/DeliveryZone/44570466", "countries" => [["id" => 359115488, "name" => "Colombia", "tax" => 0.15, "code" => "CO", "tax_name" => "VAT", "shipping_zone_id" => 44570466, "provinces" => []], ["id" => 879921427, "name" => "Canada", "tax" => 0.05, "code" => "CA", "tax_name" => "GST", "shipping_zone_id" => 44570466, "provinces" => [["id" => 224293623, "country_id" => 879921427, "name" => "Quebec", "code" => "QC", "tax" => 0.09, "tax_name" => "HST", "tax_type" => "compounded", "tax_percentage" => 9.0, "shipping_zone_id" => 44570466], ["id" => 702530425, "country_id" => 879921427, "name" => "Ontario", "code" => "ON", "tax" => 0.08, "tax_name" => null, "tax_type" => null, "tax_percentage" => 8.0, "shipping_zone_id" => 44570466]]], ["id" => 817138619, "name" => "United States", "tax" => 0.0, "code" => "US", "tax_name" => "Federal Tax", "shipping_zone_id" => 44570466, "provinces" => [["id" => 9350860, "country_id" => 817138619, "name" => "Massachusetts", "code" => "MA", "tax" => 0.065, "tax_name" => null, "tax_type" => null, "tax_percentage" => 6.5, "shipping_zone_id" => 44570466], ["id" => 1013111685, "country_id" => 817138619, "name" => "New York", "code" => "NY", "tax" => 0.04, "tax_name" => null, "tax_type" => null, "tax_percentage" => 4.0, "shipping_zone_id" => 44570466]]]], "weight_based_shipping_rates" => [["id" => 522512552, "name" => "Free Under 5kg", "price" => "0.00", "shipping_zone_id" => 44570466, "weight_low" => 0.0, "weight_high" => 5.0]], "price_based_shipping_rates" => [["id" => 64051, "name" => "Free Shipping", "price" => "0.00", "shipping_zone_id" => 44570466, "min_order_subtotal" => null, "max_order_subtotal" => "450"]], "carrier_shipping_rate_providers" => [["id" => 615128020, "carrier_service_id" => 260046840, "flat_modifier" => "", "percent_modifier" => null, "service_filter" => ["*" => "+"], "shipping_zone_id" => 44570466]]]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2023-04/shipping_zones.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        ShippingZone::all(
            $this->test_session,
            [],
            [],
        );
    }

}
