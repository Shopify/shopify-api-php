<?php

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Order;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class Order202110Test extends BaseTestCase
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
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-10/orders.json?status=any",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Order::all(
            $this->test_session,
            [],
            ["status" => "any"],
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
                "https://test-shop.myshopify.io/admin/api/2021-10/orders.json?ids=1073459980",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Order::all(
            $this->test_session,
            [],
            ["ids" => 1073459980],
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
                "https://test-shop.myshopify.io/admin/api/2021-10/orders.json?financial_status=authorized",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Order::all(
            $this->test_session,
            [],
            ["financial_status" => "authorized"],
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
                "https://test-shop.myshopify.io/admin/api/2021-10/orders.json?updated_at_min=2005-07-31T15%3A57%3A11-04%3A00",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Order::all(
            $this->test_session,
            [],
            ["updated_at_min" => "2005-07-31T15:57:11-04:00"],
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
                "https://test-shop.myshopify.io/admin/api/2021-10/orders.json?fields=created_at%2Cid%2Cname%2Ctotal-price",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Order::all(
            $this->test_session,
            [],
            ["fields" => "created_at,id,name,total-price"],
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
                "https://test-shop.myshopify.io/admin/api/2021-10/orders.json?since_id=123",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Order::all(
            $this->test_session,
            [],
            ["since_id" => 123],
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
                "https://test-shop.myshopify.io/admin/api/2021-10/orders/450789469.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Order::find(
            $this->test_session,
            450789469,
            [],
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
                "https://test-shop.myshopify.io/admin/api/2021-10/orders/450789469.json?fields=id%2Cline_items%2Cname%2Ctotal_price",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Order::find(
            $this->test_session,
            450789469,
            [],
            ["fields" => "id,line_items,name,total_price"],
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
                "https://test-shop.myshopify.io/admin/api/2021-10/orders/450789469.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["order" => ["id" => 450789469, "note" => "Customer contacted us about a custom engraving on this iPod"]]),
            ),
        ]);

        $order = new Order($this->test_session);
        $order->id = 450789469;
        $order->note = "Customer contacted us about a custom engraving on this iPod";
        $order->save();
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
                "https://test-shop.myshopify.io/admin/api/2021-10/orders/450789469.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["order" => ["id" => 450789469, "note_attributes" => [["name" => "colour", "value" => "red"]]]]),
            ),
        ]);

        $order = new Order($this->test_session);
        $order->id = 450789469;
        $order->note_attributes = [
            [
                "name" => "colour",
                "value" => "red"
            ]
        ];
        $order->save();
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
                "https://test-shop.myshopify.io/admin/api/2021-10/orders/450789469.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["order" => ["id" => 450789469, "email" => "a-different@email.com"]]),
            ),
        ]);

        $order = new Order($this->test_session);
        $order->id = 450789469;
        $order->email = "a-different@email.com";
        $order->save();
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
                "https://test-shop.myshopify.io/admin/api/2021-10/orders/450789469.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["order" => ["id" => 450789469, "phone" => " 15145556677"]]),
            ),
        ]);

        $order = new Order($this->test_session);
        $order->id = 450789469;
        $order->phone = " 15145556677";
        $order->save();
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
                "https://test-shop.myshopify.io/admin/api/2021-10/orders/450789469.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["order" => ["id" => 450789469, "buyer_accepts_marketing" => true]]),
            ),
        ]);

        $order = new Order($this->test_session);
        $order->id = 450789469;
        $order->buyer_accepts_marketing = true;
        $order->save();
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
                "https://test-shop.myshopify.io/admin/api/2021-10/orders/450789469.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["order" => ["id" => 450789469, "shipping_address" => ["address1" => "123 Ship Street", "city" => "Shipsville"]]]),
            ),
        ]);

        $order = new Order($this->test_session);
        $order->id = 450789469;
        $order->shipping_address = [
            "address1" => "123 Ship Street",
            "city" => "Shipsville"
        ];
        $order->save();
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
                "https://test-shop.myshopify.io/admin/api/2021-10/orders/450789469.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["order" => ["id" => 450789469, "customer" => null]]),
            ),
        ]);

        $order = new Order($this->test_session);
        $order->id = 450789469;
        $order->customer = null;
        $order->save();
    }

    /**

     *
     * @return void
     */
    public function test_16(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-10/orders/450789469.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["order" => ["id" => 450789469, "tags" => "External, Inbound, Outbound"]]),
            ),
        ]);

        $order = new Order($this->test_session);
        $order->id = 450789469;
        $order->tags = "External, Inbound, Outbound";
        $order->save();
    }

    /**

     *
     * @return void
     */
    public function test_17(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-10/orders/450789469.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["order" => ["id" => 450789469, "metafields" => [["key" => "new", "value" => "newvalue", "type" => "single_line_text_field", "namespace" => "global"]]]]),
            ),
        ]);

        $order = new Order($this->test_session);
        $order->id = 450789469;
        $order->metafields = [
            [
                "key" => "new",
                "value" => "newvalue",
                "type" => "single_line_text_field",
                "namespace" => "global"
            ]
        ];
        $order->save();
    }

    /**

     *
     * @return void
     */
    public function test_18(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-10/orders/450789469.json",
                "DELETE",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Order::delete(
            $this->test_session,
            450789469,
            [],
            [],
        );
    }

    /**

     *
     * @return void
     */
    public function test_19(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-10/orders/count.json?status=any",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Order::count(
            $this->test_session,
            [],
            ["status" => "any"],
        );
    }

    /**

     *
     * @return void
     */
    public function test_20(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-10/orders/count.json?financial_status=authorized",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Order::count(
            $this->test_session,
            [],
            ["financial_status" => "authorized"],
        );
    }

    /**

     *
     * @return void
     */
    public function test_21(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-10/orders/450789469/close.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        $order = new Order($this->test_session);
        $order->id = 450789469;
        $order->close(
            [],
        );
    }

    /**

     *
     * @return void
     */
    public function test_22(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-10/orders/450789469/open.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        $order = new Order($this->test_session);
        $order->id = 450789469;
        $order->open(
            [],
        );
    }

    /**

     *
     * @return void
     */
    public function test_23(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-10/orders/450789469/cancel.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        $order = new Order($this->test_session);
        $order->id = 450789469;
        $order->cancel(
            [],
        );
    }

    /**

     *
     * @return void
     */
    public function test_24(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-10/orders/450789469/cancel.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["amount" => "10.00", "currency" => "USD"]),
            ),
        ]);

        $order = new Order($this->test_session);
        $order->id = 450789469;
        $order->cancel(
            [],
            ["amount" => "10.00", "currency" => "USD"],
        );
    }

    /**

     *
     * @return void
     */
    public function test_25(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-10/orders/450789469/cancel.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["refund" => ["note" => "Customer made a mistake", "shipping" => ["full_refund" => true], "refund_line_items" => [["line_item_id" => 466157049, "quantity" => 1, "restock_type" => "cancel", "location_id" => 24826418]], "transactions" => [["parent_id" => 1068278509, "amount" => "10.00", "kind" => "refund", "gateway" => "bogus"], ["parent_id" => 1068278510, "amount" => "100.00", "kind" => "refund", "gateway" => "gift_card"]]]]),
            ),
        ]);

        $order = new Order($this->test_session);
        $order->id = 450789469;
        $order->cancel(
            [],
            ["refund" => ["note" => "Customer made a mistake", "shipping" => ["full_refund" => true], "refund_line_items" => [["line_item_id" => 466157049, "quantity" => 1, "restock_type" => "cancel", "location_id" => 24826418]], "transactions" => [["parent_id" => 1068278509, "amount" => "10.00", "kind" => "refund", "gateway" => "bogus"], ["parent_id" => 1068278510, "amount" => "100.00", "kind" => "refund", "gateway" => "gift_card"]]]],
        );
    }

    /**

     *
     * @return void
     */
    public function test_26(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-10/orders.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["order" => ["line_items" => [["variant_id" => 447654529, "quantity" => 1]]]]),
            ),
        ]);

        $order = new Order($this->test_session);
        $order->line_items = [
            [
                "variant_id" => 447654529,
                "quantity" => 1
            ]
        ];
        $order->save();
    }

    /**

     *
     * @return void
     */
    public function test_27(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-10/orders.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["order" => ["email" => "foo@example.com", "fulfillment_status" => "fulfilled", "send_receipt" => true, "send_fulfillment_receipt" => true, "line_items" => [["variant_id" => 457924702, "quantity" => 1]]]]),
            ),
        ]);

        $order = new Order($this->test_session);
        $order->email = "foo@example.com";
        $order->fulfillment_status = "fulfilled";
        $order->send_receipt = true;
        $order->send_fulfillment_receipt = true;
        $order->line_items = [
            [
                "variant_id" => 457924702,
                "quantity" => 1
            ]
        ];
        $order->save();
    }

    /**

     *
     * @return void
     */
    public function test_28(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-10/orders.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["order" => ["email" => "foo@example.com", "fulfillment_status" => "fulfilled", "line_items" => [["variant_id" => 447654529, "quantity" => 1]]]]),
            ),
        ]);

        $order = new Order($this->test_session);
        $order->email = "foo@example.com";
        $order->fulfillment_status = "fulfilled";
        $order->line_items = [
            [
                "variant_id" => 447654529,
                "quantity" => 1
            ]
        ];
        $order->save();
    }

    /**

     *
     * @return void
     */
    public function test_29(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-10/orders.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["order" => ["email" => "foo@example.com", "fulfillment_status" => "fulfilled", "fulfillments" => [["location_id" => 24826418]], "line_items" => [["variant_id" => 447654529, "quantity" => 1]]]]),
            ),
        ]);

        $order = new Order($this->test_session);
        $order->email = "foo@example.com";
        $order->fulfillment_status = "fulfilled";
        $order->fulfillments = [
            [
                "location_id" => 24826418
            ]
        ];
        $order->line_items = [
            [
                "variant_id" => 447654529,
                "quantity" => 1
            ]
        ];
        $order->save();
    }

    /**

     *
     * @return void
     */
    public function test_30(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-10/orders.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["order" => ["line_items" => [["title" => "Big Brown Bear Boots", "price" => 74.99, "grams" => 1300, "quantity" => 3, "tax_lines" => [["price" => 13.5, "rate" => 0.06, "title" => "State tax"]]]], "transactions" => [["kind" => "sale", "status" => "success", "amount" => 238.47]], "total_tax" => 13.5, "currency" => "EUR"]]),
            ),
        ]);

        $order = new Order($this->test_session);
        $order->line_items = [
            [
                "title" => "Big Brown Bear Boots",
                "price" => 74.99,
                "grams" => 1300,
                "quantity" => 3,
                "tax_lines" => [
                        [
                                    "price" => 13.5,
                                    "rate" => 0.06,
                                    "title" => "State tax"
                                ]
                    ]
            ]
        ];
        $order->transactions = [
            [
                "kind" => "sale",
                "status" => "success",
                "amount" => 238.47
            ]
        ];
        $order->total_tax = 13.5;
        $order->currency = "EUR";
        $order->save();
    }

    /**

     *
     * @return void
     */
    public function test_31(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-10/orders.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["order" => ["line_items" => [["title" => "Red Leather Coat", "price" => 129.99, "grams" => 1700, "quantity" => 1], ["title" => "Blue Suede Shoes", "price" => 85.95, "grams" => 750, "quantity" => 1, "taxable" => false], ["title" => "Raspberry Beret", "price" => 19.99, "grams" => 320, "quantity" => 2]], "tax_lines" => [["price" => 10.2, "rate" => 0.06, "title" => "State tax"], ["price" => 4.25, "rate" => 0.025, "title" => "County tax"]], "total_tax" => 14.45]]),
            ),
        ]);

        $order = new Order($this->test_session);
        $order->line_items = [
            [
                "title" => "Red Leather Coat",
                "price" => 129.99,
                "grams" => 1700,
                "quantity" => 1
            ],
            [
                "title" => "Blue Suede Shoes",
                "price" => 85.95,
                "grams" => 750,
                "quantity" => 1,
                "taxable" => false
            ],
            [
                "title" => "Raspberry Beret",
                "price" => 19.99,
                "grams" => 320,
                "quantity" => 2
            ]
        ];
        $order->tax_lines = [
            [
                "price" => 10.2,
                "rate" => 0.06,
                "title" => "State tax"
            ],
            [
                "price" => 4.25,
                "rate" => 0.025,
                "title" => "County tax"
            ]
        ];
        $order->total_tax = 14.45;
        $order->save();
    }

    /**

     *
     * @return void
     */
    public function test_32(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-10/orders.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["order" => ["line_items" => [["variant_id" => 447654529, "quantity" => 1]], "customer" => ["id" => 207119551], "financial_status" => "pending"]]),
            ),
        ]);

        $order = new Order($this->test_session);
        $order->line_items = [
            [
                "variant_id" => 447654529,
                "quantity" => 1
            ]
        ];
        $order->customer = [
            "id" => 207119551
        ];
        $order->financial_status = "pending";
        $order->save();
    }

    /**

     *
     * @return void
     */
    public function test_33(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-10/orders.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["order" => ["line_items" => [["variant_id" => 447654529, "quantity" => 1]], "customer" => ["first_name" => "Paul", "last_name" => "Norman", "email" => "paul.norman@example.com"], "billing_address" => ["first_name" => "John", "last_name" => "Smith", "address1" => "123 Fake Street", "phone" => "555-555-5555", "city" => "Fakecity", "province" => "Ontario", "country" => "Canada", "zip" => "K2P 1L4"], "shipping_address" => ["first_name" => "Jane", "last_name" => "Smith", "address1" => "123 Fake Street", "phone" => "777-777-7777", "city" => "Fakecity", "province" => "Ontario", "country" => "Canada", "zip" => "K2P 1L4"], "email" => "jane@example.com", "transactions" => [["kind" => "authorization", "status" => "success", "amount" => 50.0]], "financial_status" => "partially_paid"]]),
            ),
        ]);

        $order = new Order($this->test_session);
        $order->line_items = [
            [
                "variant_id" => 447654529,
                "quantity" => 1
            ]
        ];
        $order->customer = [
            "first_name" => "Paul",
            "last_name" => "Norman",
            "email" => "paul.norman@example.com"
        ];
        $order->billing_address = [
            "first_name" => "John",
            "last_name" => "Smith",
            "address1" => "123 Fake Street",
            "phone" => "555-555-5555",
            "city" => "Fakecity",
            "province" => "Ontario",
            "country" => "Canada",
            "zip" => "K2P 1L4"
        ];
        $order->shipping_address = [
            "first_name" => "Jane",
            "last_name" => "Smith",
            "address1" => "123 Fake Street",
            "phone" => "777-777-7777",
            "city" => "Fakecity",
            "province" => "Ontario",
            "country" => "Canada",
            "zip" => "K2P 1L4"
        ];
        $order->email = "jane@example.com";
        $order->transactions = [
            [
                "kind" => "authorization",
                "status" => "success",
                "amount" => 50.0
            ]
        ];
        $order->financial_status = "partially_paid";
        $order->save();
    }

    /**

     *
     * @return void
     */
    public function test_34(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-10/orders.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["order" => ["line_items" => [["variant_id" => 447654529, "quantity" => 1]], "email" => "jane@example.com", "phone" => 18885551234, "billing_address" => ["first_name" => "John", "last_name" => "Smith", "address1" => "123 Fake Street", "phone" => "555-555-5555", "city" => "Fakecity", "province" => "Ontario", "country" => "Canada", "zip" => "K2P 1L4"], "shipping_address" => ["first_name" => "Jane", "last_name" => "Smith", "address1" => "123 Fake Street", "phone" => "777-777-7777", "city" => "Fakecity", "province" => "Ontario", "country" => "Canada", "zip" => "K2P 1L4"], "transactions" => [["kind" => "sale", "status" => "success", "amount" => 50.0]], "financial_status" => "paid", "discount_codes" => [["code" => "FAKE30", "amount" => "9.00", "type" => "percentage"]]]]),
            ),
        ]);

        $order = new Order($this->test_session);
        $order->line_items = [
            [
                "variant_id" => 447654529,
                "quantity" => 1
            ]
        ];
        $order->email = "jane@example.com";
        $order->phone = 18885551234;
        $order->billing_address = [
            "first_name" => "John",
            "last_name" => "Smith",
            "address1" => "123 Fake Street",
            "phone" => "555-555-5555",
            "city" => "Fakecity",
            "province" => "Ontario",
            "country" => "Canada",
            "zip" => "K2P 1L4"
        ];
        $order->shipping_address = [
            "first_name" => "Jane",
            "last_name" => "Smith",
            "address1" => "123 Fake Street",
            "phone" => "777-777-7777",
            "city" => "Fakecity",
            "province" => "Ontario",
            "country" => "Canada",
            "zip" => "K2P 1L4"
        ];
        $order->transactions = [
            [
                "kind" => "sale",
                "status" => "success",
                "amount" => 50.0
            ]
        ];
        $order->financial_status = "paid";
        $order->discount_codes = [
            [
                "code" => "FAKE30",
                "amount" => "9.00",
                "type" => "percentage"
            ]
        ];
        $order->save();
    }

}
