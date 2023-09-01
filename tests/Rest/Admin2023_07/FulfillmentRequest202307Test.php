<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Admin2023_07\FulfillmentRequest;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class FulfillmentRequest202307Test extends BaseTestCase
{
    /** @var Session */
    private $test_session;

    public function setUp(): void
    {
        parent::setUp();

        Context::$API_VERSION = "2023-07";

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
                  ["original_fulfillment_order" => ["id" => 1046000782, "shop_id" => 548380009, "order_id" => 450789469, "assigned_location_id" => 24826418, "request_status" => "submitted", "status" => "open", "supported_actions" => ["cancel_fulfillment_order"], "destination" => ["id" => 1046000782, "address1" => "Chestnut Street 92", "address2" => "", "city" => "Louisville", "company" => null, "country" => "United States", "email" => "bob.norman@mail.example.com", "first_name" => "Bob", "last_name" => "Norman", "phone" => "+1(502)-459-2181", "province" => "Kentucky", "zip" => "40202"], "origin" => ["address1" => null, "address2" => null, "city" => null, "country_code" => "DE", "location_id" => 24826418, "name" => "Apple Api Shipwire", "phone" => null, "province" => null, "zip" => null], "line_items" => [["id" => 1058737493, "shop_id" => 548380009, "fulfillment_order_id" => 1046000782, "quantity" => 1, "line_item_id" => 466157049, "inventory_item_id" => 39072856, "fulfillable_quantity" => 1, "variant_id" => 39072856], ["id" => 1058737494, "shop_id" => 548380009, "fulfillment_order_id" => 1046000782, "quantity" => 1, "line_item_id" => 518995019, "inventory_item_id" => 49148385, "fulfillable_quantity" => 1, "variant_id" => 49148385], ["id" => 1058737495, "shop_id" => 548380009, "fulfillment_order_id" => 1046000782, "quantity" => 1, "line_item_id" => 703073504, "inventory_item_id" => 457924702, "fulfillable_quantity" => 1, "variant_id" => 457924702]], "outgoing_requests" => [["message" => "Fulfill this ASAP please.", "request_options" => ["notify_customer" => false], "sent_at" => "2023-07-05T18:48:36-04:00", "kind" => "fulfillment_request"]], "fulfillment_service_handle" => "shipwire-app"], "submitted_fulfillment_order" => ["id" => 1046000782, "shop_id" => 548380009, "order_id" => 450789469, "assigned_location_id" => 24826418, "request_status" => "submitted", "status" => "open", "supported_actions" => ["cancel_fulfillment_order"], "destination" => ["id" => 1046000782, "address1" => "Chestnut Street 92", "address2" => "", "city" => "Louisville", "company" => null, "country" => "United States", "email" => "bob.norman@mail.example.com", "first_name" => "Bob", "last_name" => "Norman", "phone" => "+1(502)-459-2181", "province" => "Kentucky", "zip" => "40202"], "origin" => ["address1" => null, "address2" => null, "city" => null, "country_code" => "DE", "location_id" => 24826418, "name" => "Apple Api Shipwire", "phone" => null, "province" => null, "zip" => null], "line_items" => [["id" => 1058737493, "shop_id" => 548380009, "fulfillment_order_id" => 1046000782, "quantity" => 1, "line_item_id" => 466157049, "inventory_item_id" => 39072856, "fulfillable_quantity" => 1, "variant_id" => 39072856], ["id" => 1058737494, "shop_id" => 548380009, "fulfillment_order_id" => 1046000782, "quantity" => 1, "line_item_id" => 518995019, "inventory_item_id" => 49148385, "fulfillable_quantity" => 1, "variant_id" => 49148385], ["id" => 1058737495, "shop_id" => 548380009, "fulfillment_order_id" => 1046000782, "quantity" => 1, "line_item_id" => 703073504, "inventory_item_id" => 457924702, "fulfillable_quantity" => 1, "variant_id" => 457924702]], "outgoing_requests" => [["message" => "Fulfill this ASAP please.", "request_options" => ["notify_customer" => false], "sent_at" => "2023-07-05T18:48:36-04:00", "kind" => "fulfillment_request"]], "fulfillment_service_handle" => "shipwire-app"], "unsubmitted_fulfillment_order" => null]
                )),
                "https://test-shop.myshopify.io/admin/api/2023-07/fulfillment_orders/1046000782/fulfillment_request.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["fulfillment_request" => ["message" => "Fulfill this ASAP please."]]),
            ),
        ]);

        $fulfillment_request = new FulfillmentRequest($this->test_session);
        $fulfillment_request->fulfillment_order_id = 1046000782;
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
                  ["original_fulfillment_order" => ["id" => 1046000777, "shop_id" => 548380009, "order_id" => 450789469, "assigned_location_id" => 24826418, "request_status" => "unsubmitted", "status" => "closed", "supported_actions" => [], "destination" => ["id" => 1046000777, "address1" => "Chestnut Street 92", "address2" => "", "city" => "Louisville", "company" => null, "country" => "United States", "email" => "bob.norman@mail.example.com", "first_name" => "Bob", "last_name" => "Norman", "phone" => "+1(502)-459-2181", "province" => "Kentucky", "zip" => "40202"], "origin" => ["address1" => null, "address2" => null, "city" => null, "country_code" => "DE", "location_id" => 24826418, "name" => "Apple Api Shipwire", "phone" => null, "province" => null, "zip" => null], "line_items" => [["id" => 1058737481, "shop_id" => 548380009, "fulfillment_order_id" => 1046000777, "quantity" => 1, "line_item_id" => 466157049, "inventory_item_id" => 39072856, "fulfillable_quantity" => 1, "variant_id" => 39072856], ["id" => 1058737482, "shop_id" => 548380009, "fulfillment_order_id" => 1046000777, "quantity" => 1, "line_item_id" => 518995019, "inventory_item_id" => 49148385, "fulfillable_quantity" => 1, "variant_id" => 49148385], ["id" => 1058737483, "shop_id" => 548380009, "fulfillment_order_id" => 1046000777, "quantity" => 1, "line_item_id" => 703073504, "inventory_item_id" => 457924702, "fulfillable_quantity" => 1, "variant_id" => 457924702]], "outgoing_requests" => [], "fulfillment_service_handle" => "shipwire-app"], "submitted_fulfillment_order" => ["id" => 1046000778, "shop_id" => 548380009, "order_id" => 450789469, "assigned_location_id" => 24826418, "request_status" => "submitted", "status" => "open", "supported_actions" => ["cancel_fulfillment_order"], "destination" => ["id" => 1046000778, "address1" => "Chestnut Street 92", "address2" => "", "city" => "Louisville", "company" => null, "country" => "United States", "email" => "bob.norman@mail.example.com", "first_name" => "Bob", "last_name" => "Norman", "phone" => "+1(502)-459-2181", "province" => "Kentucky", "zip" => "40202"], "origin" => ["address1" => null, "address2" => null, "city" => null, "country_code" => "DE", "location_id" => 24826418, "name" => "Apple Api Shipwire", "phone" => null, "province" => null, "zip" => null], "line_items" => [["id" => 1058737484, "shop_id" => 548380009, "fulfillment_order_id" => 1046000778, "quantity" => 1, "line_item_id" => 466157049, "inventory_item_id" => 39072856, "fulfillable_quantity" => 1, "variant_id" => 39072856], ["id" => 1058737485, "shop_id" => 548380009, "fulfillment_order_id" => 1046000778, "quantity" => 1, "line_item_id" => 518995019, "inventory_item_id" => 49148385, "fulfillable_quantity" => 1, "variant_id" => 49148385]], "outgoing_requests" => [["message" => "Fulfill this ASAP please.", "request_options" => ["notify_customer" => false], "sent_at" => "2023-07-05T18:48:31-04:00", "kind" => "fulfillment_request"]], "fulfillment_service_handle" => "shipwire-app"], "unsubmitted_fulfillment_order" => ["id" => 1046000779, "shop_id" => 548380009, "order_id" => 450789469, "assigned_location_id" => 24826418, "request_status" => "unsubmitted", "status" => "open", "supported_actions" => ["request_fulfillment", "create_fulfillment"], "destination" => ["id" => 1046000779, "address1" => "Chestnut Street 92", "address2" => "", "city" => "Louisville", "company" => null, "country" => "United States", "email" => "bob.norman@mail.example.com", "first_name" => "Bob", "last_name" => "Norman", "phone" => "+1(502)-459-2181", "province" => "Kentucky", "zip" => "40202"], "origin" => ["address1" => null, "address2" => null, "city" => null, "country_code" => "DE", "location_id" => 24826418, "name" => "Apple Api Shipwire", "phone" => null, "province" => null, "zip" => null], "line_items" => [["id" => 1058737486, "shop_id" => 548380009, "fulfillment_order_id" => 1046000779, "quantity" => 1, "line_item_id" => 703073504, "inventory_item_id" => 457924702, "fulfillable_quantity" => 1, "variant_id" => 457924702]], "outgoing_requests" => [], "fulfillment_service_handle" => "shipwire-app"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2023-07/fulfillment_orders/1046000777/fulfillment_request.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["fulfillment_request" => ["message" => "Fulfill this ASAP please.", "fulfillment_order_line_items" => [["id" => 1058737481, "quantity" => 1], ["id" => 1058737482, "quantity" => 1]]]]),
            ),
        ]);

        $fulfillment_request = new FulfillmentRequest($this->test_session);
        $fulfillment_request->fulfillment_order_id = 1046000777;
        $fulfillment_request->message = "Fulfill this ASAP please.";
        $fulfillment_request->fulfillment_order_line_items = [
            [
                "id" => 1058737481,
                "quantity" => 1
            ],
            [
                "id" => 1058737482,
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
                  ["fulfillment_order" => ["id" => 1046000780, "shop_id" => 548380009, "order_id" => 450789469, "assigned_location_id" => 24826418, "request_status" => "accepted", "status" => "in_progress", "supported_actions" => ["request_cancellation", "create_fulfillment"], "destination" => ["id" => 1046000780, "address1" => "Chestnut Street 92", "address2" => "", "city" => "Louisville", "company" => null, "country" => "United States", "email" => "bob.norman@mail.example.com", "first_name" => "Bob", "last_name" => "Norman", "phone" => "+1(502)-459-2181", "province" => "Kentucky", "zip" => "40202"], "origin" => ["address1" => null, "address2" => null, "city" => null, "country_code" => "DE", "location_id" => 24826418, "name" => "Apple Api Shipwire", "phone" => null, "province" => null, "zip" => null], "line_items" => [["id" => 1058737487, "shop_id" => 548380009, "fulfillment_order_id" => 1046000780, "quantity" => 1, "line_item_id" => 466157049, "inventory_item_id" => 39072856, "fulfillable_quantity" => 1, "variant_id" => 39072856], ["id" => 1058737488, "shop_id" => 548380009, "fulfillment_order_id" => 1046000780, "quantity" => 1, "line_item_id" => 518995019, "inventory_item_id" => 49148385, "fulfillable_quantity" => 1, "variant_id" => 49148385], ["id" => 1058737489, "shop_id" => 548380009, "fulfillment_order_id" => 1046000780, "quantity" => 1, "line_item_id" => 703073504, "inventory_item_id" => 457924702, "fulfillable_quantity" => 1, "variant_id" => 457924702]], "outgoing_requests" => [], "fulfillment_service_handle" => "shipwire-app"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2023-07/fulfillment_orders/1046000780/fulfillment_request/accept.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["fulfillment_request" => ["message" => "We will start processing your fulfillment on the next business day."]]),
            ),
        ]);

        $fulfillment_request = new FulfillmentRequest($this->test_session);
        $fulfillment_request->fulfillment_order_id = 1046000780;
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
                  ["fulfillment_order" => ["id" => 1046000781, "shop_id" => 548380009, "order_id" => 450789469, "assigned_location_id" => 24826418, "request_status" => "rejected", "status" => "open", "supported_actions" => ["request_fulfillment", "create_fulfillment"], "destination" => ["id" => 1046000781, "address1" => "Chestnut Street 92", "address2" => "", "city" => "Louisville", "company" => null, "country" => "United States", "email" => "bob.norman@mail.example.com", "first_name" => "Bob", "last_name" => "Norman", "phone" => "+1(502)-459-2181", "province" => "Kentucky", "zip" => "40202"], "origin" => ["address1" => null, "address2" => null, "city" => null, "country_code" => "DE", "location_id" => 24826418, "name" => "Apple Api Shipwire", "phone" => null, "province" => null, "zip" => null], "line_items" => [["id" => 1058737490, "shop_id" => 548380009, "fulfillment_order_id" => 1046000781, "quantity" => 1, "line_item_id" => 466157049, "inventory_item_id" => 39072856, "fulfillable_quantity" => 1, "variant_id" => 39072856], ["id" => 1058737491, "shop_id" => 548380009, "fulfillment_order_id" => 1046000781, "quantity" => 1, "line_item_id" => 518995019, "inventory_item_id" => 49148385, "fulfillable_quantity" => 1, "variant_id" => 49148385], ["id" => 1058737492, "shop_id" => 548380009, "fulfillment_order_id" => 1046000781, "quantity" => 1, "line_item_id" => 703073504, "inventory_item_id" => 457924702, "fulfillable_quantity" => 1, "variant_id" => 457924702]], "outgoing_requests" => [], "fulfillment_service_handle" => "shipwire-app"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2023-07/fulfillment_orders/1046000781/fulfillment_request/reject.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["fulfillment_request" => ["message" => "Not enough inventory on hand to complete the work.", "reason" => "inventory_out_of_stock", "line_items" => [["fulfillment_order_line_item_id" => 1058737490, "message" => "Not enough inventory."]]]]),
            ),
        ]);

        $fulfillment_request = new FulfillmentRequest($this->test_session);
        $fulfillment_request->fulfillment_order_id = 1046000781;
        $fulfillment_request->reject(
            [],
            ["fulfillment_request" => ["message" => "Not enough inventory on hand to complete the work.", "reason" => "inventory_out_of_stock", "line_items" => [["fulfillment_order_line_item_id" => 1058737490, "message" => "Not enough inventory."]]]],
        );
    }

}
