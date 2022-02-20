<?php

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Blog;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class Blog202110Test extends BaseTestCase
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
                "https://test-shop.myshopify.io/admin/api/2021-10/blogs.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Blog::all(
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
                "https://test-shop.myshopify.io/admin/api/2021-10/blogs.json?since_id=241253187",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Blog::all(
            $this->test_session,
            [],
            ["since_id" => 241253187],
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
                "https://test-shop.myshopify.io/admin/api/2021-10/blogs.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["blog" => ["title" => "Apple main blog"]]),
            ),
        ]);

        $blog = new Blog($this->test_session);
        $blog->title = "Apple main blog";
        $blog->save();
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
                "https://test-shop.myshopify.io/admin/api/2021-10/blogs.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["blog" => ["title" => "Apple main blog", "metafields" => [["key" => "sponsor", "value" => "Shopify", "type" => "single_line_text_field", "namespace" => "global"]]]]),
            ),
        ]);

        $blog = new Blog($this->test_session);
        $blog->title = "Apple main blog";
        $blog->metafields = [
            [
                "key" => "sponsor",
                "value" => "Shopify",
                "type" => "single_line_text_field",
                "namespace" => "global"
            ]
        ];
        $blog->save();
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
                "https://test-shop.myshopify.io/admin/api/2021-10/blogs/count.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Blog::count(
            $this->test_session,
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
                "https://test-shop.myshopify.io/admin/api/2021-10/blogs/241253187.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Blog::find(
            $this->test_session,
            241253187,
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
                "https://test-shop.myshopify.io/admin/api/2021-10/blogs/241253187.json?fields=id%2Ctitle",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Blog::find(
            $this->test_session,
            241253187,
            [],
            ["fields" => "id,title"],
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
                "https://test-shop.myshopify.io/admin/api/2021-10/blogs/241253187.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["blog" => ["id" => 241253187, "title" => "IPod Updates"]]),
            ),
        ]);

        $blog = new Blog($this->test_session);
        $blog->id = 241253187;
        $blog->title = "IPod Updates";
        $blog->save();
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
                "https://test-shop.myshopify.io/admin/api/2021-10/blogs/241253187.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["blog" => ["id" => 241253187, "title" => "IPod Updates", "handle" => "ipod-updates", "commentable" => "moderate"]]),
            ),
        ]);

        $blog = new Blog($this->test_session);
        $blog->id = 241253187;
        $blog->title = "IPod Updates";
        $blog->handle = "ipod-updates";
        $blog->commentable = "moderate";
        $blog->save();
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
                "https://test-shop.myshopify.io/admin/api/2021-10/blogs/241253187.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["blog" => ["id" => 241253187, "metafields" => [["key" => "sponsor", "value" => "Shopify", "type" => "single_line_text_field", "namespace" => "global"]]]]),
            ),
        ]);

        $blog = new Blog($this->test_session);
        $blog->id = 241253187;
        $blog->metafields = [
            [
                "key" => "sponsor",
                "value" => "Shopify",
                "type" => "single_line_text_field",
                "namespace" => "global"
            ]
        ];
        $blog->save();
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
                "https://test-shop.myshopify.io/admin/api/2021-10/blogs/241253187.json",
                "DELETE",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Blog::delete(
            $this->test_session,
            241253187,
            [],
            [],
        );
    }

}
