<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Admin2022_10\Collection;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class Collection202210Test extends BaseTestCase
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
                  ["collection" => ["id" => 841564295, "handle" => "ipods", "title" => "IPods", "updated_at" => "2008-02-01T19:00:00-05:00", "body_html" => "<p>The best selling ipod ever</p>", "published_at" => "2008-02-01T19:00:00-05:00", "sort_order" => "manual", "template_suffix" => null, "products_count" => 1, "collection_type" => "custom", "published_scope" => "web", "admin_graphql_api_id" => "gid://shopify/Collection/841564295", "image" => ["created_at" => "2023-04-04T17:13:27-04:00", "alt" => "MP3 Player 8gb", "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/collections/ipod_nano_8gb.jpg?v=1680642807"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-10/collections/841564295.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Collection::find(
            $this->test_session,
            841564295,
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
                  ["products" => [["id" => 632910392, "title" => "IPod Nano - 8GB", "body_html" => "<p>It's the small iPod with one very big idea: Video. Now the world's most popular music player, available in 4GB and 8GB models, lets you enjoy TV shows, movies, video podcasts, and more. The larger, brighter display means amazing picture quality. In six eye-catching colors, iPod nano is stunning all around. And with models starting at just \$149, little speaks volumes.</p>", "vendor" => "Apple", "product_type" => "Cult Products", "created_at" => "2023-04-04T17:13:27-04:00", "handle" => "ipod-nano", "updated_at" => "2023-04-04T17:13:27-04:00", "published_at" => "2007-12-31T19:00:00-05:00", "template_suffix" => null, "published_scope" => "web", "tags" => "Emotive, Flash Memory, MP3, Music", "admin_graphql_api_id" => "gid://shopify/Product/632910392", "options" => [["id" => 594680422, "product_id" => 632910392, "name" => "Color", "position" => 1]], "images" => [["id" => 850703190, "product_id" => 632910392, "position" => 1, "created_at" => "2023-04-04T17:13:27-04:00", "updated_at" => "2023-04-04T17:13:27-04:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano.png?v=1680642807", "variant_ids" => [], "admin_graphql_api_id" => "gid://shopify/ProductImage/850703190"], ["id" => 562641783, "product_id" => 632910392, "position" => 2, "created_at" => "2023-04-04T17:13:27-04:00", "updated_at" => "2023-04-04T17:13:27-04:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano-2.png?v=1680642807", "variant_ids" => [808950810], "admin_graphql_api_id" => "gid://shopify/ProductImage/562641783"], ["id" => 378407906, "product_id" => 632910392, "position" => 3, "created_at" => "2023-04-04T17:13:27-04:00", "updated_at" => "2023-04-04T17:13:27-04:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano.png?v=1680642807", "variant_ids" => [], "admin_graphql_api_id" => "gid://shopify/ProductImage/378407906"]], "image" => ["id" => 850703190, "product_id" => 632910392, "position" => 1, "created_at" => "2023-04-04T17:13:27-04:00", "updated_at" => "2023-04-04T17:13:27-04:00", "alt" => null, "width" => 123, "height" => 456, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano.png?v=1680642807", "variant_ids" => [], "admin_graphql_api_id" => "gid://shopify/ProductImage/850703190"]]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-10/collections/841564295/products.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Collection::products(
            $this->test_session,
            841564295,
            [],
            [],
        );
    }

}
