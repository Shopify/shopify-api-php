<?php

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Transaction;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class Transaction202107Test extends BaseTestCase
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
                "https://test-shop.myshopify.io/admin/api/2021-07/orders/450789469/transactions.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Transaction::all(
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
                "https://test-shop.myshopify.io/admin/api/2021-07/orders/450789469/transactions.json?since_id=801038806",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Transaction::all(
            $this->test_session,
            ["order_id" => 450789469],
            ["since_id" => 801038806],
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
                "https://test-shop.myshopify.io/admin/api/2021-07/orders/450789469/transactions.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["transaction" => ["currency" => "USD", "amount" => "10.00", "kind" => "capture", "parent_id" => 389404469]]),
            ),
        ]);

        $transaction = new Transaction($this->test_session);
        $transaction->order_id = 450789469;
        $transaction->currency = "USD";
        $transaction->amount = "10.00";
        $transaction->kind = "capture";
        $transaction->parent_id = 389404469;
        $transaction->save();
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
                "https://test-shop.myshopify.io/admin/api/2021-07/orders/450789469/transactions.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["transaction" => ["currency" => "USD", "amount" => "10.00", "kind" => "void", "parent_id" => 389404469]]),
            ),
        ]);

        $transaction = new Transaction($this->test_session);
        $transaction->order_id = 450789469;
        $transaction->currency = "USD";
        $transaction->amount = "10.00";
        $transaction->kind = "void";
        $transaction->parent_id = 389404469;
        $transaction->save();
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
                "https://test-shop.myshopify.io/admin/api/2021-07/orders/450789469/transactions.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["transaction" => ["currency" => "USD", "amount" => "10.00", "kind" => "capture", "parent_id" => 389404469, "test" => true]]),
            ),
        ]);

        $transaction = new Transaction($this->test_session);
        $transaction->order_id = 450789469;
        $transaction->currency = "USD";
        $transaction->amount = "10.00";
        $transaction->kind = "capture";
        $transaction->parent_id = 389404469;
        $transaction->test = true;
        $transaction->save();
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
                "https://test-shop.myshopify.io/admin/api/2021-07/orders/450789469/transactions.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["transaction" => ["kind" => "capture", "authorization" => "authorization-key"]]),
            ),
        ]);

        $transaction = new Transaction($this->test_session);
        $transaction->order_id = 450789469;
        $transaction->kind = "capture";
        $transaction->authorization = "authorization-key";
        $transaction->save();
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
                "https://test-shop.myshopify.io/admin/api/2021-07/orders/450789469/transactions/count.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Transaction::count(
            $this->test_session,
            ["order_id" => 450789469],
            [],
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
                "https://test-shop.myshopify.io/admin/api/2021-07/orders/450789469/transactions/389404469.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Transaction::find(
            $this->test_session,
            389404469,
            ["order_id" => 450789469],
            [],
        );
    }

}
