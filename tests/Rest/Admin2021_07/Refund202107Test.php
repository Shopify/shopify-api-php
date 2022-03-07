<?php

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Refund;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class Refund202107Test extends BaseTestCase
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
                "https://test-shop.myshopify.io/admin/api/2021-07/orders/450789469/refunds.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Refund::all(
            $this->test_session,
            ["order_id" => "450789469"],
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
                "https://test-shop.myshopify.io/admin/api/2021-07/orders/450789469/refunds.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["refund" => ["currency" => "USD", "notify" => true, "note" => "wrong size", "shipping" => ["full_refund" => true], "refund_line_items" => [["line_item_id" => 518995019, "quantity" => 1, "restock_type" => "return", "location_id" => 487838322]], "transactions" => [["parent_id" => 801038806, "amount" => 41.94, "kind" => "refund", "gateway" => "bogus"]]]]),
            ),
        ]);

        $refund = new Refund($this->test_session);
        $refund->order_id = 450789469;
        $refund->currency = "USD";
        $refund->notify = true;
        $refund->note = "wrong size";
        $refund->shipping = [
            "full_refund" => true
        ];
        $refund->refund_line_items = [
            [
                "line_item_id" => 518995019,
                "quantity" => 1,
                "restock_type" => "return",
                "location_id" => 487838322
            ]
        ];
        $refund->transactions = [
            [
                "parent_id" => 801038806,
                "amount" => 41.94,
                "kind" => "refund",
                "gateway" => "bogus"
            ]
        ];
        $refund->save();
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
                "https://test-shop.myshopify.io/admin/api/2021-07/orders/450789469/refunds.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["refund" => ["currency" => "USD", "shipping" => ["amount" => 5.0], "transactions" => [["parent_id" => 801038806, "amount" => 5.0, "kind" => "refund", "gateway" => "bogus"]]]]),
            ),
        ]);

        $refund = new Refund($this->test_session);
        $refund->order_id = 450789469;
        $refund->currency = "USD";
        $refund->shipping = [
            "amount" => 5.0
        ];
        $refund->transactions = [
            [
                "parent_id" => 801038806,
                "amount" => 5.0,
                "kind" => "refund",
                "gateway" => "bogus"
            ]
        ];
        $refund->save();
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
                "https://test-shop.myshopify.io/admin/api/2021-07/orders/450789469/refunds/509562969.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Refund::find(
            $this->test_session,
            509562969,
            ["order_id" => "450789469"],
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
                "https://test-shop.myshopify.io/admin/api/2021-07/orders/450789469/refunds/calculate.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["refund" => ["shipping" => ["full_refund" => true], "refund_line_items" => [["line_item_id" => 518995019, "quantity" => 1, "restock_type" => "no_restock"]]]]),
            ),
        ]);

        $refund = new Refund($this->test_session);
        $refund->order_id = 450789469;
        $refund->calculate(
            [],
            ["refund" => ["shipping" => ["full_refund" => true], "refund_line_items" => [["line_item_id" => 518995019, "quantity" => 1, "restock_type" => "no_restock"]]]],
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
                "https://test-shop.myshopify.io/admin/api/2021-07/orders/450789469/refunds/calculate.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["refund" => ["currency" => "USD", "shipping" => ["full_refund" => true], "refund_line_items" => [["line_item_id" => 518995019, "quantity" => 1, "restock_type" => "no_restock"]]]]),
            ),
        ]);

        $refund = new Refund($this->test_session);
        $refund->order_id = 450789469;
        $refund->calculate(
            [],
            ["refund" => ["currency" => "USD", "shipping" => ["full_refund" => true], "refund_line_items" => [["line_item_id" => 518995019, "quantity" => 1, "restock_type" => "no_restock"]]]],
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
                "https://test-shop.myshopify.io/admin/api/2021-07/orders/450789469/refunds/calculate.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["refund" => ["currency" => "USD", "shipping" => ["amount" => 2.0]]]),
            ),
        ]);

        $refund = new Refund($this->test_session);
        $refund->order_id = 450789469;
        $refund->calculate(
            [],
            ["refund" => ["currency" => "USD", "shipping" => ["amount" => 2.0]]],
        );
    }

}
