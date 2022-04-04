<?php

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Admin2021_10\OrderRisk;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class OrderRisk202110Test extends BaseTestCase
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
                  ["risk" => ["id" => 1029151489, "order_id" => 450789469, "checkout_id" => 901414060, "source" => "External", "score" => "1.0", "recommendation" => "cancel", "display" => true, "cause_cancel" => true, "message" => "This order came from an anonymous proxy", "merchant_message" => "This order came from an anonymous proxy"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-10/orders/450789469/risks.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["risk" => ["message" => "This order came from an anonymous proxy", "recommendation" => "cancel", "score" => 1.0, "source" => "External", "cause_cancel" => true, "display" => true]]),
            ),
        ]);

        $order_risk = new OrderRisk($this->test_session);
        $order_risk->order_id = 450789469;
        $order_risk->message = "This order came from an anonymous proxy";
        $order_risk->recommendation = "cancel";
        $order_risk->score = 1.0;
        $order_risk->source = "External";
        $order_risk->cause_cancel = true;
        $order_risk->display = true;
        $order_risk->save();
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
                  ["risks" => [["id" => 284138680, "order_id" => 450789469, "checkout_id" => null, "source" => "External", "score" => "1.0", "recommendation" => "cancel", "display" => true, "cause_cancel" => true, "message" => "This order was placed from a proxy IP", "merchant_message" => "This order was placed from a proxy IP"], ["id" => 1029151491, "order_id" => 450789469, "checkout_id" => 901414060, "source" => "External", "score" => "1.0", "recommendation" => "cancel", "display" => true, "cause_cancel" => true, "message" => "This order came from an anonymous proxy", "merchant_message" => "This order came from an anonymous proxy"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-10/orders/450789469/risks.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        OrderRisk::all(
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
                  ["risk" => ["id" => 284138680, "order_id" => 450789469, "checkout_id" => null, "source" => "External", "score" => "1.0", "recommendation" => "cancel", "display" => true, "cause_cancel" => true, "message" => "This order was placed from a proxy IP", "merchant_message" => "This order was placed from a proxy IP"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-10/orders/450789469/risks/284138680.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        OrderRisk::find(
            $this->test_session,
            284138680,
            ["order_id" => "450789469"],
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
                  ["risk" => ["order_id" => 450789469, "cause_cancel" => false, "message" => "After further review, this is a legitimate order", "recommendation" => "accept", "score" => "0.0", "source" => "External", "id" => 284138680, "checkout_id" => null, "display" => true, "merchant_message" => "After further review, this is a legitimate order"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-10/orders/450789469/risks/284138680.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["risk" => ["id" => 284138680, "message" => "After further review, this is a legitimate order", "recommendation" => "accept", "source" => "External", "cause_cancel" => false, "score" => 0.0]]),
            ),
        ]);

        $order_risk = new OrderRisk($this->test_session);
        $order_risk->order_id = 450789469;
        $order_risk->id = 284138680;
        $order_risk->message = "After further review, this is a legitimate order";
        $order_risk->recommendation = "accept";
        $order_risk->source = "External";
        $order_risk->cause_cancel = false;
        $order_risk->score = 0.0;
        $order_risk->save();
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
                  []
                )),
                "https://test-shop.myshopify.io/admin/api/2021-10/orders/450789469/risks/284138680.json",
                "DELETE",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        OrderRisk::delete(
            $this->test_session,
            284138680,
            ["order_id" => "450789469"],
            [],
        );
    }

}
