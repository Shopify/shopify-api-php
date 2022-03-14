<?php

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Product;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class Product202107Test extends BaseTestCase
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
                  ["products" => [["id" => 632910392, "title" => "IPod Nano - 8GB", "body_html" => "<p>It's the small iPod with one very big idea: Video. Now the world's most popular music player, available in 4GB and 8GB models, lets you enjoy TV shows, movies, video podcasts, and more. The larger, brighter display means amazing picture quality. In six eye-catching colors, iPod nano is stunning all around. And with models starting at just \$149, little speaks volumes.</p>", "vendor" => "Apple", "product_type" => "Cult Products", "created_at" => "2022-02-03T17:14:40-05:00", "handle" => "ipod-nano", "updated_at" => "2022-02-03T17:14:40-05:00", "published_at" => "2007-12-31T19:00:00-05:00", "template_suffix" => null, "published_scope" => "web", "tags" => "Emotive, Flash Memory, MP3, Music", "admin_graphql_api_id" => "gid://shopify/Product/632910392", "variants" => [["id" => 808950810, "product_id" => 632910392, "title" => "Pink", "price" => "199.00", "sku" => "IPOD2008PINK", "position" => 1, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Pink", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "taxable" => true, "barcode" => "1234_pink", "grams" => 567, "image_id" => 562641783, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 808950810, "inventory_quantity" => 10, "old_inventory_quantity" => 10, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/808950810"], ["id" => 49148385, "product_id" => 632910392, "title" => "Red", "price" => "199.00", "sku" => "IPOD2008RED", "position" => 2, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Red", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "taxable" => true, "barcode" => "1234_red", "grams" => 567, "image_id" => null, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 49148385, "inventory_quantity" => 20, "old_inventory_quantity" => 20, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/49148385"], ["id" => 39072856, "product_id" => 632910392, "title" => "Green", "price" => "199.00", "sku" => "IPOD2008GREEN", "position" => 3, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Green", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "taxable" => true, "barcode" => "1234_green", "grams" => 567, "image_id" => null, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 39072856, "inventory_quantity" => 30, "old_inventory_quantity" => 30, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/39072856"], ["id" => 457924702, "product_id" => 632910392, "title" => "Black", "price" => "199.00", "sku" => "IPOD2008BLACK", "position" => 4, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Black", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "taxable" => true, "barcode" => "1234_black", "grams" => 567, "image_id" => null, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 457924702, "inventory_quantity" => 40, "old_inventory_quantity" => 40, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/457924702"]], "options" => [["id" => 594680422, "product_id" => 632910392, "name" => "Color", "position" => 1, "values" => ["Pink", "Red", "Green", "Black"]]], "images" => [["id" => 850703190, "product_id" => 632910392, "position" => 1, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano.png?v=1643926480", "variant_ids" => [], "admin_graphql_api_id" => "gid://shopify/ProductImage/850703190"], ["id" => 562641783, "product_id" => 632910392, "position" => 2, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano-2.png?v=1643926480", "variant_ids" => [808950810], "admin_graphql_api_id" => "gid://shopify/ProductImage/562641783"], ["id" => 378407906, "product_id" => 632910392, "position" => 3, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano.png?v=1643926480", "variant_ids" => [], "admin_graphql_api_id" => "gid://shopify/ProductImage/378407906"]], "image" => ["id" => 850703190, "product_id" => 632910392, "position" => 1, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano.png?v=1643926480", "variant_ids" => [], "admin_graphql_api_id" => "gid://shopify/ProductImage/850703190"]], ["id" => 921728736, "title" => "IPod Touch 8GB", "body_html" => "<p>The iPod Touch has the iPhone's multi-touch interface, with a physical home button off the touch screen. The home screen has a list of buttons for the available applications.</p>", "vendor" => "Apple", "product_type" => "Cult Products", "created_at" => "2022-02-03T17:14:40-05:00", "handle" => "ipod-touch", "updated_at" => "2022-02-03T17:14:40-05:00", "published_at" => "2008-09-25T20:00:00-04:00", "template_suffix" => null, "published_scope" => "web", "tags" => "", "admin_graphql_api_id" => "gid://shopify/Product/921728736", "variants" => [["id" => 447654529, "product_id" => 921728736, "title" => "Black", "price" => "199.00", "sku" => "IPOD2009BLACK", "position" => 1, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "shipwire-app", "inventory_management" => "shipwire-app", "option1" => "Black", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "taxable" => true, "barcode" => "1234_black", "grams" => 567, "image_id" => null, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 447654529, "inventory_quantity" => 13, "old_inventory_quantity" => 13, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/447654529"]], "options" => [["id" => 891236591, "product_id" => 921728736, "name" => "Title", "position" => 1, "values" => ["Black"]]], "images" => [], "image" => null]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/products.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Product::all(
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
                  ["products" => [["id" => 632910392, "title" => "IPod Nano - 8GB", "body_html" => "<p>It's the small iPod with one very big idea: Video. Now the world's most popular music player, available in 4GB and 8GB models, lets you enjoy TV shows, movies, video podcasts, and more. The larger, brighter display means amazing picture quality. In six eye-catching colors, iPod nano is stunning all around. And with models starting at just \$149, little speaks volumes.</p>", "vendor" => "Apple", "product_type" => "Cult Products", "created_at" => "2022-02-03T17:14:40-05:00", "handle" => "ipod-nano", "updated_at" => "2022-02-03T17:14:40-05:00", "published_at" => "2007-12-31T19:00:00-05:00", "template_suffix" => null, "published_scope" => "web", "tags" => "Emotive, Flash Memory, MP3, Music", "admin_graphql_api_id" => "gid://shopify/Product/632910392", "variants" => [["id" => 808950810, "product_id" => 632910392, "title" => "Pink", "price" => "199.00", "sku" => "IPOD2008PINK", "position" => 1, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Pink", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "taxable" => true, "barcode" => "1234_pink", "grams" => 567, "image_id" => 562641783, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 808950810, "inventory_quantity" => 10, "old_inventory_quantity" => 10, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/808950810"], ["id" => 49148385, "product_id" => 632910392, "title" => "Red", "price" => "199.00", "sku" => "IPOD2008RED", "position" => 2, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Red", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "taxable" => true, "barcode" => "1234_red", "grams" => 567, "image_id" => null, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 49148385, "inventory_quantity" => 20, "old_inventory_quantity" => 20, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/49148385"], ["id" => 39072856, "product_id" => 632910392, "title" => "Green", "price" => "199.00", "sku" => "IPOD2008GREEN", "position" => 3, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Green", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "taxable" => true, "barcode" => "1234_green", "grams" => 567, "image_id" => null, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 39072856, "inventory_quantity" => 30, "old_inventory_quantity" => 30, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/39072856"], ["id" => 457924702, "product_id" => 632910392, "title" => "Black", "price" => "199.00", "sku" => "IPOD2008BLACK", "position" => 4, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Black", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "taxable" => true, "barcode" => "1234_black", "grams" => 567, "image_id" => null, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 457924702, "inventory_quantity" => 40, "old_inventory_quantity" => 40, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/457924702"]], "options" => [["id" => 594680422, "product_id" => 632910392, "name" => "Color", "position" => 1, "values" => ["Pink", "Red", "Green", "Black"]]], "images" => [["id" => 850703190, "product_id" => 632910392, "position" => 1, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano.png?v=1643926480", "variant_ids" => [], "admin_graphql_api_id" => "gid://shopify/ProductImage/850703190"], ["id" => 562641783, "product_id" => 632910392, "position" => 2, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano-2.png?v=1643926480", "variant_ids" => [808950810], "admin_graphql_api_id" => "gid://shopify/ProductImage/562641783"], ["id" => 378407906, "product_id" => 632910392, "position" => 3, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano.png?v=1643926480", "variant_ids" => [], "admin_graphql_api_id" => "gid://shopify/ProductImage/378407906"]], "image" => ["id" => 850703190, "product_id" => 632910392, "position" => 1, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano.png?v=1643926480", "variant_ids" => [], "admin_graphql_api_id" => "gid://shopify/ProductImage/850703190"]], ["id" => 921728736, "title" => "IPod Touch 8GB", "body_html" => "<p>The iPod Touch has the iPhone's multi-touch interface, with a physical home button off the touch screen. The home screen has a list of buttons for the available applications.</p>", "vendor" => "Apple", "product_type" => "Cult Products", "created_at" => "2022-02-03T17:14:40-05:00", "handle" => "ipod-touch", "updated_at" => "2022-02-03T17:14:40-05:00", "published_at" => "2008-09-25T20:00:00-04:00", "template_suffix" => null, "published_scope" => "web", "tags" => "", "admin_graphql_api_id" => "gid://shopify/Product/921728736", "variants" => [["id" => 447654529, "product_id" => 921728736, "title" => "Black", "price" => "199.00", "sku" => "IPOD2009BLACK", "position" => 1, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "shipwire-app", "inventory_management" => "shipwire-app", "option1" => "Black", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "taxable" => true, "barcode" => "1234_black", "grams" => 567, "image_id" => null, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 447654529, "inventory_quantity" => 13, "old_inventory_quantity" => 13, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/447654529"]], "options" => [["id" => 891236591, "product_id" => 921728736, "name" => "Title", "position" => 1, "values" => ["Black"]]], "images" => [], "image" => null]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/products.json?ids=632910392%2C921728736",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Product::all(
            $this->test_session,
            [],
            ["ids" => "632910392,921728736"],
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
                  ["products" => [["id" => 632910392, "title" => "IPod Nano - 8GB", "images" => [["id" => 850703190, "product_id" => 632910392, "position" => 1, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano.png?v=1643926480", "variant_ids" => [], "admin_graphql_api_id" => "gid://shopify/ProductImage/850703190"], ["id" => 562641783, "product_id" => 632910392, "position" => 2, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano-2.png?v=1643926480", "variant_ids" => [808950810], "admin_graphql_api_id" => "gid://shopify/ProductImage/562641783"], ["id" => 378407906, "product_id" => 632910392, "position" => 3, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano.png?v=1643926480", "variant_ids" => [], "admin_graphql_api_id" => "gid://shopify/ProductImage/378407906"]]], ["id" => 921728736, "title" => "IPod Touch 8GB", "images" => []]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/products.json?fields=id%2Cimages%2Ctitle",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Product::all(
            $this->test_session,
            [],
            ["fields" => "id,images,title"],
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
                  ["products" => [["id" => 632910392, "title" => "IPod Nano - 8GB", "body_html" => "<p>It's the small iPod with one very big idea: Video. Now the world's most popular music player, available in 4GB and 8GB models, lets you enjoy TV shows, movies, video podcasts, and more. The larger, brighter display means amazing picture quality. In six eye-catching colors, iPod nano is stunning all around. And with models starting at just \$149, little speaks volumes.</p>", "vendor" => "Apple", "product_type" => "Cult Products", "created_at" => "2022-02-03T17:14:40-05:00", "handle" => "ipod-nano", "updated_at" => "2022-02-03T17:14:40-05:00", "published_at" => "2007-12-31T19:00:00-05:00", "template_suffix" => null, "published_scope" => "web", "tags" => "Emotive, Flash Memory, MP3, Music", "admin_graphql_api_id" => "gid://shopify/Product/632910392", "variants" => [["id" => 808950810, "product_id" => 632910392, "title" => "Pink", "price" => "199.00", "sku" => "IPOD2008PINK", "position" => 1, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Pink", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "taxable" => true, "barcode" => "1234_pink", "grams" => 567, "image_id" => 562641783, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 808950810, "inventory_quantity" => 10, "old_inventory_quantity" => 10, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/808950810"], ["id" => 49148385, "product_id" => 632910392, "title" => "Red", "price" => "199.00", "sku" => "IPOD2008RED", "position" => 2, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Red", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "taxable" => true, "barcode" => "1234_red", "grams" => 567, "image_id" => null, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 49148385, "inventory_quantity" => 20, "old_inventory_quantity" => 20, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/49148385"], ["id" => 39072856, "product_id" => 632910392, "title" => "Green", "price" => "199.00", "sku" => "IPOD2008GREEN", "position" => 3, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Green", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "taxable" => true, "barcode" => "1234_green", "grams" => 567, "image_id" => null, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 39072856, "inventory_quantity" => 30, "old_inventory_quantity" => 30, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/39072856"], ["id" => 457924702, "product_id" => 632910392, "title" => "Black", "price" => "199.00", "sku" => "IPOD2008BLACK", "position" => 4, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Black", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "taxable" => true, "barcode" => "1234_black", "grams" => 567, "image_id" => null, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 457924702, "inventory_quantity" => 40, "old_inventory_quantity" => 40, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/457924702"]], "options" => [["id" => 594680422, "product_id" => 632910392, "name" => "Color", "position" => 1, "values" => ["Pink", "Red", "Green", "Black"]]], "images" => [["id" => 850703190, "product_id" => 632910392, "position" => 1, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano.png?v=1643926480", "variant_ids" => [], "admin_graphql_api_id" => "gid://shopify/ProductImage/850703190"], ["id" => 562641783, "product_id" => 632910392, "position" => 2, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano-2.png?v=1643926480", "variant_ids" => [808950810], "admin_graphql_api_id" => "gid://shopify/ProductImage/562641783"], ["id" => 378407906, "product_id" => 632910392, "position" => 3, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano.png?v=1643926480", "variant_ids" => [], "admin_graphql_api_id" => "gid://shopify/ProductImage/378407906"]], "image" => ["id" => 850703190, "product_id" => 632910392, "position" => 1, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano.png?v=1643926480", "variant_ids" => [], "admin_graphql_api_id" => "gid://shopify/ProductImage/850703190"]]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/products.json?collection_id=841564295",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Product::all(
            $this->test_session,
            [],
            ["collection_id" => "841564295"],
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
                  ["products" => [["id" => 921728736, "title" => "IPod Touch 8GB", "body_html" => "<p>The iPod Touch has the iPhone's multi-touch interface, with a physical home button off the touch screen. The home screen has a list of buttons for the available applications.</p>", "vendor" => "Apple", "product_type" => "Cult Products", "created_at" => "2022-02-03T17:14:40-05:00", "handle" => "ipod-touch", "updated_at" => "2022-02-03T17:14:40-05:00", "published_at" => "2008-09-25T20:00:00-04:00", "template_suffix" => null, "published_scope" => "web", "tags" => "", "admin_graphql_api_id" => "gid://shopify/Product/921728736", "variants" => [["id" => 447654529, "product_id" => 921728736, "title" => "Black", "price" => "199.00", "sku" => "IPOD2009BLACK", "position" => 1, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "shipwire-app", "inventory_management" => "shipwire-app", "option1" => "Black", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "taxable" => true, "barcode" => "1234_black", "grams" => 567, "image_id" => null, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 447654529, "inventory_quantity" => 13, "old_inventory_quantity" => 13, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/447654529"]], "options" => [["id" => 891236591, "product_id" => 921728736, "name" => "Title", "position" => 1, "values" => ["Black"]]], "images" => [], "image" => null]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/products.json?since_id=632910392",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Product::all(
            $this->test_session,
            [],
            ["since_id" => "632910392"],
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
                  ["products" => [["id" => 632910392, "title" => "IPod Nano - 8GB", "body_html" => "<p>It's the small iPod with one very big idea: Video. Now the world's most popular music player, available in 4GB and 8GB models, lets you enjoy TV shows, movies, video podcasts, and more. The larger, brighter display means amazing picture quality. In six eye-catching colors, iPod nano is stunning all around. And with models starting at just \$149, little speaks volumes.</p>", "vendor" => "Apple", "product_type" => "Cult Products", "created_at" => "2022-02-03T17:14:40-05:00", "handle" => "ipod-nano", "updated_at" => "2022-02-03T17:14:40-05:00", "published_at" => "2007-12-31T19:00:00-05:00", "template_suffix" => null, "published_scope" => "web", "tags" => "Emotive, Flash Memory, MP3, Music", "admin_graphql_api_id" => "gid://shopify/Product/632910392", "variants" => [["id" => 808950810, "product_id" => 632910392, "title" => "Pink", "price" => "199.00", "sku" => "IPOD2008PINK", "position" => 1, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Pink", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "taxable" => true, "barcode" => "1234_pink", "grams" => 567, "image_id" => 562641783, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 808950810, "inventory_quantity" => 10, "old_inventory_quantity" => 10, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/808950810"], ["id" => 49148385, "product_id" => 632910392, "title" => "Red", "price" => "199.00", "sku" => "IPOD2008RED", "position" => 2, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Red", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "taxable" => true, "barcode" => "1234_red", "grams" => 567, "image_id" => null, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 49148385, "inventory_quantity" => 20, "old_inventory_quantity" => 20, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/49148385"], ["id" => 39072856, "product_id" => 632910392, "title" => "Green", "price" => "199.00", "sku" => "IPOD2008GREEN", "position" => 3, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Green", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "taxable" => true, "barcode" => "1234_green", "grams" => 567, "image_id" => null, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 39072856, "inventory_quantity" => 30, "old_inventory_quantity" => 30, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/39072856"], ["id" => 457924702, "product_id" => 632910392, "title" => "Black", "price" => "199.00", "sku" => "IPOD2008BLACK", "position" => 4, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Black", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "taxable" => true, "barcode" => "1234_black", "grams" => 567, "image_id" => null, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 457924702, "inventory_quantity" => 40, "old_inventory_quantity" => 40, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/457924702"]], "options" => [["id" => 594680422, "product_id" => 632910392, "name" => "Color", "position" => 1, "values" => ["Pink", "Red", "Green", "Black"]]], "images" => [["id" => 850703190, "product_id" => 632910392, "position" => 1, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano.png?v=1643926480", "variant_ids" => [], "admin_graphql_api_id" => "gid://shopify/ProductImage/850703190"], ["id" => 562641783, "product_id" => 632910392, "position" => 2, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano-2.png?v=1643926480", "variant_ids" => [808950810], "admin_graphql_api_id" => "gid://shopify/ProductImage/562641783"], ["id" => 378407906, "product_id" => 632910392, "position" => 3, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano.png?v=1643926480", "variant_ids" => [], "admin_graphql_api_id" => "gid://shopify/ProductImage/378407906"]], "image" => ["id" => 850703190, "product_id" => 632910392, "position" => 1, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano.png?v=1643926480", "variant_ids" => [], "admin_graphql_api_id" => "gid://shopify/ProductImage/850703190"]], ["id" => 921728736, "title" => "IPod Touch 8GB", "body_html" => "<p>The iPod Touch has the iPhone's multi-touch interface, with a physical home button off the touch screen. The home screen has a list of buttons for the available applications.</p>", "vendor" => "Apple", "product_type" => "Cult Products", "created_at" => "2022-02-03T17:14:40-05:00", "handle" => "ipod-touch", "updated_at" => "2022-02-03T17:14:40-05:00", "published_at" => "2008-09-25T20:00:00-04:00", "template_suffix" => null, "published_scope" => "web", "tags" => "", "admin_graphql_api_id" => "gid://shopify/Product/921728736", "variants" => [["id" => 447654529, "product_id" => 921728736, "title" => "Black", "price" => "199.00", "sku" => "IPOD2009BLACK", "position" => 1, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "shipwire-app", "inventory_management" => "shipwire-app", "option1" => "Black", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "taxable" => true, "barcode" => "1234_black", "grams" => 567, "image_id" => null, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 447654529, "inventory_quantity" => 13, "old_inventory_quantity" => 13, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/447654529"]], "options" => [["id" => 891236591, "product_id" => 921728736, "name" => "Title", "position" => 1, "values" => ["Black"]]], "images" => [], "image" => null]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/products.json?presentment_currencies=USD",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Product::all(
            $this->test_session,
            [],
            ["presentment_currencies" => "USD"],
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
                  ["product" => ["id" => 1071559625, "title" => "Burton Custom Freestyle 151", "body_html" => "<strong>Good snowboard!</strong>", "vendor" => "Burton", "product_type" => "Snowboard", "created_at" => "2022-02-03T17:19:42-05:00", "handle" => "burton-custom-freestyle-151", "updated_at" => "2022-02-03T17:19:42-05:00", "published_at" => "2022-02-03T17:19:42-05:00", "template_suffix" => null, "status" => "active", "published_scope" => "web", "tags" => "Barnes & Noble, Big Air, John's Fav", "admin_graphql_api_id" => "gid://shopify/Product/1071559625", "variants" => [["id" => 1070325095, "product_id" => 1071559625, "title" => "Default Title", "price" => "0.00", "sku" => "", "position" => 1, "inventory_policy" => "deny", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => null, "option1" => "Default Title", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:19:42-05:00", "updated_at" => "2022-02-03T17:19:42-05:00", "taxable" => true, "barcode" => null, "grams" => 0, "image_id" => null, "weight" => 0.0, "weight_unit" => "lb", "inventory_item_id" => 1070325095, "inventory_quantity" => 0, "old_inventory_quantity" => 0, "presentment_prices" => [["price" => ["amount" => "0.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/1070325095"]], "options" => [["id" => 1055547261, "product_id" => 1071559625, "name" => "Title", "position" => 1, "values" => ["Default Title"]]], "images" => [], "image" => null]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/products.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["product" => ["title" => "Burton Custom Freestyle 151", "body_html" => "<strong>Good snowboard!</strong>", "vendor" => "Burton", "product_type" => "Snowboard", "tags" => ["Barnes & Noble", "Big Air", "John's Fav"]]]),
            ),
        ]);

        $product = new Product($this->test_session);
        $product->title = "Burton Custom Freestyle 151";
        $product->body_html = "<strong>Good snowboard!</strong>";
        $product->vendor = "Burton";
        $product->product_type = "Snowboard";
        $product->tags = [
            "Barnes & Noble",
            "Big Air",
            "John's Fav"
        ];
        $product->save();
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
                  ["product" => ["id" => 1071559626, "title" => "Burton Custom Freestyle 151", "body_html" => "<strong>Good snowboard!</strong>", "vendor" => "Burton", "product_type" => "Snowboard", "created_at" => "2022-02-03T17:19:44-05:00", "handle" => "burton-custom-freestyle-151", "updated_at" => "2022-02-03T17:19:44-05:00", "published_at" => null, "template_suffix" => null, "status" => "active", "published_scope" => "web", "tags" => "", "admin_graphql_api_id" => "gid://shopify/Product/1071559626", "variants" => [["id" => 1070325096, "product_id" => 1071559626, "title" => "Default Title", "price" => "0.00", "sku" => "", "position" => 1, "inventory_policy" => "deny", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => null, "option1" => "Default Title", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:19:44-05:00", "updated_at" => "2022-02-03T17:19:44-05:00", "taxable" => true, "barcode" => null, "grams" => 0, "image_id" => null, "weight" => 0.0, "weight_unit" => "lb", "inventory_item_id" => 1070325096, "inventory_quantity" => 0, "old_inventory_quantity" => 0, "presentment_prices" => [["price" => ["amount" => "0.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/1070325096"]], "options" => [["id" => 1055547262, "product_id" => 1071559626, "name" => "Title", "position" => 1, "values" => ["Default Title"]]], "images" => [], "image" => null]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/products.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["product" => ["title" => "Burton Custom Freestyle 151", "body_html" => "<strong>Good snowboard!</strong>", "vendor" => "Burton", "product_type" => "Snowboard", "published" => false]]),
            ),
        ]);

        $product = new Product($this->test_session);
        $product->title = "Burton Custom Freestyle 151";
        $product->body_html = "<strong>Good snowboard!</strong>";
        $product->vendor = "Burton";
        $product->product_type = "Snowboard";
        $product->published = false;
        $product->save();
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
                  ["product" => ["id" => 1071559627, "title" => "Burton Custom Freestyle 151", "body_html" => "<strong>Good snowboard!</strong>", "vendor" => "Burton", "product_type" => "Snowboard", "created_at" => "2022-02-03T17:19:46-05:00", "handle" => "burton-custom-freestyle-151", "updated_at" => "2022-02-03T17:19:46-05:00", "published_at" => null, "template_suffix" => null, "status" => "draft", "published_scope" => "web", "tags" => "", "admin_graphql_api_id" => "gid://shopify/Product/1071559627", "variants" => [["id" => 1070325097, "product_id" => 1071559627, "title" => "Default Title", "price" => "0.00", "sku" => "", "position" => 1, "inventory_policy" => "deny", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => null, "option1" => "Default Title", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:19:46-05:00", "updated_at" => "2022-02-03T17:19:46-05:00", "taxable" => true, "barcode" => null, "grams" => 0, "image_id" => null, "weight" => 0.0, "weight_unit" => "lb", "inventory_item_id" => 1070325097, "inventory_quantity" => 0, "old_inventory_quantity" => 0, "presentment_prices" => [["price" => ["amount" => "0.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/1070325097"]], "options" => [["id" => 1055547263, "product_id" => 1071559627, "name" => "Title", "position" => 1, "values" => ["Default Title"]]], "images" => [], "image" => null]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/products.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["product" => ["title" => "Burton Custom Freestyle 151", "body_html" => "<strong>Good snowboard!</strong>", "vendor" => "Burton", "product_type" => "Snowboard", "status" => "draft"]]),
            ),
        ]);

        $product = new Product($this->test_session);
        $product->title = "Burton Custom Freestyle 151";
        $product->body_html = "<strong>Good snowboard!</strong>";
        $product->vendor = "Burton";
        $product->product_type = "Snowboard";
        $product->status = "draft";
        $product->save();
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
                  ["product" => ["id" => 1071559628, "title" => "Burton Custom Freestyle 151", "body_html" => "<strong>Good snowboard!</strong>", "vendor" => "Burton", "product_type" => "Snowboard", "created_at" => "2022-02-03T17:19:48-05:00", "handle" => "burton-custom-freestyle-151", "updated_at" => "2022-02-03T17:19:48-05:00", "published_at" => "2022-02-03T17:19:48-05:00", "template_suffix" => null, "status" => "active", "published_scope" => "web", "tags" => "", "admin_graphql_api_id" => "gid://shopify/Product/1071559628", "variants" => [["id" => 1070325098, "product_id" => 1071559628, "title" => "First", "price" => "10.00", "sku" => "123", "position" => 1, "inventory_policy" => "deny", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => null, "option1" => "First", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:19:48-05:00", "updated_at" => "2022-02-03T17:19:48-05:00", "taxable" => true, "barcode" => null, "grams" => 0, "image_id" => null, "weight" => 0.0, "weight_unit" => "lb", "inventory_item_id" => 1070325098, "inventory_quantity" => 0, "old_inventory_quantity" => 0, "presentment_prices" => [["price" => ["amount" => "10.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/1070325098"], ["id" => 1070325099, "product_id" => 1071559628, "title" => "Second", "price" => "20.00", "sku" => "123", "position" => 2, "inventory_policy" => "deny", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => null, "option1" => "Second", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:19:48-05:00", "updated_at" => "2022-02-03T17:19:48-05:00", "taxable" => true, "barcode" => null, "grams" => 0, "image_id" => null, "weight" => 0.0, "weight_unit" => "lb", "inventory_item_id" => 1070325099, "inventory_quantity" => 0, "old_inventory_quantity" => 0, "presentment_prices" => [["price" => ["amount" => "20.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/1070325099"]], "options" => [["id" => 1055547264, "product_id" => 1071559628, "name" => "Title", "position" => 1, "values" => ["First", "Second"]]], "images" => [], "image" => null]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/products.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["product" => ["title" => "Burton Custom Freestyle 151", "body_html" => "<strong>Good snowboard!</strong>", "vendor" => "Burton", "product_type" => "Snowboard", "variants" => [["option1" => "First", "price" => "10.00", "sku" => "123"], ["option1" => "Second", "price" => "20.00", "sku" => "123"]]]]),
            ),
        ]);

        $product = new Product($this->test_session);
        $product->title = "Burton Custom Freestyle 151";
        $product->body_html = "<strong>Good snowboard!</strong>";
        $product->vendor = "Burton";
        $product->product_type = "Snowboard";
        $product->variants = [
            [
                "option1" => "First",
                "price" => "10.00",
                "sku" => "123"
            ],
            [
                "option1" => "Second",
                "price" => "20.00",
                "sku" => "123"
            ]
        ];
        $product->save();
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
                  ["product" => ["id" => 1071559629, "title" => "Burton Custom Freestyle 151", "body_html" => "<strong>Good snowboard!</strong>", "vendor" => "Burton", "product_type" => "Snowboard", "created_at" => "2022-02-03T17:19:50-05:00", "handle" => "burton-custom-freestyle-151", "updated_at" => "2022-02-03T17:19:50-05:00", "published_at" => "2022-02-03T17:19:50-05:00", "template_suffix" => null, "status" => "active", "published_scope" => "web", "tags" => "", "admin_graphql_api_id" => "gid://shopify/Product/1071559629", "variants" => [["id" => 1070325100, "product_id" => 1071559629, "title" => "Blue / 155", "price" => "0.00", "sku" => "", "position" => 1, "inventory_policy" => "deny", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => null, "option1" => "Blue", "option2" => "155", "option3" => null, "created_at" => "2022-02-03T17:19:50-05:00", "updated_at" => "2022-02-03T17:19:50-05:00", "taxable" => true, "barcode" => null, "grams" => 0, "image_id" => null, "weight" => 0.0, "weight_unit" => "lb", "inventory_item_id" => 1070325100, "inventory_quantity" => 0, "old_inventory_quantity" => 0, "presentment_prices" => [["price" => ["amount" => "0.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/1070325100"], ["id" => 1070325101, "product_id" => 1071559629, "title" => "Black / 159", "price" => "0.00", "sku" => "", "position" => 2, "inventory_policy" => "deny", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => null, "option1" => "Black", "option2" => "159", "option3" => null, "created_at" => "2022-02-03T17:19:50-05:00", "updated_at" => "2022-02-03T17:19:50-05:00", "taxable" => true, "barcode" => null, "grams" => 0, "image_id" => null, "weight" => 0.0, "weight_unit" => "lb", "inventory_item_id" => 1070325101, "inventory_quantity" => 0, "old_inventory_quantity" => 0, "presentment_prices" => [["price" => ["amount" => "0.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/1070325101"]], "options" => [["id" => 1055547265, "product_id" => 1071559629, "name" => "Color", "position" => 1, "values" => ["Blue", "Black"]], ["id" => 1055547266, "product_id" => 1071559629, "name" => "Size", "position" => 2, "values" => ["155", "159"]]], "images" => [], "image" => null]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/products.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["product" => ["title" => "Burton Custom Freestyle 151", "body_html" => "<strong>Good snowboard!</strong>", "vendor" => "Burton", "product_type" => "Snowboard", "variants" => [["option1" => "Blue", "option2" => "155"], ["option1" => "Black", "option2" => "159"]], "options" => [["name" => "Color", "values" => ["Blue", "Black"]], ["name" => "Size", "values" => ["155", "159"]]]]]),
            ),
        ]);

        $product = new Product($this->test_session);
        $product->title = "Burton Custom Freestyle 151";
        $product->body_html = "<strong>Good snowboard!</strong>";
        $product->vendor = "Burton";
        $product->product_type = "Snowboard";
        $product->variants = [
            [
                "option1" => "Blue",
                "option2" => "155"
            ],
            [
                "option1" => "Black",
                "option2" => "159"
            ]
        ];
        $product->options = [
            [
                "name" => "Color",
                "values" => [
                    "Blue",
                    "Black"
                ]
            ],
            [
                "name" => "Size",
                "values" => [
                    "155",
                    "159"
                ]
            ]
        ];
        $product->save();
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
                  ["product" => ["id" => 1071559630, "title" => "Burton Custom Freestyle 151", "body_html" => "<strong>Good snowboard!</strong>", "vendor" => "Burton", "product_type" => "Snowboard", "created_at" => "2022-02-03T17:19:52-05:00", "handle" => "burton-custom-freestyle-151", "updated_at" => "2022-02-03T17:19:52-05:00", "published_at" => "2022-02-03T17:19:52-05:00", "template_suffix" => null, "status" => "active", "published_scope" => "web", "tags" => "", "admin_graphql_api_id" => "gid://shopify/Product/1071559630", "variants" => [["id" => 1070325102, "product_id" => 1071559630, "title" => "Default Title", "price" => "0.00", "sku" => "", "position" => 1, "inventory_policy" => "deny", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => null, "option1" => "Default Title", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:19:52-05:00", "updated_at" => "2022-02-03T17:19:52-05:00", "taxable" => true, "barcode" => null, "grams" => 0, "image_id" => null, "weight" => 0.0, "weight_unit" => "lb", "inventory_item_id" => 1070325102, "inventory_quantity" => 0, "old_inventory_quantity" => 0, "presentment_prices" => [["price" => ["amount" => "0.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/1070325102"]], "options" => [["id" => 1055547267, "product_id" => 1071559630, "name" => "Title", "position" => 1, "values" => ["Default Title"]]], "images" => [["id" => 1001473928, "product_id" => 1071559630, "position" => 1, "created_at" => "2022-02-03T17:19:52-05:00", "updated_at" => "2022-02-03T17:19:52-05:00", "alt" => null, "width" => 1, "height" => 1, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/df3e567d6f16d040326c7a0ea29a4f41.gif?v=1643926792", "variant_ids" => [], "admin_graphql_api_id" => "gid://shopify/ProductImage/1001473928"]], "image" => ["id" => 1001473928, "product_id" => 1071559630, "position" => 1, "created_at" => "2022-02-03T17:19:52-05:00", "updated_at" => "2022-02-03T17:19:52-05:00", "alt" => null, "width" => 1, "height" => 1, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/df3e567d6f16d040326c7a0ea29a4f41.gif?v=1643926792", "variant_ids" => [], "admin_graphql_api_id" => "gid://shopify/ProductImage/1001473928"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/products.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["product" => ["title" => "Burton Custom Freestyle 151", "body_html" => "<strong>Good snowboard!</strong>", "vendor" => "Burton", "product_type" => "Snowboard", "images" => [["attachment" => "R0lGODlhAQABAIAAAAAAAAAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==\n"]]]]),
            ),
        ]);

        $product = new Product($this->test_session);
        $product->title = "Burton Custom Freestyle 151";
        $product->body_html = "<strong>Good snowboard!</strong>";
        $product->vendor = "Burton";
        $product->product_type = "Snowboard";
        $product->images = [
            [
                "attachment" => "R0lGODlhAQABAIAAAAAAAAAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==\n"
            ]
        ];
        $product->save();
    }

    /**

     *
     * @return void
     */
    public function test_13(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["product" => ["id" => 1071559631, "title" => "Burton Custom Freestyle 151", "body_html" => "<strong>Good snowboard!</strong>", "vendor" => "Burton", "product_type" => "Snowboard", "created_at" => "2022-02-03T17:19:54-05:00", "handle" => "burton-custom-freestyle-151", "updated_at" => "2022-02-03T17:19:54-05:00", "published_at" => "2022-02-03T17:19:54-05:00", "template_suffix" => null, "status" => "active", "published_scope" => "web", "tags" => "", "admin_graphql_api_id" => "gid://shopify/Product/1071559631", "variants" => [["id" => 1070325103, "product_id" => 1071559631, "title" => "Default Title", "price" => "0.00", "sku" => "", "position" => 1, "inventory_policy" => "deny", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => null, "option1" => "Default Title", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:19:54-05:00", "updated_at" => "2022-02-03T17:19:54-05:00", "taxable" => true, "barcode" => null, "grams" => 0, "image_id" => null, "weight" => 0.0, "weight_unit" => "lb", "inventory_item_id" => 1070325103, "inventory_quantity" => 0, "old_inventory_quantity" => 0, "presentment_prices" => [["price" => ["amount" => "0.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/1070325103"]], "options" => [["id" => 1055547268, "product_id" => 1071559631, "name" => "Title", "position" => 1, "values" => ["Default Title"]]], "images" => [["id" => 1001473929, "product_id" => 1071559631, "position" => 1, "created_at" => "2022-02-03T17:19:54-05:00", "updated_at" => "2022-02-03T17:19:54-05:00", "alt" => null, "width" => 110, "height" => 140, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/rails_logo20220203-1526776-b30eyr.gif?v=1643926794", "variant_ids" => [], "admin_graphql_api_id" => "gid://shopify/ProductImage/1001473929"]], "image" => ["id" => 1001473929, "product_id" => 1071559631, "position" => 1, "created_at" => "2022-02-03T17:19:54-05:00", "updated_at" => "2022-02-03T17:19:54-05:00", "alt" => null, "width" => 110, "height" => 140, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/rails_logo20220203-1526776-b30eyr.gif?v=1643926794", "variant_ids" => [], "admin_graphql_api_id" => "gid://shopify/ProductImage/1001473929"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/products.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["product" => ["title" => "Burton Custom Freestyle 151", "body_html" => "<strong>Good snowboard!</strong>", "vendor" => "Burton", "product_type" => "Snowboard", "images" => [["src" => "http://example.com/rails_logo.gif"]]]]),
            ),
        ]);

        $product = new Product($this->test_session);
        $product->title = "Burton Custom Freestyle 151";
        $product->body_html = "<strong>Good snowboard!</strong>";
        $product->vendor = "Burton";
        $product->product_type = "Snowboard";
        $product->images = [
            [
                "src" => "http://example.com/rails_logo.gif"
            ]
        ];
        $product->save();
    }

    /**

     *
     * @return void
     */
    public function test_14(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["product" => ["id" => 1071559632, "title" => "Burton Custom Freestyle 151", "body_html" => "<strong>Good snowboard!</strong>", "vendor" => "Burton", "product_type" => "Snowboard", "created_at" => "2022-02-03T17:19:57-05:00", "handle" => "burton-custom-freestyle-151", "updated_at" => "2022-02-03T17:19:57-05:00", "published_at" => "2022-02-03T17:19:57-05:00", "template_suffix" => null, "status" => "active", "published_scope" => "web", "tags" => "", "admin_graphql_api_id" => "gid://shopify/Product/1071559632", "variants" => [["id" => 1070325104, "product_id" => 1071559632, "title" => "Default Title", "price" => "0.00", "sku" => "", "position" => 1, "inventory_policy" => "deny", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => null, "option1" => "Default Title", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:19:57-05:00", "updated_at" => "2022-02-03T17:19:57-05:00", "taxable" => true, "barcode" => null, "grams" => 0, "image_id" => null, "weight" => 0.0, "weight_unit" => "lb", "inventory_item_id" => 1070325104, "inventory_quantity" => 0, "old_inventory_quantity" => 0, "presentment_prices" => [["price" => ["amount" => "0.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/1070325104"]], "options" => [["id" => 1055547269, "product_id" => 1071559632, "name" => "Title", "position" => 1, "values" => ["Default Title"]]], "images" => [], "image" => null]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/products.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["product" => ["title" => "Burton Custom Freestyle 151", "body_html" => "<strong>Good snowboard!</strong>", "vendor" => "Burton", "product_type" => "Snowboard", "metafields_global_title_tag" => "Product SEO Title", "metafields_global_description_tag" => "Product SEO Description"]]),
            ),
        ]);

        $product = new Product($this->test_session);
        $product->title = "Burton Custom Freestyle 151";
        $product->body_html = "<strong>Good snowboard!</strong>";
        $product->vendor = "Burton";
        $product->product_type = "Snowboard";
        $product->metafields_global_title_tag = "Product SEO Title";
        $product->metafields_global_description_tag = "Product SEO Description";
        $product->save();
    }

    /**

     *
     * @return void
     */
    public function test_15(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["product" => ["id" => 1071559633, "title" => "Burton Custom Freestyle 151", "body_html" => "<strong>Good snowboard!</strong>", "vendor" => "Burton", "product_type" => "Snowboard", "created_at" => "2022-02-03T17:19:59-05:00", "handle" => "burton-custom-freestyle-151", "updated_at" => "2022-02-03T17:20:00-05:00", "published_at" => "2022-02-03T17:19:59-05:00", "template_suffix" => null, "status" => "active", "published_scope" => "web", "tags" => "", "admin_graphql_api_id" => "gid://shopify/Product/1071559633", "variants" => [["id" => 1070325105, "product_id" => 1071559633, "title" => "Default Title", "price" => "0.00", "sku" => "", "position" => 1, "inventory_policy" => "deny", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => null, "option1" => "Default Title", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:19:59-05:00", "updated_at" => "2022-02-03T17:19:59-05:00", "taxable" => true, "barcode" => null, "grams" => 0, "image_id" => null, "weight" => 0.0, "weight_unit" => "lb", "inventory_item_id" => 1070325105, "inventory_quantity" => 0, "old_inventory_quantity" => 0, "presentment_prices" => [["price" => ["amount" => "0.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/1070325105"]], "options" => [["id" => 1055547270, "product_id" => 1071559633, "name" => "Title", "position" => 1, "values" => ["Default Title"]]], "images" => [], "image" => null]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/products.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["product" => ["title" => "Burton Custom Freestyle 151", "body_html" => "<strong>Good snowboard!</strong>", "vendor" => "Burton", "product_type" => "Snowboard", "metafields" => [["key" => "new", "value" => "newvalue", "type" => "single_line_text_field", "namespace" => "global"]]]]),
            ),
        ]);

        $product = new Product($this->test_session);
        $product->title = "Burton Custom Freestyle 151";
        $product->body_html = "<strong>Good snowboard!</strong>";
        $product->vendor = "Burton";
        $product->product_type = "Snowboard";
        $product->metafields = [
            [
                "key" => "new",
                "value" => "newvalue",
                "type" => "single_line_text_field",
                "namespace" => "global"
            ]
        ];
        $product->save();
    }

    /**

     *
     * @return void
     */
    public function test_16(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["count" => 2]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/products/count.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Product::count(
            $this->test_session,
            [],
            [],
        );
    }

    /**

     *
     * @return void
     */
    public function test_17(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["count" => 1]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/products/count.json?collection_id=841564295",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Product::count(
            $this->test_session,
            [],
            ["collection_id" => "841564295"],
        );
    }

    /**

     *
     * @return void
     */
    public function test_18(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["product" => ["id" => 632910392, "title" => "IPod Nano - 8GB", "body_html" => "<p>It's the small iPod with one very big idea: Video. Now the world's most popular music player, available in 4GB and 8GB models, lets you enjoy TV shows, movies, video podcasts, and more. The larger, brighter display means amazing picture quality. In six eye-catching colors, iPod nano is stunning all around. And with models starting at just \$149, little speaks volumes.</p>", "vendor" => "Apple", "product_type" => "Cult Products", "created_at" => "2022-02-03T17:14:40-05:00", "handle" => "ipod-nano", "updated_at" => "2022-02-03T17:14:40-05:00", "published_at" => "2007-12-31T19:00:00-05:00", "template_suffix" => null, "status" => "active", "published_scope" => "web", "tags" => "Emotive, Flash Memory, MP3, Music", "admin_graphql_api_id" => "gid://shopify/Product/632910392", "variants" => [["id" => 808950810, "product_id" => 632910392, "title" => "Pink", "price" => "199.00", "sku" => "IPOD2008PINK", "position" => 1, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Pink", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "taxable" => true, "barcode" => "1234_pink", "grams" => 567, "image_id" => 562641783, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 808950810, "inventory_quantity" => 10, "old_inventory_quantity" => 10, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/808950810"], ["id" => 49148385, "product_id" => 632910392, "title" => "Red", "price" => "199.00", "sku" => "IPOD2008RED", "position" => 2, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Red", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "taxable" => true, "barcode" => "1234_red", "grams" => 567, "image_id" => null, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 49148385, "inventory_quantity" => 20, "old_inventory_quantity" => 20, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/49148385"], ["id" => 39072856, "product_id" => 632910392, "title" => "Green", "price" => "199.00", "sku" => "IPOD2008GREEN", "position" => 3, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Green", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "taxable" => true, "barcode" => "1234_green", "grams" => 567, "image_id" => null, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 39072856, "inventory_quantity" => 30, "old_inventory_quantity" => 30, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/39072856"], ["id" => 457924702, "product_id" => 632910392, "title" => "Black", "price" => "199.00", "sku" => "IPOD2008BLACK", "position" => 4, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Black", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "taxable" => true, "barcode" => "1234_black", "grams" => 567, "image_id" => null, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 457924702, "inventory_quantity" => 40, "old_inventory_quantity" => 40, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/457924702"]], "options" => [["id" => 594680422, "product_id" => 632910392, "name" => "Color", "position" => 1, "values" => ["Pink", "Red", "Green", "Black"]]], "images" => [["id" => 850703190, "product_id" => 632910392, "position" => 1, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano.png?v=1643926480", "variant_ids" => [], "admin_graphql_api_id" => "gid://shopify/ProductImage/850703190"], ["id" => 562641783, "product_id" => 632910392, "position" => 2, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano-2.png?v=1643926480", "variant_ids" => [808950810], "admin_graphql_api_id" => "gid://shopify/ProductImage/562641783"], ["id" => 378407906, "product_id" => 632910392, "position" => 3, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano.png?v=1643926480", "variant_ids" => [], "admin_graphql_api_id" => "gid://shopify/ProductImage/378407906"]], "image" => ["id" => 850703190, "product_id" => 632910392, "position" => 1, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano.png?v=1643926480", "variant_ids" => [], "admin_graphql_api_id" => "gid://shopify/ProductImage/850703190"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/products/632910392.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Product::find(
            $this->test_session,
            632910392,
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
                $this->buildMockHttpResponse(200, json_encode(
                  ["product" => ["id" => 632910392, "title" => "IPod Nano - 8GB", "images" => [["id" => 850703190, "product_id" => 632910392, "position" => 1, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano.png?v=1643926480", "variant_ids" => [], "admin_graphql_api_id" => "gid://shopify/ProductImage/850703190"], ["id" => 562641783, "product_id" => 632910392, "position" => 2, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano-2.png?v=1643926480", "variant_ids" => [808950810], "admin_graphql_api_id" => "gid://shopify/ProductImage/562641783"], ["id" => 378407906, "product_id" => 632910392, "position" => 3, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano.png?v=1643926480", "variant_ids" => [], "admin_graphql_api_id" => "gid://shopify/ProductImage/378407906"]]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/products/632910392.json?fields=id%2Cimages%2Ctitle",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Product::find(
            $this->test_session,
            632910392,
            [],
            ["fields" => "id,images,title"],
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
                $this->buildMockHttpResponse(200, json_encode(
                  ["product" => ["id" => 632910392, "title" => "New product title", "body_html" => "<p>It's the small iPod with one very big idea: Video. Now the world's most popular music player, available in 4GB and 8GB models, lets you enjoy TV shows, movies, video podcasts, and more. The larger, brighter display means amazing picture quality. In six eye-catching colors, iPod nano is stunning all around. And with models starting at just \$149, little speaks volumes.</p>", "vendor" => "Apple", "product_type" => "Cult Products", "created_at" => "2022-02-03T17:14:40-05:00", "handle" => "ipod-nano", "updated_at" => "2022-02-03T17:20:34-05:00", "published_at" => "2007-12-31T19:00:00-05:00", "template_suffix" => null, "status" => "active", "published_scope" => "web", "tags" => "Emotive, Flash Memory, MP3, Music", "admin_graphql_api_id" => "gid://shopify/Product/632910392", "variants" => [["id" => 808950810, "product_id" => 632910392, "title" => "Pink", "price" => "199.00", "sku" => "IPOD2008PINK", "position" => 1, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Pink", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "taxable" => true, "barcode" => "1234_pink", "grams" => 567, "image_id" => 562641783, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 808950810, "inventory_quantity" => 10, "old_inventory_quantity" => 10, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/808950810"], ["id" => 49148385, "product_id" => 632910392, "title" => "Red", "price" => "199.00", "sku" => "IPOD2008RED", "position" => 2, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Red", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "taxable" => true, "barcode" => "1234_red", "grams" => 567, "image_id" => null, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 49148385, "inventory_quantity" => 20, "old_inventory_quantity" => 20, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/49148385"], ["id" => 39072856, "product_id" => 632910392, "title" => "Green", "price" => "199.00", "sku" => "IPOD2008GREEN", "position" => 3, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Green", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "taxable" => true, "barcode" => "1234_green", "grams" => 567, "image_id" => null, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 39072856, "inventory_quantity" => 30, "old_inventory_quantity" => 30, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/39072856"], ["id" => 457924702, "product_id" => 632910392, "title" => "Black", "price" => "199.00", "sku" => "IPOD2008BLACK", "position" => 4, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Black", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "taxable" => true, "barcode" => "1234_black", "grams" => 567, "image_id" => null, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 457924702, "inventory_quantity" => 40, "old_inventory_quantity" => 40, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/457924702"]], "options" => [["id" => 594680422, "product_id" => 632910392, "name" => "Color", "position" => 1, "values" => ["Pink", "Red", "Green", "Black"]]], "images" => [["id" => 850703190, "product_id" => 632910392, "position" => 1, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano.png?v=1643926480", "variant_ids" => [], "admin_graphql_api_id" => "gid://shopify/ProductImage/850703190"], ["id" => 562641783, "product_id" => 632910392, "position" => 2, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano-2.png?v=1643926480", "variant_ids" => [808950810], "admin_graphql_api_id" => "gid://shopify/ProductImage/562641783"], ["id" => 378407906, "product_id" => 632910392, "position" => 3, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano.png?v=1643926480", "variant_ids" => [], "admin_graphql_api_id" => "gid://shopify/ProductImage/378407906"]], "image" => ["id" => 850703190, "product_id" => 632910392, "position" => 1, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano.png?v=1643926480", "variant_ids" => [], "admin_graphql_api_id" => "gid://shopify/ProductImage/850703190"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/products/632910392.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["product" => ["id" => 632910392, "title" => "New product title"]]),
            ),
        ]);

        $product = new Product($this->test_session);
        $product->id = 632910392;
        $product->title = "New product title";
        $product->save();
    }

    /**

     *
     * @return void
     */
    public function test_21(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["product" => ["id" => 632910392, "title" => "IPod Nano - 8GB", "body_html" => "<p>It's the small iPod with one very big idea: Video. Now the world's most popular music player, available in 4GB and 8GB models, lets you enjoy TV shows, movies, video podcasts, and more. The larger, brighter display means amazing picture quality. In six eye-catching colors, iPod nano is stunning all around. And with models starting at just \$149, little speaks volumes.</p>", "vendor" => "Apple", "product_type" => "Cult Products", "created_at" => "2022-02-03T17:14:40-05:00", "handle" => "ipod-nano", "updated_at" => "2022-02-03T17:20:36-05:00", "published_at" => null, "template_suffix" => null, "status" => "draft", "published_scope" => "web", "tags" => "Emotive, Flash Memory, MP3, Music", "admin_graphql_api_id" => "gid://shopify/Product/632910392", "variants" => [["id" => 808950810, "product_id" => 632910392, "title" => "Pink", "price" => "199.00", "sku" => "IPOD2008PINK", "position" => 1, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Pink", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "taxable" => true, "barcode" => "1234_pink", "grams" => 567, "image_id" => 562641783, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 808950810, "inventory_quantity" => 10, "old_inventory_quantity" => 10, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/808950810"], ["id" => 49148385, "product_id" => 632910392, "title" => "Red", "price" => "199.00", "sku" => "IPOD2008RED", "position" => 2, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Red", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "taxable" => true, "barcode" => "1234_red", "grams" => 567, "image_id" => null, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 49148385, "inventory_quantity" => 20, "old_inventory_quantity" => 20, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/49148385"], ["id" => 39072856, "product_id" => 632910392, "title" => "Green", "price" => "199.00", "sku" => "IPOD2008GREEN", "position" => 3, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Green", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "taxable" => true, "barcode" => "1234_green", "grams" => 567, "image_id" => null, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 39072856, "inventory_quantity" => 30, "old_inventory_quantity" => 30, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/39072856"], ["id" => 457924702, "product_id" => 632910392, "title" => "Black", "price" => "199.00", "sku" => "IPOD2008BLACK", "position" => 4, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Black", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "taxable" => true, "barcode" => "1234_black", "grams" => 567, "image_id" => null, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 457924702, "inventory_quantity" => 40, "old_inventory_quantity" => 40, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/457924702"]], "options" => [["id" => 594680422, "product_id" => 632910392, "name" => "Color", "position" => 1, "values" => ["Pink", "Red", "Green", "Black"]]], "images" => [["id" => 850703190, "product_id" => 632910392, "position" => 1, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano.png?v=1643926480", "variant_ids" => [], "admin_graphql_api_id" => "gid://shopify/ProductImage/850703190"], ["id" => 562641783, "product_id" => 632910392, "position" => 2, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano-2.png?v=1643926480", "variant_ids" => [808950810], "admin_graphql_api_id" => "gid://shopify/ProductImage/562641783"], ["id" => 378407906, "product_id" => 632910392, "position" => 3, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano.png?v=1643926480", "variant_ids" => [], "admin_graphql_api_id" => "gid://shopify/ProductImage/378407906"]], "image" => ["id" => 850703190, "product_id" => 632910392, "position" => 1, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano.png?v=1643926480", "variant_ids" => [], "admin_graphql_api_id" => "gid://shopify/ProductImage/850703190"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/products/632910392.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["product" => ["id" => 632910392, "status" => "draft"]]),
            ),
        ]);

        $product = new Product($this->test_session);
        $product->id = 632910392;
        $product->status = "draft";
        $product->save();
    }

    /**

     *
     * @return void
     */
    public function test_22(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["product" => ["id" => 632910392, "title" => "IPod Nano - 8GB", "body_html" => "<p>It's the small iPod with one very big idea: Video. Now the world's most popular music player, available in 4GB and 8GB models, lets you enjoy TV shows, movies, video podcasts, and more. The larger, brighter display means amazing picture quality. In six eye-catching colors, iPod nano is stunning all around. And with models starting at just \$149, little speaks volumes.</p>", "vendor" => "Apple", "product_type" => "Cult Products", "created_at" => "2022-02-03T17:14:40-05:00", "handle" => "ipod-nano", "updated_at" => "2022-02-03T17:20:38-05:00", "published_at" => "2007-12-31T19:00:00-05:00", "template_suffix" => null, "status" => "active", "published_scope" => "web", "tags" => "Barnes & Noble, John's Fav", "admin_graphql_api_id" => "gid://shopify/Product/632910392", "variants" => [["id" => 808950810, "product_id" => 632910392, "title" => "Pink", "price" => "199.00", "sku" => "IPOD2008PINK", "position" => 1, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Pink", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "taxable" => true, "barcode" => "1234_pink", "grams" => 567, "image_id" => 562641783, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 808950810, "inventory_quantity" => 10, "old_inventory_quantity" => 10, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/808950810"], ["id" => 49148385, "product_id" => 632910392, "title" => "Red", "price" => "199.00", "sku" => "IPOD2008RED", "position" => 2, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Red", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "taxable" => true, "barcode" => "1234_red", "grams" => 567, "image_id" => null, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 49148385, "inventory_quantity" => 20, "old_inventory_quantity" => 20, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/49148385"], ["id" => 39072856, "product_id" => 632910392, "title" => "Green", "price" => "199.00", "sku" => "IPOD2008GREEN", "position" => 3, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Green", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "taxable" => true, "barcode" => "1234_green", "grams" => 567, "image_id" => null, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 39072856, "inventory_quantity" => 30, "old_inventory_quantity" => 30, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/39072856"], ["id" => 457924702, "product_id" => 632910392, "title" => "Black", "price" => "199.00", "sku" => "IPOD2008BLACK", "position" => 4, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Black", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "taxable" => true, "barcode" => "1234_black", "grams" => 567, "image_id" => null, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 457924702, "inventory_quantity" => 40, "old_inventory_quantity" => 40, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/457924702"]], "options" => [["id" => 594680422, "product_id" => 632910392, "name" => "Color", "position" => 1, "values" => ["Pink", "Red", "Green", "Black"]]], "images" => [["id" => 850703190, "product_id" => 632910392, "position" => 1, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano.png?v=1643926480", "variant_ids" => [], "admin_graphql_api_id" => "gid://shopify/ProductImage/850703190"], ["id" => 562641783, "product_id" => 632910392, "position" => 2, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano-2.png?v=1643926480", "variant_ids" => [808950810], "admin_graphql_api_id" => "gid://shopify/ProductImage/562641783"], ["id" => 378407906, "product_id" => 632910392, "position" => 3, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano.png?v=1643926480", "variant_ids" => [], "admin_graphql_api_id" => "gid://shopify/ProductImage/378407906"]], "image" => ["id" => 850703190, "product_id" => 632910392, "position" => 1, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano.png?v=1643926480", "variant_ids" => [], "admin_graphql_api_id" => "gid://shopify/ProductImage/850703190"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/products/632910392.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["product" => ["id" => 632910392, "tags" => "Barnes & Noble, John's Fav"]]),
            ),
        ]);

        $product = new Product($this->test_session);
        $product->id = 632910392;
        $product->tags = "Barnes & Noble, John's Fav";
        $product->save();
    }

    /**

     *
     * @return void
     */
    public function test_23(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["product" => ["id" => 632910392, "title" => "IPod Nano - 8GB", "body_html" => "<p>It's the small iPod with one very big idea: Video. Now the world's most popular music player, available in 4GB and 8GB models, lets you enjoy TV shows, movies, video podcasts, and more. The larger, brighter display means amazing picture quality. In six eye-catching colors, iPod nano is stunning all around. And with models starting at just \$149, little speaks volumes.</p>", "vendor" => "Apple", "product_type" => "Cult Products", "created_at" => "2022-02-03T17:14:40-05:00", "handle" => "ipod-nano", "updated_at" => "2022-02-03T17:20:40-05:00", "published_at" => "2007-12-31T19:00:00-05:00", "template_suffix" => null, "status" => "active", "published_scope" => "web", "tags" => "Emotive, Flash Memory, MP3, Music", "admin_graphql_api_id" => "gid://shopify/Product/632910392", "variants" => [["id" => 808950810, "product_id" => 632910392, "title" => "Pink", "price" => "199.00", "sku" => "IPOD2008PINK", "position" => 1, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Pink", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:20:40-05:00", "taxable" => true, "barcode" => "1234_pink", "grams" => 567, "image_id" => null, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 808950810, "inventory_quantity" => 10, "old_inventory_quantity" => 10, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/808950810"], ["id" => 49148385, "product_id" => 632910392, "title" => "Red", "price" => "199.00", "sku" => "IPOD2008RED", "position" => 2, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Red", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "taxable" => true, "barcode" => "1234_red", "grams" => 567, "image_id" => null, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 49148385, "inventory_quantity" => 20, "old_inventory_quantity" => 20, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/49148385"], ["id" => 39072856, "product_id" => 632910392, "title" => "Green", "price" => "199.00", "sku" => "IPOD2008GREEN", "position" => 3, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Green", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "taxable" => true, "barcode" => "1234_green", "grams" => 567, "image_id" => null, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 39072856, "inventory_quantity" => 30, "old_inventory_quantity" => 30, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/39072856"], ["id" => 457924702, "product_id" => 632910392, "title" => "Black", "price" => "199.00", "sku" => "IPOD2008BLACK", "position" => 4, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Black", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "taxable" => true, "barcode" => "1234_black", "grams" => 567, "image_id" => null, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 457924702, "inventory_quantity" => 40, "old_inventory_quantity" => 40, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/457924702"]], "options" => [["id" => 594680422, "product_id" => 632910392, "name" => "Color", "position" => 1, "values" => ["Pink", "Red", "Green", "Black"]]], "images" => [], "image" => null]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/products/632910392.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["product" => ["id" => 632910392, "images" => []]]),
            ),
        ]);

        $product = new Product($this->test_session);
        $product->id = 632910392;
        $product->images = [];
        $product->save();
    }

    /**

     *
     * @return void
     */
    public function test_24(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["product" => ["id" => 632910392, "title" => "IPod Nano - 8GB", "body_html" => "<p>It's the small iPod with one very big idea: Video. Now the world's most popular music player, available in 4GB and 8GB models, lets you enjoy TV shows, movies, video podcasts, and more. The larger, brighter display means amazing picture quality. In six eye-catching colors, iPod nano is stunning all around. And with models starting at just \$149, little speaks volumes.</p>", "vendor" => "Apple", "product_type" => "Cult Products", "created_at" => "2022-02-03T17:14:40-05:00", "handle" => "ipod-nano", "updated_at" => "2022-02-03T17:20:44-05:00", "published_at" => "2007-12-31T19:00:00-05:00", "template_suffix" => null, "status" => "active", "published_scope" => "web", "tags" => "Emotive, Flash Memory, MP3, Music", "admin_graphql_api_id" => "gid://shopify/Product/632910392", "variants" => [["id" => 808950810, "product_id" => 632910392, "title" => "Pink", "price" => "199.00", "sku" => "IPOD2008PINK", "position" => 1, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Pink", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "taxable" => true, "barcode" => "1234_pink", "grams" => 567, "image_id" => 562641783, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 808950810, "inventory_quantity" => 10, "old_inventory_quantity" => 10, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/808950810"], ["id" => 49148385, "product_id" => 632910392, "title" => "Red", "price" => "199.00", "sku" => "IPOD2008RED", "position" => 2, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Red", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "taxable" => true, "barcode" => "1234_red", "grams" => 567, "image_id" => null, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 49148385, "inventory_quantity" => 20, "old_inventory_quantity" => 20, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/49148385"], ["id" => 39072856, "product_id" => 632910392, "title" => "Green", "price" => "199.00", "sku" => "IPOD2008GREEN", "position" => 3, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Green", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "taxable" => true, "barcode" => "1234_green", "grams" => 567, "image_id" => null, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 39072856, "inventory_quantity" => 30, "old_inventory_quantity" => 30, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/39072856"], ["id" => 457924702, "product_id" => 632910392, "title" => "Black", "price" => "199.00", "sku" => "IPOD2008BLACK", "position" => 4, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Black", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "taxable" => true, "barcode" => "1234_black", "grams" => 567, "image_id" => null, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 457924702, "inventory_quantity" => 40, "old_inventory_quantity" => 40, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/457924702"]], "options" => [["id" => 594680422, "product_id" => 632910392, "name" => "Color", "position" => 1, "values" => ["Pink", "Red", "Green", "Black"]]], "images" => [["id" => 850703190, "product_id" => 632910392, "position" => 1, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano.png?v=1643926480", "variant_ids" => [], "admin_graphql_api_id" => "gid://shopify/ProductImage/850703190"], ["id" => 562641783, "product_id" => 632910392, "position" => 2, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano-2.png?v=1643926480", "variant_ids" => [808950810], "admin_graphql_api_id" => "gid://shopify/ProductImage/562641783"], ["id" => 378407906, "product_id" => 632910392, "position" => 3, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano.png?v=1643926480", "variant_ids" => [], "admin_graphql_api_id" => "gid://shopify/ProductImage/378407906"], ["id" => 1001473931, "product_id" => 632910392, "position" => 4, "created_at" => "2022-02-03T17:20:44-05:00", "updated_at" => "2022-02-03T17:20:44-05:00", "alt" => null, "width" => 110, "height" => 140, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/rails_logo20220203-1526776-s8p8gs.gif?v=1643926844", "variant_ids" => [], "admin_graphql_api_id" => "gid://shopify/ProductImage/1001473931"]], "image" => ["id" => 850703190, "product_id" => 632910392, "position" => 1, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano.png?v=1643926480", "variant_ids" => [], "admin_graphql_api_id" => "gid://shopify/ProductImage/850703190"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/products/632910392.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["product" => ["id" => 632910392, "images" => [["id" => 850703190], ["id" => 562641783], ["id" => 378407906], ["src" => "http://example.com/rails_logo.gif"]]]]),
            ),
        ]);

        $product = new Product($this->test_session);
        $product->id = 632910392;
        $product->images = [
            [
                "id" => 850703190
            ],
            [
                "id" => 562641783
            ],
            [
                "id" => 378407906
            ],
            [
                "src" => "http://example.com/rails_logo.gif"
            ]
        ];
        $product->save();
    }

    /**

     *
     * @return void
     */
    public function test_25(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["product" => ["id" => 632910392, "title" => "IPod Nano - 8GB", "body_html" => "<p>It's the small iPod with one very big idea: Video. Now the world's most popular music player, available in 4GB and 8GB models, lets you enjoy TV shows, movies, video podcasts, and more. The larger, brighter display means amazing picture quality. In six eye-catching colors, iPod nano is stunning all around. And with models starting at just \$149, little speaks volumes.</p>", "vendor" => "Apple", "product_type" => "Cult Products", "created_at" => "2022-02-03T17:14:40-05:00", "handle" => "ipod-nano", "updated_at" => "2022-02-03T17:20:46-05:00", "published_at" => "2007-12-31T19:00:00-05:00", "template_suffix" => null, "status" => "active", "published_scope" => "web", "tags" => "Emotive, Flash Memory, MP3, Music", "admin_graphql_api_id" => "gid://shopify/Product/632910392", "variants" => [["id" => 808950810, "product_id" => 632910392, "title" => "Pink", "price" => "199.00", "sku" => "IPOD2008PINK", "position" => 1, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Pink", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "taxable" => true, "barcode" => "1234_pink", "grams" => 567, "image_id" => 562641783, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 808950810, "inventory_quantity" => 10, "old_inventory_quantity" => 10, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/808950810"], ["id" => 49148385, "product_id" => 632910392, "title" => "Red", "price" => "199.00", "sku" => "IPOD2008RED", "position" => 2, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Red", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "taxable" => true, "barcode" => "1234_red", "grams" => 567, "image_id" => null, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 49148385, "inventory_quantity" => 20, "old_inventory_quantity" => 20, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/49148385"], ["id" => 39072856, "product_id" => 632910392, "title" => "Green", "price" => "199.00", "sku" => "IPOD2008GREEN", "position" => 3, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Green", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "taxable" => true, "barcode" => "1234_green", "grams" => 567, "image_id" => null, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 39072856, "inventory_quantity" => 30, "old_inventory_quantity" => 30, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/39072856"], ["id" => 457924702, "product_id" => 632910392, "title" => "Black", "price" => "199.00", "sku" => "IPOD2008BLACK", "position" => 4, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Black", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "taxable" => true, "barcode" => "1234_black", "grams" => 567, "image_id" => null, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 457924702, "inventory_quantity" => 40, "old_inventory_quantity" => 40, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/457924702"]], "options" => [["id" => 594680422, "product_id" => 632910392, "name" => "Color", "position" => 1, "values" => ["Pink", "Red", "Green", "Black"]]], "images" => [["id" => 378407906, "product_id" => 632910392, "position" => 1, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:20:46-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano.png?v=1643926846", "variant_ids" => [], "admin_graphql_api_id" => "gid://shopify/ProductImage/378407906"], ["id" => 562641783, "product_id" => 632910392, "position" => 2, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano-2.png?v=1643926480", "variant_ids" => [808950810], "admin_graphql_api_id" => "gid://shopify/ProductImage/562641783"], ["id" => 850703190, "product_id" => 632910392, "position" => 3, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:20:46-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano.png?v=1643926846", "variant_ids" => [], "admin_graphql_api_id" => "gid://shopify/ProductImage/850703190"]], "image" => ["id" => 378407906, "product_id" => 632910392, "position" => 1, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:20:46-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano.png?v=1643926846", "variant_ids" => [], "admin_graphql_api_id" => "gid://shopify/ProductImage/378407906"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/products/632910392.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["product" => ["id" => 632910392, "images" => [["id" => 850703190, "position" => 3], ["id" => 562641783, "position" => 2], ["id" => 378407906, "position" => 1]]]]),
            ),
        ]);

        $product = new Product($this->test_session);
        $product->id = 632910392;
        $product->images = [
            [
                "id" => 850703190,
                "position" => 3
            ],
            [
                "id" => 562641783,
                "position" => 2
            ],
            [
                "id" => 378407906,
                "position" => 1
            ]
        ];
        $product->save();
    }

    /**

     *
     * @return void
     */
    public function test_26(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["product" => ["id" => 632910392, "title" => "IPod Nano - 8GB", "body_html" => "<p>It's the small iPod with one very big idea: Video. Now the world's most popular music player, available in 4GB and 8GB models, lets you enjoy TV shows, movies, video podcasts, and more. The larger, brighter display means amazing picture quality. In six eye-catching colors, iPod nano is stunning all around. And with models starting at just \$149, little speaks volumes.</p>", "vendor" => "Apple", "product_type" => "Cult Products", "created_at" => "2022-02-03T17:14:40-05:00", "handle" => "ipod-nano", "updated_at" => "2022-02-03T17:20:49-05:00", "published_at" => "2007-12-31T19:00:00-05:00", "template_suffix" => null, "status" => "active", "published_scope" => "web", "tags" => "Emotive, Flash Memory, MP3, Music", "admin_graphql_api_id" => "gid://shopify/Product/632910392", "variants" => [["id" => 457924702, "product_id" => 632910392, "title" => "Black", "price" => "199.00", "sku" => "IPOD2008BLACK", "position" => 1, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Black", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:20:49-05:00", "taxable" => true, "barcode" => "1234_black", "grams" => 567, "image_id" => null, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 457924702, "inventory_quantity" => 40, "old_inventory_quantity" => 40, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/457924702"], ["id" => 39072856, "product_id" => 632910392, "title" => "Green", "price" => "199.00", "sku" => "IPOD2008GREEN", "position" => 2, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Green", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:20:49-05:00", "taxable" => true, "barcode" => "1234_green", "grams" => 567, "image_id" => null, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 39072856, "inventory_quantity" => 30, "old_inventory_quantity" => 30, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/39072856"], ["id" => 49148385, "product_id" => 632910392, "title" => "Red", "price" => "199.00", "sku" => "IPOD2008RED", "position" => 3, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Red", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:20:49-05:00", "taxable" => true, "barcode" => "1234_red", "grams" => 567, "image_id" => null, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 49148385, "inventory_quantity" => 20, "old_inventory_quantity" => 20, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/49148385"], ["id" => 808950810, "product_id" => 632910392, "title" => "Pink", "price" => "199.00", "sku" => "IPOD2008PINK", "position" => 4, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Pink", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:20:49-05:00", "taxable" => true, "barcode" => "1234_pink", "grams" => 567, "image_id" => 562641783, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 808950810, "inventory_quantity" => 10, "old_inventory_quantity" => 10, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/808950810"]], "options" => [["id" => 594680422, "product_id" => 632910392, "name" => "Color", "position" => 1, "values" => ["Black", "Green", "Red", "Pink"]]], "images" => [["id" => 850703190, "product_id" => 632910392, "position" => 1, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano.png?v=1643926480", "variant_ids" => [], "admin_graphql_api_id" => "gid://shopify/ProductImage/850703190"], ["id" => 562641783, "product_id" => 632910392, "position" => 2, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano-2.png?v=1643926480", "variant_ids" => [808950810], "admin_graphql_api_id" => "gid://shopify/ProductImage/562641783"], ["id" => 378407906, "product_id" => 632910392, "position" => 3, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano.png?v=1643926480", "variant_ids" => [], "admin_graphql_api_id" => "gid://shopify/ProductImage/378407906"]], "image" => ["id" => 850703190, "product_id" => 632910392, "position" => 1, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano.png?v=1643926480", "variant_ids" => [], "admin_graphql_api_id" => "gid://shopify/ProductImage/850703190"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/products/632910392.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["product" => ["id" => 632910392, "variants" => [["id" => 457924702], ["id" => 39072856], ["id" => 49148385], ["id" => 808950810]]]]),
            ),
        ]);

        $product = new Product($this->test_session);
        $product->id = 632910392;
        $product->variants = [
            [
                "id" => 457924702
            ],
            [
                "id" => 39072856
            ],
            [
                "id" => 49148385
            ],
            [
                "id" => 808950810
            ]
        ];
        $product->save();
    }

    /**

     *
     * @return void
     */
    public function test_27(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["product" => ["id" => 632910392, "title" => "Updated Product Title", "body_html" => "<p>It's the small iPod with one very big idea: Video. Now the world's most popular music player, available in 4GB and 8GB models, lets you enjoy TV shows, movies, video podcasts, and more. The larger, brighter display means amazing picture quality. In six eye-catching colors, iPod nano is stunning all around. And with models starting at just \$149, little speaks volumes.</p>", "vendor" => "Apple", "product_type" => "Cult Products", "created_at" => "2022-02-03T17:14:40-05:00", "handle" => "ipod-nano", "updated_at" => "2022-02-03T17:20:53-05:00", "published_at" => "2007-12-31T19:00:00-05:00", "template_suffix" => null, "status" => "active", "published_scope" => "web", "tags" => "Emotive, Flash Memory, MP3, Music", "admin_graphql_api_id" => "gid://shopify/Product/632910392", "variants" => [["id" => 808950810, "product_id" => 632910392, "title" => "Pink", "price" => "2000.00", "sku" => "Updating the Product SKU", "position" => 1, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Pink", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:20:53-05:00", "taxable" => true, "barcode" => "1234_pink", "grams" => 567, "image_id" => 562641783, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 808950810, "inventory_quantity" => 10, "old_inventory_quantity" => 10, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/808950810"], ["id" => 49148385, "product_id" => 632910392, "title" => "Red", "price" => "199.00", "sku" => "IPOD2008RED", "position" => 2, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Red", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "taxable" => true, "barcode" => "1234_red", "grams" => 567, "image_id" => null, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 49148385, "inventory_quantity" => 20, "old_inventory_quantity" => 20, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/49148385"], ["id" => 39072856, "product_id" => 632910392, "title" => "Green", "price" => "199.00", "sku" => "IPOD2008GREEN", "position" => 3, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Green", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "taxable" => true, "barcode" => "1234_green", "grams" => 567, "image_id" => null, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 39072856, "inventory_quantity" => 30, "old_inventory_quantity" => 30, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/39072856"], ["id" => 457924702, "product_id" => 632910392, "title" => "Black", "price" => "199.00", "sku" => "IPOD2008BLACK", "position" => 4, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Black", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "taxable" => true, "barcode" => "1234_black", "grams" => 567, "image_id" => null, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 457924702, "inventory_quantity" => 40, "old_inventory_quantity" => 40, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/457924702"]], "options" => [["id" => 594680422, "product_id" => 632910392, "name" => "Color", "position" => 1, "values" => ["Pink", "Red", "Green", "Black"]]], "images" => [["id" => 850703190, "product_id" => 632910392, "position" => 1, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano.png?v=1643926480", "variant_ids" => [], "admin_graphql_api_id" => "gid://shopify/ProductImage/850703190"], ["id" => 562641783, "product_id" => 632910392, "position" => 2, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano-2.png?v=1643926480", "variant_ids" => [808950810], "admin_graphql_api_id" => "gid://shopify/ProductImage/562641783"], ["id" => 378407906, "product_id" => 632910392, "position" => 3, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano.png?v=1643926480", "variant_ids" => [], "admin_graphql_api_id" => "gid://shopify/ProductImage/378407906"]], "image" => ["id" => 850703190, "product_id" => 632910392, "position" => 1, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano.png?v=1643926480", "variant_ids" => [], "admin_graphql_api_id" => "gid://shopify/ProductImage/850703190"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/products/632910392.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["product" => ["id" => 632910392, "title" => "Updated Product Title", "variants" => [["id" => 808950810, "price" => "2000.00", "sku" => "Updating the Product SKU"], ["id" => 49148385], ["id" => 39072856], ["id" => 457924702]]]]),
            ),
        ]);

        $product = new Product($this->test_session);
        $product->id = 632910392;
        $product->title = "Updated Product Title";
        $product->variants = [
            [
                "id" => 808950810,
                "price" => "2000.00",
                "sku" => "Updating the Product SKU"
            ],
            [
                "id" => 49148385
            ],
            [
                "id" => 39072856
            ],
            [
                "id" => 457924702
            ]
        ];
        $product->save();
    }

    /**

     *
     * @return void
     */
    public function test_28(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["product" => ["id" => 632910392, "title" => "IPod Nano - 8GB", "body_html" => "<p>It's the small iPod with one very big idea: Video. Now the world's most popular music player, available in 4GB and 8GB models, lets you enjoy TV shows, movies, video podcasts, and more. The larger, brighter display means amazing picture quality. In six eye-catching colors, iPod nano is stunning all around. And with models starting at just \$149, little speaks volumes.</p>", "vendor" => "Apple", "product_type" => "Cult Products", "created_at" => "2022-02-03T17:14:40-05:00", "handle" => "ipod-nano", "updated_at" => "2022-02-03T17:14:40-05:00", "published_at" => "2007-12-31T19:00:00-05:00", "template_suffix" => null, "status" => "active", "published_scope" => "web", "tags" => "Emotive, Flash Memory, MP3, Music", "admin_graphql_api_id" => "gid://shopify/Product/632910392", "variants" => [["id" => 808950810, "product_id" => 632910392, "title" => "Pink", "price" => "199.00", "sku" => "IPOD2008PINK", "position" => 1, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Pink", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "taxable" => true, "barcode" => "1234_pink", "grams" => 567, "image_id" => 562641783, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 808950810, "inventory_quantity" => 10, "old_inventory_quantity" => 10, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/808950810"], ["id" => 49148385, "product_id" => 632910392, "title" => "Red", "price" => "199.00", "sku" => "IPOD2008RED", "position" => 2, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Red", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "taxable" => true, "barcode" => "1234_red", "grams" => 567, "image_id" => null, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 49148385, "inventory_quantity" => 20, "old_inventory_quantity" => 20, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/49148385"], ["id" => 39072856, "product_id" => 632910392, "title" => "Green", "price" => "199.00", "sku" => "IPOD2008GREEN", "position" => 3, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Green", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "taxable" => true, "barcode" => "1234_green", "grams" => 567, "image_id" => null, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 39072856, "inventory_quantity" => 30, "old_inventory_quantity" => 30, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/39072856"], ["id" => 457924702, "product_id" => 632910392, "title" => "Black", "price" => "199.00", "sku" => "IPOD2008BLACK", "position" => 4, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Black", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "taxable" => true, "barcode" => "1234_black", "grams" => 567, "image_id" => null, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 457924702, "inventory_quantity" => 40, "old_inventory_quantity" => 40, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/457924702"]], "options" => [["id" => 594680422, "product_id" => 632910392, "name" => "Color", "position" => 1, "values" => ["Pink", "Red", "Green", "Black"]]], "images" => [["id" => 850703190, "product_id" => 632910392, "position" => 1, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano.png?v=1643926480", "variant_ids" => [], "admin_graphql_api_id" => "gid://shopify/ProductImage/850703190"], ["id" => 562641783, "product_id" => 632910392, "position" => 2, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano-2.png?v=1643926480", "variant_ids" => [808950810], "admin_graphql_api_id" => "gid://shopify/ProductImage/562641783"], ["id" => 378407906, "product_id" => 632910392, "position" => 3, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano.png?v=1643926480", "variant_ids" => [], "admin_graphql_api_id" => "gid://shopify/ProductImage/378407906"]], "image" => ["id" => 850703190, "product_id" => 632910392, "position" => 1, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano.png?v=1643926480", "variant_ids" => [], "admin_graphql_api_id" => "gid://shopify/ProductImage/850703190"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/products/632910392.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["product" => ["id" => 632910392, "metafields_global_title_tag" => "Brand new title", "metafields_global_description_tag" => "Brand new description"]]),
            ),
        ]);

        $product = new Product($this->test_session);
        $product->id = 632910392;
        $product->metafields_global_title_tag = "Brand new title";
        $product->metafields_global_description_tag = "Brand new description";
        $product->save();
    }

    /**

     *
     * @return void
     */
    public function test_29(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["product" => ["id" => 632910392, "title" => "IPod Nano - 8GB", "body_html" => "<p>It's the small iPod with one very big idea: Video. Now the world's most popular music player, available in 4GB and 8GB models, lets you enjoy TV shows, movies, video podcasts, and more. The larger, brighter display means amazing picture quality. In six eye-catching colors, iPod nano is stunning all around. And with models starting at just \$149, little speaks volumes.</p>", "vendor" => "Apple", "product_type" => "Cult Products", "created_at" => "2022-02-03T17:14:40-05:00", "handle" => "ipod-nano", "updated_at" => "2022-02-03T17:20:57-05:00", "published_at" => "2022-02-03T17:20:57-05:00", "template_suffix" => null, "status" => "active", "published_scope" => "web", "tags" => "Emotive, Flash Memory, MP3, Music", "admin_graphql_api_id" => "gid://shopify/Product/632910392", "variants" => [["id" => 808950810, "product_id" => 632910392, "title" => "Pink", "price" => "199.00", "sku" => "IPOD2008PINK", "position" => 1, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Pink", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "taxable" => true, "barcode" => "1234_pink", "grams" => 567, "image_id" => 562641783, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 808950810, "inventory_quantity" => 10, "old_inventory_quantity" => 10, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/808950810"], ["id" => 49148385, "product_id" => 632910392, "title" => "Red", "price" => "199.00", "sku" => "IPOD2008RED", "position" => 2, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Red", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "taxable" => true, "barcode" => "1234_red", "grams" => 567, "image_id" => null, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 49148385, "inventory_quantity" => 20, "old_inventory_quantity" => 20, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/49148385"], ["id" => 39072856, "product_id" => 632910392, "title" => "Green", "price" => "199.00", "sku" => "IPOD2008GREEN", "position" => 3, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Green", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "taxable" => true, "barcode" => "1234_green", "grams" => 567, "image_id" => null, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 39072856, "inventory_quantity" => 30, "old_inventory_quantity" => 30, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/39072856"], ["id" => 457924702, "product_id" => 632910392, "title" => "Black", "price" => "199.00", "sku" => "IPOD2008BLACK", "position" => 4, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Black", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "taxable" => true, "barcode" => "1234_black", "grams" => 567, "image_id" => null, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 457924702, "inventory_quantity" => 40, "old_inventory_quantity" => 40, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/457924702"]], "options" => [["id" => 594680422, "product_id" => 632910392, "name" => "Color", "position" => 1, "values" => ["Pink", "Red", "Green", "Black"]]], "images" => [["id" => 850703190, "product_id" => 632910392, "position" => 1, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano.png?v=1643926480", "variant_ids" => [], "admin_graphql_api_id" => "gid://shopify/ProductImage/850703190"], ["id" => 562641783, "product_id" => 632910392, "position" => 2, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano-2.png?v=1643926480", "variant_ids" => [808950810], "admin_graphql_api_id" => "gid://shopify/ProductImage/562641783"], ["id" => 378407906, "product_id" => 632910392, "position" => 3, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano.png?v=1643926480", "variant_ids" => [], "admin_graphql_api_id" => "gid://shopify/ProductImage/378407906"]], "image" => ["id" => 850703190, "product_id" => 632910392, "position" => 1, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano.png?v=1643926480", "variant_ids" => [], "admin_graphql_api_id" => "gid://shopify/ProductImage/850703190"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/products/632910392.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["product" => ["id" => 632910392, "published" => true]]),
            ),
        ]);

        $product = new Product($this->test_session);
        $product->id = 632910392;
        $product->published = true;
        $product->save();
    }

    /**

     *
     * @return void
     */
    public function test_30(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["product" => ["id" => 632910392, "title" => "IPod Nano - 8GB", "body_html" => "<p>It's the small iPod with one very big idea: Video. Now the world's most popular music player, available in 4GB and 8GB models, lets you enjoy TV shows, movies, video podcasts, and more. The larger, brighter display means amazing picture quality. In six eye-catching colors, iPod nano is stunning all around. And with models starting at just \$149, little speaks volumes.</p>", "vendor" => "Apple", "product_type" => "Cult Products", "created_at" => "2022-02-03T17:14:40-05:00", "handle" => "ipod-nano", "updated_at" => "2022-02-03T17:20:59-05:00", "published_at" => null, "template_suffix" => null, "status" => "active", "published_scope" => "web", "tags" => "Emotive, Flash Memory, MP3, Music", "admin_graphql_api_id" => "gid://shopify/Product/632910392", "variants" => [["id" => 808950810, "product_id" => 632910392, "title" => "Pink", "price" => "199.00", "sku" => "IPOD2008PINK", "position" => 1, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Pink", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "taxable" => true, "barcode" => "1234_pink", "grams" => 567, "image_id" => 562641783, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 808950810, "inventory_quantity" => 10, "old_inventory_quantity" => 10, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/808950810"], ["id" => 49148385, "product_id" => 632910392, "title" => "Red", "price" => "199.00", "sku" => "IPOD2008RED", "position" => 2, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Red", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "taxable" => true, "barcode" => "1234_red", "grams" => 567, "image_id" => null, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 49148385, "inventory_quantity" => 20, "old_inventory_quantity" => 20, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/49148385"], ["id" => 39072856, "product_id" => 632910392, "title" => "Green", "price" => "199.00", "sku" => "IPOD2008GREEN", "position" => 3, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Green", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "taxable" => true, "barcode" => "1234_green", "grams" => 567, "image_id" => null, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 39072856, "inventory_quantity" => 30, "old_inventory_quantity" => 30, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/39072856"], ["id" => 457924702, "product_id" => 632910392, "title" => "Black", "price" => "199.00", "sku" => "IPOD2008BLACK", "position" => 4, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Black", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "taxable" => true, "barcode" => "1234_black", "grams" => 567, "image_id" => null, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 457924702, "inventory_quantity" => 40, "old_inventory_quantity" => 40, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/457924702"]], "options" => [["id" => 594680422, "product_id" => 632910392, "name" => "Color", "position" => 1, "values" => ["Pink", "Red", "Green", "Black"]]], "images" => [["id" => 850703190, "product_id" => 632910392, "position" => 1, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano.png?v=1643926480", "variant_ids" => [], "admin_graphql_api_id" => "gid://shopify/ProductImage/850703190"], ["id" => 562641783, "product_id" => 632910392, "position" => 2, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano-2.png?v=1643926480", "variant_ids" => [808950810], "admin_graphql_api_id" => "gid://shopify/ProductImage/562641783"], ["id" => 378407906, "product_id" => 632910392, "position" => 3, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano.png?v=1643926480", "variant_ids" => [], "admin_graphql_api_id" => "gid://shopify/ProductImage/378407906"]], "image" => ["id" => 850703190, "product_id" => 632910392, "position" => 1, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano.png?v=1643926480", "variant_ids" => [], "admin_graphql_api_id" => "gid://shopify/ProductImage/850703190"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/products/632910392.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["product" => ["id" => 632910392, "published" => false]]),
            ),
        ]);

        $product = new Product($this->test_session);
        $product->id = 632910392;
        $product->published = false;
        $product->save();
    }

    /**

     *
     * @return void
     */
    public function test_31(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["product" => ["id" => 632910392, "title" => "IPod Nano - 8GB", "body_html" => "<p>It's the small iPod with one very big idea: Video. Now the world's most popular music player, available in 4GB and 8GB models, lets you enjoy TV shows, movies, video podcasts, and more. The larger, brighter display means amazing picture quality. In six eye-catching colors, iPod nano is stunning all around. And with models starting at just \$149, little speaks volumes.</p>", "vendor" => "Apple", "product_type" => "Cult Products", "created_at" => "2022-02-03T17:14:40-05:00", "handle" => "ipod-nano", "updated_at" => "2022-02-03T17:21:01-05:00", "published_at" => "2007-12-31T19:00:00-05:00", "template_suffix" => null, "status" => "active", "published_scope" => "web", "tags" => "Emotive, Flash Memory, MP3, Music", "admin_graphql_api_id" => "gid://shopify/Product/632910392", "variants" => [["id" => 808950810, "product_id" => 632910392, "title" => "Pink", "price" => "199.00", "sku" => "IPOD2008PINK", "position" => 1, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Pink", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "taxable" => true, "barcode" => "1234_pink", "grams" => 567, "image_id" => 562641783, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 808950810, "inventory_quantity" => 10, "old_inventory_quantity" => 10, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/808950810"], ["id" => 49148385, "product_id" => 632910392, "title" => "Red", "price" => "199.00", "sku" => "IPOD2008RED", "position" => 2, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Red", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "taxable" => true, "barcode" => "1234_red", "grams" => 567, "image_id" => null, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 49148385, "inventory_quantity" => 20, "old_inventory_quantity" => 20, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/49148385"], ["id" => 39072856, "product_id" => 632910392, "title" => "Green", "price" => "199.00", "sku" => "IPOD2008GREEN", "position" => 3, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Green", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "taxable" => true, "barcode" => "1234_green", "grams" => 567, "image_id" => null, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 39072856, "inventory_quantity" => 30, "old_inventory_quantity" => 30, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/39072856"], ["id" => 457924702, "product_id" => 632910392, "title" => "Black", "price" => "199.00", "sku" => "IPOD2008BLACK", "position" => 4, "inventory_policy" => "continue", "compare_at_price" => null, "fulfillment_service" => "manual", "inventory_management" => "shopify", "option1" => "Black", "option2" => null, "option3" => null, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "taxable" => true, "barcode" => "1234_black", "grams" => 567, "image_id" => null, "weight" => 1.25, "weight_unit" => "lb", "inventory_item_id" => 457924702, "inventory_quantity" => 40, "old_inventory_quantity" => 40, "presentment_prices" => [["price" => ["amount" => "199.00", "currency_code" => "USD"], "compare_at_price" => null]], "requires_shipping" => true, "admin_graphql_api_id" => "gid://shopify/ProductVariant/457924702"]], "options" => [["id" => 594680422, "product_id" => 632910392, "name" => "Color", "position" => 1, "values" => ["Pink", "Red", "Green", "Black"]]], "images" => [["id" => 850703190, "product_id" => 632910392, "position" => 1, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano.png?v=1643926480", "variant_ids" => [], "admin_graphql_api_id" => "gid://shopify/ProductImage/850703190"], ["id" => 562641783, "product_id" => 632910392, "position" => 2, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano-2.png?v=1643926480", "variant_ids" => [808950810], "admin_graphql_api_id" => "gid://shopify/ProductImage/562641783"], ["id" => 378407906, "product_id" => 632910392, "position" => 3, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano.png?v=1643926480", "variant_ids" => [], "admin_graphql_api_id" => "gid://shopify/ProductImage/378407906"]], "image" => ["id" => 850703190, "product_id" => 632910392, "position" => 1, "created_at" => "2022-02-03T17:14:40-05:00", "updated_at" => "2022-02-03T17:14:40-05:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano.png?v=1643926480", "variant_ids" => [], "admin_graphql_api_id" => "gid://shopify/ProductImage/850703190"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/products/632910392.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["product" => ["id" => 632910392, "metafields" => [["key" => "new", "value" => "newvalue", "type" => "single_line_text_field", "namespace" => "global"]]]]),
            ),
        ]);

        $product = new Product($this->test_session);
        $product->id = 632910392;
        $product->metafields = [
            [
                "key" => "new",
                "value" => "newvalue",
                "type" => "single_line_text_field",
                "namespace" => "global"
            ]
        ];
        $product->save();
    }

    /**

     *
     * @return void
     */
    public function test_32(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  []
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/products/632910392.json",
                "DELETE",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Product::delete(
            $this->test_session,
            632910392,
            [],
            [],
        );
    }

}
