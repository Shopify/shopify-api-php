<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Admin2022_04\Fulfillment;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class Fulfillment202204Test extends BaseTestCase
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
                  ["fulfillments" => [["id" => 1069019866, "order_id" => 450789469, "status" => "success", "created_at" => "2022-10-03T13:21:01-04:00", "service" => "shipwire-app", "updated_at" => "2022-10-03T13:21:01-04:00", "tracking_company" => "TNT", "shipment_status" => null, "location_id" => 24826418, "line_items" => [["id" => 518995019, "variant_id" => 49148385, "title" => "IPod Nano - 8gb", "quantity" => 1, "sku" => "IPOD2008RED", "variant_title" => "red", "vendor" => null, "fulfillment_service" => "shipwire-app", "product_id" => 632910392, "requires_shipping" => true, "taxable" => true, "gift_card" => false, "name" => "IPod Nano - 8gb - red", "variant_inventory_management" => "shipwire-app", "properties" => [], "product_exists" => true, "fulfillable_quantity" => 1, "grams" => 200, "price" => "199.00", "total_discount" => "0.00", "fulfillment_status" => null, "price_set" => ["shop_money" => ["amount" => "199.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "199.00", "currency_code" => "USD"]], "total_discount_set" => ["shop_money" => ["amount" => "0.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "0.00", "currency_code" => "USD"]], "discount_allocations" => [["amount" => "3.33", "discount_application_index" => 0, "amount_set" => ["shop_money" => ["amount" => "3.33", "currency_code" => "USD"], "presentment_money" => ["amount" => "3.33", "currency_code" => "USD"]]]], "admin_graphql_api_id" => "gid://shopify/LineItem/518995019", "duties" => [], "tax_lines" => [["price" => "3.98", "rate" => 0.06, "title" => "State Tax", "price_set" => ["shop_money" => ["amount" => "3.98", "currency_code" => "USD"], "presentment_money" => ["amount" => "3.98", "currency_code" => "USD"]]]]]], "tracking_number" => "123456789", "tracking_numbers" => ["123456789"], "tracking_url" => "https://www.tnt.com/express/en_us/site/tracking.html?searchType=con&cons=123456789", "tracking_urls" => ["https://www.tnt.com/express/en_us/site/tracking.html?searchType=con&cons=123456789"], "receipt" => [], "name" => "#1001.1", "admin_graphql_api_id" => "gid://shopify/Fulfillment/1069019866"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/orders/450789469/fulfillments.json?since_id=255858046",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Fulfillment::all(
            $this->test_session,
            ["order_id" => "450789469"],
            ["since_id" => "255858046"],
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
                  ["fulfillments" => [["id" => 255858046, "order_id" => 450789469, "status" => "failure", "created_at" => "2022-10-03T13:07:13-04:00", "service" => "manual", "updated_at" => "2022-10-03T13:07:13-04:00", "tracking_company" => "USPS", "shipment_status" => null, "location_id" => 655441491, "line_items" => [["id" => 466157049, "variant_id" => 39072856, "title" => "IPod Nano - 8gb", "quantity" => 1, "sku" => "IPOD2008GREEN", "variant_title" => "green", "vendor" => null, "fulfillment_service" => "manual", "product_id" => 632910392, "requires_shipping" => true, "taxable" => true, "gift_card" => false, "name" => "IPod Nano - 8gb - green", "variant_inventory_management" => "shopify", "properties" => [["name" => "Custom Engraving Front", "value" => "Happy Birthday"], ["name" => "Custom Engraving Back", "value" => "Merry Christmas"]], "product_exists" => true, "fulfillable_quantity" => 0, "grams" => 200, "price" => "199.00", "total_discount" => "0.00", "fulfillment_status" => null, "price_set" => ["shop_money" => ["amount" => "199.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "199.00", "currency_code" => "USD"]], "total_discount_set" => ["shop_money" => ["amount" => "0.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "0.00", "currency_code" => "USD"]], "discount_allocations" => [["amount" => "3.34", "discount_application_index" => 0, "amount_set" => ["shop_money" => ["amount" => "3.34", "currency_code" => "USD"], "presentment_money" => ["amount" => "3.34", "currency_code" => "USD"]]]], "admin_graphql_api_id" => "gid://shopify/LineItem/466157049", "duties" => [], "tax_lines" => [["price" => "3.98", "rate" => 0.06, "title" => "State Tax", "price_set" => ["shop_money" => ["amount" => "3.98", "currency_code" => "USD"], "presentment_money" => ["amount" => "3.98", "currency_code" => "USD"]]]]]], "tracking_number" => "1Z2345", "tracking_numbers" => ["1Z2345"], "tracking_url" => "https://tools.usps.com/go/TrackConfirmAction_input?qtc_tLabels1=1Z2345", "tracking_urls" => ["https://tools.usps.com/go/TrackConfirmAction_input?qtc_tLabels1=1Z2345"], "receipt" => ["testcase" => true, "authorization" => "123456"], "name" => "#1001.0", "admin_graphql_api_id" => "gid://shopify/Fulfillment/255858046"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/orders/450789469/fulfillments.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Fulfillment::all(
            $this->test_session,
            ["order_id" => "450789469"],
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
                  ["fulfillments" => [["id" => 1069019874, "order_id" => 450789469, "status" => "success", "created_at" => "2022-10-03T13:07:13-04:00", "service" => "manual", "updated_at" => "2022-10-03T13:07:13-04:00", "tracking_company" => "UPS", "shipment_status" => null, "location_id" => 24826418, "line_items" => [["id" => 1071823194, "variant_id" => 43729076, "title" => "Draft", "quantity" => 1, "sku" => "draft-151", "variant_title" => "151cm", "vendor" => null, "fulfillment_service" => "manual", "product_id" => 108828309, "requires_shipping" => true, "taxable" => true, "gift_card" => false, "name" => "Draft - 151cm", "variant_inventory_management" => null, "properties" => [], "product_exists" => true, "fulfillable_quantity" => 1, "grams" => 0, "price" => "10.00", "total_discount" => "0.00", "fulfillment_status" => "fulfilled", "price_set" => ["shop_money" => ["amount" => "10.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "10.00", "currency_code" => "USD"]], "total_discount_set" => ["shop_money" => ["amount" => "0.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "0.00", "currency_code" => "USD"]], "discount_allocations" => [], "duties" => [], "admin_graphql_api_id" => "gid://shopify/LineItem/1071823194", "tax_lines" => []]], "tracking_number" => "#\u26201\u2622\n---\n4321\n", "tracking_numbers" => ["#\u26201\u2622\n---\n4321\n"], "tracking_url" => "https://www.ups.com/WebTracking?loc=en_US&requester=ST&trackNums=#\u26201\u2622---4321", "tracking_urls" => ["https://www.ups.com/WebTracking?loc=en_US&requester=ST&trackNums=#\u26201\u2622---4321"], "receipt" => [], "name" => "#1001.1", "admin_graphql_api_id" => "gid://shopify/Fulfillment/1069019874"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/fulfillment_orders/1046000816/fulfillments.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Fulfillment::all(
            $this->test_session,
            ["fulfillment_order_id" => "1046000816"],
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
                  ["count" => 1]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/orders/450789469/fulfillments/count.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Fulfillment::count(
            $this->test_session,
            ["order_id" => "450789469"],
            [],
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
                  ["fulfillment" => ["id" => 255858046, "order_id" => 450789469, "status" => "failure", "created_at" => "2022-10-03T13:07:13-04:00", "service" => "manual", "updated_at" => "2022-10-03T13:07:13-04:00", "tracking_company" => "USPS", "shipment_status" => null, "location_id" => 655441491, "origin_address" => null, "line_items" => [["id" => 466157049, "variant_id" => 39072856, "title" => "IPod Nano - 8gb", "quantity" => 1, "sku" => "IPOD2008GREEN", "variant_title" => "green", "vendor" => null, "fulfillment_service" => "manual", "product_id" => 632910392, "requires_shipping" => true, "taxable" => true, "gift_card" => false, "name" => "IPod Nano - 8gb - green", "variant_inventory_management" => "shopify", "properties" => [["name" => "Custom Engraving Front", "value" => "Happy Birthday"], ["name" => "Custom Engraving Back", "value" => "Merry Christmas"]], "product_exists" => true, "fulfillable_quantity" => 1, "grams" => 200, "price" => "199.00", "total_discount" => "0.00", "fulfillment_status" => null, "price_set" => ["shop_money" => ["amount" => "199.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "199.00", "currency_code" => "USD"]], "total_discount_set" => ["shop_money" => ["amount" => "0.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "0.00", "currency_code" => "USD"]], "discount_allocations" => [["amount" => "3.34", "discount_application_index" => 0, "amount_set" => ["shop_money" => ["amount" => "3.34", "currency_code" => "USD"], "presentment_money" => ["amount" => "3.34", "currency_code" => "USD"]]]], "duties" => [], "admin_graphql_api_id" => "gid://shopify/LineItem/466157049", "tax_lines" => [["title" => "State Tax", "price" => "3.98", "rate" => 0.06, "channel_liable" => null, "price_set" => ["shop_money" => ["amount" => "3.98", "currency_code" => "USD"], "presentment_money" => ["amount" => "3.98", "currency_code" => "USD"]]]]]], "tracking_number" => "1Z2345", "tracking_numbers" => ["1Z2345"], "tracking_url" => "https://tools.usps.com/go/TrackConfirmAction_input?qtc_tLabels1=1Z2345", "tracking_urls" => ["https://tools.usps.com/go/TrackConfirmAction_input?qtc_tLabels1=1Z2345"], "receipt" => ["testcase" => true, "authorization" => "123456"], "name" => "#1001.0", "admin_graphql_api_id" => "gid://shopify/Fulfillment/255858046"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/orders/450789469/fulfillments/255858046.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Fulfillment::find(
            $this->test_session,
            255858046,
            ["order_id" => "450789469"],
            [],
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
                  ["fulfillment" => ["location_id" => 655441491, "id" => 255858046, "order_id" => 450789469, "status" => "failure", "created_at" => "2022-10-03T13:07:13-04:00", "service" => "manual", "updated_at" => "2022-10-03T13:21:13-04:00", "tracking_company" => "USPS", "shipment_status" => null, "origin_address" => null, "line_items" => [["id" => 466157049, "variant_id" => 39072856, "title" => "IPod Nano - 8gb", "quantity" => 1, "sku" => "IPOD2008GREEN", "variant_title" => "green", "vendor" => null, "fulfillment_service" => "manual", "product_id" => 632910392, "requires_shipping" => true, "taxable" => true, "gift_card" => false, "name" => "IPod Nano - 8gb - green", "variant_inventory_management" => "shopify", "properties" => [["name" => "Custom Engraving Front", "value" => "Happy Birthday"], ["name" => "Custom Engraving Back", "value" => "Merry Christmas"]], "product_exists" => true, "fulfillable_quantity" => 1, "grams" => 200, "price" => "199.00", "total_discount" => "0.00", "fulfillment_status" => null, "price_set" => ["shop_money" => ["amount" => "199.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "199.00", "currency_code" => "USD"]], "total_discount_set" => ["shop_money" => ["amount" => "0.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "0.00", "currency_code" => "USD"]], "discount_allocations" => [["amount" => "3.34", "discount_application_index" => 0, "amount_set" => ["shop_money" => ["amount" => "3.34", "currency_code" => "USD"], "presentment_money" => ["amount" => "3.34", "currency_code" => "USD"]]]], "duties" => [], "admin_graphql_api_id" => "gid://shopify/LineItem/466157049", "tax_lines" => [["title" => "State Tax", "price" => "3.98", "rate" => 0.06, "channel_liable" => null, "price_set" => ["shop_money" => ["amount" => "3.98", "currency_code" => "USD"], "presentment_money" => ["amount" => "3.98", "currency_code" => "USD"]]]]]], "tracking_number" => "987654321", "tracking_numbers" => ["987654321"], "tracking_url" => "https://tools.usps.com/go/TrackConfirmAction_input?qtc_tLabels1=987654321", "tracking_urls" => ["https://tools.usps.com/go/TrackConfirmAction_input?qtc_tLabels1=987654321"], "receipt" => ["testcase" => true, "authorization" => "123456"], "name" => "#1001.0", "admin_graphql_api_id" => "gid://shopify/Fulfillment/255858046"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/orders/450789469/fulfillments/255858046.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["fulfillment" => ["tracking_number" => "987654321"]]),
            ),
        ]);

        $fulfillment = new Fulfillment($this->test_session);
        $fulfillment->order_id = 450789469;
        $fulfillment->id = 255858046;
        $fulfillment->tracking_number = "987654321";
        $fulfillment->save();
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
                  ["fulfillment" => ["id" => 1069019864, "order_id" => 450789469, "status" => "success", "created_at" => "2022-10-03T13:20:56-04:00", "service" => "manual", "updated_at" => "2022-10-03T13:20:56-04:00", "tracking_company" => null, "shipment_status" => null, "location_id" => 655441491, "origin_address" => null, "line_items" => [["id" => 518995019, "variant_id" => 49148385, "title" => "IPod Nano - 8gb", "quantity" => 1, "sku" => "IPOD2008RED", "variant_title" => "red", "vendor" => null, "fulfillment_service" => "manual", "product_id" => 632910392, "requires_shipping" => true, "taxable" => true, "gift_card" => false, "name" => "IPod Nano - 8gb - red", "variant_inventory_management" => "shopify", "properties" => [], "product_exists" => true, "fulfillable_quantity" => 0, "grams" => 200, "price" => "199.00", "total_discount" => "0.00", "fulfillment_status" => "fulfilled", "price_set" => ["shop_money" => ["amount" => "199.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "199.00", "currency_code" => "USD"]], "total_discount_set" => ["shop_money" => ["amount" => "0.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "0.00", "currency_code" => "USD"]], "discount_allocations" => [["amount" => "3.33", "discount_application_index" => 0, "amount_set" => ["shop_money" => ["amount" => "3.33", "currency_code" => "USD"], "presentment_money" => ["amount" => "3.33", "currency_code" => "USD"]]]], "duties" => [], "admin_graphql_api_id" => "gid://shopify/LineItem/518995019", "tax_lines" => [["title" => "State Tax", "price" => "3.98", "rate" => 0.06, "channel_liable" => null, "price_set" => ["shop_money" => ["amount" => "3.98", "currency_code" => "USD"], "presentment_money" => ["amount" => "3.98", "currency_code" => "USD"]]]]]], "tracking_number" => null, "tracking_numbers" => [], "tracking_url" => null, "tracking_urls" => [], "receipt" => [], "name" => "#1001.1", "admin_graphql_api_id" => "gid://shopify/Fulfillment/1069019864"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/orders/450789469/fulfillments.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["fulfillment" => ["location_id" => 655441491, "tracking_number" => null, "line_items" => [["id" => 518995019]]]]),
            ),
        ]);

        $fulfillment = new Fulfillment($this->test_session);
        $fulfillment->order_id = 450789469;
        $fulfillment->location_id = 655441491;
        $fulfillment->tracking_number = null;
        $fulfillment->line_items = [
            [
                "id" => 518995019
            ]
        ];
        $fulfillment->save();
    }

    /**

     *
     * @return void
     */
    public function test_8(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["fulfillment" => ["id" => 1069019865, "order_id" => 450789469, "status" => "success", "created_at" => "2022-10-03T13:20:59-04:00", "service" => "manual", "updated_at" => "2022-10-03T13:20:59-04:00", "tracking_company" => null, "shipment_status" => null, "location_id" => 655441491, "origin_address" => null, "line_items" => [["id" => 518995019, "variant_id" => 49148385, "title" => "IPod Nano - 8gb", "quantity" => 1, "sku" => "IPOD2008RED", "variant_title" => "red", "vendor" => null, "fulfillment_service" => "manual", "product_id" => 632910392, "requires_shipping" => true, "taxable" => true, "gift_card" => false, "name" => "IPod Nano - 8gb - red", "variant_inventory_management" => "shopify", "properties" => [], "product_exists" => true, "fulfillable_quantity" => 0, "grams" => 200, "price" => "199.00", "total_discount" => "0.00", "fulfillment_status" => "fulfilled", "price_set" => ["shop_money" => ["amount" => "199.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "199.00", "currency_code" => "USD"]], "total_discount_set" => ["shop_money" => ["amount" => "0.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "0.00", "currency_code" => "USD"]], "discount_allocations" => [["amount" => "3.33", "discount_application_index" => 0, "amount_set" => ["shop_money" => ["amount" => "3.33", "currency_code" => "USD"], "presentment_money" => ["amount" => "3.33", "currency_code" => "USD"]]]], "duties" => [], "admin_graphql_api_id" => "gid://shopify/LineItem/518995019", "tax_lines" => [["title" => "State Tax", "price" => "3.98", "rate" => 0.06, "channel_liable" => null, "price_set" => ["shop_money" => ["amount" => "3.98", "currency_code" => "USD"], "presentment_money" => ["amount" => "3.98", "currency_code" => "USD"]]]]]], "tracking_number" => null, "tracking_numbers" => [], "tracking_url" => null, "tracking_urls" => [], "receipt" => [], "name" => "#1001.1", "admin_graphql_api_id" => "gid://shopify/Fulfillment/1069019865"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/orders/450789469/fulfillments.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["fulfillment" => ["location_id" => 655441491, "tracking_number" => null, "line_items" => [["id" => 518995019, "quantity" => 1]]]]),
            ),
        ]);

        $fulfillment = new Fulfillment($this->test_session);
        $fulfillment->order_id = 450789469;
        $fulfillment->location_id = 655441491;
        $fulfillment->tracking_number = null;
        $fulfillment->line_items = [
            [
                "id" => 518995019,
                "quantity" => 1
            ]
        ];
        $fulfillment->save();
    }

    /**

     *
     * @return void
     */
    public function test_9(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["fulfillment" => ["id" => 1069019867, "order_id" => 450789469, "status" => "success", "created_at" => "2022-10-03T13:21:04-04:00", "service" => "manual", "updated_at" => "2022-10-03T13:21:04-04:00", "tracking_company" => "USPS", "shipment_status" => null, "location_id" => 655441491, "origin_address" => null, "line_items" => [["id" => 518995019, "variant_id" => 49148385, "title" => "IPod Nano - 8gb", "quantity" => 1, "sku" => "IPOD2008RED", "variant_title" => "red", "vendor" => null, "fulfillment_service" => "manual", "product_id" => 632910392, "requires_shipping" => true, "taxable" => true, "gift_card" => false, "name" => "IPod Nano - 8gb - red", "variant_inventory_management" => "shopify", "properties" => [], "product_exists" => true, "fulfillable_quantity" => 0, "grams" => 200, "price" => "199.00", "total_discount" => "0.00", "fulfillment_status" => "fulfilled", "price_set" => ["shop_money" => ["amount" => "199.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "199.00", "currency_code" => "USD"]], "total_discount_set" => ["shop_money" => ["amount" => "0.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "0.00", "currency_code" => "USD"]], "discount_allocations" => [["amount" => "3.33", "discount_application_index" => 0, "amount_set" => ["shop_money" => ["amount" => "3.33", "currency_code" => "USD"], "presentment_money" => ["amount" => "3.33", "currency_code" => "USD"]]]], "duties" => [], "admin_graphql_api_id" => "gid://shopify/LineItem/518995019", "tax_lines" => [["title" => "State Tax", "price" => "3.98", "rate" => 0.06, "channel_liable" => null, "price_set" => ["shop_money" => ["amount" => "3.98", "currency_code" => "USD"], "presentment_money" => ["amount" => "3.98", "currency_code" => "USD"]]]]]], "tracking_number" => "CJ274101086US", "tracking_numbers" => ["CJ274101086US"], "tracking_url" => "http://www.custom-tracking.com/?tracking_number=CJ274101086US", "tracking_urls" => ["http://www.custom-tracking.com/?tracking_number=CJ274101086US"], "receipt" => [], "name" => "#1001.1", "admin_graphql_api_id" => "gid://shopify/Fulfillment/1069019867"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/orders/450789469/fulfillments.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["fulfillment" => ["location_id" => 655441491, "tracking_number" => "CJ274101086US", "tracking_url" => "http://www.custom-tracking.com/?tracking_number=CJ274101086US", "line_items" => [["id" => 518995019]]]]),
            ),
        ]);

        $fulfillment = new Fulfillment($this->test_session);
        $fulfillment->order_id = 450789469;
        $fulfillment->location_id = 655441491;
        $fulfillment->tracking_number = "CJ274101086US";
        $fulfillment->tracking_url = "http://www.custom-tracking.com/?tracking_number=CJ274101086US";
        $fulfillment->line_items = [
            [
                "id" => 518995019
            ]
        ];
        $fulfillment->save();
    }

    /**

     *
     * @return void
     */
    public function test_10(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["fulfillment" => ["id" => 1069019873, "order_id" => 450789469, "status" => "success", "created_at" => "2022-10-03T13:21:27-04:00", "service" => "manual", "updated_at" => "2022-10-03T13:21:27-04:00", "tracking_company" => "Deutsche Post", "shipment_status" => null, "location_id" => 655441491, "origin_address" => null, "line_items" => [["id" => 518995019, "variant_id" => 49148385, "title" => "IPod Nano - 8gb", "quantity" => 1, "sku" => "IPOD2008RED", "variant_title" => "red", "vendor" => null, "fulfillment_service" => "manual", "product_id" => 632910392, "requires_shipping" => true, "taxable" => true, "gift_card" => false, "name" => "IPod Nano - 8gb - red", "variant_inventory_management" => "shopify", "properties" => [], "product_exists" => true, "fulfillable_quantity" => 0, "grams" => 200, "price" => "199.00", "total_discount" => "0.00", "fulfillment_status" => "fulfilled", "price_set" => ["shop_money" => ["amount" => "199.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "199.00", "currency_code" => "USD"]], "total_discount_set" => ["shop_money" => ["amount" => "0.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "0.00", "currency_code" => "USD"]], "discount_allocations" => [["amount" => "3.33", "discount_application_index" => 0, "amount_set" => ["shop_money" => ["amount" => "3.33", "currency_code" => "USD"], "presentment_money" => ["amount" => "3.33", "currency_code" => "USD"]]]], "duties" => [], "admin_graphql_api_id" => "gid://shopify/LineItem/518995019", "tax_lines" => [["title" => "State Tax", "price" => "3.98", "rate" => 0.06, "channel_liable" => null, "price_set" => ["shop_money" => ["amount" => "3.98", "currency_code" => "USD"], "presentment_money" => ["amount" => "3.98", "currency_code" => "USD"]]]]]], "tracking_number" => "07814c092e18d1908c176269f270fc66", "tracking_numbers" => ["07814c092e18d1908c176269f270fc66", "b957ab68622bfad6f333db5920b2cca9", "353edc645006270ae0c6d1a84fa8e7b4"], "tracking_url" => "https://www.deutschepost.de/de/s/sendungsverfolgung/verfolgen.html?piececode=07814c092e18d1908c176269f270fc66", "tracking_urls" => ["https://www.deutschepost.de/de/s/sendungsverfolgung/verfolgen.html?piececode=07814c092e18d1908c176269f270fc66", "https://www.deutschepost.de/de/s/sendungsverfolgung/verfolgen.html?piececode=b957ab68622bfad6f333db5920b2cca9", "https://www.deutschepost.de/de/s/sendungsverfolgung/verfolgen.html?piececode=353edc645006270ae0c6d1a84fa8e7b4"], "receipt" => [], "name" => "#1001.1", "admin_graphql_api_id" => "gid://shopify/Fulfillment/1069019873"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/orders/450789469/fulfillments.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["fulfillment" => ["location_id" => 655441491, "tracking_numbers" => ["07814c092e18d1908c176269f270fc66", "b957ab68622bfad6f333db5920b2cca9", "353edc645006270ae0c6d1a84fa8e7b4"], "line_items" => [["id" => 518995019]]]]),
            ),
        ]);

        $fulfillment = new Fulfillment($this->test_session);
        $fulfillment->order_id = 450789469;
        $fulfillment->location_id = 655441491;
        $fulfillment->tracking_numbers = [
            "07814c092e18d1908c176269f270fc66",
            "b957ab68622bfad6f333db5920b2cca9",
            "353edc645006270ae0c6d1a84fa8e7b4"
        ];
        $fulfillment->line_items = [
            [
                "id" => 518995019
            ]
        ];
        $fulfillment->save();
    }

    /**

     *
     * @return void
     */
    public function test_11(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["fulfillment" => ["id" => 1069019875, "order_id" => 450789469, "status" => "success", "created_at" => "2022-10-03T13:21:32-04:00", "service" => "manual", "updated_at" => "2022-10-03T13:21:32-04:00", "tracking_company" => "fed ex", "shipment_status" => null, "location_id" => 655441491, "origin_address" => null, "line_items" => [["id" => 518995019, "variant_id" => 49148385, "title" => "IPod Nano - 8gb", "quantity" => 1, "sku" => "IPOD2008RED", "variant_title" => "red", "vendor" => null, "fulfillment_service" => "manual", "product_id" => 632910392, "requires_shipping" => true, "taxable" => true, "gift_card" => false, "name" => "IPod Nano - 8gb - red", "variant_inventory_management" => "shopify", "properties" => [], "product_exists" => true, "fulfillable_quantity" => 0, "grams" => 200, "price" => "199.00", "total_discount" => "0.00", "fulfillment_status" => "fulfilled", "price_set" => ["shop_money" => ["amount" => "199.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "199.00", "currency_code" => "USD"]], "total_discount_set" => ["shop_money" => ["amount" => "0.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "0.00", "currency_code" => "USD"]], "discount_allocations" => [["amount" => "3.33", "discount_application_index" => 0, "amount_set" => ["shop_money" => ["amount" => "3.33", "currency_code" => "USD"], "presentment_money" => ["amount" => "3.33", "currency_code" => "USD"]]]], "duties" => [], "admin_graphql_api_id" => "gid://shopify/LineItem/518995019", "tax_lines" => [["title" => "State Tax", "price" => "3.98", "rate" => 0.06, "channel_liable" => null, "price_set" => ["shop_money" => ["amount" => "3.98", "currency_code" => "USD"], "presentment_money" => ["amount" => "3.98", "currency_code" => "USD"]]]]]], "tracking_number" => "123456789010", "tracking_numbers" => ["123456789010"], "tracking_url" => "https://www.new-fedex-tracking.com/?number=123456789010", "tracking_urls" => ["https://www.new-fedex-tracking.com/?number=123456789010"], "receipt" => [], "name" => "#1001.1", "admin_graphql_api_id" => "gid://shopify/Fulfillment/1069019875"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/orders/450789469/fulfillments.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["fulfillment" => ["location_id" => 655441491, "tracking_number" => "123456789010", "tracking_company" => "fed ex", "tracking_url" => "https://www.new-fedex-tracking.com/?number=123456789010", "line_items" => [["id" => 518995019]]]]),
            ),
        ]);

        $fulfillment = new Fulfillment($this->test_session);
        $fulfillment->order_id = 450789469;
        $fulfillment->location_id = 655441491;
        $fulfillment->tracking_number = "123456789010";
        $fulfillment->tracking_company = "fed ex";
        $fulfillment->tracking_url = "https://www.new-fedex-tracking.com/?number=123456789010";
        $fulfillment->line_items = [
            [
                "id" => 518995019
            ]
        ];
        $fulfillment->save();
    }

    /**

     *
     * @return void
     */
    public function test_12(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["fulfillment" => ["id" => 1069019876, "order_id" => 450789469, "status" => "success", "created_at" => "2022-10-03T13:21:48-04:00", "service" => "manual", "updated_at" => "2022-10-03T13:21:48-04:00", "tracking_company" => "Custom Tracking Company", "shipment_status" => null, "location_id" => 655441491, "origin_address" => null, "line_items" => [["id" => 518995019, "variant_id" => 49148385, "title" => "IPod Nano - 8gb", "quantity" => 1, "sku" => "IPOD2008RED", "variant_title" => "red", "vendor" => null, "fulfillment_service" => "manual", "product_id" => 632910392, "requires_shipping" => true, "taxable" => true, "gift_card" => false, "name" => "IPod Nano - 8gb - red", "variant_inventory_management" => "shopify", "properties" => [], "product_exists" => true, "fulfillable_quantity" => 0, "grams" => 200, "price" => "199.00", "total_discount" => "0.00", "fulfillment_status" => "fulfilled", "price_set" => ["shop_money" => ["amount" => "199.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "199.00", "currency_code" => "USD"]], "total_discount_set" => ["shop_money" => ["amount" => "0.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "0.00", "currency_code" => "USD"]], "discount_allocations" => [["amount" => "3.33", "discount_application_index" => 0, "amount_set" => ["shop_money" => ["amount" => "3.33", "currency_code" => "USD"], "presentment_money" => ["amount" => "3.33", "currency_code" => "USD"]]]], "duties" => [], "admin_graphql_api_id" => "gid://shopify/LineItem/518995019", "tax_lines" => [["title" => "State Tax", "price" => "3.98", "rate" => 0.06, "channel_liable" => null, "price_set" => ["shop_money" => ["amount" => "3.98", "currency_code" => "USD"], "presentment_money" => ["amount" => "3.98", "currency_code" => "USD"]]]]]], "tracking_number" => "1234567", "tracking_numbers" => ["1234567"], "tracking_url" => null, "tracking_urls" => [], "receipt" => [], "name" => "#1001.1", "admin_graphql_api_id" => "gid://shopify/Fulfillment/1069019876"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/orders/450789469/fulfillments.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["fulfillment" => ["location_id" => 655441491, "tracking_number" => "1234567", "tracking_company" => "Custom Tracking Company", "line_items" => [["id" => 518995019]]]]),
            ),
        ]);

        $fulfillment = new Fulfillment($this->test_session);
        $fulfillment->order_id = 450789469;
        $fulfillment->location_id = 655441491;
        $fulfillment->tracking_number = "1234567";
        $fulfillment->tracking_company = "Custom Tracking Company";
        $fulfillment->line_items = [
            [
                "id" => 518995019
            ]
        ];
        $fulfillment->save();
    }

    /**

     *
     * @return void
     */
    public function test_13(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["fulfillment" => ["id" => 1069019877, "order_id" => 450789469, "status" => "success", "created_at" => "2022-10-03T13:21:50-04:00", "service" => "manual", "updated_at" => "2022-10-03T13:21:50-04:00", "tracking_company" => "Jack Black's Pack, Stack and Track", "shipment_status" => null, "location_id" => 655441491, "origin_address" => null, "line_items" => [["id" => 518995019, "variant_id" => 49148385, "title" => "IPod Nano - 8gb", "quantity" => 1, "sku" => "IPOD2008RED", "variant_title" => "red", "vendor" => null, "fulfillment_service" => "manual", "product_id" => 632910392, "requires_shipping" => true, "taxable" => true, "gift_card" => false, "name" => "IPod Nano - 8gb - red", "variant_inventory_management" => "shopify", "properties" => [], "product_exists" => true, "fulfillable_quantity" => 0, "grams" => 200, "price" => "199.00", "total_discount" => "0.00", "fulfillment_status" => "fulfilled", "price_set" => ["shop_money" => ["amount" => "199.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "199.00", "currency_code" => "USD"]], "total_discount_set" => ["shop_money" => ["amount" => "0.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "0.00", "currency_code" => "USD"]], "discount_allocations" => [["amount" => "3.33", "discount_application_index" => 0, "amount_set" => ["shop_money" => ["amount" => "3.33", "currency_code" => "USD"], "presentment_money" => ["amount" => "3.33", "currency_code" => "USD"]]]], "duties" => [], "admin_graphql_api_id" => "gid://shopify/LineItem/518995019", "tax_lines" => [["title" => "State Tax", "price" => "3.98", "rate" => 0.06, "channel_liable" => null, "price_set" => ["shop_money" => ["amount" => "3.98", "currency_code" => "USD"], "presentment_money" => ["amount" => "3.98", "currency_code" => "USD"]]]]]], "tracking_number" => null, "tracking_numbers" => [], "tracking_url" => "http://www.packagetrackr.com/track/somecarrier/1234567", "tracking_urls" => ["http://www.packagetrackr.com/track/somecarrier/1234567"], "receipt" => [], "name" => "#1001.1", "admin_graphql_api_id" => "gid://shopify/Fulfillment/1069019877"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/orders/450789469/fulfillments.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["fulfillment" => ["location_id" => 655441491, "tracking_url" => "http://www.packagetrackr.com/track/somecarrier/1234567", "tracking_company" => "Jack Black's Pack, Stack and Track", "line_items" => [["id" => 518995019]]]]),
            ),
        ]);

        $fulfillment = new Fulfillment($this->test_session);
        $fulfillment->order_id = 450789469;
        $fulfillment->location_id = 655441491;
        $fulfillment->tracking_url = "http://www.packagetrackr.com/track/somecarrier/1234567";
        $fulfillment->tracking_company = "Jack Black's Pack, Stack and Track";
        $fulfillment->line_items = [
            [
                "id" => 518995019
            ]
        ];
        $fulfillment->save();
    }

    /**

     *
     * @return void
     */
    public function test_14(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["fulfillment" => ["id" => 1069019878, "order_id" => 450789469, "status" => "success", "created_at" => "2022-10-03T13:21:52-04:00", "service" => "manual", "updated_at" => "2022-10-03T13:21:53-04:00", "tracking_company" => null, "shipment_status" => null, "location_id" => 655441491, "origin_address" => null, "line_items" => [["id" => 518995019, "variant_id" => 49148385, "title" => "IPod Nano - 8gb", "quantity" => 1, "sku" => "IPOD2008RED", "variant_title" => "red", "vendor" => null, "fulfillment_service" => "manual", "product_id" => 632910392, "requires_shipping" => true, "taxable" => true, "gift_card" => false, "name" => "IPod Nano - 8gb - red", "variant_inventory_management" => "shopify", "properties" => [], "product_exists" => true, "fulfillable_quantity" => 0, "grams" => 200, "price" => "199.00", "total_discount" => "0.00", "fulfillment_status" => "fulfilled", "price_set" => ["shop_money" => ["amount" => "199.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "199.00", "currency_code" => "USD"]], "total_discount_set" => ["shop_money" => ["amount" => "0.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "0.00", "currency_code" => "USD"]], "discount_allocations" => [["amount" => "3.33", "discount_application_index" => 0, "amount_set" => ["shop_money" => ["amount" => "3.33", "currency_code" => "USD"], "presentment_money" => ["amount" => "3.33", "currency_code" => "USD"]]]], "duties" => [], "admin_graphql_api_id" => "gid://shopify/LineItem/518995019", "tax_lines" => [["title" => "State Tax", "price" => "3.98", "rate" => 0.06, "channel_liable" => null, "price_set" => ["shop_money" => ["amount" => "3.98", "currency_code" => "USD"], "presentment_money" => ["amount" => "3.98", "currency_code" => "USD"]]]]]], "tracking_number" => null, "tracking_numbers" => [], "tracking_url" => null, "tracking_urls" => [], "receipt" => [], "name" => "#1001.1", "admin_graphql_api_id" => "gid://shopify/Fulfillment/1069019878"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/orders/450789469/fulfillments.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["fulfillment" => ["location_id" => 655441491, "tracking_number" => null, "line_items" => [["id" => 518995019]]]]),
            ),
        ]);

        $fulfillment = new Fulfillment($this->test_session);
        $fulfillment->order_id = 450789469;
        $fulfillment->location_id = 655441491;
        $fulfillment->tracking_number = null;
        $fulfillment->line_items = [
            [
                "id" => 518995019
            ]
        ];
        $fulfillment->save();
    }

    /**

     *
     * @return void
     */
    public function test_15(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["fulfillment" => ["id" => 1069019879, "order_id" => 450789469, "status" => "success", "created_at" => "2022-10-03T13:21:57-04:00", "service" => "manual", "updated_at" => "2022-10-03T13:21:57-04:00", "tracking_company" => "Chinese Post", "shipment_status" => null, "location_id" => 655441491, "origin_address" => null, "line_items" => [["id" => 518995019, "variant_id" => 49148385, "title" => "IPod Nano - 8gb", "quantity" => 1, "sku" => "IPOD2008RED", "variant_title" => "red", "vendor" => null, "fulfillment_service" => "manual", "product_id" => 632910392, "requires_shipping" => true, "taxable" => true, "gift_card" => false, "name" => "IPod Nano - 8gb - red", "variant_inventory_management" => "shopify", "properties" => [], "product_exists" => true, "fulfillable_quantity" => 0, "grams" => 200, "price" => "199.00", "total_discount" => "0.00", "fulfillment_status" => "fulfilled", "price_set" => ["shop_money" => ["amount" => "199.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "199.00", "currency_code" => "USD"]], "total_discount_set" => ["shop_money" => ["amount" => "0.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "0.00", "currency_code" => "USD"]], "discount_allocations" => [["amount" => "3.33", "discount_application_index" => 0, "amount_set" => ["shop_money" => ["amount" => "3.33", "currency_code" => "USD"], "presentment_money" => ["amount" => "3.33", "currency_code" => "USD"]]]], "duties" => [], "admin_graphql_api_id" => "gid://shopify/LineItem/518995019", "tax_lines" => [["title" => "State Tax", "price" => "3.98", "rate" => 0.06, "channel_liable" => null, "price_set" => ["shop_money" => ["amount" => "3.98", "currency_code" => "USD"], "presentment_money" => ["amount" => "3.98", "currency_code" => "USD"]]]]]], "tracking_number" => "RR123456789CN", "tracking_numbers" => ["RR123456789CN"], "tracking_url" => "http://www.track-chinapost.com/result_china.php?order_no=RR123456789CN", "tracking_urls" => ["http://www.track-chinapost.com/result_china.php?order_no=RR123456789CN"], "receipt" => [], "name" => "#1001.1", "admin_graphql_api_id" => "gid://shopify/Fulfillment/1069019879"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/orders/450789469/fulfillments.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["fulfillment" => ["location_id" => 655441491, "tracking_number" => "RR123456789CN", "tracking_company" => "Chinese Post", "line_items" => [["id" => 518995019]]]]),
            ),
        ]);

        $fulfillment = new Fulfillment($this->test_session);
        $fulfillment->order_id = 450789469;
        $fulfillment->location_id = 655441491;
        $fulfillment->tracking_number = "RR123456789CN";
        $fulfillment->tracking_company = "Chinese Post";
        $fulfillment->line_items = [
            [
                "id" => 518995019
            ]
        ];
        $fulfillment->save();
    }

    /**

     *
     * @return void
     */
    public function test_16(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["fulfillment" => ["id" => 1069019880, "order_id" => 450789469, "status" => "success", "created_at" => "2022-10-03T13:21:59-04:00", "service" => "manual", "updated_at" => "2022-10-03T13:21:59-04:00", "tracking_company" => "fed ex", "shipment_status" => null, "location_id" => 655441491, "origin_address" => null, "line_items" => [["id" => 518995019, "variant_id" => 49148385, "title" => "IPod Nano - 8gb", "quantity" => 1, "sku" => "IPOD2008RED", "variant_title" => "red", "vendor" => null, "fulfillment_service" => "manual", "product_id" => 632910392, "requires_shipping" => true, "taxable" => true, "gift_card" => false, "name" => "IPod Nano - 8gb - red", "variant_inventory_management" => "shopify", "properties" => [], "product_exists" => true, "fulfillable_quantity" => 0, "grams" => 200, "price" => "199.00", "total_discount" => "0.00", "fulfillment_status" => "fulfilled", "price_set" => ["shop_money" => ["amount" => "199.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "199.00", "currency_code" => "USD"]], "total_discount_set" => ["shop_money" => ["amount" => "0.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "0.00", "currency_code" => "USD"]], "discount_allocations" => [["amount" => "3.33", "discount_application_index" => 0, "amount_set" => ["shop_money" => ["amount" => "3.33", "currency_code" => "USD"], "presentment_money" => ["amount" => "3.33", "currency_code" => "USD"]]]], "duties" => [], "admin_graphql_api_id" => "gid://shopify/LineItem/518995019", "tax_lines" => [["title" => "State Tax", "price" => "3.98", "rate" => 0.06, "channel_liable" => null, "price_set" => ["shop_money" => ["amount" => "3.98", "currency_code" => "USD"], "presentment_money" => ["amount" => "3.98", "currency_code" => "USD"]]]]]], "tracking_number" => "123456789010", "tracking_numbers" => ["123456789010"], "tracking_url" => "https://www.fedex.com/fedextrack/?trknbr=123456789010", "tracking_urls" => ["https://www.fedex.com/fedextrack/?trknbr=123456789010"], "receipt" => [], "name" => "#1001.1", "admin_graphql_api_id" => "gid://shopify/Fulfillment/1069019880"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/orders/450789469/fulfillments.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["fulfillment" => ["location_id" => 655441491, "tracking_number" => "123456789010", "tracking_company" => "fed ex", "line_items" => [["id" => 518995019]]]]),
            ),
        ]);

        $fulfillment = new Fulfillment($this->test_session);
        $fulfillment->order_id = 450789469;
        $fulfillment->location_id = 655441491;
        $fulfillment->tracking_number = "123456789010";
        $fulfillment->tracking_company = "fed ex";
        $fulfillment->line_items = [
            [
                "id" => 518995019
            ]
        ];
        $fulfillment->save();
    }

    /**

     *
     * @return void
     */
    public function test_17(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["fulfillment" => ["id" => 1069019883, "order_id" => 450789469, "status" => "success", "created_at" => "2022-10-03T13:22:03-04:00", "service" => "manual", "updated_at" => "2022-10-03T13:22:03-04:00", "tracking_company" => "4PX", "shipment_status" => null, "location_id" => 655441491, "origin_address" => null, "line_items" => [["id" => 518995019, "variant_id" => 49148385, "title" => "IPod Nano - 8gb", "quantity" => 1, "sku" => "IPOD2008RED", "variant_title" => "red", "vendor" => null, "fulfillment_service" => "manual", "product_id" => 632910392, "requires_shipping" => true, "taxable" => true, "gift_card" => false, "name" => "IPod Nano - 8gb - red", "variant_inventory_management" => "shopify", "properties" => [], "product_exists" => true, "fulfillable_quantity" => 0, "grams" => 200, "price" => "199.00", "total_discount" => "0.00", "fulfillment_status" => "fulfilled", "price_set" => ["shop_money" => ["amount" => "199.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "199.00", "currency_code" => "USD"]], "total_discount_set" => ["shop_money" => ["amount" => "0.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "0.00", "currency_code" => "USD"]], "discount_allocations" => [["amount" => "3.33", "discount_application_index" => 0, "amount_set" => ["shop_money" => ["amount" => "3.33", "currency_code" => "USD"], "presentment_money" => ["amount" => "3.33", "currency_code" => "USD"]]]], "duties" => [], "admin_graphql_api_id" => "gid://shopify/LineItem/518995019", "tax_lines" => [["title" => "State Tax", "price" => "3.98", "rate" => 0.06, "channel_liable" => null, "price_set" => ["shop_money" => ["amount" => "3.98", "currency_code" => "USD"], "presentment_money" => ["amount" => "3.98", "currency_code" => "USD"]]]]]], "tracking_number" => "123456789", "tracking_numbers" => ["123456789"], "tracking_url" => "http://track.4px.com", "tracking_urls" => ["http://track.4px.com"], "receipt" => [], "name" => "#1001.1", "admin_graphql_api_id" => "gid://shopify/Fulfillment/1069019883"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/orders/450789469/fulfillments.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["fulfillment" => ["location_id" => 655441491, "tracking_number" => "123456789", "tracking_company" => "4PX", "line_items" => [["id" => 518995019]]]]),
            ),
        ]);

        $fulfillment = new Fulfillment($this->test_session);
        $fulfillment->order_id = 450789469;
        $fulfillment->location_id = 655441491;
        $fulfillment->tracking_number = "123456789";
        $fulfillment->tracking_company = "4PX";
        $fulfillment->line_items = [
            [
                "id" => 518995019
            ]
        ];
        $fulfillment->save();
    }

    /**

     *
     * @return void
     */
    public function test_18(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["fulfillment" => ["id" => 1069019884, "order_id" => 450789469, "status" => "success", "created_at" => "2022-10-03T13:22:05-04:00", "service" => "manual", "updated_at" => "2022-10-03T13:22:05-04:00", "tracking_company" => "TNT", "shipment_status" => null, "location_id" => 487838322, "origin_address" => null, "line_items" => [["id" => 466157049, "variant_id" => 39072856, "title" => "IPod Nano - 8gb", "quantity" => 1, "sku" => "IPOD2008GREEN", "variant_title" => "green", "vendor" => null, "fulfillment_service" => "manual", "product_id" => 632910392, "requires_shipping" => true, "taxable" => true, "gift_card" => false, "name" => "IPod Nano - 8gb - green", "variant_inventory_management" => "shopify", "properties" => [["name" => "Custom Engraving Front", "value" => "Happy Birthday"], ["name" => "Custom Engraving Back", "value" => "Merry Christmas"]], "product_exists" => true, "fulfillable_quantity" => 0, "grams" => 200, "price" => "199.00", "total_discount" => "0.00", "fulfillment_status" => "fulfilled", "price_set" => ["shop_money" => ["amount" => "199.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "199.00", "currency_code" => "USD"]], "total_discount_set" => ["shop_money" => ["amount" => "0.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "0.00", "currency_code" => "USD"]], "discount_allocations" => [["amount" => "3.34", "discount_application_index" => 0, "amount_set" => ["shop_money" => ["amount" => "3.34", "currency_code" => "USD"], "presentment_money" => ["amount" => "3.34", "currency_code" => "USD"]]]], "duties" => [], "admin_graphql_api_id" => "gid://shopify/LineItem/466157049", "tax_lines" => [["title" => "State Tax", "price" => "3.98", "rate" => 0.06, "channel_liable" => null, "price_set" => ["shop_money" => ["amount" => "3.98", "currency_code" => "USD"], "presentment_money" => ["amount" => "3.98", "currency_code" => "USD"]]]]], ["id" => 518995019, "variant_id" => 49148385, "title" => "IPod Nano - 8gb", "quantity" => 1, "sku" => "IPOD2008RED", "variant_title" => "red", "vendor" => null, "fulfillment_service" => "manual", "product_id" => 632910392, "requires_shipping" => true, "taxable" => true, "gift_card" => false, "name" => "IPod Nano - 8gb - red", "variant_inventory_management" => "shopify", "properties" => [], "product_exists" => true, "fulfillable_quantity" => 0, "grams" => 200, "price" => "199.00", "total_discount" => "0.00", "fulfillment_status" => "fulfilled", "price_set" => ["shop_money" => ["amount" => "199.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "199.00", "currency_code" => "USD"]], "total_discount_set" => ["shop_money" => ["amount" => "0.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "0.00", "currency_code" => "USD"]], "discount_allocations" => [["amount" => "3.33", "discount_application_index" => 0, "amount_set" => ["shop_money" => ["amount" => "3.33", "currency_code" => "USD"], "presentment_money" => ["amount" => "3.33", "currency_code" => "USD"]]]], "duties" => [], "admin_graphql_api_id" => "gid://shopify/LineItem/518995019", "tax_lines" => [["title" => "State Tax", "price" => "3.98", "rate" => 0.06, "channel_liable" => null, "price_set" => ["shop_money" => ["amount" => "3.98", "currency_code" => "USD"], "presentment_money" => ["amount" => "3.98", "currency_code" => "USD"]]]]], ["id" => 703073504, "variant_id" => 457924702, "title" => "IPod Nano - 8gb", "quantity" => 1, "sku" => "IPOD2008BLACK", "variant_title" => "black", "vendor" => null, "fulfillment_service" => "manual", "product_id" => 632910392, "requires_shipping" => true, "taxable" => true, "gift_card" => false, "name" => "IPod Nano - 8gb - black", "variant_inventory_management" => "shopify", "properties" => [], "product_exists" => true, "fulfillable_quantity" => 0, "grams" => 200, "price" => "199.00", "total_discount" => "0.00", "fulfillment_status" => "fulfilled", "price_set" => ["shop_money" => ["amount" => "199.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "199.00", "currency_code" => "USD"]], "total_discount_set" => ["shop_money" => ["amount" => "0.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "0.00", "currency_code" => "USD"]], "discount_allocations" => [["amount" => "3.33", "discount_application_index" => 0, "amount_set" => ["shop_money" => ["amount" => "3.33", "currency_code" => "USD"], "presentment_money" => ["amount" => "3.33", "currency_code" => "USD"]]]], "duties" => [], "admin_graphql_api_id" => "gid://shopify/LineItem/703073504", "tax_lines" => [["title" => "State Tax", "price" => "3.98", "rate" => 0.06, "channel_liable" => null, "price_set" => ["shop_money" => ["amount" => "3.98", "currency_code" => "USD"], "presentment_money" => ["amount" => "3.98", "currency_code" => "USD"]]]]]], "tracking_number" => "123456789", "tracking_numbers" => ["123456789"], "tracking_url" => "https://shipping.xyz/track.php?num=123456789", "tracking_urls" => ["https://shipping.xyz/track.php?num=123456789", "https://anothershipper.corp/track.php?code=abc"], "receipt" => [], "name" => "#1001.1", "admin_graphql_api_id" => "gid://shopify/Fulfillment/1069019884"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/orders/450789469/fulfillments.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["fulfillment" => ["location_id" => 487838322, "tracking_number" => "123456789", "tracking_urls" => ["https://shipping.xyz/track.php?num=123456789", "https://anothershipper.corp/track.php?code=abc"], "notify_customer" => true]]),
            ),
        ]);

        $fulfillment = new Fulfillment($this->test_session);
        $fulfillment->order_id = 450789469;
        $fulfillment->location_id = 487838322;
        $fulfillment->tracking_number = "123456789";
        $fulfillment->tracking_urls = [
            "https://shipping.xyz/track.php?num=123456789",
            "https://anothershipper.corp/track.php?code=abc"
        ];
        $fulfillment->notify_customer = true;
        $fulfillment->save();
    }

    /**

     *
     * @return void
     */
    public function test_19(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["fulfillment" => ["id" => 1069019870, "order_id" => 450789469, "status" => "success", "created_at" => "2022-10-03T13:21:15-04:00", "service" => "manual", "updated_at" => "2022-10-03T13:21:15-04:00", "tracking_company" => "my-shipping-company", "shipment_status" => null, "location_id" => 24826418, "line_items" => [["id" => 1071823189, "variant_id" => 389013007, "title" => "Crafty Shoes - Red", "quantity" => 1, "sku" => "crappy_shoes_red", "variant_title" => "Small", "vendor" => null, "fulfillment_service" => "manual", "product_id" => 910489600, "requires_shipping" => true, "taxable" => true, "gift_card" => false, "name" => "Crafty Shoes - Red - Small", "variant_inventory_management" => null, "properties" => [], "product_exists" => true, "fulfillable_quantity" => 0, "grams" => 0, "price" => "10.00", "total_discount" => "0.00", "fulfillment_status" => "fulfilled", "price_set" => ["shop_money" => ["amount" => "10.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "10.00", "currency_code" => "USD"]], "total_discount_set" => ["shop_money" => ["amount" => "0.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "0.00", "currency_code" => "USD"]], "discount_allocations" => [], "duties" => [], "admin_graphql_api_id" => "gid://shopify/LineItem/1071823189", "tax_lines" => []]], "tracking_number" => "1562678", "tracking_numbers" => ["1562678"], "tracking_url" => "https://www.my-shipping-company.com", "tracking_urls" => ["https://www.my-shipping-company.com"], "receipt" => [], "name" => "#1001.2", "admin_graphql_api_id" => "gid://shopify/Fulfillment/1069019870"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/fulfillments.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["fulfillment" => ["message" => "The package was shipped this morning.", "notify_customer" => false, "tracking_info" => ["number" => 1562678, "url" => "https://www.my-shipping-company.com", "company" => "my-shipping-company"], "line_items_by_fulfillment_order" => [["fulfillment_order_id" => 1046000811]]]]),
            ),
        ]);

        $fulfillment = new Fulfillment($this->test_session);
        $fulfillment->message = "The package was shipped this morning.";
        $fulfillment->notify_customer = false;
        $fulfillment->tracking_info = [
            "number" => 1562678,
            "url" => "https://www.my-shipping-company.com",
            "company" => "my-shipping-company"
        ];
        $fulfillment->line_items_by_fulfillment_order = [
            [
                "fulfillment_order_id" => 1046000811
            ]
        ];
        $fulfillment->save();
    }

    /**

     *
     * @return void
     */
    public function test_20(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["fulfillment" => ["id" => 1069019882, "order_id" => 450789469, "status" => "success", "created_at" => "2022-10-03T13:22:01-04:00", "service" => "manual", "updated_at" => "2022-10-03T13:22:01-04:00", "tracking_company" => "my-shipping-company", "shipment_status" => null, "location_id" => 24826418, "line_items" => [["id" => 1071823197, "variant_id" => 389013007, "title" => "Crafty Shoes - Red", "quantity" => 1, "sku" => "crappy_shoes_red", "variant_title" => "Small", "vendor" => null, "fulfillment_service" => "manual", "product_id" => 910489600, "requires_shipping" => true, "taxable" => true, "gift_card" => false, "name" => "Crafty Shoes - Red - Small", "variant_inventory_management" => null, "properties" => [], "product_exists" => true, "fulfillable_quantity" => 0, "grams" => 0, "price" => "10.00", "total_discount" => "0.00", "fulfillment_status" => "fulfilled", "price_set" => ["shop_money" => ["amount" => "10.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "10.00", "currency_code" => "USD"]], "total_discount_set" => ["shop_money" => ["amount" => "0.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "0.00", "currency_code" => "USD"]], "discount_allocations" => [], "duties" => [], "admin_graphql_api_id" => "gid://shopify/LineItem/1071823197", "tax_lines" => []]], "tracking_number" => "1562678", "tracking_numbers" => ["1562678"], "tracking_url" => "https://www.my-shipping-company.com", "tracking_urls" => ["https://www.my-shipping-company.com"], "receipt" => [], "name" => "#1001.2", "admin_graphql_api_id" => "gid://shopify/Fulfillment/1069019882"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/fulfillments.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["fulfillment" => ["message" => "The package was shipped this morning.", "notify_customer" => false, "tracking_info" => ["number" => 1562678, "url" => "https://www.my-shipping-company.com", "company" => "my-shipping-company"], "line_items_by_fulfillment_order" => [["fulfillment_order_id" => 1046000827, "fulfillment_order_line_items" => [["id" => 1058737562, "quantity" => 1]]]]]]),
            ),
        ]);

        $fulfillment = new Fulfillment($this->test_session);
        $fulfillment->message = "The package was shipped this morning.";
        $fulfillment->notify_customer = false;
        $fulfillment->tracking_info = [
            "number" => 1562678,
            "url" => "https://www.my-shipping-company.com",
            "company" => "my-shipping-company"
        ];
        $fulfillment->line_items_by_fulfillment_order = [
            [
                "fulfillment_order_id" => 1046000827,
                "fulfillment_order_line_items" => [
                    [
                        "id" => 1058737562,
                        "quantity" => 1
                    ]
                ]
            ]
        ];
        $fulfillment->save();
    }

    /**

     *
     * @return void
     */
    public function test_21(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["fulfillment" => ["tracking_company" => "my-company", "location_id" => 24826418, "id" => 1069019871, "order_id" => 450789469, "status" => "success", "created_at" => "2022-10-03T13:07:13-04:00", "service" => "manual", "updated_at" => "2022-10-03T13:21:19-04:00", "shipment_status" => null, "line_items" => [["id" => 1071823190, "variant_id" => 43729076, "title" => "Draft", "quantity" => 1, "sku" => "draft-151", "variant_title" => "151cm", "vendor" => null, "fulfillment_service" => "manual", "product_id" => 108828309, "requires_shipping" => true, "taxable" => true, "gift_card" => false, "name" => "Draft - 151cm", "variant_inventory_management" => null, "properties" => [], "product_exists" => true, "fulfillable_quantity" => 1, "grams" => 0, "price" => "10.00", "total_discount" => "0.00", "fulfillment_status" => "fulfilled", "price_set" => ["shop_money" => ["amount" => "10.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "10.00", "currency_code" => "USD"]], "total_discount_set" => ["shop_money" => ["amount" => "0.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "0.00", "currency_code" => "USD"]], "discount_allocations" => [], "duties" => [], "admin_graphql_api_id" => "gid://shopify/LineItem/1071823190", "tax_lines" => []]], "tracking_number" => "1111", "tracking_numbers" => ["1111"], "tracking_url" => "http://www.my-url.com", "tracking_urls" => ["http://www.my-url.com"], "receipt" => [], "name" => "#1001.1", "admin_graphql_api_id" => "gid://shopify/Fulfillment/1069019871"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/fulfillments/1069019871/update_tracking.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["fulfillment" => ["notify_customer" => true, "tracking_info" => ["number" => "1111", "url" => "http://www.my-url.com", "company" => "my-company"]]]),
            ),
        ]);

        $fulfillment = new Fulfillment($this->test_session);
        $fulfillment->id = 1069019871;
        $fulfillment->update_tracking(
            [],
            ["fulfillment" => ["notify_customer" => true, "tracking_info" => ["number" => "1111", "url" => "http://www.my-url.com", "company" => "my-company"]]],
        );
    }

    /**

     *
     * @return void
     */
    public function test_22(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["fulfillment" => ["status" => "success", "location_id" => 655441491, "id" => 255858046, "order_id" => 450789469, "created_at" => "2022-10-03T13:07:13-04:00", "service" => "manual", "updated_at" => "2022-10-03T13:21:40-04:00", "tracking_company" => "USPS", "shipment_status" => null, "origin_address" => null, "line_items" => [["id" => 466157049, "variant_id" => 39072856, "title" => "IPod Nano - 8gb", "quantity" => 1, "sku" => "IPOD2008GREEN", "variant_title" => "green", "vendor" => null, "fulfillment_service" => "manual", "product_id" => 632910392, "requires_shipping" => true, "taxable" => true, "gift_card" => false, "name" => "IPod Nano - 8gb - green", "variant_inventory_management" => "shopify", "properties" => [["name" => "Custom Engraving Front", "value" => "Happy Birthday"], ["name" => "Custom Engraving Back", "value" => "Merry Christmas"]], "product_exists" => true, "fulfillable_quantity" => 0, "grams" => 200, "price" => "199.00", "total_discount" => "0.00", "fulfillment_status" => null, "price_set" => ["shop_money" => ["amount" => "199.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "199.00", "currency_code" => "USD"]], "total_discount_set" => ["shop_money" => ["amount" => "0.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "0.00", "currency_code" => "USD"]], "discount_allocations" => [["amount" => "3.34", "discount_application_index" => 0, "amount_set" => ["shop_money" => ["amount" => "3.34", "currency_code" => "USD"], "presentment_money" => ["amount" => "3.34", "currency_code" => "USD"]]]], "duties" => [], "admin_graphql_api_id" => "gid://shopify/LineItem/466157049", "tax_lines" => [["title" => "State Tax", "price" => "3.98", "rate" => 0.06, "channel_liable" => null, "price_set" => ["shop_money" => ["amount" => "3.98", "currency_code" => "USD"], "presentment_money" => ["amount" => "3.98", "currency_code" => "USD"]]]]]], "tracking_number" => "1Z2345", "tracking_numbers" => ["1Z2345"], "tracking_url" => "https://tools.usps.com/go/TrackConfirmAction_input?qtc_tLabels1=1Z2345", "tracking_urls" => ["https://tools.usps.com/go/TrackConfirmAction_input?qtc_tLabels1=1Z2345"], "receipt" => ["testcase" => true, "authorization" => "123456"], "name" => "#1001.0", "admin_graphql_api_id" => "gid://shopify/Fulfillment/255858046"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/orders/450789469/fulfillments/255858046/complete.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        $fulfillment = new Fulfillment($this->test_session);
        $fulfillment->order_id = 450789469;
        $fulfillment->id = 255858046;
        $fulfillment->complete(
            [],
        );
    }

    /**

     *
     * @return void
     */
    public function test_23(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["fulfillment" => ["status" => "open", "location_id" => 655441491, "id" => 255858046, "order_id" => 450789469, "created_at" => "2022-10-03T13:07:13-04:00", "service" => "manual", "updated_at" => "2022-10-03T13:21:45-04:00", "tracking_company" => "USPS", "shipment_status" => null, "origin_address" => null, "line_items" => [["id" => 466157049, "variant_id" => 39072856, "title" => "IPod Nano - 8gb", "quantity" => 1, "sku" => "IPOD2008GREEN", "variant_title" => "green", "vendor" => null, "fulfillment_service" => "manual", "product_id" => 632910392, "requires_shipping" => true, "taxable" => true, "gift_card" => false, "name" => "IPod Nano - 8gb - green", "variant_inventory_management" => "shopify", "properties" => [["name" => "Custom Engraving Front", "value" => "Happy Birthday"], ["name" => "Custom Engraving Back", "value" => "Merry Christmas"]], "product_exists" => true, "fulfillable_quantity" => 0, "grams" => 200, "price" => "199.00", "total_discount" => "0.00", "fulfillment_status" => null, "price_set" => ["shop_money" => ["amount" => "199.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "199.00", "currency_code" => "USD"]], "total_discount_set" => ["shop_money" => ["amount" => "0.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "0.00", "currency_code" => "USD"]], "discount_allocations" => [["amount" => "3.34", "discount_application_index" => 0, "amount_set" => ["shop_money" => ["amount" => "3.34", "currency_code" => "USD"], "presentment_money" => ["amount" => "3.34", "currency_code" => "USD"]]]], "duties" => [], "admin_graphql_api_id" => "gid://shopify/LineItem/466157049", "tax_lines" => [["title" => "State Tax", "price" => "3.98", "rate" => 0.06, "channel_liable" => null, "price_set" => ["shop_money" => ["amount" => "3.98", "currency_code" => "USD"], "presentment_money" => ["amount" => "3.98", "currency_code" => "USD"]]]]]], "tracking_number" => "1Z2345", "tracking_numbers" => ["1Z2345"], "tracking_url" => "https://tools.usps.com/go/TrackConfirmAction_input?qtc_tLabels1=1Z2345", "tracking_urls" => ["https://tools.usps.com/go/TrackConfirmAction_input?qtc_tLabels1=1Z2345"], "receipt" => ["testcase" => true, "authorization" => "123456"], "name" => "#1001.0", "admin_graphql_api_id" => "gid://shopify/Fulfillment/255858046"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/orders/450789469/fulfillments/255858046/open.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        $fulfillment = new Fulfillment($this->test_session);
        $fulfillment->order_id = 450789469;
        $fulfillment->id = 255858046;
        $fulfillment->open(
            [],
        );
    }

    /**

     *
     * @return void
     */
    public function test_24(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["fulfillment" => ["order_id" => 450789469, "status" => "cancelled", "location_id" => 655441491, "id" => 255858046, "created_at" => "2022-10-03T13:07:13-04:00", "service" => "manual", "updated_at" => "2022-10-03T13:21:17-04:00", "tracking_company" => "USPS", "shipment_status" => null, "line_items" => [["id" => 466157049, "variant_id" => 39072856, "title" => "IPod Nano - 8gb", "quantity" => 1, "sku" => "IPOD2008GREEN", "variant_title" => "green", "vendor" => null, "fulfillment_service" => "manual", "product_id" => 632910392, "requires_shipping" => true, "taxable" => true, "gift_card" => false, "name" => "IPod Nano - 8gb - green", "variant_inventory_management" => "shopify", "properties" => [["name" => "Custom Engraving Front", "value" => "Happy Birthday"], ["name" => "Custom Engraving Back", "value" => "Merry Christmas"]], "product_exists" => true, "fulfillable_quantity" => 0, "grams" => 200, "price" => "199.00", "total_discount" => "0.00", "fulfillment_status" => null, "price_set" => ["shop_money" => ["amount" => "199.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "199.00", "currency_code" => "USD"]], "total_discount_set" => ["shop_money" => ["amount" => "0.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "0.00", "currency_code" => "USD"]], "discount_allocations" => [["amount" => "3.34", "discount_application_index" => 0, "amount_set" => ["shop_money" => ["amount" => "3.34", "currency_code" => "USD"], "presentment_money" => ["amount" => "3.34", "currency_code" => "USD"]]]], "duties" => [], "admin_graphql_api_id" => "gid://shopify/LineItem/466157049", "tax_lines" => [["title" => "State Tax", "price" => "3.98", "rate" => 0.06, "price_set" => ["shop_money" => ["amount" => "3.98", "currency_code" => "USD"], "presentment_money" => ["amount" => "3.98", "currency_code" => "USD"]]]]]], "tracking_number" => "1Z2345", "tracking_numbers" => ["1Z2345"], "tracking_url" => "https://tools.usps.com/go/TrackConfirmAction_input?qtc_tLabels1=1Z2345", "tracking_urls" => ["https://tools.usps.com/go/TrackConfirmAction_input?qtc_tLabels1=1Z2345"], "receipt" => ["testcase" => true, "authorization" => "123456"], "name" => "#1001.0", "admin_graphql_api_id" => "gid://shopify/Fulfillment/255858046"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/orders/450789469/fulfillments/255858046/cancel.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        $fulfillment = new Fulfillment($this->test_session);
        $fulfillment->order_id = 450789469;
        $fulfillment->id = 255858046;
        $fulfillment->cancel(
            [],
        );
    }

    /**

     *
     * @return void
     */
    public function test_25(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["fulfillment" => ["order_id" => 450789469, "status" => "cancelled", "location_id" => 24826418, "id" => 1069019872, "created_at" => "2022-10-03T13:07:13-04:00", "service" => "manual", "updated_at" => "2022-10-03T13:21:23-04:00", "tracking_company" => "UPS", "shipment_status" => null, "line_items" => [["id" => 1071823192, "variant_id" => 43729076, "title" => "Draft", "quantity" => 1, "sku" => "draft-151", "variant_title" => "151cm", "vendor" => null, "fulfillment_service" => "manual", "product_id" => 108828309, "requires_shipping" => true, "taxable" => true, "gift_card" => false, "name" => "Draft - 151cm", "variant_inventory_management" => null, "properties" => [], "product_exists" => true, "fulfillable_quantity" => 1, "grams" => 0, "price" => "10.00", "total_discount" => "0.00", "fulfillment_status" => "fulfilled", "price_set" => ["shop_money" => ["amount" => "10.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "10.00", "currency_code" => "USD"]], "total_discount_set" => ["shop_money" => ["amount" => "0.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "0.00", "currency_code" => "USD"]], "discount_allocations" => [], "duties" => [], "admin_graphql_api_id" => "gid://shopify/LineItem/1071823192", "tax_lines" => []]], "tracking_number" => "#\u26201\u2622\n---\n4321\n", "tracking_numbers" => ["#\u26201\u2622\n---\n4321\n"], "tracking_url" => "https://www.ups.com/WebTracking?loc=en_US&requester=ST&trackNums=#\u26201\u2622---4321", "tracking_urls" => ["https://www.ups.com/WebTracking?loc=en_US&requester=ST&trackNums=#\u26201\u2622---4321"], "receipt" => [], "name" => "#1001.1", "admin_graphql_api_id" => "gid://shopify/Fulfillment/1069019872"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/fulfillments/1069019872/cancel.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        $fulfillment = new Fulfillment($this->test_session);
        $fulfillment->id = 1069019872;
        $fulfillment->cancel(
            [],
        );
    }

}
