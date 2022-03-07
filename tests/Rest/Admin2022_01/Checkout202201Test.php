<?php

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Checkout;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class Checkout202201Test extends BaseTestCase
{
    /** @var Session */
    private $test_session;

    public function setUp(): void
    {
        parent::setUp();

        Context::$API_VERSION = "2022-01";

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
                "https://test-shop.myshopify.io/admin/api/2022-01/checkouts.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["checkout" => ["line_items" => [["variant_id" => 39072856, "quantity" => 5]]]]),
            ),
        ]);

        $checkout = new Checkout($this->test_session);
        $checkout->line_items = [
            [
                "variant_id" => 39072856,
                "quantity" => 5
            ]
        ];
        $checkout->save();
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
                "https://test-shop.myshopify.io/admin/api/2022-01/checkouts.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["checkout" => ["email" => "me@example.com"]]),
            ),
        ]);

        $checkout = new Checkout($this->test_session);
        $checkout->email = "me@example.com";
        $checkout->save();
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
                "https://test-shop.myshopify.io/admin/api/2022-01/checkouts/b490a9220cd14d7344024f4874f640a6/complete.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        $checkout = new Checkout($this->test_session);
        $checkout->token = "b490a9220cd14d7344024f4874f640a6";
        $checkout->complete(
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
                "https://test-shop.myshopify.io/admin/api/2022-01/checkouts/bd5a8aa1ecd019dd3520ff791ee3a24c.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Checkout::find(
            $this->test_session,
            "bd5a8aa1ecd019dd3520ff791ee3a24c",
            [],
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
                "https://test-shop.myshopify.io/admin/api/2022-01/checkouts/7yjf4v2we7gamku6a6h7tvm8h3mmvs4x.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Checkout::find(
            $this->test_session,
            "7yjf4v2we7gamku6a6h7tvm8h3mmvs4x",
            [],
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
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2022-01/checkouts/exuw7apwoycchjuwtiqg8nytfhphr62a.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Checkout::find(
            $this->test_session,
            "exuw7apwoycchjuwtiqg8nytfhphr62a",
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
                "https://test-shop.myshopify.io/admin/api/2022-01/checkouts/exuw7apwoycchjuwtiqg8nytfhphr62a.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["checkout" => ["token" => "exuw7apwoycchjuwtiqg8nytfhphr62a", "email" => "john.smith@example.com", "shipping_address" => ["first_name" => "John", "last_name" => "Smith", "address1" => "126 York St.", "city" => "Los Angeles", "province_code" => "CA", "country_code" => "US", "phone" => "(123)456-7890", "zip" => "90002"]]]),
            ),
        ]);

        $checkout = new Checkout($this->test_session);
        $checkout->token = "exuw7apwoycchjuwtiqg8nytfhphr62a";
        $checkout->email = "john.smith@example.com";
        $checkout->shipping_address = [
            "first_name" => "John",
            "last_name" => "Smith",
            "address1" => "126 York St.",
            "city" => "Los Angeles",
            "province_code" => "CA",
            "country_code" => "US",
            "phone" => "(123)456-7890",
            "zip" => "90002"
        ];
        $checkout->save();
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
                "https://test-shop.myshopify.io/admin/api/2022-01/checkouts/exuw7apwoycchjuwtiqg8nytfhphr62a.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["checkout" => ["token" => "exuw7apwoycchjuwtiqg8nytfhphr62a", "shipping_line" => ["handle" => "shopify-Free Shipping-0.00"]]]),
            ),
        ]);

        $checkout = new Checkout($this->test_session);
        $checkout->token = "exuw7apwoycchjuwtiqg8nytfhphr62a";
        $checkout->shipping_line = [
            "handle" => "shopify-Free Shipping-0.00"
        ];
        $checkout->save();
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
                "https://test-shop.myshopify.io/admin/api/2022-01/checkouts/exuw7apwoycchjuwtiqg8nytfhphr62a/shipping_rates.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Checkout::shipping_rates(
            $this->test_session,
            "exuw7apwoycchjuwtiqg8nytfhphr62a",
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
                "https://test-shop.myshopify.io/admin/api/2022-01/checkouts/exuw7apwoycchjuwtiqg8nytfhphr62a/shipping_rates.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Checkout::shipping_rates(
            $this->test_session,
            "exuw7apwoycchjuwtiqg8nytfhphr62a",
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
                "https://test-shop.myshopify.io/admin/api/2022-01/checkouts/zs9ru89kuqcdagk8bz4r9hnxt22wwd42/shipping_rates.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Checkout::shipping_rates(
            $this->test_session,
            "zs9ru89kuqcdagk8bz4r9hnxt22wwd42",
            [],
            [],
        );
    }

}
