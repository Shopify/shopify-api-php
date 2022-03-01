<?php

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\DraftOrder;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class DraftOrder202104Test extends BaseTestCase
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
                "https://test-shop.myshopify.io/admin/api/2021-04/draft_orders.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["draft_order" => ["line_items" => [["variant_id" => 447654529, "quantity" => 1]]]]),
            ),
        ]);

        $draft_order = new DraftOrder($this->test_session);
        $draft_order->line_items = [
            [
                "variant_id" => 447654529,
                "quantity" => 1
            ]
        ];
        $draft_order->save();
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
                "https://test-shop.myshopify.io/admin/api/2021-04/draft_orders.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["draft_order" => ["line_items" => [["title" => "Custom Tee", "price" => "20.00", "quantity" => 2]], "applied_discount" => ["description" => "Custom discount", "value_type" => "fixed_amount", "value" => 10.0, "amount" => "10.00", "title" => "Custom"], "customer" => ["id" => 207119551], "use_customer_default_address" => true]]),
            ),
        ]);

        $draft_order = new DraftOrder($this->test_session);
        $draft_order->line_items = [
            [
                "title" => "Custom Tee",
                "price" => "20.00",
                "quantity" => 2
            ]
        ];
        $draft_order->applied_discount = [
            "description" => "Custom discount",
            "value_type" => "fixed_amount",
            "value" => 10.0,
            "amount" => "10.00",
            "title" => "Custom"
        ];
        $draft_order->customer = [
            "id" => 207119551
        ];
        $draft_order->use_customer_default_address = true;
        $draft_order->save();
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
                "https://test-shop.myshopify.io/admin/api/2021-04/draft_orders.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["draft_order" => ["line_items" => [["title" => "Custom Tee", "price" => "20.00", "quantity" => 1, "applied_discount" => ["description" => "Custom discount", "value_type" => "fixed_amount", "value" => 10.0, "amount" => 10.0, "title" => "Custom"]]]]]),
            ),
        ]);

        $draft_order = new DraftOrder($this->test_session);
        $draft_order->line_items = [
            [
                "title" => "Custom Tee",
                "price" => "20.00",
                "quantity" => 1,
                "applied_discount" => [
                        "description" => "Custom discount",
                        "value_type" => "fixed_amount",
                        "value" => 10.0,
                        "amount" => 10.0,
                        "title" => "Custom"
                    ]
            ]
        ];
        $draft_order->save();
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
                "https://test-shop.myshopify.io/admin/api/2021-04/draft_orders.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["draft_order" => ["line_items" => [["title" => "Custom Tee", "price" => "20.00", "quantity" => 1, "applied_discount" => ["description" => "Custom discount", "value_type" => "percentage", "value" => 10.0, "amount" => 2.0, "title" => "Custom"]]]]]),
            ),
        ]);

        $draft_order = new DraftOrder($this->test_session);
        $draft_order->line_items = [
            [
                "title" => "Custom Tee",
                "price" => "20.00",
                "quantity" => 1,
                "applied_discount" => [
                        "description" => "Custom discount",
                        "value_type" => "percentage",
                        "value" => 10.0,
                        "amount" => 2.0,
                        "title" => "Custom"
                    ]
            ]
        ];
        $draft_order->save();
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
                "https://test-shop.myshopify.io/admin/api/2021-04/draft_orders.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["draft_order" => ["line_items" => [["title" => "Custom Tee", "price" => "20.00", "quantity" => 2]], "customer" => ["id" => 207119551], "use_customer_default_address" => true]]),
            ),
        ]);

        $draft_order = new DraftOrder($this->test_session);
        $draft_order->line_items = [
            [
                "title" => "Custom Tee",
                "price" => "20.00",
                "quantity" => 2
            ]
        ];
        $draft_order->customer = [
            "id" => 207119551
        ];
        $draft_order->use_customer_default_address = true;
        $draft_order->save();
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
                "https://test-shop.myshopify.io/admin/api/2021-04/draft_orders.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        DraftOrder::all(
            $this->test_session,
            [],
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
                "https://test-shop.myshopify.io/admin/api/2021-04/draft_orders/994118539.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["draft_order" => ["id" => 994118539, "note" => "Customer contacted us about a custom engraving on this iPod"]]),
            ),
        ]);

        $draft_order = new DraftOrder($this->test_session);
        $draft_order->id = 994118539;
        $draft_order->note = "Customer contacted us about a custom engraving on this iPod";
        $draft_order->save();
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
                "https://test-shop.myshopify.io/admin/api/2021-04/draft_orders/994118539.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["draft_order" => ["id" => 994118539, "applied_discount" => ["description" => "Custom discount", "value_type" => "percentage", "value" => 10.0, "amount" => "19.90", "title" => "Custom"]]]),
            ),
        ]);

        $draft_order = new DraftOrder($this->test_session);
        $draft_order->id = 994118539;
        $draft_order->applied_discount = [
            "description" => "Custom discount",
            "value_type" => "percentage",
            "value" => 10.0,
            "amount" => "19.90",
            "title" => "Custom"
        ];
        $draft_order->save();
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
                "https://test-shop.myshopify.io/admin/api/2021-04/draft_orders/994118539.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        DraftOrder::find(
            $this->test_session,
            994118539,
            [],
            [],
        );
    }

    /**

     *
     * @return void
     */
    public function test_10(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-04/draft_orders/994118539.json",
                "DELETE",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        DraftOrder::delete(
            $this->test_session,
            994118539,
            [],
            [],
        );
    }

    /**

     *
     * @return void
     */
    public function test_11(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-04/draft_orders/count.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        DraftOrder::count(
            $this->test_session,
            [],
            [],
        );
    }

    /**

     *
     * @return void
     */
    public function test_12(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-04/draft_orders/994118539/send_invoice.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["draft_order_invoice" => ["to" => "first@example.com", "from" => "j.smith@example.com", "bcc" => ["j.smith@example.com"], "subject" => "Apple Computer Invoice", "custom_message" => "Thank you for ordering!"]]),
            ),
        ]);

        $draft_order = new DraftOrder($this->test_session);
        $draft_order->id = 994118539;
        $draft_order->send_invoice(
            [],
            ["draft_order_invoice" => ["to" => "first@example.com", "from" => "j.smith@example.com", "bcc" => ["j.smith@example.com"], "subject" => "Apple Computer Invoice", "custom_message" => "Thank you for ordering!"]],
        );
    }

    /**

     *
     * @return void
     */
    public function test_13(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-04/draft_orders/994118539/send_invoice.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["draft_order_invoice" => []]),
            ),
        ]);

        $draft_order = new DraftOrder($this->test_session);
        $draft_order->id = 994118539;
        $draft_order->send_invoice(
            [],
            ["draft_order_invoice" => []],
        );
    }

    /**

     *
     * @return void
     */
    public function test_14(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-04/draft_orders/994118539/complete.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        $draft_order = new DraftOrder($this->test_session);
        $draft_order->id = 994118539;
        $draft_order->complete(
            [],
        );
    }

    /**

     *
     * @return void
     */
    public function test_15(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-04/draft_orders/994118539/complete.json?payment_pending=true",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        $draft_order = new DraftOrder($this->test_session);
        $draft_order->id = 994118539;
        $draft_order->complete(
            ["payment_pending" => "true"],
        );
    }

}
