<?php

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\OrderRisk;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class OrderRiskUnstableTest extends BaseTestCase
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
                "https://test-shop.myshopify.io/admin/api/unstable/orders/450789469/risks.json",
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
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/unstable/orders/450789469/risks.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        OrderRisk::all(
            $this->test_session,
            ["order_id" => 450789469],
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
                "https://test-shop.myshopify.io/admin/api/unstable/orders/450789469/risks/284138680.json",
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
            ["order_id" => 450789469],
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
                "https://test-shop.myshopify.io/admin/api/unstable/orders/450789469/risks/284138680.json",
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
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/unstable/orders/450789469/risks/284138680.json",
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
            ["order_id" => 450789469],
            [],
        );
    }

}
