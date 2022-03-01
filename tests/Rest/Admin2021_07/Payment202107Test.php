<?php

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Payment;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class Payment202107Test extends BaseTestCase
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
                "https://test-shop.myshopify.io/admin/api/2021-07/checkouts/7yjf4v2we7gamku6a6h7tvm8h3mmvs4x/payments.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["payment" => ["request_details" => ["ip_address" => "123.1.1.1", "accept_language" => "en-US,en;q=0.8,fr;q=0.6", "user_agent" => "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.98 Safari/537.36"], "amount" => "398.00", "session_id" => "global-4f10a3a42a3b4d41", "unique_token" => "client-side-idempotency-token"]]),
            ),
        ]);

        $payment = new Payment($this->test_session);
        $payment->checkout_id = "7yjf4v2we7gamku6a6h7tvm8h3mmvs4x";
        $payment->request_details = [
            "ip_address" => "123.1.1.1",
            "accept_language" => "en-US,en;q=0.8,fr;q=0.6",
            "user_agent" => "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.98 Safari/537.36"
        ];
        $payment->amount = "398.00";
        $payment->session_id = "global-4f10a3a42a3b4d41";
        $payment->unique_token = "client-side-idempotency-token";
        $payment->save();
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
                "https://test-shop.myshopify.io/admin/api/2021-07/checkouts/7yjf4v2we7gamku6a6h7tvm8h3mmvs4x/payments.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Payment::all(
            $this->test_session,
            ["checkout_id" => "7yjf4v2we7gamku6a6h7tvm8h3mmvs4x"],
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
                "https://test-shop.myshopify.io/admin/api/2021-07/checkouts/7yjf4v2we7gamku6a6h7tvm8h3mmvs4x/payments/25428999.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Payment::find(
            $this->test_session,
            25428999,
            ["checkout_id" => "7yjf4v2we7gamku6a6h7tvm8h3mmvs4x"],
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
                "https://test-shop.myshopify.io/admin/api/2021-07/checkouts/7yjf4v2we7gamku6a6h7tvm8h3mmvs4x/payments/25428999.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Payment::find(
            $this->test_session,
            25428999,
            ["checkout_id" => "7yjf4v2we7gamku6a6h7tvm8h3mmvs4x"],
            [],
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
                "https://test-shop.myshopify.io/admin/api/2021-07/checkouts/7yjf4v2we7gamku6a6h7tvm8h3mmvs4x/payments/count.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Payment::count(
            $this->test_session,
            ["checkout_id" => "7yjf4v2we7gamku6a6h7tvm8h3mmvs4x"],
            [],
        );
    }

}
