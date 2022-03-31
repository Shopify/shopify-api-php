<?php

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Admin2022_04\Page;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class Page202204Test extends BaseTestCase
{
    /** @var Session */
    private $test_session;

    public function setUp(): void
    {
        parent::setUp();

        Context::$API_VERSION = "2022-04";

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
                  ["pages" => [["id" => 108828309, "title" => "Sample Page", "shop_id" => 548380009, "handle" => "sample", "body_html" => "<p>this is a <strong>sample</strong> page.</p>", "author" => "Dennis", "created_at" => "2008-07-15T20:00:00-04:00", "updated_at" => "2008-07-16T20:00:00-04:00", "published_at" => null, "template_suffix" => null, "admin_graphql_api_id" => "gid://shopify/OnlineStorePage/108828309"], ["id" => 169524623, "title" => "Store hours", "shop_id" => 548380009, "handle" => "store-hours", "body_html" => "<p>We never close.</p>", "author" => "Jobs", "created_at" => "2013-12-31T19:00:00-05:00", "updated_at" => "2013-12-31T19:00:00-05:00", "published_at" => "2014-02-01T19:00:00-05:00", "template_suffix" => null, "admin_graphql_api_id" => "gid://shopify/OnlineStorePage/169524623"], ["id" => 322471, "title" => "Support", "shop_id" => 548380009, "handle" => "support", "body_html" => "<p>Come in store for support.</p>", "author" => "Dennis", "created_at" => "2009-07-15T20:00:00-04:00", "updated_at" => "2009-07-16T20:00:00-04:00", "published_at" => null, "template_suffix" => null, "admin_graphql_api_id" => "gid://shopify/OnlineStorePage/322471"], ["id" => 131092082, "title" => "Terms of Services", "shop_id" => 548380009, "handle" => "tos", "body_html" => "<p>We make <strong>perfect</strong> stuff, we don't need a warranty.</p>", "author" => "Dennis", "created_at" => "2008-07-15T20:00:00-04:00", "updated_at" => "2008-07-16T20:00:00-04:00", "published_at" => "2008-07-15T20:00:00-04:00", "template_suffix" => null, "admin_graphql_api_id" => "gid://shopify/OnlineStorePage/131092082"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/pages.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Page::all(
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
                  ["pages" => [["id" => 131092082, "title" => "Terms of Services", "shop_id" => 548380009, "handle" => "tos", "body_html" => "<p>We make <strong>perfect</strong> stuff, we don't need a warranty.</p>", "author" => "Dennis", "created_at" => "2008-07-15T20:00:00-04:00", "updated_at" => "2008-07-16T20:00:00-04:00", "published_at" => "2008-07-15T20:00:00-04:00", "template_suffix" => null, "admin_graphql_api_id" => "gid://shopify/OnlineStorePage/131092082"], ["id" => 169524623, "title" => "Store hours", "shop_id" => 548380009, "handle" => "store-hours", "body_html" => "<p>We never close.</p>", "author" => "Jobs", "created_at" => "2013-12-31T19:00:00-05:00", "updated_at" => "2013-12-31T19:00:00-05:00", "published_at" => "2014-02-01T19:00:00-05:00", "template_suffix" => null, "admin_graphql_api_id" => "gid://shopify/OnlineStorePage/169524623"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/pages.json?since_id=108828309",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Page::all(
            $this->test_session,
            [],
            ["since_id" => "108828309"],
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
                  ["page" => ["id" => 1025371369, "title" => "Warranty information", "shop_id" => 548380009, "handle" => "warranty-information", "body_html" => "<h2>Warranty</h2>\n<p>Returns accepted if we receive items <strong>30 days after purchase</strong>.</p>", "author" => "Shopify API", "created_at" => "2022-03-30T19:47:18-04:00", "updated_at" => "2022-03-30T19:47:18-04:00", "published_at" => "2022-03-30T19:47:18-04:00", "template_suffix" => null, "admin_graphql_api_id" => "gid://shopify/OnlineStorePage/1025371369"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/pages.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["page" => ["title" => "Warranty information", "body_html" => "<h2>Warranty</h2>\n<p>Returns accepted if we receive items <strong>30 days after purchase</strong>.</p>"]]),
            ),
        ]);

        $page = new Page($this->test_session);
        $page->title = "Warranty information";
        $page->body_html = "<h2>Warranty</h2>\n<p>Returns accepted if we receive items <strong>30 days after purchase</strong>.</p>";
        $page->save();
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
                  ["page" => ["id" => 1025371370, "title" => "Warranty information", "shop_id" => 548380009, "handle" => "warranty-information", "body_html" => "<h2>Warranty</h2>\n<p>Returns accepted if we receive items <strong>30 days after purchase</strong>.</p>", "author" => "Shopify API", "created_at" => "2022-03-30T19:47:19-04:00", "updated_at" => "2022-03-30T19:47:19-04:00", "published_at" => null, "template_suffix" => null, "admin_graphql_api_id" => "gid://shopify/OnlineStorePage/1025371370"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/pages.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["page" => ["title" => "Warranty information", "body_html" => "<h2>Warranty</h2>\n<p>Returns accepted if we receive items <strong>30 days after purchase</strong>.</p>", "published" => false]]),
            ),
        ]);

        $page = new Page($this->test_session);
        $page->title = "Warranty information";
        $page->body_html = "<h2>Warranty</h2>\n<p>Returns accepted if we receive items <strong>30 days after purchase</strong>.</p>";
        $page->published = false;
        $page->save();
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
                  ["page" => ["id" => 1025371371, "title" => "Warranty information", "shop_id" => 548380009, "handle" => "warranty-information", "body_html" => "<h2>Warranty</h2>\n<p>Returns accepted if we receive items <strong>30 days after purchase</strong>.</p>", "author" => "Shopify API", "created_at" => "2022-03-30T19:47:21-04:00", "updated_at" => "2022-03-30T19:47:21-04:00", "published_at" => "2022-03-30T19:47:21-04:00", "template_suffix" => null, "admin_graphql_api_id" => "gid://shopify/OnlineStorePage/1025371371"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/pages.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["page" => ["title" => "Warranty information", "body_html" => "<h2>Warranty</h2>\n<p>Returns accepted if we receive items <strong>30 days after purchase</strong>.</p>", "metafields" => [["key" => "new", "value" => "new value", "type" => "single_line_text_field", "namespace" => "global"]]]]),
            ),
        ]);

        $page = new Page($this->test_session);
        $page->title = "Warranty information";
        $page->body_html = "<h2>Warranty</h2>\n<p>Returns accepted if we receive items <strong>30 days after purchase</strong>.</p>";
        $page->metafields = [
            [
                "key" => "new",
                "value" => "new value",
                "type" => "single_line_text_field",
                "namespace" => "global"
            ]
        ];
        $page->save();
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
                  ["count" => 4]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/pages/count.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Page::count(
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
                $this->buildMockHttpResponse(200, json_encode(
                  ["page" => ["id" => 131092082, "title" => "Terms of Services", "shop_id" => 548380009, "handle" => "tos", "body_html" => "<p>We make <strong>perfect</strong> stuff, we don't need a warranty.</p>", "author" => "Dennis", "created_at" => "2008-07-15T20:00:00-04:00", "updated_at" => "2008-07-16T20:00:00-04:00", "published_at" => "2008-07-15T20:00:00-04:00", "template_suffix" => null, "admin_graphql_api_id" => "gid://shopify/OnlineStorePage/131092082"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/pages/131092082.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Page::find(
            $this->test_session,
            131092082,
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
                $this->buildMockHttpResponse(200, json_encode(
                  ["page" => ["shop_id" => 548380009, "body_html" => "<p>Returns accepted if we receive the items 14 days after purchase.</p>", "title" => "Terms of Services", "handle" => "tos", "id" => 131092082, "author" => "Dennis", "created_at" => "2008-07-15T20:00:00-04:00", "updated_at" => "2022-03-30T19:47:28-04:00", "published_at" => "2008-07-15T20:00:00-04:00", "template_suffix" => null, "admin_graphql_api_id" => "gid://shopify/OnlineStorePage/131092082"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/pages/131092082.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["page" => ["id" => 131092082, "body_html" => "<p>Returns accepted if we receive the items 14 days after purchase.</p>"]]),
            ),
        ]);

        $page = new Page($this->test_session);
        $page->id = 131092082;
        $page->body_html = "<p>Returns accepted if we receive the items 14 days after purchase.</p>";
        $page->save();
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
                  ["page" => ["shop_id" => 548380009, "author" => "Christopher Gorski", "body_html" => "<p>Returns accepted if we receive the items <strong>14 days</strong> after purchase.</p>", "handle" => "new-warranty", "title" => "New warranty", "id" => 131092082, "created_at" => "2008-07-15T20:00:00-04:00", "updated_at" => "2022-03-30T19:47:29-04:00", "published_at" => "2008-07-15T20:00:00-04:00", "template_suffix" => null, "admin_graphql_api_id" => "gid://shopify/OnlineStorePage/131092082"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/pages/131092082.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["page" => ["id" => 131092082, "body_html" => "<p>Returns accepted if we receive the items <strong>14 days</strong> after purchase.</p>", "author" => "Christopher Gorski", "title" => "New warranty", "handle" => "new-warranty"]]),
            ),
        ]);

        $page = new Page($this->test_session);
        $page->id = 131092082;
        $page->body_html = "<p>Returns accepted if we receive the items <strong>14 days</strong> after purchase.</p>";
        $page->author = "Christopher Gorski";
        $page->title = "New warranty";
        $page->handle = "new-warranty";
        $page->save();
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
                  ["page" => ["shop_id" => 548380009, "published_at" => "2022-03-30T19:47:31-04:00", "title" => "Terms of Services", "handle" => "tos", "body_html" => "<p>We make <strong>perfect</strong> stuff, we don't need a warranty.</p>", "id" => 131092082, "author" => "Dennis", "created_at" => "2008-07-15T20:00:00-04:00", "updated_at" => "2022-03-30T19:47:31-04:00", "template_suffix" => null, "admin_graphql_api_id" => "gid://shopify/OnlineStorePage/131092082"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/pages/131092082.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["page" => ["id" => 131092082, "published" => true]]),
            ),
        ]);

        $page = new Page($this->test_session);
        $page->id = 131092082;
        $page->published = true;
        $page->save();
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
                  ["page" => ["shop_id" => 548380009, "published_at" => null, "title" => "Terms of Services", "handle" => "tos", "body_html" => "<p>We make <strong>perfect</strong> stuff, we don't need a warranty.</p>", "id" => 131092082, "author" => "Dennis", "created_at" => "2008-07-15T20:00:00-04:00", "updated_at" => "2022-03-30T19:47:32-04:00", "template_suffix" => null, "admin_graphql_api_id" => "gid://shopify/OnlineStorePage/131092082"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/pages/131092082.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["page" => ["id" => 131092082, "published" => false]]),
            ),
        ]);

        $page = new Page($this->test_session);
        $page->id = 131092082;
        $page->published = false;
        $page->save();
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
                  ["page" => ["shop_id" => 548380009, "title" => "Terms of Services", "handle" => "tos", "body_html" => "<p>We make <strong>perfect</strong> stuff, we don't need a warranty.</p>", "id" => 131092082, "author" => "Dennis", "created_at" => "2008-07-15T20:00:00-04:00", "updated_at" => "2022-03-30T19:47:33-04:00", "published_at" => "2008-07-15T20:00:00-04:00", "template_suffix" => null, "admin_graphql_api_id" => "gid://shopify/OnlineStorePage/131092082"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/pages/131092082.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["page" => ["id" => 131092082, "metafields" => [["key" => "new", "value" => "new value", "type" => "single_line_text_field", "namespace" => "global"]]]]),
            ),
        ]);

        $page = new Page($this->test_session);
        $page->id = 131092082;
        $page->metafields = [
            [
                "key" => "new",
                "value" => "new value",
                "type" => "single_line_text_field",
                "namespace" => "global"
            ]
        ];
        $page->save();
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
                  []
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/pages/131092082.json",
                "DELETE",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Page::delete(
            $this->test_session,
            131092082,
            [],
            [],
        );
    }

}
