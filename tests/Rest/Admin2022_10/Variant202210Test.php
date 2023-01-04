<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Admin2022_10\Variant;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class Variant202210Test extends BaseTestCase
{
    /** @var Session */
    private $test_session;

    public function setUp(): void
    {
        parent::setUp();

        Context::$API_VERSION = "2022-10";

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
                  ["variants" => [["id" => 39072856, "product_id" => 632910392, "title" => "Green", "price" => "199.00", "sku" => "IPOD2008GREEN", "position" => 3, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Green", "option2" => null, "option3" => null, "created_at" => "2023-01-03T12:21:36-05:00", "updated_at" => "2023-01-03T12:21:36-05:00", "taxable" => true, "barcode" => "1234_green", "grams" => 567, "image_id" => null, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 39072856, "inventory_quantity" => 30, "old_inventory_quantity" => 30, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/39072856"], ["id" => 49148385, "product_id" => 632910392, "title" => "Red", "price" => "199.00", "sku" => "IPOD2008RED", "position" => 2, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Red", "option2" => null, "option3" => null, "created_at" => "2023-01-03T12:21:36-05:00", "updated_at" => "2023-01-03T12:21:36-05:00", "taxable" => true, "barcode" => "1234_red", "grams" => 567, "image_id" => null, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 49148385, "inventory_quantity" => 20, "old_inventory_quantity" => 20, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/49148385"], ["id" => 457924702, "product_id" => 632910392, "title" => "Black", "price" => "199.00", "sku" => "IPOD2008BLACK", "position" => 4, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Black", "option2" => null, "option3" => null, "created_at" => "2023-01-03T12:21:36-05:00", "updated_at" => "2023-01-03T12:21:36-05:00", "taxable" => true, "barcode" => "1234_black", "grams" => 567, "image_id" => null, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 457924702, "inventory_quantity" => 40, "old_inventory_quantity" => 40, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/457924702"], ["id" => 808950810, "product_id" => 632910392, "title" => "Pink", "price" => "199.00", "sku" => "IPOD2008PINK", "position" => 1, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Pink", "option2" => null, "option3" => null, "created_at" => "2023-01-03T12:21:36-05:00", "updated_at" => "2023-01-03T12:21:36-05:00", "taxable" => true, "barcode" => "1234_pink", "grams" => 567, "image_id" => 562641783, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 808950810, "inventory_quantity" => 10, "old_inventory_quantity" => 10, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/808950810"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-10/products/632910392/variants.json",
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
    public function test_2(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["variants" => [["id" => 457924702, "product_id" => 632910392, "title" => "Black", "price" => "199.00", "sku" => "IPOD2008BLACK", "position" => 4, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Black", "option2" => null, "option3" => null, "created_at" => "2023-01-03T12:21:36-05:00", "updated_at" => "2023-01-03T12:21:36-05:00", "taxable" => true, "barcode" => "1234_black", "grams" => 567, "image_id" => null, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 457924702, "inventory_quantity" => 40, "old_inventory_quantity" => 40, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/457924702"], ["id" => 808950810, "product_id" => 632910392, "title" => "Pink", "price" => "199.00", "sku" => "IPOD2008PINK", "position" => 1, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Pink", "option2" => null, "option3" => null, "created_at" => "2023-01-03T12:21:36-05:00", "updated_at" => "2023-01-03T12:21:36-05:00", "taxable" => true, "barcode" => "1234_pink", "grams" => 567, "image_id" => 562641783, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 808950810, "inventory_quantity" => 10, "old_inventory_quantity" => 10, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/808950810"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-10/products/632910392/variants.json?since_id=49148385",
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
    public function test_3(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["variants" => [["id" => 39072856, "product_id" => 632910392, "title" => "Green", "price" => "199.00", "sku" => "IPOD2008GREEN", "position" => 3, "inventory_policy" => "continue", "compare_at_price" => "249.00", "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Green", "option2" => null, "option3" => null, "created_at" => "2023-01-03T12:21:36-05:00", "updated_at" => "2023-01-03T12:21:36-05:00", "taxable" => true, "barcode" => "1234_green", "grams" => 567, "image_id" => null, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 39072856, "inventory_quantity" => 30, "old_inventory_quantity" => 30, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => ["amount" => "249.00", "currency_code" => "USD"]], ["price" => ["amount" => "249.00", "currency_code" => "CAD"], "compare_at_price" => ["amount" => "312.00", "currency_code" => "CAD"]]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/39072856"], ["id" => 49148385, "product_id" => 632910392, "title" => "Red", "price" => "199.00", "sku" => "IPOD2008RED", "position" => 2, "inventory_policy" => "continue", "compare_at_price" => "249.00", "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Red", "option2" => null, "option3" => null, "created_at" => "2023-01-03T12:21:36-05:00", "updated_at" => "2023-01-03T12:21:36-05:00", "taxable" => true, "barcode" => "1234_red", "grams" => 567, "image_id" => null, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 49148385, "inventory_quantity" => 20, "old_inventory_quantity" => 20, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => ["amount" => "249.00", "currency_code" => "USD"]], ["price" => ["amount" => "249.00", "currency_code" => "CAD"], "compare_at_price" => ["amount" => "312.00", "currency_code" => "CAD"]]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/49148385"], ["id" => 457924702, "product_id" => 632910392, "title" => "Black", "price" => "199.00", "sku" => "IPOD2008BLACK", "position" => 4, "inventory_policy" => "continue", "compare_at_price" => "249.00", "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Black", "option2" => null, "option3" => null, "created_at" => "2023-01-03T12:21:36-05:00", "updated_at" => "2023-01-03T12:21:36-05:00", "taxable" => true, "barcode" => "1234_black", "grams" => 567, "image_id" => null, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 457924702, "inventory_quantity" => 40, "old_inventory_quantity" => 40, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => ["amount" => "249.00", "currency_code" => "USD"]], ["price" => ["amount" => "249.00", "currency_code" => "CAD"], "compare_at_price" => ["amount" => "312.00", "currency_code" => "CAD"]]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/457924702"], ["id" => 808950810, "product_id" => 632910392, "title" => "Pink", "price" => "199.00", "sku" => "IPOD2008PINK", "position" => 1, "inventory_policy" => "continue", "compare_at_price" => "249.00", "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Pink", "option2" => null, "option3" => null, "created_at" => "2023-01-03T12:21:36-05:00", "updated_at" => "2023-01-03T12:21:36-05:00", "taxable" => true, "barcode" => "1234_pink", "grams" => 567, "image_id" => 562641783, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 808950810, "inventory_quantity" => 10, "old_inventory_quantity" => 10, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => ["amount" => "249.00", "currency_code" => "USD"]], ["price" => ["amount" => "249.00", "currency_code" => "CAD"], "compare_at_price" => ["amount" => "312.00", "currency_code" => "CAD"]]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/808950810"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-10/products/632910392/variants.json?presentment_currencies=USD%2CCAD",
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
    public function test_4(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["variant" => ["id" => 1070325020, "product_id" => 632910392, "title" => "Yellow", "price" => "1.00", "sku" => "", "position" => 5, "inventory_policy" => "deny", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Yellow", "option2" => null, "option3" => null, "created_at" => "2023-01-03T12:25:18-05:00", "updated_at" => "2023-01-03T12:25:18-05:00", "taxable" => true, "barcode" => null, "grams" => 0, "image_id" => null, "weight" => 0.0, "weight_unit" => "lb", "inventory_item_id" => 1070325020, "inventory_quantity" => 0, "old_inventory_quantity" => 0, "presentment_prices" => [["price" => ["amount" => "1.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/1070325020"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-10/products/632910392/variants.json",
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
    public function test_5(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["variant" => ["id" => 1070325023, "product_id" => 632910392, "title" => "Blue", "price" => "0.00", "sku" => "", "position" => 5, "inventory_policy" => "deny", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Blue", "option2" => null, "option3" => null, "created_at" => "2023-01-03T12:25:36-05:00", "updated_at" => "2023-01-03T12:25:36-05:00", "taxable" => true, "barcode" => null, "grams" => 0, "image_id" => null, "weight" => 0.0, "weight_unit" => "lb", "inventory_item_id" => 1070325023, "inventory_quantity" => 0, "old_inventory_quantity" => 0, "presentment_prices" => [["price" => ["amount" => "0.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/1070325023"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-10/products/632910392/variants.json",
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
    public function test_6(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["variant" => ["id" => 1070325022, "product_id" => 632910392, "title" => "Purple", "price" => "0.00", "sku" => "", "position" => 5, "inventory_policy" => "deny", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Purple", "option2" => null, "option3" => null, "created_at" => "2023-01-03T12:25:32-05:00", "updated_at" => "2023-01-03T12:25:32-05:00", "taxable" => true, "barcode" => null, "grams" => 0, "image_id" => 850703190, "weight" => 0.0, "weight_unit" => "lb", "inventory_item_id" => 1070325022, "inventory_quantity" => 0, "old_inventory_quantity" => 0, "presentment_prices" => [["price" => ["amount" => "0.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/1070325022"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-10/products/632910392/variants.json",
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
    public function test_7(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["count" => 4]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-10/products/632910392/variants/count.json",
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
    public function test_8(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["variant" => ["id" => 808950810, "product_id" => 632910392, "title" => "Pink", "price" => "199.00", "sku" => "IPOD2008PINK", "position" => 1, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Pink", "option2" => null, "option3" => null, "created_at" => "2023-01-03T12:21:36-05:00", "updated_at" => "2023-01-03T12:21:36-05:00", "taxable" => true, "barcode" => "1234_pink", "grams" => 567, "image_id" => 562641783, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 808950810, "inventory_quantity" => 10, "old_inventory_quantity" => 10, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "tax_code" => "DA040000", "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/808950810"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-10/variants/808950810.json",
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
    public function test_9(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["variant" => ["id" => 808950810, "product_id" => 632910392, "title" => "Pink", "price" => "199.00", "sku" => "IPOD2008PINK", "position" => 1, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Pink", "option2" => null, "option3" => null, "created_at" => "2023-01-03T12:21:36-05:00", "updated_at" => "2023-01-03T12:25:13-05:00", "taxable" => true, "barcode" => "1234_pink", "grams" => 567, "image_id" => 562641783, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 808950810, "inventory_quantity" => 10, "old_inventory_quantity" => 10, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/808950810"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-10/variants/808950810.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["variant" => ["metafields" => [["key" => "new", "value" => "newvalue", "type" => "single_line_text_field", "namespace" => "global"]]]]),
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
    public function test_10(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["variant" => ["id" => 808950810, "product_id" => 632910392, "title" => "Pink", "price" => "199.00", "sku" => "IPOD2008PINK", "position" => 1, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Pink", "option2" => null, "option3" => null, "created_at" => "2023-01-03T12:21:36-05:00", "updated_at" => "2023-01-03T12:25:26-05:00", "taxable" => true, "barcode" => "1234_pink", "grams" => 567, "image_id" => 562641783, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 808950810, "inventory_quantity" => 10, "old_inventory_quantity" => 10, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/808950810"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-10/variants/808950810.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["variant" => ["image_id" => 562641783]]),
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
    public function test_11(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["variant" => ["id" => 808950810, "product_id" => 632910392, "title" => "Not Pink", "price" => "99.00", "sku" => "IPOD2008PINK", "position" => 1, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Not Pink", "option2" => null, "option3" => null, "created_at" => "2023-01-03T12:21:36-05:00", "updated_at" => "2023-01-03T12:25:43-05:00", "taxable" => true, "barcode" => "1234_pink", "grams" => 567, "image_id" => 562641783, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 808950810, "inventory_quantity" => 10, "old_inventory_quantity" => 10, "presentment_prices" => [["price" => ["amount" => "99.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/808950810"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-10/variants/808950810.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["variant" => ["option1" => "Not Pink", "price" => "99.00"]]),
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
    public function test_12(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  []
                )),
                "https://test-shop.myshopify.io/admin/api/2022-10/products/632910392/variants/808950810.json",
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
