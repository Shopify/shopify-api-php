<?php

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\FulfillmentRequest;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class FulfillmentRequest202107Test extends BaseTestCase
{
    /** @var Session */
    private $test_session;

    public function setUp(): void
    {
        parent::setUp();

        Context::$API_VERSION = "2021-07";

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
                "https://test-shop.myshopify.io/admin/api/2021-07/fulfillment_orders/1046000840/fulfillment_request.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["fulfillment_request" => ["message" => "Fulfill this ASAP please.", "fulfillment_order_line_items" => [["id" => 1058737578, "quantity" => 1], ["id" => 1058737579, "quantity" => 1]]]]),
            ),
        ]);

        $fulfillment_request = new FulfillmentRequest($this->test_session);
        $fulfillment_request->fulfillment_order_id = 1046000840;
        $fulfillment_request->message = "Fulfill this ASAP please.";
        $fulfillment_request->fulfillment_order_line_items = [
            [
                "id" => 1058737578,
                "quantity" => 1
            ],
            [
                "id" => 1058737579,
                "quantity" => 1
            ]
        ];
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
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-07/fulfillment_orders/1046000843/fulfillment_request.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["fulfillment_request" => ["message" => "Fulfill this ASAP please."]]),
            ),
        ]);

        $fulfillment_request = new FulfillmentRequest($this->test_session);
        $fulfillment_request->fulfillment_order_id = 1046000843;
        $fulfillment_request->message = "Fulfill this ASAP please.";
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
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-07/fulfillment_orders/1046000844/fulfillment_request/accept.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["fulfillment_request" => ["message" => "We will start processing your fulfillment on the next business day."]]),
            ),
        ]);

        $fulfillment_request = new FulfillmentRequest($this->test_session);
        $fulfillment_request->fulfillment_order_id = 1046000844;
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
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-07/fulfillment_orders/1046000845/fulfillment_request/reject.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["fulfillment_request" => ["message" => "Not enough inventory on hand to complete the work."]]),
            ),
        ]);

        $fulfillment_request = new FulfillmentRequest($this->test_session);
        $fulfillment_request->fulfillment_order_id = 1046000845;
        $fulfillment_request->reject(
            [],
            ["fulfillment_request" => ["message" => "Not enough inventory on hand to complete the work."]],
        );
    }

}
