<?php

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\FulfillmentOrder;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class FulfillmentOrderUnstableTest extends BaseTestCase
{
    /** @var Session */
    private $test_session;

    public function setUp(): void
    {
        parent::setUp();

        Context::$API_VERSION = "unstable";

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
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/unstable/orders/450789469/fulfillment_orders.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        FulfillmentOrder::all(
            $this->test_session,
            ["order_id" => 450789469],
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
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/unstable/fulfillment_orders/1046000847.json",
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
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/unstable/fulfillment_orders/1046000848/cancel.json",
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
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/unstable/fulfillment_orders/1046000851/close.json",
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
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/unstable/fulfillment_orders/1046000852/move.json",
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
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/unstable/fulfillment_orders/1046000854/open.json",
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
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/unstable/fulfillment_orders/1046000855/reschedule.json",
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
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/unstable/fulfillment_orders/1046000856/hold.json",
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
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/unstable/fulfillment_orders/1046000858/release_hold.json",
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
