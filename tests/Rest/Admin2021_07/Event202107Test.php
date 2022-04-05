<?php

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Admin2021_07\Event;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class Event202107Test extends BaseTestCase
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
                  ["events" => [["id" => 164748010, "subject_id" => 450789469, "created_at" => "2008-01-10T06:00:00-05:00", "subject_type" => "Order", "verb" => "confirmed", "arguments" => ["#1001", "Bob Norman"], "body" => null, "message" => "Received new order <a href=\"https://jsmith.myshopify.com/admin/orders/450789469\">#1001</a> by Bob Norman.", "author" => "Shopify", "description" => "Received new order #1001 by Bob Norman.", "path" => "/admin/orders/450789469"], ["id" => 365755215, "subject_id" => 632910392, "created_at" => "2008-01-10T07:00:00-05:00", "subject_type" => "Product", "verb" => "create", "arguments" => ["IPod Nano - 8GB"], "body" => null, "message" => "Product was created: <a href=\"https://jsmith.myshopify.com/admin/products/632910392\">IPod Nano - 8GB</a>.", "author" => "Shopify", "description" => "Product was created: IPod Nano - 8GB.", "path" => "/admin/products/632910392"], ["id" => 677313116, "subject_id" => 921728736, "created_at" => "2008-01-10T08:00:00-05:00", "subject_type" => "Product", "verb" => "create", "arguments" => ["IPod Touch 8GB"], "body" => null, "message" => "Product was created: <a href=\"https://jsmith.myshopify.com/admin/products/921728736\">IPod Touch 8GB</a>.", "author" => "Shopify", "description" => "Product was created: IPod Touch 8GB.", "path" => "/admin/products/921728736"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/events.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Event::all(
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
                  ["events" => [["id" => 677313116, "subject_id" => 921728736, "created_at" => "2008-01-10T08:00:00-05:00", "subject_type" => "Product", "verb" => "create", "arguments" => ["IPod Touch 8GB"], "body" => null, "message" => "Product was created: <a href=\"https://jsmith.myshopify.com/admin/products/921728736\">IPod Touch 8GB</a>.", "author" => "Shopify", "description" => "Product was created: IPod Touch 8GB.", "path" => "/admin/products/921728736"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/events.json?created_at_min=2008-01-10+12%3A30%3A00%2B00%3A00",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Event::all(
            $this->test_session,
            [],
            ["created_at_min" => "2008-01-10 12:30:00+00:00"],
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
                  ["events" => [["id" => 103105390, "subject_id" => 450789469, "created_at" => "2008-01-10T05:00:00-05:00", "subject_type" => "Order", "verb" => "authorization_success", "arguments" => ["389404469", "210.94", "USD"], "body" => null, "message" => "A transaction was authorized.", "author" => "Shopify", "description" => "A transaction was authorized.", "path" => "/admin/orders/450789469"], ["id" => 164748010, "subject_id" => 450789469, "created_at" => "2008-01-10T06:00:00-05:00", "subject_type" => "Order", "verb" => "confirmed", "arguments" => ["#1001", "Bob Norman"], "body" => null, "message" => "Received new order <a href=\"https://jsmith.myshopify.com/admin/orders/450789469\">#1001</a> by Bob Norman.", "author" => "Shopify", "description" => "Received new order #1001 by Bob Norman.", "path" => "/admin/orders/450789469"], ["id" => 852065041, "subject_id" => 450789469, "created_at" => "2008-01-10T09:00:00-05:00", "subject_type" => "Order", "verb" => "placed", "arguments" => [], "body" => null, "message" => "This order was created for Bob Norman from draft order <a href=\"https://jsmith.myshopify.com/admin/draft_orders/72885271\">#D4</a>.", "author" => "Shopify", "description" => "This order was created for Bob Norman from draft order #D4.", "path" => "/admin/orders/450789469"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/orders/450789469/events.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Event::all(
            $this->test_session,
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
                  ["events" => [["id" => 852065041, "subject_id" => 450789469, "created_at" => "2008-01-10T09:00:00-05:00", "subject_type" => "Order", "verb" => "placed", "arguments" => [], "body" => null, "message" => "This order was created for Bob Norman from draft order <a href=\"https://jsmith.myshopify.com/admin/draft_orders/72885271\">#D4</a>.", "author" => "Shopify", "description" => "This order was created for Bob Norman from draft order #D4.", "path" => "/admin/orders/450789469"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/orders/450789469/events.json?limit=1&since_id=164748010",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Event::all(
            $this->test_session,
            ["order_id" => "450789469"],
            ["limit" => "1", "since_id" => "164748010"],
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
                  ["events" => [["id" => 677313116, "subject_id" => 921728736, "created_at" => "2008-01-10T08:00:00-05:00", "subject_type" => "Product", "verb" => "create", "arguments" => ["IPod Touch 8GB"], "body" => null, "message" => "Product was created: <a href=\"https://jsmith.myshopify.com/admin/products/921728736\">IPod Touch 8GB</a>.", "author" => "Shopify", "description" => "Product was created: IPod Touch 8GB.", "path" => "/admin/products/921728736"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/products/921728736/events.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Event::all(
            $this->test_session,
            ["product_id" => "921728736"],
            [],
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
                  ["events" => [["id" => 365755215, "subject_id" => 632910392, "created_at" => "2008-01-10T07:00:00-05:00", "subject_type" => "Product", "verb" => "create", "arguments" => ["IPod Nano - 8GB"], "body" => null, "message" => "Product was created: <a href=\"https://jsmith.myshopify.com/admin/products/632910392\">IPod Nano - 8GB</a>.", "author" => "Shopify", "description" => "Product was created: IPod Nano - 8GB.", "path" => "/admin/products/632910392"], ["id" => 677313116, "subject_id" => 921728736, "created_at" => "2008-01-10T08:00:00-05:00", "subject_type" => "Product", "verb" => "create", "arguments" => ["IPod Touch 8GB"], "body" => null, "message" => "Product was created: <a href=\"https://jsmith.myshopify.com/admin/products/921728736\">IPod Touch 8GB</a>.", "author" => "Shopify", "description" => "Product was created: IPod Touch 8GB.", "path" => "/admin/products/921728736"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/events.json?since_id=164748010",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Event::all(
            $this->test_session,
            [],
            ["since_id" => "164748010"],
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
                $this->buildMockHttpResponse(200, json_encode(
                  ["events" => [["id" => 164748010, "subject_id" => 450789469, "created_at" => "2008-01-10T06:00:00-05:00", "subject_type" => "Order", "verb" => "confirmed", "arguments" => ["#1001", "Bob Norman"], "body" => null, "message" => "Received new order <a href=\"https://jsmith.myshopify.com/admin/orders/450789469\">#1001</a> by Bob Norman.", "author" => "Shopify", "description" => "Received new order #1001 by Bob Norman.", "path" => "/admin/orders/450789469"], ["id" => 365755215, "subject_id" => 632910392, "created_at" => "2008-01-10T07:00:00-05:00", "subject_type" => "Product", "verb" => "create", "arguments" => ["IPod Nano - 8GB"], "body" => null, "message" => "Product was created: <a href=\"https://jsmith.myshopify.com/admin/products/632910392\">IPod Nano - 8GB</a>.", "author" => "Shopify", "description" => "Product was created: IPod Nano - 8GB.", "path" => "/admin/products/632910392"], ["id" => 677313116, "subject_id" => 921728736, "created_at" => "2008-01-10T08:00:00-05:00", "subject_type" => "Product", "verb" => "create", "arguments" => ["IPod Touch 8GB"], "body" => null, "message" => "Product was created: <a href=\"https://jsmith.myshopify.com/admin/products/921728736\">IPod Touch 8GB</a>.", "author" => "Shopify", "description" => "Product was created: IPod Touch 8GB.", "path" => "/admin/products/921728736"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/events.json?filter=Product%2COrder",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Event::all(
            $this->test_session,
            [],
            ["filter" => "Product,Order"],
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
                $this->buildMockHttpResponse(200, json_encode(
                  ["events" => []]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/events.json?filter=Product&verb=destroy",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Event::all(
            $this->test_session,
            [],
            ["filter" => "Product", "verb" => "destroy"],
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
                $this->buildMockHttpResponse(200, json_encode(
                  ["event" => ["id" => 677313116, "subject_id" => 921728736, "created_at" => "2008-01-10T08:00:00-05:00", "subject_type" => "Product", "verb" => "create", "arguments" => ["IPod Touch 8GB"], "body" => null, "message" => "Product was created: <a href=\"https://jsmith.myshopify.com/admin/products/921728736\">IPod Touch 8GB</a>.", "author" => "Shopify", "description" => "Product was created: IPod Touch 8GB.", "path" => "/admin/products/921728736"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/events/677313116.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Event::find(
            $this->test_session,
            677313116,
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
                $this->buildMockHttpResponse(200, json_encode(
                  ["count" => 1]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/events/count.json?created_at_min=2008-01-10T13%3A00%3A00%2B00%3A00",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Event::count(
            $this->test_session,
            [],
            ["created_at_min" => "2008-01-10T13:00:00+00:00"],
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
                $this->buildMockHttpResponse(200, json_encode(
                  ["count" => 3]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/events/count.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Event::count(
            $this->test_session,
            [],
            [],
        );
    }

}
