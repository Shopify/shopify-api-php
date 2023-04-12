<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Admin2023_04\FulfillmentEvent;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class FulfillmentEvent202304Test extends BaseTestCase
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
                  ["fulfillment_events" => [["id" => 944956391, "fulfillment_id" => 255858046, "status" => "in_transit", "message" => null, "happened_at" => "2023-04-04T17:41:01-04:00", "city" => null, "province" => null, "country" => null, "zip" => null, "address1" => null, "latitude" => null, "longitude" => null, "shop_id" => 548380009, "created_at" => "2023-04-04T17:41:01-04:00", "updated_at" => "2023-04-04T17:41:01-04:00", "estimated_delivery_at" => null, "order_id" => 450789469, "admin_graphql_api_id" => "gid://shopify/FulfillmentEvent/944956391"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2023-04/orders/450789469/fulfillments/255858046/events.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        FulfillmentEvent::all(
            $this->test_session,
            ["order_id" => "450789469", "fulfillment_id" => "255858046"],
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
                  ["fulfillment_event" => ["id" => 944956392, "fulfillment_id" => 255858046, "status" => "in_transit", "message" => null, "happened_at" => "2023-04-04T17:41:03-04:00", "city" => null, "province" => null, "country" => null, "zip" => null, "address1" => null, "latitude" => null, "longitude" => null, "shop_id" => 548380009, "created_at" => "2023-04-04T17:41:03-04:00", "updated_at" => "2023-04-04T17:41:03-04:00", "estimated_delivery_at" => null, "order_id" => 450789469, "admin_graphql_api_id" => "gid://shopify/FulfillmentEvent/944956392"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2023-04/orders/450789469/fulfillments/255858046/events.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["event" => ["status" => "in_transit"]]),
            ),
        ]);

        $fulfillment_event = new FulfillmentEvent($this->test_session);
        $fulfillment_event->order_id = 450789469;
        $fulfillment_event->fulfillment_id = 255858046;
        $fulfillment_event->status = "in_transit";
        $fulfillment_event->save();
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
                  ["fulfillment_event" => ["id" => 944956393, "fulfillment_id" => 255858046, "status" => "in_transit", "message" => null, "happened_at" => "2023-04-04T17:41:03-04:00", "city" => null, "province" => null, "country" => null, "zip" => null, "address1" => null, "latitude" => null, "longitude" => null, "shop_id" => 548380009, "created_at" => "2023-04-04T17:41:03-04:00", "updated_at" => "2023-04-04T17:41:03-04:00", "estimated_delivery_at" => null, "order_id" => 450789469, "admin_graphql_api_id" => "gid://shopify/FulfillmentEvent/944956393"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2023-04/orders/450789469/fulfillments/255858046/events/944956393.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        FulfillmentEvent::find(
            $this->test_session,
            944956393,
            ["order_id" => "450789469", "fulfillment_id" => "255858046"],
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
                  []
                )),
                "https://test-shop.myshopify.io/admin/api/2023-04/orders/450789469/fulfillments/255858046/events/944956394.json",
                "DELETE",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        FulfillmentEvent::delete(
            $this->test_session,
            944956394,
            ["order_id" => "450789469", "fulfillment_id" => "255858046"],
            [],
        );
    }

}
