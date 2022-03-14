<?php

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\FulfillmentOrder;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class FulfillmentOrder202110Test extends BaseTestCase
{
    /** @var Session */
    private $test_session;

    public function setUp(): void
    {
        parent::setUp();

        Context::$API_VERSION = "2021-10";

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
                  ["fulfillment_orders" => [["id" => 1046000846, "shop_id" => 548380009, "order_id" => 450789469, "assigned_location_id" => 24826418, "request_status" => "submitted", "status" => "open", "supported_actions" => ["cancel_fulfillment_order"], "destination" => ["id" => 1046000833, "address1" => "Chestnut Street 92", "address2" => "", "city" => "Louisville", "company" => null, "country" => "United States", "email" => "bob.norman@hostmail.com", "first_name" => "Bob", "last_name" => "Norman", "phone" => "555-625-1199", "province" => "Kentucky", "zip" => "40202"], "line_items" => [["id" => 1058737593, "shop_id" => 548380009, "fulfillment_order_id" => 1046000846, "quantity" => 1, "line_item_id" => 518995019, "inventory_item_id" => 49148385, "fulfillable_quantity" => 1, "variant_id" => 49148385]], "fulfillment_service_handle" => "mars-fulfillment", "assigned_location" => ["address1" => null, "address2" => null, "city" => null, "country_code" => "DE", "location_id" => 24826418, "name" => "Apple Api Shipwire", "phone" => null, "province" => null, "zip" => null], "merchant_requests" => []]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-10/orders/450789469/fulfillment_orders.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        FulfillmentOrder::all(
            $this->test_session,
            ["order_id" => "450789469"],
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
                  ["fulfillment_order" => ["id" => 1046000847, "shop_id" => 548380009, "order_id" => 450789469, "assigned_location_id" => 24826418, "request_status" => "submitted", "status" => "open", "supported_actions" => ["cancel_fulfillment_order"], "destination" => ["id" => 1046000834, "address1" => "Chestnut Street 92", "address2" => "", "city" => "Louisville", "company" => null, "country" => "United States", "email" => "bob.norman@hostmail.com", "first_name" => "Bob", "last_name" => "Norman", "phone" => "555-625-1199", "province" => "Kentucky", "zip" => "40202"], "line_items" => [["id" => 1058737594, "shop_id" => 548380009, "fulfillment_order_id" => 1046000847, "quantity" => 1, "line_item_id" => 518995019, "inventory_item_id" => 49148385, "fulfillable_quantity" => 1, "variant_id" => 49148385]], "fulfillment_service_handle" => "mars-fulfillment", "assigned_location" => ["address1" => null, "address2" => null, "city" => null, "country_code" => "DE", "location_id" => 24826418, "name" => "Apple Api Shipwire", "phone" => null, "province" => null, "zip" => null], "merchant_requests" => []]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-10/fulfillment_orders/1046000847.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        FulfillmentOrder::find(
            $this->test_session,
            1046000847,
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
                  ["fulfillment_order" => ["id" => 1046000848, "shop_id" => 548380009, "order_id" => 450789469, "assigned_location_id" => 24826418, "request_status" => "submitted", "status" => "closed", "supported_actions" => [], "destination" => ["id" => 1046000835, "address1" => "Chestnut Street 92", "address2" => "", "city" => "Louisville", "company" => null, "country" => "United States", "email" => "bob.norman@hostmail.com", "first_name" => "Bob", "last_name" => "Norman", "phone" => "555-625-1199", "province" => "Kentucky", "zip" => "40202"], "line_items" => [["id" => 1058737595, "shop_id" => 548380009, "fulfillment_order_id" => 1046000848, "quantity" => 1, "line_item_id" => 518995019, "inventory_item_id" => 49148385, "fulfillable_quantity" => 1, "variant_id" => 49148385]], "fulfillment_service_handle" => "mars-fulfillment", "assigned_location" => ["address1" => null, "address2" => null, "city" => null, "country_code" => "DE", "location_id" => 24826418, "name" => "Apple Api Shipwire", "phone" => null, "province" => null, "zip" => null], "merchant_requests" => []], "replacement_fulfillment_order" => ["id" => 1046000849, "shop_id" => 548380009, "order_id" => 450789469, "assigned_location_id" => 24826418, "request_status" => "unsubmitted", "status" => "open", "supported_actions" => ["request_fulfillment", "create_fulfillment"], "destination" => ["id" => 1046000836, "address1" => "Chestnut Street 92", "address2" => "", "city" => "Louisville", "company" => null, "country" => "United States", "email" => "bob.norman@hostmail.com", "first_name" => "Bob", "last_name" => "Norman", "phone" => "555-625-1199", "province" => "Kentucky", "zip" => "40202"], "line_items" => [["id" => 1058737596, "shop_id" => 548380009, "fulfillment_order_id" => 1046000849, "quantity" => 1, "line_item_id" => 518995019, "inventory_item_id" => 49148385, "fulfillable_quantity" => 1, "variant_id" => 49148385]], "fulfillment_service_handle" => "mars-fulfillment", "assigned_location" => ["address1" => null, "address2" => null, "city" => null, "country_code" => "DE", "location_id" => 24826418, "name" => "Apple Api Shipwire", "phone" => null, "province" => null, "zip" => null], "merchant_requests" => []]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-10/fulfillment_orders/1046000848/cancel.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        $fulfillment_order = new FulfillmentOrder($this->test_session);
        $fulfillment_order->id = 1046000848;
        $fulfillment_order->cancel(
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
                  ["fulfillment_order" => ["id" => 1046000851, "shop_id" => 548380009, "order_id" => 450789469, "assigned_location_id" => 24826418, "request_status" => "closed", "status" => "incomplete", "supported_actions" => ["request_fulfillment", "create_fulfillment"], "destination" => ["id" => 1046000838, "address1" => "Chestnut Street 92", "address2" => "", "city" => "Louisville", "company" => null, "country" => "United States", "email" => "bob.norman@hostmail.com", "first_name" => "Bob", "last_name" => "Norman", "phone" => "555-625-1199", "province" => "Kentucky", "zip" => "40202"], "line_items" => [["id" => 1058737598, "shop_id" => 548380009, "fulfillment_order_id" => 1046000851, "quantity" => 1, "line_item_id" => 518995019, "inventory_item_id" => 49148385, "fulfillable_quantity" => 1, "variant_id" => 49148385]], "fulfillment_service_handle" => "mars-fulfillment", "assigned_location" => ["address1" => null, "address2" => null, "city" => null, "country_code" => "DE", "location_id" => 24826418, "name" => "Apple Api Shipwire", "phone" => null, "province" => null, "zip" => null], "merchant_requests" => []]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-10/fulfillment_orders/1046000851/close.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["fulfillment_order" => ["message" => "Not enough inventory to complete this work."]]),
            ),
        ]);

        $fulfillment_order = new FulfillmentOrder($this->test_session);
        $fulfillment_order->id = 1046000851;
        $fulfillment_order->close(
            [],
            ["fulfillment_order" => ["message" => "Not enough inventory to complete this work."]],
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
                  ["original_fulfillment_order" => ["id" => 1046000852, "shop_id" => 548380009, "order_id" => 450789469, "assigned_location_id" => 487838322, "request_status" => "submitted", "status" => "closed", "supported_actions" => [], "destination" => ["id" => 1046000839, "address1" => "Chestnut Street 92", "address2" => "", "city" => "Louisville", "company" => null, "country" => "United States", "email" => "bob.norman@hostmail.com", "first_name" => "Bob", "last_name" => "Norman", "phone" => "555-625-1199", "province" => "Kentucky", "zip" => "40202"], "line_items" => [["id" => 1058737599, "shop_id" => 548380009, "fulfillment_order_id" => 1046000852, "quantity" => 1, "line_item_id" => 518995019, "inventory_item_id" => 49148385, "fulfillable_quantity" => 1, "variant_id" => 49148385]], "fulfillment_service_handle" => "manual", "assigned_location" => ["address1" => null, "address2" => null, "city" => null, "country_code" => "DE", "location_id" => 24826418, "name" => "Apple Api Shipwire", "phone" => null, "province" => null, "zip" => null], "merchant_requests" => []], "moved_fulfillment_order" => ["id" => 1046000853, "shop_id" => 548380009, "order_id" => 450789469, "assigned_location_id" => 655441491, "request_status" => "unsubmitted", "status" => "open", "supported_actions" => ["create_fulfillment", "move"], "destination" => ["id" => 1046000840, "address1" => "Chestnut Street 92", "address2" => "", "city" => "Louisville", "company" => null, "country" => "United States", "email" => "bob.norman@hostmail.com", "first_name" => "Bob", "last_name" => "Norman", "phone" => "555-625-1199", "province" => "Kentucky", "zip" => "40202"], "line_items" => [["id" => 1058737600, "shop_id" => 548380009, "fulfillment_order_id" => 1046000853, "quantity" => 1, "line_item_id" => 518995019, "inventory_item_id" => 49148385, "fulfillable_quantity" => 1, "variant_id" => 49148385]], "fulfillment_service_handle" => "manual", "assigned_location" => ["address1" => "50 Rideau Street", "address2" => null, "city" => "Ottawa", "country_code" => "CA", "location_id" => 655441491, "name" => "50 Rideau Street", "phone" => null, "province" => "Ontario", "zip" => "K1N 9J7"], "merchant_requests" => []], "remaining_fulfillment_order" => null]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-10/fulfillment_orders/1046000852/move.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["fulfillment_order" => ["new_location_id" => 655441491]]),
            ),
        ]);

        $fulfillment_order = new FulfillmentOrder($this->test_session);
        $fulfillment_order->id = 1046000852;
        $fulfillment_order->move(
            [],
            ["fulfillment_order" => ["new_location_id" => 655441491]],
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
                  ["fulfillment_order" => ["id" => 1046000854, "shop_id" => 548380009, "order_id" => 450789469, "assigned_location_id" => 24826418, "request_status" => "unsubmitted", "status" => "open", "supported_actions" => ["request_fulfillment", "create_fulfillment"], "destination" => ["id" => 1046000841, "address1" => "Chestnut Street 92", "address2" => "", "city" => "Louisville", "company" => null, "country" => "United States", "email" => "bob.norman@hostmail.com", "first_name" => "Bob", "last_name" => "Norman", "phone" => "555-625-1199", "province" => "Kentucky", "zip" => "40202"], "line_items" => [["id" => 1058737601, "shop_id" => 548380009, "fulfillment_order_id" => 1046000854, "quantity" => 1, "line_item_id" => 518995019, "inventory_item_id" => 49148385, "fulfillable_quantity" => 1, "variant_id" => 49148385]], "fulfillment_service_handle" => "mars-fulfillment", "fulfill_at" => null, "assigned_location" => ["address1" => null, "address2" => null, "city" => null, "country_code" => "DE", "location_id" => 24826418, "name" => "Apple Api Shipwire", "phone" => null, "province" => null, "zip" => null], "merchant_requests" => []]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-10/fulfillment_orders/1046000854/open.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        $fulfillment_order = new FulfillmentOrder($this->test_session);
        $fulfillment_order->id = 1046000854;
        $fulfillment_order->open(
            [],
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
                  ["fulfillment_order" => ["id" => 1046000855, "shop_id" => 548380009, "order_id" => 450789469, "assigned_location_id" => 24826418, "request_status" => "unsubmitted", "status" => "scheduled", "supported_actions" => ["mark_as_open"], "destination" => ["id" => 1046000842, "address1" => "Chestnut Street 92", "address2" => "", "city" => "Louisville", "company" => null, "country" => "United States", "email" => "bob.norman@hostmail.com", "first_name" => "Bob", "last_name" => "Norman", "phone" => "555-625-1199", "province" => "Kentucky", "zip" => "40202"], "line_items" => [["id" => 1058737602, "shop_id" => 548380009, "fulfillment_order_id" => 1046000855, "quantity" => 1, "line_item_id" => 518995019, "inventory_item_id" => 49148385, "fulfillable_quantity" => 1, "variant_id" => 49148385]], "fulfillment_service_handle" => "mars-fulfillment", "fulfill_at" => "2023-03-03T00:00:00-05:00", "assigned_location" => ["address1" => null, "address2" => null, "city" => null, "country_code" => "DE", "location_id" => 24826418, "name" => "Apple Api Shipwire", "phone" => null, "province" => null, "zip" => null], "merchant_requests" => []]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-10/fulfillment_orders/1046000855/reschedule.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["fulfillment_order" => ["new_fulfill_at" => "2023-03-03"]]),
            ),
        ]);

        $fulfillment_order = new FulfillmentOrder($this->test_session);
        $fulfillment_order->id = 1046000855;
        $fulfillment_order->reschedule(
            [],
            ["fulfillment_order" => ["new_fulfill_at" => "2023-03-03"]],
        );
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
                  ["fulfillment_order" => ["id" => 1046000856, "shop_id" => 548380009, "order_id" => 450789469, "assigned_location_id" => 24826418, "request_status" => "unsubmitted", "status" => "on_hold", "supported_actions" => ["release_hold"], "destination" => ["id" => 1046000843, "address1" => "Chestnut Street 92", "address2" => "", "city" => "Louisville", "company" => null, "country" => "United States", "email" => "bob.norman@hostmail.com", "first_name" => "Bob", "last_name" => "Norman", "phone" => "555-625-1199", "province" => "Kentucky", "zip" => "40202"], "line_items" => [["id" => 1058737603, "shop_id" => 548380009, "fulfillment_order_id" => 1046000856, "quantity" => 1, "line_item_id" => 518995019, "inventory_item_id" => 49148385, "fulfillable_quantity" => 1, "variant_id" => 49148385]], "fulfill_at" => null, "international_duties" => ["incoterm" => "DAP"], "fulfillment_holds" => [["reason" => "inventory_out_of_stock", "reason_notes" => "Not enough inventory to complete this work."]], "delivery_method" => null, "assigned_location" => ["address1" => null, "address2" => null, "city" => null, "country_code" => "DE", "location_id" => 24826418, "name" => "Apple Api Shipwire", "phone" => null, "province" => null, "zip" => null], "merchant_requests" => []]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-10/fulfillment_orders/1046000856/hold.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["fulfillment_hold" => ["reason" => "inventory_out_of_stock", "reason_notes" => "Not enough inventory to complete this work."]]),
            ),
        ]);

        $fulfillment_order = new FulfillmentOrder($this->test_session);
        $fulfillment_order->id = 1046000856;
        $fulfillment_order->hold(
            [],
            ["fulfillment_hold" => ["reason" => "inventory_out_of_stock", "reason_notes" => "Not enough inventory to complete this work."]],
        );
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
                  ["fulfillment_order" => ["id" => 1046000858, "shop_id" => 548380009, "order_id" => 450789469, "assigned_location_id" => 24826418, "request_status" => "submitted", "status" => "open", "supported_actions" => ["cancel_fulfillment_order"], "destination" => ["id" => 1046000845, "address1" => "Chestnut Street 92", "address2" => "", "city" => "Louisville", "company" => null, "country" => "United States", "email" => "bob.norman@hostmail.com", "first_name" => "Bob", "last_name" => "Norman", "phone" => "555-625-1199", "province" => "Kentucky", "zip" => "40202"], "line_items" => [["id" => 1058737605, "shop_id" => 548380009, "fulfillment_order_id" => 1046000858, "quantity" => 1, "line_item_id" => 518995019, "inventory_item_id" => 49148385, "fulfillable_quantity" => 1, "variant_id" => 49148385]], "fulfill_at" => "2022-02-03T17:09:59-05:00", "international_duties" => ["incoterm" => "DAP"], "fulfillment_holds" => [], "delivery_method" => null, "assigned_location" => ["address1" => null, "address2" => null, "city" => null, "country_code" => "DE", "location_id" => 24826418, "name" => "Apple Api Shipwire", "phone" => null, "province" => null, "zip" => null], "merchant_requests" => []]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-10/fulfillment_orders/1046000858/release_hold.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        $fulfillment_order = new FulfillmentOrder($this->test_session);
        $fulfillment_order->id = 1046000858;
        $fulfillment_order->release_hold(
            [],
        );
    }

}
