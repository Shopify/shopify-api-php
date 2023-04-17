<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Admin2022_01\FulfillmentRequest;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class FulfillmentRequest202201Test extends BaseTestCase
{
    /** @var Session */
    private $test_session;

    public function setUp(): void
    {
        parent::setUp();

        Context::$API_VERSION = "2022-01";

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
                  ["original_fulfillment_order" => ["id" => 1046000809, "shop_id" => 548380009, "order_id" => 450789469, "assigned_location_id" => 24826418, "request_status" => "submitted", "status" => "open", "supported_actions" => ["cancel_fulfillment_order"], "destination" => ["id" => 1046000801, "address1" => "Chestnut Street 92", "address2" => "", "city" => "Louisville", "company" => null, "country" => "United States", "email" => "bob.norman@mail.example.com", "first_name" => "Bob", "last_name" => "Norman", "phone" => "+1(502)-459-2181", "province" => "Kentucky", "zip" => "40202"], "origin" => ["address1" => null, "address2" => null, "city" => null, "country_code" => "DE", "location_id" => 24826418, "name" => "Apple Api Shipwire", "phone" => null, "province" => null, "zip" => null], "line_items" => [["id" => 1058737540, "shop_id" => 548380009, "fulfillment_order_id" => 1046000809, "quantity" => 1, "line_item_id" => 466157049, "inventory_item_id" => 39072856, "fulfillable_quantity" => 1, "variant_id" => 39072856], ["id" => 1058737541, "shop_id" => 548380009, "fulfillment_order_id" => 1046000809, "quantity" => 1, "line_item_id" => 518995019, "inventory_item_id" => 49148385, "fulfillable_quantity" => 1, "variant_id" => 49148385], ["id" => 1058737542, "shop_id" => 548380009, "fulfillment_order_id" => 1046000809, "quantity" => 1, "line_item_id" => 703073504, "inventory_item_id" => 457924702, "fulfillable_quantity" => 1, "variant_id" => 457924702]], "outgoing_requests" => [["message" => "Fulfill this ASAP please.", "request_options" => ["notify_customer" => false], "sent_at" => "2023-01-03T12:55:15-05:00", "kind" => "fulfillment_request"]], "fulfillment_service_handle" => "shipwire-app"], "submitted_fulfillment_order" => ["id" => 1046000809, "shop_id" => 548380009, "order_id" => 450789469, "assigned_location_id" => 24826418, "request_status" => "submitted", "status" => "open", "supported_actions" => ["cancel_fulfillment_order"], "destination" => ["id" => 1046000801, "address1" => "Chestnut Street 92", "address2" => "", "city" => "Louisville", "company" => null, "country" => "United States", "email" => "bob.norman@mail.example.com", "first_name" => "Bob", "last_name" => "Norman", "phone" => "+1(502)-459-2181", "province" => "Kentucky", "zip" => "40202"], "origin" => ["address1" => null, "address2" => null, "city" => null, "country_code" => "DE", "location_id" => 24826418, "name" => "Apple Api Shipwire", "phone" => null, "province" => null, "zip" => null], "line_items" => [["id" => 1058737540, "shop_id" => 548380009, "fulfillment_order_id" => 1046000809, "quantity" => 1, "line_item_id" => 466157049, "inventory_item_id" => 39072856, "fulfillable_quantity" => 1, "variant_id" => 39072856], ["id" => 1058737541, "shop_id" => 548380009, "fulfillment_order_id" => 1046000809, "quantity" => 1, "line_item_id" => 518995019, "inventory_item_id" => 49148385, "fulfillable_quantity" => 1, "variant_id" => 49148385], ["id" => 1058737542, "shop_id" => 548380009, "fulfillment_order_id" => 1046000809, "quantity" => 1, "line_item_id" => 703073504, "inventory_item_id" => 457924702, "fulfillable_quantity" => 1, "variant_id" => 457924702]], "outgoing_requests" => [["message" => "Fulfill this ASAP please.", "request_options" => ["notify_customer" => false], "sent_at" => "2023-01-03T12:55:15-05:00", "kind" => "fulfillment_request"]], "fulfillment_service_handle" => "shipwire-app"], "unsubmitted_fulfillment_order" => null]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-01/fulfillment_orders/1046000809/fulfillment_request.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["fulfillment_request" => ["message" => "Fulfill this ASAP please."]]),
            ),
        ]);

        $fulfillment_request = new FulfillmentRequest($this->test_session);
        $fulfillment_request->fulfillment_order_id = 1046000809;
        $fulfillment_request->message = "Fulfill this ASAP please.";
        $fulfillment_request->save();
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
                  ["original_fulfillment_order" => ["id" => 1046000812, "shop_id" => 548380009, "order_id" => 450789469, "assigned_location_id" => 24826418, "request_status" => "unsubmitted", "status" => "closed", "supported_actions" => [], "destination" => ["id" => 1046000804, "address1" => "Chestnut Street 92", "address2" => "", "city" => "Louisville", "company" => null, "country" => "United States", "email" => "bob.norman@mail.example.com", "first_name" => "Bob", "last_name" => "Norman", "phone" => "+1(502)-459-2181", "province" => "Kentucky", "zip" => "40202"], "origin" => ["address1" => null, "address2" => null, "city" => null, "country_code" => "DE", "location_id" => 24826418, "name" => "Apple Api Shipwire", "phone" => null, "province" => null, "zip" => null], "line_items" => [["id" => 1058737549, "shop_id" => 548380009, "fulfillment_order_id" => 1046000812, "quantity" => 1, "line_item_id" => 466157049, "inventory_item_id" => 39072856, "fulfillable_quantity" => 1, "variant_id" => 39072856], ["id" => 1058737550, "shop_id" => 548380009, "fulfillment_order_id" => 1046000812, "quantity" => 1, "line_item_id" => 518995019, "inventory_item_id" => 49148385, "fulfillable_quantity" => 1, "variant_id" => 49148385], ["id" => 1058737551, "shop_id" => 548380009, "fulfillment_order_id" => 1046000812, "quantity" => 1, "line_item_id" => 703073504, "inventory_item_id" => 457924702, "fulfillable_quantity" => 1, "variant_id" => 457924702]], "outgoing_requests" => [], "fulfillment_service_handle" => "shipwire-app"], "submitted_fulfillment_order" => ["id" => 1046000813, "shop_id" => 548380009, "order_id" => 450789469, "assigned_location_id" => 24826418, "request_status" => "submitted", "status" => "open", "supported_actions" => ["cancel_fulfillment_order"], "destination" => ["id" => 1046000805, "address1" => "Chestnut Street 92", "address2" => "", "city" => "Louisville", "company" => null, "country" => "United States", "email" => "bob.norman@mail.example.com", "first_name" => "Bob", "last_name" => "Norman", "phone" => "+1(502)-459-2181", "province" => "Kentucky", "zip" => "40202"], "origin" => ["address1" => null, "address2" => null, "city" => null, "country_code" => "DE", "location_id" => 24826418, "name" => "Apple Api Shipwire", "phone" => null, "province" => null, "zip" => null], "line_items" => [["id" => 1058737552, "shop_id" => 548380009, "fulfillment_order_id" => 1046000813, "quantity" => 1, "line_item_id" => 466157049, "inventory_item_id" => 39072856, "fulfillable_quantity" => 1, "variant_id" => 39072856], ["id" => 1058737553, "shop_id" => 548380009, "fulfillment_order_id" => 1046000813, "quantity" => 1, "line_item_id" => 518995019, "inventory_item_id" => 49148385, "fulfillable_quantity" => 1, "variant_id" => 49148385]], "outgoing_requests" => [["message" => "Fulfill this ASAP please.", "request_options" => ["notify_customer" => false], "sent_at" => "2023-01-03T12:55:27-05:00", "kind" => "fulfillment_request"]], "fulfillment_service_handle" => "shipwire-app"], "unsubmitted_fulfillment_order" => ["id" => 1046000814, "shop_id" => 548380009, "order_id" => 450789469, "assigned_location_id" => 24826418, "request_status" => "unsubmitted", "status" => "open", "supported_actions" => ["request_fulfillment", "create_fulfillment"], "destination" => ["id" => 1046000806, "address1" => "Chestnut Street 92", "address2" => "", "city" => "Louisville", "company" => null, "country" => "United States", "email" => "bob.norman@mail.example.com", "first_name" => "Bob", "last_name" => "Norman", "phone" => "+1(502)-459-2181", "province" => "Kentucky", "zip" => "40202"], "origin" => ["address1" => null, "address2" => null, "city" => null, "country_code" => "DE", "location_id" => 24826418, "name" => "Apple Api Shipwire", "phone" => null, "province" => null, "zip" => null], "line_items" => [["id" => 1058737554, "shop_id" => 548380009, "fulfillment_order_id" => 1046000814, "quantity" => 1, "line_item_id" => 703073504, "inventory_item_id" => 457924702, "fulfillable_quantity" => 1, "variant_id" => 457924702]], "outgoing_requests" => [], "fulfillment_service_handle" => "shipwire-app"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-01/fulfillment_orders/1046000812/fulfillment_request.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["fulfillment_request" => ["message" => "Fulfill this ASAP please.", "fulfillment_order_line_items" => [["id" => 1058737549, "quantity" => 1], ["id" => 1058737550, "quantity" => 1]]]]),
            ),
        ]);

        $fulfillment_request = new FulfillmentRequest($this->test_session);
        $fulfillment_request->fulfillment_order_id = 1046000812;
        $fulfillment_request->message = "Fulfill this ASAP please.";
        $fulfillment_request->fulfillment_order_line_items = [
            [
                "id" => 1058737549,
                "quantity" => 1
            ],
            [
                "id" => 1058737550,
                "quantity" => 1
            ]
        ];
        $fulfillment_request->save();
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
                  ["fulfillment_order" => ["id" => 1046000810, "shop_id" => 548380009, "order_id" => 450789469, "assigned_location_id" => 24826418, "request_status" => "accepted", "status" => "in_progress", "supported_actions" => ["request_cancellation", "create_fulfillment"], "destination" => ["id" => 1046000802, "address1" => "Chestnut Street 92", "address2" => "", "city" => "Louisville", "company" => null, "country" => "United States", "email" => "bob.norman@mail.example.com", "first_name" => "Bob", "last_name" => "Norman", "phone" => "+1(502)-459-2181", "province" => "Kentucky", "zip" => "40202"], "origin" => ["address1" => null, "address2" => null, "city" => null, "country_code" => "DE", "location_id" => 24826418, "name" => "Apple Api Shipwire", "phone" => null, "province" => null, "zip" => null], "line_items" => [["id" => 1058737543, "shop_id" => 548380009, "fulfillment_order_id" => 1046000810, "quantity" => 1, "line_item_id" => 466157049, "inventory_item_id" => 39072856, "fulfillable_quantity" => 1, "variant_id" => 39072856], ["id" => 1058737544, "shop_id" => 548380009, "fulfillment_order_id" => 1046000810, "quantity" => 1, "line_item_id" => 518995019, "inventory_item_id" => 49148385, "fulfillable_quantity" => 1, "variant_id" => 49148385], ["id" => 1058737545, "shop_id" => 548380009, "fulfillment_order_id" => 1046000810, "quantity" => 1, "line_item_id" => 703073504, "inventory_item_id" => 457924702, "fulfillable_quantity" => 1, "variant_id" => 457924702]], "outgoing_requests" => [], "fulfillment_service_handle" => "shipwire-app"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-01/fulfillment_orders/1046000810/fulfillment_request/accept.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["fulfillment_request" => ["message" => "We will start processing your fulfillment on the next business day."]]),
            ),
        ]);

        $fulfillment_request = new FulfillmentRequest($this->test_session);
        $fulfillment_request->fulfillment_order_id = 1046000810;
        $fulfillment_request->accept(
            [],
            ["fulfillment_request" => ["message" => "We will start processing your fulfillment on the next business day."]],
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
                  ["fulfillment_order" => ["id" => 1046000811, "shop_id" => 548380009, "order_id" => 450789469, "assigned_location_id" => 24826418, "request_status" => "rejected", "status" => "open", "supported_actions" => ["request_fulfillment", "create_fulfillment"], "destination" => ["id" => 1046000803, "address1" => "Chestnut Street 92", "address2" => "", "city" => "Louisville", "company" => null, "country" => "United States", "email" => "bob.norman@mail.example.com", "first_name" => "Bob", "last_name" => "Norman", "phone" => "+1(502)-459-2181", "province" => "Kentucky", "zip" => "40202"], "origin" => ["address1" => null, "address2" => null, "city" => null, "country_code" => "DE", "location_id" => 24826418, "name" => "Apple Api Shipwire", "phone" => null, "province" => null, "zip" => null], "line_items" => [["id" => 1058737546, "shop_id" => 548380009, "fulfillment_order_id" => 1046000811, "quantity" => 1, "line_item_id" => 466157049, "inventory_item_id" => 39072856, "fulfillable_quantity" => 1, "variant_id" => 39072856], ["id" => 1058737547, "shop_id" => 548380009, "fulfillment_order_id" => 1046000811, "quantity" => 1, "line_item_id" => 518995019, "inventory_item_id" => 49148385, "fulfillable_quantity" => 1, "variant_id" => 49148385], ["id" => 1058737548, "shop_id" => 548380009, "fulfillment_order_id" => 1046000811, "quantity" => 1, "line_item_id" => 703073504, "inventory_item_id" => 457924702, "fulfillable_quantity" => 1, "variant_id" => 457924702]], "outgoing_requests" => [], "fulfillment_service_handle" => "shipwire-app"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-01/fulfillment_orders/1046000811/fulfillment_request/reject.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["fulfillment_request" => ["message" => "Not enough inventory on hand to complete the work.", "reason" => "inventory_out_of_stock", "line_items" => [["fulfillment_order_line_item_id" => 1058737546, "message" => "Not enough inventory."]]]]),
            ),
        ]);

        $fulfillment_request = new FulfillmentRequest($this->test_session);
        $fulfillment_request->fulfillment_order_id = 1046000811;
        $fulfillment_request->reject(
            [],
            ["fulfillment_request" => ["message" => "Not enough inventory on hand to complete the work.", "reason" => "inventory_out_of_stock", "line_items" => [["fulfillment_order_line_item_id" => 1058737546, "message" => "Not enough inventory."]]]],
        );
    }

}
