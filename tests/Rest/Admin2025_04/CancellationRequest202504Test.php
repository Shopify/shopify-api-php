<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Admin2025_04\CancellationRequest;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class CancellationRequest202504Test extends BaseTestCase
{
    /** @var Session */
    private $test_session;

    public function setUp(): void
    {
        parent::setUp();

        Context::$API_VERSION = "2025-04";

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
                  ["fulfillment_order" => ["id" => 1046000839, "shop_id" => 548380009, "order_id" => 450789469, "assigned_location_id" => 24826418, "request_status" => "cancellation_requested", "status" => "in_progress", "supported_actions" => ["cancel_fulfillment_order"], "destination" => ["id" => 1046000823, "address1" => "Chestnut Street 92", "address2" => "", "city" => "Louisville", "company" => null, "country" => "United States", "email" => "bob.norman@mail.example.com", "first_name" => "Bob", "last_name" => "Norman", "phone" => "+1(502)-459-2181", "province" => "Kentucky", "zip" => "40202"], "origin" => ["address1" => null, "address2" => null, "city" => null, "country_code" => "DE", "location_id" => 24826418, "name" => "Apple Api Shipwire", "phone" => null, "province" => null, "zip" => null], "line_items" => [["id" => 1058737579, "shop_id" => 548380009, "fulfillment_order_id" => 1046000839, "quantity" => 1, "line_item_id" => 518995019, "inventory_item_id" => 49148385, "fulfillable_quantity" => 1, "variant_id" => 49148385]], "outgoing_requests" => [], "international_duties" => null, "fulfillment_service_handle" => "shipwire-app"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2025-04/fulfillment_orders/1046000839/cancellation_request.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["cancellation_request" => ["message" => "The customer changed his mind."]]),
            ),
        ]);

        $cancellation_request = new CancellationRequest($this->test_session);
        $cancellation_request->fulfillment_order_id = 1046000839;
        $cancellation_request->message = "The customer changed his mind.";
        $cancellation_request->save();
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
                  ["fulfillment_order" => ["id" => 1046000840, "shop_id" => 548380009, "order_id" => 450789469, "assigned_location_id" => 24826418, "request_status" => "cancellation_accepted", "status" => "cancelled", "supported_actions" => ["request_fulfillment"], "destination" => ["id" => 1046000824, "address1" => "Chestnut Street 92", "address2" => "", "city" => "Louisville", "company" => null, "country" => "United States", "email" => "bob.norman@mail.example.com", "first_name" => "Bob", "last_name" => "Norman", "phone" => "+1(502)-459-2181", "province" => "Kentucky", "zip" => "40202"], "origin" => ["address1" => null, "address2" => null, "city" => null, "country_code" => "DE", "location_id" => 24826418, "name" => "Apple Api Shipwire", "phone" => null, "province" => null, "zip" => null], "line_items" => [["id" => 1058737580, "shop_id" => 548380009, "fulfillment_order_id" => 1046000840, "quantity" => 1, "line_item_id" => 518995019, "inventory_item_id" => 49148385, "fulfillable_quantity" => 1, "variant_id" => 49148385]], "outgoing_requests" => [], "international_duties" => null, "fulfillment_service_handle" => "shipwire-app"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2025-04/fulfillment_orders/1046000840/cancellation_request/accept.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["cancellation_request" => ["message" => "We had not started any processing yet."]]),
            ),
        ]);

        $cancellation_request = new CancellationRequest($this->test_session);
        $cancellation_request->fulfillment_order_id = 1046000840;
        $cancellation_request->accept(
            [],
            ["cancellation_request" => ["message" => "We had not started any processing yet."]],
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
                  ["fulfillment_order" => ["id" => 1046000838, "shop_id" => 548380009, "order_id" => 450789469, "assigned_location_id" => 24826418, "request_status" => "cancellation_rejected", "status" => "in_progress", "supported_actions" => [], "destination" => ["id" => 1046000822, "address1" => "Chestnut Street 92", "address2" => "", "city" => "Louisville", "company" => null, "country" => "United States", "email" => "bob.norman@mail.example.com", "first_name" => "Bob", "last_name" => "Norman", "phone" => "+1(502)-459-2181", "province" => "Kentucky", "zip" => "40202"], "origin" => ["address1" => null, "address2" => null, "city" => null, "country_code" => "DE", "location_id" => 24826418, "name" => "Apple Api Shipwire", "phone" => null, "province" => null, "zip" => null], "line_items" => [["id" => 1058737578, "shop_id" => 548380009, "fulfillment_order_id" => 1046000838, "quantity" => 1, "line_item_id" => 518995019, "inventory_item_id" => 49148385, "fulfillable_quantity" => 1, "variant_id" => 49148385]], "outgoing_requests" => [], "international_duties" => null, "fulfillment_service_handle" => "shipwire-app"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2025-04/fulfillment_orders/1046000838/cancellation_request/reject.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["cancellation_request" => ["message" => "We have already send the shipment out."]]),
            ),
        ]);

        $cancellation_request = new CancellationRequest($this->test_session);
        $cancellation_request->fulfillment_order_id = 1046000838;
        $cancellation_request->reject(
            [],
            ["cancellation_request" => ["message" => "We have already send the shipment out."]],
        );
    }

}
