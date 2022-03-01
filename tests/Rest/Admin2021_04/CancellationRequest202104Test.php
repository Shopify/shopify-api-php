<?php

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\CancellationRequest;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class CancellationRequest202104Test extends BaseTestCase
{
    /** @var Session */
    private $test_session;

    public function setUp(): void
    {
        parent::setUp();

        Context::$API_VERSION = "2021-04";

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
                "https://test-shop.myshopify.io/admin/api/2021-04/fulfillment_orders/1046000837/cancellation_request.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["cancellation_request" => ["message" => "The customer changed his mind."]]),
            ),
        ]);

        $cancellation_request = new CancellationRequest($this->test_session);
        $cancellation_request->fulfillment_order_id = 1046000837;
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
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-04/fulfillment_orders/1046000838/cancellation_request/accept.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["cancellation_request" => ["message" => "We had not started any processing yet."]]),
            ),
        ]);

        $cancellation_request = new CancellationRequest($this->test_session);
        $cancellation_request->fulfillment_order_id = 1046000838;
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
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-04/fulfillment_orders/1046000839/cancellation_request/reject.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["cancellation_request" => ["message" => "We have already send the shipment out."]]),
            ),
        ]);

        $cancellation_request = new CancellationRequest($this->test_session);
        $cancellation_request->fulfillment_order_id = 1046000839;
        $cancellation_request->reject(
            [],
            ["cancellation_request" => ["message" => "We have already send the shipment out."]],
        );
    }

}
