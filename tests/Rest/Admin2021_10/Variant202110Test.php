<?php

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Variant;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class Variant202110Test extends BaseTestCase
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
                "https://test-shop.myshopify.io/admin/api/2021-10/products/632910392/variants.json?since_id=49148385",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Variant::all(
            $this->test_session,
            ["product_id" => "632910392"],
            ["since_id" => "49148385"],
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
                "https://test-shop.myshopify.io/admin/api/2021-10/products/632910392/variants.json?presentment_currencies=USD%2CCAD",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Variant::all(
            $this->test_session,
            ["product_id" => "632910392"],
            ["presentment_currencies" => "USD,CAD"],
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
                "https://test-shop.myshopify.io/admin/api/2021-10/products/632910392/variants.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Variant::all(
            $this->test_session,
            ["product_id" => "632910392"],
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
                "https://test-shop.myshopify.io/admin/api/2021-10/products/632910392/variants/count.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Variant::count(
            $this->test_session,
            ["product_id" => "632910392"],
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
                "https://test-shop.myshopify.io/admin/api/2021-10/variants/808950810.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Variant::find(
            $this->test_session,
            808950810,
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
                "https://test-shop.myshopify.io/admin/api/2021-10/variants/808950810.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["variant" => ["id" => 808950810, "option1" => "Not Pink", "price" => "99.00"]]),
            ),
        ]);

        $variant = new Variant($this->test_session);
        $variant->id = 808950810;
        $variant->option1 = "Not Pink";
        $variant->price = "99.00";
        $variant->save();
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
                "https://test-shop.myshopify.io/admin/api/2021-10/variants/808950810.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["variant" => ["id" => 808950810, "image_id" => 562641783]]),
            ),
        ]);

        $variant = new Variant($this->test_session);
        $variant->id = 808950810;
        $variant->image_id = 562641783;
        $variant->save();
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
                "https://test-shop.myshopify.io/admin/api/2021-10/variants/808950810.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["variant" => ["id" => 808950810, "metafields" => [["key" => "new", "value" => "newvalue", "type" => "single_line_text_field", "namespace" => "global"]]]]),
            ),
        ]);

        $variant = new Variant($this->test_session);
        $variant->id = 808950810;
        $variant->metafields = [
            [
                "key" => "new",
                "value" => "newvalue",
                "type" => "single_line_text_field",
                "namespace" => "global"
            ]
        ];
        $variant->save();
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
                "https://test-shop.myshopify.io/admin/api/2021-10/products/632910392/variants.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["variant" => ["option1" => "Yellow", "price" => "1.00"]]),
            ),
        ]);

        $variant = new Variant($this->test_session);
        $variant->product_id = 632910392;
        $variant->option1 = "Yellow";
        $variant->price = "1.00";
        $variant->save();
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
                "https://test-shop.myshopify.io/admin/api/2021-10/products/632910392/variants.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["variant" => ["image_id" => 850703190, "option1" => "Purple"]]),
            ),
        ]);

        $variant = new Variant($this->test_session);
        $variant->product_id = 632910392;
        $variant->image_id = 850703190;
        $variant->option1 = "Purple";
        $variant->save();
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
                "https://test-shop.myshopify.io/admin/api/2021-10/products/632910392/variants.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["variant" => ["option1" => "Blue", "metafields" => [["key" => "new", "value" => "newvalue", "type" => "single_line_text_field", "namespace" => "global"]]]]),
            ),
        ]);

        $variant = new Variant($this->test_session);
        $variant->product_id = 632910392;
        $variant->option1 = "Blue";
        $variant->metafields = [
            [
                "key" => "new",
                "value" => "newvalue",
                "type" => "single_line_text_field",
                "namespace" => "global"
            ]
        ];
        $variant->save();
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
                "https://test-shop.myshopify.io/admin/api/2021-10/products/632910392/variants/808950810.json",
                "DELETE",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Variant::delete(
            $this->test_session,
            808950810,
            ["product_id" => "632910392"],
            [],
        );
    }

}
