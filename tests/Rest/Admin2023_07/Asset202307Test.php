<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Admin2023_07\Asset;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class Asset202307Test extends BaseTestCase
{
    /** @var Session */
    private $test_session;

    public function setUp(): void
    {
        parent::setUp();

        Context::$API_VERSION = "2023-07";

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
                  ["assets" => [["key" => "layout/theme.liquid", "public_url" => null, "created_at" => "2010-07-12T15:31:50-04:00", "updated_at" => "2010-07-12T15:31:50-04:00", "content_type" => "application/x-liquid", "size" => 3252, "checksum" => null, "theme_id" => 828155753], ["key" => "assets/sidebar-devider.gif", "public_url" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/t/1/assets/sidebar-devider.gif?v=1278963110", "created_at" => "2010-07-12T15:31:50-04:00", "updated_at" => "2010-07-12T15:31:50-04:00", "content_type" => "image/gif", "size" => 1016, "checksum" => null, "theme_id" => 828155753], ["key" => "assets/bg-body-pink.gif", "public_url" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/t/1/assets/bg-body-pink.gif?v=1278963110", "created_at" => "2010-07-12T15:31:50-04:00", "updated_at" => "2010-07-12T15:31:50-04:00", "content_type" => "image/gif", "size" => 1562, "checksum" => null, "theme_id" => 828155753], ["key" => "assets/bg-content.gif", "public_url" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/t/1/assets/bg-content.gif?v=1278963110", "created_at" => "2010-07-12T15:31:50-04:00", "updated_at" => "2010-07-12T15:31:50-04:00", "content_type" => "image/gif", "size" => 134, "checksum" => null, "theme_id" => 828155753], ["key" => "sections/header_section.liquid", "public_url" => null, "created_at" => "2017-04-28T10:30:00-04:00", "updated_at" => "2017-04-28T10:30:00-04:00", "content_type" => "application/x-liquid", "size" => 998, "checksum" => null, "theme_id" => 828155753], ["key" => "assets/shop.css.liquid", "public_url" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/t/1/assets/shop.css.liquid?v=1278963110", "created_at" => "2010-07-12T15:31:50-04:00", "updated_at" => "2010-07-12T15:31:50-04:00", "content_type" => "application/x-liquid", "size" => 14675, "checksum" => null, "theme_id" => 828155753], ["key" => "assets/shop.js", "public_url" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/t/1/assets/shop.js?v=1278963110", "created_at" => "2010-07-12T15:31:50-04:00", "updated_at" => "2010-07-12T15:31:50-04:00", "content_type" => "application/javascript", "size" => 348, "checksum" => null, "theme_id" => 828155753], ["key" => "assets/bg-main.gif", "public_url" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/t/1/assets/bg-main.gif?v=1278963110", "created_at" => "2010-07-12T15:31:50-04:00", "updated_at" => "2010-07-12T15:31:50-04:00", "content_type" => "image/gif", "size" => 297, "checksum" => null, "theme_id" => 828155753], ["key" => "sections/content_section.liquid", "public_url" => null, "created_at" => "2016-02-11T14:31:50-05:00", "updated_at" => "2016-02-11T14:31:50-05:00", "content_type" => "application/x-liquid", "size" => 997, "checksum" => null, "theme_id" => 828155753], ["key" => "templates/page.liquid", "public_url" => null, "created_at" => "2010-07-12T15:31:50-04:00", "updated_at" => "2010-07-12T15:31:50-04:00", "content_type" => "application/x-liquid", "size" => 147, "checksum" => null, "theme_id" => 828155753], ["key" => "assets/bg-body-green.gif", "public_url" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/t/1/assets/bg-body-green.gif?v=1278963110", "created_at" => "2010-07-12T15:31:50-04:00", "updated_at" => "2010-07-12T15:31:50-04:00", "content_type" => "image/gif", "size" => 1542, "checksum" => null, "theme_id" => 828155753], ["key" => "assets/shop.css", "public_url" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/t/1/assets/shop.css?v=1278963110", "created_at" => "2010-07-12T15:31:50-04:00", "updated_at" => "2010-07-12T15:31:50-04:00", "content_type" => "text/css", "size" => 14058, "checksum" => null, "theme_id" => 828155753], ["key" => "config/settings_schema.json", "public_url" => null, "created_at" => "2010-07-12T15:31:50-04:00", "updated_at" => "2010-07-12T15:31:50-04:00", "content_type" => "application/json", "size" => 4570, "checksum" => null, "theme_id" => 828155753], ["key" => "sections/product_section.liquid", "public_url" => null, "created_at" => "2016-02-14T16:31:41-05:00", "updated_at" => "2016-02-14T16:31:41-05:00", "content_type" => "application/x-liquid", "size" => 2440, "checksum" => null, "theme_id" => 828155753], ["key" => "templates/blog.liquid", "public_url" => null, "created_at" => "2010-07-12T15:31:50-04:00", "updated_at" => "2010-07-12T15:31:50-04:00", "content_type" => "application/x-liquid", "size" => 786, "checksum" => null, "theme_id" => 828155753], ["key" => "templates/article.liquid", "public_url" => null, "created_at" => "2010-07-12T15:31:50-04:00", "updated_at" => "2010-07-12T15:31:50-04:00", "content_type" => "application/x-liquid", "size" => 2486, "checksum" => null, "theme_id" => 828155753], ["key" => "templates/product.liquid", "public_url" => null, "created_at" => "2010-07-12T15:31:50-04:00", "updated_at" => "2010-07-12T15:31:50-04:00", "content_type" => "application/x-liquid", "size" => 2796, "checksum" => null, "theme_id" => 828155753], ["key" => "sections/footer_section.liquid", "public_url" => null, "created_at" => "2017-04-28T10:30:00-04:00", "updated_at" => "2017-04-28T10:30:00-04:00", "content_type" => "application/x-liquid", "size" => 999, "checksum" => null, "theme_id" => 828155753], ["key" => "assets/bg-footer.gif", "public_url" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/t/1/assets/bg-footer.gif?v=1278963110", "created_at" => "2010-07-12T15:31:50-04:00", "updated_at" => "2010-07-12T15:31:50-04:00", "content_type" => "image/gif", "size" => 1434, "checksum" => null, "theme_id" => 828155753], ["key" => "assets/bg-sidebar.gif", "public_url" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/t/1/assets/bg-sidebar.gif?v=1278963110", "created_at" => "2010-07-12T15:31:50-04:00", "updated_at" => "2010-07-12T15:31:50-04:00", "content_type" => "image/gif", "size" => 124, "checksum" => null, "theme_id" => 828155753], ["key" => "assets/bg-body-orange.gif", "public_url" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/t/1/assets/bg-body-orange.gif?v=1278963110", "created_at" => "2010-07-12T15:31:50-04:00", "updated_at" => "2010-07-12T15:31:50-04:00", "content_type" => "image/gif", "size" => 1548, "checksum" => null, "theme_id" => 828155753], ["key" => "templates/collection.liquid", "public_url" => null, "created_at" => "2010-07-12T15:31:50-04:00", "updated_at" => "2010-07-12T15:31:50-04:00", "content_type" => "application/x-liquid", "size" => 946, "checksum" => null, "theme_id" => 828155753], ["key" => "assets/sidebar-menu.jpg", "public_url" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/t/1/assets/sidebar-menu.jpg?v=1278963110", "created_at" => "2010-07-12T15:31:50-04:00", "updated_at" => "2010-07-12T15:31:50-04:00", "content_type" => "image/jpeg", "size" => 1609, "checksum" => null, "theme_id" => 828155753], ["key" => "templates/cart.liquid", "public_url" => null, "created_at" => "2010-07-12T15:31:50-04:00", "updated_at" => "2010-07-12T15:31:50-04:00", "content_type" => "application/x-liquid", "size" => 2047, "checksum" => null, "theme_id" => 828155753], ["key" => "config/settings_data.json", "public_url" => null, "created_at" => "2010-07-12T15:31:50-04:00", "updated_at" => "2010-07-12T15:31:50-04:00", "content_type" => "application/json", "size" => 4570, "checksum" => null, "theme_id" => 828155753], ["key" => "templates/index.liquid", "public_url" => null, "created_at" => "2010-07-12T15:31:50-04:00", "updated_at" => "2010-07-12T15:31:50-04:00", "content_type" => "application/x-liquid", "size" => 1068, "checksum" => null, "theme_id" => 828155753], ["key" => "assets/bg-body.gif", "public_url" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/t/1/assets/bg-body.gif?v=1278963110", "created_at" => "2010-07-12T15:31:50-04:00", "updated_at" => "2010-07-12T15:31:50-04:00", "content_type" => "image/gif", "size" => 1571, "checksum" => null, "theme_id" => 828155753]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2023-07/themes/828155753/assets.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Asset::all(
            $this->test_session,
            ["theme_id" => "828155753"],
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
                  ["asset" => ["key" => "templates/index.liquid", "public_url" => null, "created_at" => "2010-07-12T15:31:50-04:00", "updated_at" => "2023-07-05T18:50:56-04:00", "content_type" => "application/x-liquid", "size" => 110, "checksum" => "cd71db2e14df976c8aa44b44c8dae77b", "theme_id" => 828155753]]
                )),
                "https://test-shop.myshopify.io/admin/api/2023-07/themes/828155753/assets.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["asset" => ["key" => "templates/index.liquid", "value" => "<img src='backsoon-postit.png'><p>We are busy updating the store for you and will be back within the hour.</p>"]]),
            ),
        ]);

        $asset = new Asset($this->test_session);
        $asset->theme_id = 828155753;
        $asset->key = "templates/index.liquid";
        $asset->value = "<img src='backsoon-postit.png'><p>We are busy updating the store for you and will be back within the hour.</p>";
        $asset->save();
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
                  ["asset" => ["key" => "assets/empty.gif", "public_url" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/t/1/assets/empty.gif?v=1688597455", "created_at" => "2023-07-05T18:50:55-04:00", "updated_at" => "2023-07-05T18:50:55-04:00", "content_type" => "image/gif", "size" => 43, "checksum" => "45cf913e5d9d3c9b2058033056d3dd23", "theme_id" => 828155753]]
                )),
                "https://test-shop.myshopify.io/admin/api/2023-07/themes/828155753/assets.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["asset" => ["key" => "assets/empty.gif", "attachment" => "R0lGODlhAQABAPABAP///wAAACH5BAEKAAAALAAAAAABAAEAAAICRAEAOw==\n"]]),
            ),
        ]);

        $asset = new Asset($this->test_session);
        $asset->theme_id = 828155753;
        $asset->key = "assets/empty.gif";
        $asset->attachment = "R0lGODlhAQABAPABAP///wAAACH5BAEKAAAALAAAAAABAAEAAAICRAEAOw==\n";
        $asset->save();
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
                  ["asset" => ["key" => "assets/bg-body.gif", "public_url" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/t/1/assets/bg-body.gif?v=1688597459", "created_at" => "2010-07-12T15:31:50-04:00", "updated_at" => "2023-07-05T18:50:59-04:00", "content_type" => "image/gif", "size" => 43, "checksum" => "45cf913e5d9d3c9b2058033056d3dd23", "theme_id" => 828155753]]
                )),
                "https://test-shop.myshopify.io/admin/api/2023-07/themes/828155753/assets.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["asset" => ["key" => "assets/bg-body.gif", "src" => "http://example.com/new_bg.gif"]]),
            ),
        ]);

        $asset = new Asset($this->test_session);
        $asset->theme_id = 828155753;
        $asset->key = "assets/bg-body.gif";
        $asset->src = "http://example.com/new_bg.gif";
        $asset->save();
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
                  ["asset" => ["key" => "layout/alternate.liquid", "public_url" => null, "created_at" => "2023-07-05T18:50:58-04:00", "updated_at" => "2023-07-05T18:50:58-04:00", "content_type" => "application/x-liquid", "size" => 3049, "checksum" => "1879a06996941b2ff1ff485a1fe60a97", "theme_id" => 828155753]]
                )),
                "https://test-shop.myshopify.io/admin/api/2023-07/themes/828155753/assets.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["asset" => ["key" => "layout/alternate.liquid", "source_key" => "layout/theme.liquid"]]),
            ),
        ]);

        $asset = new Asset($this->test_session);
        $asset->theme_id = 828155753;
        $asset->key = "layout/alternate.liquid";
        $asset->source_key = "layout/theme.liquid";
        $asset->save();
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
                  ["asset" => ["key" => "templates/index.liquid", "public_url" => null, "value" => "<!-- LIST 3 PER ROW -->\n<h2>Featured Products</h2>\n<table id=\"products\" cellspacing=\"0\" cellpadding=\"0\">\n  {% tablerow product in collections.frontpage.products cols:3 %}\n    <a href=\"{{product.url}}\">{{ product.featured_image | product_img_url: 'small' | img_tag }}</a>\n    <h3><a href=\"{{product.url}}\">{{product.title}}</a></h3>\n    <ul class=\"attributes\">\n      <li><span class=\"money\">{{product.price_min | money}}</span></li>\n    </ul>\n  {% endtablerow %}\n</table>\n<!-- /LIST 3 PER ROW -->\n\n{{ content_for_index }}\n\n<div id=\"articles\">\n  {% assign article = pages.frontpage %}\n  <div class=\"article\">\n    {% if article.content != \"\" %}\n      <h3>{{ article.title }}</h3>\n      <div class=\"article-body textile\">\n        {{ article.content }}\n      </div>\n    {% else %}\n      <div class=\"article-body textile\">\n        In <em>Admin &gt; Blogs &amp; Pages</em>, create a page with the handle <strong><code>frontpage</code></strong> and it will show up here.\n        <br />\n        {{ \"Learn more about handles\" | link_to \"http://wiki.shopify.com/Handle\" }}\n      </div>\n    {% endif %}\n  </div>\n</div>\n", "created_at" => "2010-07-12T15:31:50-04:00", "updated_at" => "2010-07-12T15:31:50-04:00", "content_type" => "application/x-liquid", "size" => 1068, "checksum" => null, "theme_id" => 828155753]]
                )),
                "https://test-shop.myshopify.io/admin/api/2023-07/themes/828155753/assets.json?asset%5Bkey%5D=templates%2Findex.liquid",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Asset::all(
            $this->test_session,
            ["theme_id" => "828155753"],
            ["asset" => ["key" => "templates/index.liquid"]],
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
                  ["message" => "assets/bg-body.gif was successfully deleted"]
                )),
                "https://test-shop.myshopify.io/admin/api/2023-07/themes/828155753/assets.json?asset%5Bkey%5D=assets%2Fbg-body.gif",
                "DELETE",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Asset::delete(
            $this->test_session,
            ["theme_id" => "828155753"],
            ["asset" => ["key" => "assets/bg-body.gif"]],
        );
    }

}
