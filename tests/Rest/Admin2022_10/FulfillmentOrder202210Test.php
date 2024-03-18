<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Admin2022_10\FulfillmentOrder;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class FulfillmentOrder202210Test extends BaseTestCase
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
                  ["fulfillment_orders" => [["id" => 1046000789, "shop_id" => 548380009, "order_id" => 450789469, "assigned_location_id" => 24826418, "request_status" => "submitted", "status" => "open", "supported_actions" => ["cancel_fulfillment_order"], "destination" => ["id" => 1046000785, "address1" => "Chestnut Street 92", "address2" => "", "city" => "Louisville", "company" => null, "country" => "United States", "email" => "bob.norman@mail.example.com", "first_name" => "Bob", "last_name" => "Norman", "phone" => "+1(502)-459-2181", "province" => "Kentucky", "zip" => "40202"], "line_items" => [["id" => 1058737491, "shop_id" => 548380009, "fulfillment_order_id" => 1046000789, "quantity" => 1, "line_item_id" => 518995019, "inventory_item_id" => 49148385, "fulfillable_quantity" => 1, "variant_id" => 49148385]], "fulfillment_service_handle" => "mars-fulfillment", "assigned_location" => ["address1" => null, "address2" => null, "city" => null, "country_code" => "DE", "location_id" => 24826418, "name" => "Apple Api Shipwire", "phone" => null, "province" => null, "zip" => null], "merchant_requests" => []]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-10/orders/450789469/fulfillment_orders.json",
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
                  ["fulfillment_order" => ["id" => 1046000786, "shop_id" => 548380009, "order_id" => 450789469, "assigned_location_id" => 24826418, "request_status" => "submitted", "status" => "open", "supported_actions" => ["cancel_fulfillment_order"], "destination" => ["id" => 1046000782, "address1" => "Chestnut Street 92", "address2" => "", "city" => "Louisville", "company" => null, "country" => "United States", "email" => "bob.norman@mail.example.com", "first_name" => "Bob", "last_name" => "Norman", "phone" => "+1(502)-459-2181", "province" => "Kentucky", "zip" => "40202"], "line_items" => [["id" => 1058737488, "shop_id" => 548380009, "fulfillment_order_id" => 1046000786, "quantity" => 1, "line_item_id" => 518995019, "inventory_item_id" => 49148385, "fulfillable_quantity" => 1, "variant_id" => 49148385]], "fulfillment_service_handle" => "mars-fulfillment", "assigned_location" => ["address1" => null, "address2" => null, "city" => null, "country_code" => "DE", "location_id" => 24826418, "name" => "Apple Api Shipwire", "phone" => null, "province" => null, "zip" => null], "merchant_requests" => []]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-10/fulfillment_orders/1046000786.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        FulfillmentOrder::find(
            $this->test_session,
            1046000786,
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
                  ["fulfillment_order" => ["id" => 1046000783, "shop_id" => 548380009, "order_id" => 450789469, "assigned_location_id" => 24826418, "request_status" => "submitted", "status" => "closed", "supported_actions" => [], "destination" => ["id" => 1046000779, "address1" => "Chestnut Street 92", "address2" => "", "city" => "Louisville", "company" => null, "country" => "United States", "email" => "bob.norman@mail.example.com", "first_name" => "Bob", "last_name" => "Norman", "phone" => "+1(502)-459-2181", "province" => "Kentucky", "zip" => "40202"], "line_items" => [], "fulfillment_service_handle" => "mars-fulfillment", "assigned_location" => ["address1" => null, "address2" => null, "city" => null, "country_code" => "DE", "location_id" => 24826418, "name" => "Apple Api Shipwire", "phone" => null, "province" => null, "zip" => null], "merchant_requests" => []], "replacement_fulfillment_order" => ["id" => 1046000784, "shop_id" => 548380009, "order_id" => 450789469, "assigned_location_id" => 24826418, "request_status" => "unsubmitted", "status" => "open", "supported_actions" => ["request_fulfillment", "create_fulfillment"], "destination" => ["id" => 1046000780, "address1" => "Chestnut Street 92", "address2" => "", "city" => "Louisville", "company" => null, "country" => "United States", "email" => "bob.norman@mail.example.com", "first_name" => "Bob", "last_name" => "Norman", "phone" => "+1(502)-459-2181", "province" => "Kentucky", "zip" => "40202"], "line_items" => [["id" => 1058737486, "shop_id" => 548380009, "fulfillment_order_id" => 1046000784, "quantity" => 1, "line_item_id" => 518995019, "inventory_item_id" => 49148385, "fulfillable_quantity" => 1, "variant_id" => 49148385]], "fulfillment_service_handle" => "mars-fulfillment", "assigned_location" => ["address1" => null, "address2" => null, "city" => null, "country_code" => "DE", "location_id" => 24826418, "name" => "Apple Api Shipwire", "phone" => null, "province" => null, "zip" => null], "merchant_requests" => []]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-10/fulfillment_orders/1046000783/cancel.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        $fulfillment_order = new FulfillmentOrder($this->test_session);
        $fulfillment_order->id = 1046000783;
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
                  ["fulfillment_order" => ["id" => 1046000785, "shop_id" => 548380009, "order_id" => 450789469, "assigned_location_id" => 24826418, "request_status" => "closed", "status" => "incomplete", "supported_actions" => ["request_fulfillment", "create_fulfillment"], "destination" => ["id" => 1046000781, "address1" => "Chestnut Street 92", "address2" => "", "city" => "Louisville", "company" => null, "country" => "United States", "email" => "bob.norman@mail.example.com", "first_name" => "Bob", "last_name" => "Norman", "phone" => "+1(502)-459-2181", "province" => "Kentucky", "zip" => "40202"], "line_items" => [["id" => 1058737487, "shop_id" => 548380009, "fulfillment_order_id" => 1046000785, "quantity" => 1, "line_item_id" => 518995019, "inventory_item_id" => 49148385, "fulfillable_quantity" => 1, "variant_id" => 49148385]], "fulfillment_service_handle" => "mars-fulfillment", "assigned_location" => ["address1" => null, "address2" => null, "city" => null, "country_code" => "DE", "location_id" => 24826418, "name" => "Apple Api Shipwire", "phone" => null, "province" => null, "zip" => null], "merchant_requests" => []]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-10/fulfillment_orders/1046000785/close.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["fulfillment_order" => ["message" => "Not enough inventory to complete this work."]]),
            ),
        ]);

        $fulfillment_order = new FulfillmentOrder($this->test_session);
        $fulfillment_order->id = 1046000785;
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
                  ["original_fulfillment_order" => ["id" => 1046000787, "shop_id" => 548380009, "order_id" => 450789469, "assigned_location_id" => 487838322, "request_status" => "submitted", "status" => "closed", "supported_actions" => [], "destination" => ["id" => 1046000783, "address1" => "Chestnut Street 92", "address2" => "", "city" => "Louisville", "company" => null, "country" => "United States", "email" => "bob.norman@mail.example.com", "first_name" => "Bob", "last_name" => "Norman", "phone" => "+1(502)-459-2181", "province" => "Kentucky", "zip" => "40202"], "line_items" => [["id" => 1058737489, "shop_id" => 548380009, "fulfillment_order_id" => 1046000787, "quantity" => 1, "line_item_id" => 518995019, "inventory_item_id" => 49148385, "fulfillable_quantity" => 1, "variant_id" => 49148385]], "fulfillment_service_handle" => "manual", "assigned_location" => ["address1" => null, "address2" => null, "city" => null, "country_code" => "DE", "location_id" => 24826418, "name" => "Apple Api Shipwire", "phone" => null, "province" => null, "zip" => null], "merchant_requests" => []], "moved_fulfillment_order" => ["id" => 1046000788, "shop_id" => 548380009, "order_id" => 450789469, "assigned_location_id" => 655441491, "request_status" => "unsubmitted", "status" => "open", "supported_actions" => ["create_fulfillment", "move"], "destination" => ["id" => 1046000784, "address1" => "Chestnut Street 92", "address2" => "", "city" => "Louisville", "company" => null, "country" => "United States", "email" => "bob.norman@mail.example.com", "first_name" => "Bob", "last_name" => "Norman", "phone" => "+1(502)-459-2181", "province" => "Kentucky", "zip" => "40202"], "line_items" => [["id" => 1058737490, "shop_id" => 548380009, "fulfillment_order_id" => 1046000788, "quantity" => 1, "line_item_id" => 518995019, "inventory_item_id" => 49148385, "fulfillable_quantity" => 1, "variant_id" => 49148385]], "fulfillment_service_handle" => "manual", "assigned_location" => ["address1" => "50 Rideau Street", "address2" => null, "city" => "Ottawa", "country_code" => "CA", "location_id" => 655441491, "name" => "50 Rideau Street", "phone" => null, "province" => "Ontario", "zip" => "K1N 9J7"], "merchant_requests" => []], "remaining_fulfillment_order" => null]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-10/fulfillment_orders/1046000787/move.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["fulfillment_order" => ["new_location_id" => 655441491, "fulfillment_order_line_items" => [["id" => 1058737489, "quantity" => 1]]]]),
            ),
        ]);

        $fulfillment_order = new FulfillmentOrder($this->test_session);
        $fulfillment_order->id = 1046000787;
        $fulfillment_order->move(
            [],
            ["fulfillment_order" => ["new_location_id" => 655441491, "fulfillment_order_line_items" => [["id" => 1058737489, "quantity" => 1]]]],
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
                  ["fulfillment_order" => ["id" => 1046000793, "shop_id" => 548380009, "order_id" => 450789469, "assigned_location_id" => 24826418, "request_status" => "unsubmitted", "status" => "open", "supported_actions" => ["request_fulfillment", "create_fulfillment"], "destination" => ["id" => 1046000789, "address1" => "Chestnut Street 92", "address2" => "", "city" => "Louisville", "company" => null, "country" => "United States", "email" => "bob.norman@mail.example.com", "first_name" => "Bob", "last_name" => "Norman", "phone" => "+1(502)-459-2181", "province" => "Kentucky", "zip" => "40202"], "line_items" => [["id" => 1058737495, "shop_id" => 548380009, "fulfillment_order_id" => 1046000793, "quantity" => 1, "line_item_id" => 518995019, "inventory_item_id" => 49148385, "fulfillable_quantity" => 1, "variant_id" => 49148385]], "fulfillment_service_handle" => "mars-fulfillment", "fulfill_at" => null, "assigned_location" => ["address1" => null, "address2" => null, "city" => null, "country_code" => "DE", "location_id" => 24826418, "name" => "Apple Api Shipwire", "phone" => null, "province" => null, "zip" => null], "merchant_requests" => []]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-10/fulfillment_orders/1046000793/open.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        $fulfillment_order = new FulfillmentOrder($this->test_session);
        $fulfillment_order->id = 1046000793;
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
                  ["fulfillment_order" => ["id" => 1046000794, "shop_id" => 548380009, "order_id" => 450789469, "assigned_location_id" => 24826418, "request_status" => "unsubmitted", "status" => "scheduled", "supported_actions" => ["mark_as_open"], "destination" => ["id" => 1046000790, "address1" => "Chestnut Street 92", "address2" => "", "city" => "Louisville", "company" => null, "country" => "United States", "email" => "bob.norman@mail.example.com", "first_name" => "Bob", "last_name" => "Norman", "phone" => "+1(502)-459-2181", "province" => "Kentucky", "zip" => "40202"], "line_items" => [["id" => 1058737496, "shop_id" => 548380009, "fulfillment_order_id" => 1046000794, "quantity" => 1, "line_item_id" => 518995019, "inventory_item_id" => 49148385, "fulfillable_quantity" => 1, "variant_id" => 49148385]], "fulfillment_service_handle" => "mars-fulfillment", "fulfill_at" => "2024-11-03T12:21:00-05:00", "assigned_location" => ["address1" => null, "address2" => null, "city" => null, "country_code" => "DE", "location_id" => 24826418, "name" => "Apple Api Shipwire", "phone" => null, "province" => null, "zip" => null], "merchant_requests" => []]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-10/fulfillment_orders/1046000794/reschedule.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["fulfillment_order" => ["new_fulfill_at" => "2024-11-03 17:21 UTC"]]),
            ),
        ]);

        $fulfillment_order = new FulfillmentOrder($this->test_session);
        $fulfillment_order->id = 1046000794;
        $fulfillment_order->reschedule(
            [],
            ["fulfillment_order" => ["new_fulfill_at" => "2024-11-03 17:21 UTC"]],
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
                  ["fulfillment_order" => ["id" => 1046000792, "shop_id" => 548380009, "order_id" => 450789469, "assigned_location_id" => 24826418, "request_status" => "unsubmitted", "status" => "on_hold", "supported_actions" => ["release_hold"], "destination" => ["id" => 1046000788, "address1" => "Chestnut Street 92", "address2" => "", "city" => "Louisville", "company" => null, "country" => "United States", "email" => "bob.norman@mail.example.com", "first_name" => "Bob", "last_name" => "Norman", "phone" => "+1(502)-459-2181", "province" => "Kentucky", "zip" => "40202"], "line_items" => [["id" => 1058737494, "shop_id" => 548380009, "fulfillment_order_id" => 1046000792, "quantity" => 1, "line_item_id" => 518995019, "inventory_item_id" => 49148385, "fulfillable_quantity" => 1, "variant_id" => 49148385]], "fulfill_at" => null, "international_duties" => ["incoterm" => null], "fulfillment_holds" => [["reason" => "inventory_out_of_stock", "reason_notes" => "Not enough inventory to complete this work."]], "delivery_method" => null, "assigned_location" => ["address1" => null, "address2" => null, "city" => null, "country_code" => "DE", "location_id" => 24826418, "name" => "Apple Api Shipwire", "phone" => null, "province" => null, "zip" => null], "merchant_requests" => []]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-10/fulfillment_orders/1046000792/hold.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["fulfillment_hold" => ["reason" => "inventory_out_of_stock", "reason_notes" => "Not enough inventory to complete this work.", "fulfillment_order_line_items" => [["id" => 1058737494, "quantity" => 1]]]]),
            ),
        ]);

        $fulfillment_order = new FulfillmentOrder($this->test_session);
        $fulfillment_order->id = 1046000792;
        $fulfillment_order->hold(
            [],
            ["fulfillment_hold" => ["reason" => "inventory_out_of_stock", "reason_notes" => "Not enough inventory to complete this work.", "fulfillment_order_line_items" => [["id" => 1058737494, "quantity" => 1]]]],
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
                  []
                )),
                "https://test-shop.myshopify.io/admin/api/2022-10/fulfillment_orders/set_fulfillment_orders_deadline.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["fulfillment_order_ids" => [1046000791], "fulfillment_deadline" => "2021-05-26T10:00:00-04:00"]),
            ),
        ]);

        $fulfillment_order = new FulfillmentOrder($this->test_session);

        $fulfillment_order->set_fulfillment_orders_deadline(
            [],
            ["fulfillment_order_ids" => [1046000791], "fulfillment_deadline" => "2021-05-26T10:00:00-04:00"],
        );
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
                  ["fulfillment_order" => ["id" => 1046000795, "shop_id" => 548380009, "order_id" => 450789469, "assigned_location_id" => 24826418, "request_status" => "submitted", "status" => "open", "supported_actions" => ["cancel_fulfillment_order"], "destination" => ["id" => 1046000791, "address1" => "Chestnut Street 92", "address2" => "", "city" => "Louisville", "company" => null, "country" => "United States", "email" => "bob.norman@mail.example.com", "first_name" => "Bob", "last_name" => "Norman", "phone" => "+1(502)-459-2181", "province" => "Kentucky", "zip" => "40202"], "origin" => ["address1" => null, "address2" => null, "city" => null, "country_code" => "DE", "location_id" => 24826418, "name" => "Apple Api Shipwire", "phone" => null, "province" => null, "zip" => null], "line_items" => [["id" => 1058737497, "shop_id" => 548380009, "fulfillment_order_id" => 1046000795, "quantity" => 1, "line_item_id" => 518995019, "inventory_item_id" => 49148385, "fulfillable_quantity" => 1, "variant_id" => 49148385]], "outgoing_requests" => [], "fulfill_at" => null, "international_duties" => ["incoterm" => null], "fulfillment_holds" => [], "delivery_method" => null]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-10/fulfillment_orders/1046000795/release_hold.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        $fulfillment_order = new FulfillmentOrder($this->test_session);
        $fulfillment_order->id = 1046000795;
        $fulfillment_order->release_hold(
            [],
        );
    }

}
