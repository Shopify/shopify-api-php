<?php

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Admin2021_07\TenderTransaction;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class TenderTransaction202107Test extends BaseTestCase
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
                $this->buildMockHttpResponse(200, json_encode(
                  ["tender_transactions" => [["id" => 1011222849, "order_id" => 450789469, "amount" => "250.94", "currency" => "USD", "user_id" => null, "test" => false, "processed_at" => "2005-08-07T10:22:51-04:00", "remote_reference" => "authorization-key", "payment_details" => null, "payment_method" => "unknown"], ["id" => 1011222848, "order_id" => 450789469, "amount" => "250.94", "currency" => "USD", "user_id" => null, "test" => false, "processed_at" => "2005-08-05T10:22:51-04:00", "remote_reference" => "authorization-key", "payment_details" => null, "payment_method" => "unknown"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/tender_transactions.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        TenderTransaction::all(
            $this->test_session,
            [],
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
                  ["tender_transactions" => [["id" => 1011222851, "order_id" => 450789469, "amount" => "250.94", "currency" => "USD", "user_id" => null, "test" => false, "processed_at" => "2005-08-07T10:22:51-04:00", "remote_reference" => "authorization-key", "payment_details" => null, "payment_method" => "unknown"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/tender_transactions.json?since_id=1011222850",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        TenderTransaction::all(
            $this->test_session,
            [],
            ["since_id" => "1011222850"],
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
                  ["tender_transactions" => [["id" => 1011222853, "order_id" => 450789469, "amount" => "250.94", "currency" => "USD", "user_id" => null, "test" => false, "processed_at" => "2005-08-07T10:22:51-04:00", "remote_reference" => "authorization-key", "payment_details" => null, "payment_method" => "unknown"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/tender_transactions.json?processed_at_min=2005-08-06+10%3A22%3A51+-0400",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        TenderTransaction::all(
            $this->test_session,
            [],
            ["processed_at_min" => "2005-08-06 10:22:51 -0400"],
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
                  ["tender_transactions" => [["id" => 1011222854, "order_id" => 450789469, "amount" => "250.94", "currency" => "USD", "user_id" => null, "test" => false, "processed_at" => "2005-08-05T10:22:51-04:00", "remote_reference" => "authorization-key", "payment_details" => null, "payment_method" => "unknown"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/tender_transactions.json?processed_at_max=2005-08-06+10%3A22%3A51+-0400",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        TenderTransaction::all(
            $this->test_session,
            [],
            ["processed_at_max" => "2005-08-06 10:22:51 -0400"],
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
                $this->buildMockHttpResponse(200, json_encode(
                  ["tender_transactions" => [["id" => 1011222856, "order_id" => 450789469, "amount" => "250.94", "currency" => "USD", "user_id" => null, "test" => false, "processed_at" => "2005-08-05T10:22:51-04:00", "remote_reference" => "authorization-key", "payment_details" => null, "payment_method" => "unknown"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/tender_transactions.json?processed_at_max=2005-08-05+10%3A22%3A51+-0400",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        TenderTransaction::all(
            $this->test_session,
            [],
            ["processed_at_max" => "2005-08-05 10:22:51 -0400"],
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
                $this->buildMockHttpResponse(200, json_encode(
                  ["tender_transactions" => [["id" => 1011222858, "order_id" => 450789469, "amount" => "250.94", "currency" => "USD", "user_id" => null, "test" => false, "processed_at" => "2005-08-05T10:22:51-04:00", "remote_reference" => "authorization-key", "payment_details" => null, "payment_method" => "unknown"], ["id" => 1011222859, "order_id" => 450789469, "amount" => "250.94", "currency" => "USD", "user_id" => null, "test" => false, "processed_at" => "2005-08-07T10:22:51-04:00", "remote_reference" => "authorization-key", "payment_details" => null, "payment_method" => "unknown"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/tender_transactions.json?order=processed_at+ASC",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        TenderTransaction::all(
            $this->test_session,
            [],
            ["order" => "processed_at ASC"],
        );
    }

}
