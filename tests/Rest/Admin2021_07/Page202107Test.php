<?php

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Page;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class Page202107Test extends BaseTestCase
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
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-07/pages.json",
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
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-07/pages.json?since_id=108828309",
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
            ["since_id" => 108828309],
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
                "https://test-shop.myshopify.io/admin/api/2021-07/pages.json",
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
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-07/pages.json",
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
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-07/pages.json",
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
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-07/pages/count.json",
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
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-07/pages/131092082.json",
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
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-07/pages/131092082.json",
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
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-07/pages/131092082.json",
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
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-07/pages/131092082.json",
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
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-07/pages/131092082.json",
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
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-07/pages/131092082.json",
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
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-07/pages/131092082.json",
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
