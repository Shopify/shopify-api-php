<?php

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Admin2021_07\Blog;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class Blog202107Test extends BaseTestCase
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
                  ["blogs" => [["id" => 382285388, "handle" => "banana-blog", "title" => "A Gnu Blog", "updated_at" => "2006-02-02T19:00:00-05:00", "commentable" => "no", "feedburner" => null, "feedburner_location" => null, "created_at" => "2022-03-30T19:40:01-04:00", "template_suffix" => null, "tags" => "", "admin_graphql_api_id" => "gid://shopify/OnlineStoreBlog/382285388"], ["id" => 241253187, "handle" => "apple-blog", "title" => "Mah Blog", "updated_at" => "2006-02-01T19:00:00-05:00", "commentable" => "no", "feedburner" => null, "feedburner_location" => null, "created_at" => "2022-03-30T19:40:01-04:00", "template_suffix" => null, "tags" => "Announcing, Mystery", "admin_graphql_api_id" => "gid://shopify/OnlineStoreBlog/241253187"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/blogs.json",
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
                $this->buildMockHttpResponse(200, json_encode(
                  ["blogs" => [["id" => 382285388, "handle" => "banana-blog", "title" => "A Gnu Blog", "updated_at" => "2006-02-02T19:00:00-05:00", "commentable" => "no", "feedburner" => null, "feedburner_location" => null, "created_at" => "2022-03-30T19:40:01-04:00", "template_suffix" => null, "tags" => "", "admin_graphql_api_id" => "gid://shopify/OnlineStoreBlog/382285388"], ["id" => 1008414251, "handle" => "apple-main-blog", "title" => "Apple main blog", "updated_at" => "2022-03-30T19:44:54-04:00", "commentable" => "no", "feedburner" => null, "feedburner_location" => null, "created_at" => "2022-03-30T19:44:54-04:00", "template_suffix" => null, "tags" => "", "admin_graphql_api_id" => "gid://shopify/OnlineStoreBlog/1008414251"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/blogs.json?since_id=241253187",
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
            ["since_id" => "241253187"],
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
                  ["blog" => ["id" => 1008414254, "handle" => "apple-main-blog", "title" => "Apple main blog", "updated_at" => "2022-03-30T19:45:02-04:00", "commentable" => "no", "feedburner" => null, "feedburner_location" => null, "created_at" => "2022-03-30T19:45:02-04:00", "template_suffix" => null, "tags" => "", "admin_graphql_api_id" => "gid://shopify/OnlineStoreBlog/1008414254"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/blogs.json",
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
                $this->buildMockHttpResponse(200, json_encode(
                  ["blog" => ["id" => 1008414255, "handle" => "apple-main-blog", "title" => "Apple main blog", "updated_at" => "2022-03-30T19:45:04-04:00", "commentable" => "no", "feedburner" => null, "feedburner_location" => null, "created_at" => "2022-03-30T19:45:04-04:00", "template_suffix" => null, "tags" => "", "admin_graphql_api_id" => "gid://shopify/OnlineStoreBlog/1008414255"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/blogs.json",
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
                $this->buildMockHttpResponse(200, json_encode(
                  ["count" => 2]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/blogs/count.json",
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
                $this->buildMockHttpResponse(200, json_encode(
                  ["blog" => ["id" => 241253187, "handle" => "apple-blog", "title" => "Mah Blog", "updated_at" => "2006-02-01T19:00:00-05:00", "commentable" => "no", "feedburner" => null, "feedburner_location" => null, "created_at" => "2022-03-30T19:40:01-04:00", "template_suffix" => null, "tags" => "Announcing, Mystery", "admin_graphql_api_id" => "gid://shopify/OnlineStoreBlog/241253187"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/blogs/241253187.json",
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
                $this->buildMockHttpResponse(200, json_encode(
                  ["blog" => ["id" => 241253187, "title" => "Mah Blog"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/blogs/241253187.json?fields=id%2Ctitle",
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
                $this->buildMockHttpResponse(200, json_encode(
                  ["blog" => ["title" => "IPod Updates", "handle" => "apple-blog", "id" => 241253187, "updated_at" => "2022-03-30T19:45:08-04:00", "commentable" => "no", "feedburner" => null, "feedburner_location" => null, "created_at" => "2022-03-30T19:40:01-04:00", "template_suffix" => null, "tags" => "Announcing, Mystery", "admin_graphql_api_id" => "gid://shopify/OnlineStoreBlog/241253187"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/blogs/241253187.json",
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
                $this->buildMockHttpResponse(200, json_encode(
                  ["blog" => ["title" => "IPod Updates", "handle" => "ipod-updates", "commentable" => "moderate", "id" => 241253187, "updated_at" => "2022-03-30T19:45:09-04:00", "feedburner" => null, "feedburner_location" => null, "created_at" => "2022-03-30T19:40:01-04:00", "template_suffix" => null, "tags" => "Announcing, Mystery", "admin_graphql_api_id" => "gid://shopify/OnlineStoreBlog/241253187"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/blogs/241253187.json",
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
                $this->buildMockHttpResponse(200, json_encode(
                  ["blog" => ["title" => "Mah Blog", "handle" => "apple-blog", "id" => 241253187, "updated_at" => "2022-03-30T19:45:11-04:00", "commentable" => "no", "feedburner" => null, "feedburner_location" => null, "created_at" => "2022-03-30T19:40:01-04:00", "template_suffix" => null, "tags" => "Announcing, Mystery", "admin_graphql_api_id" => "gid://shopify/OnlineStoreBlog/241253187"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/blogs/241253187.json",
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
                $this->buildMockHttpResponse(200, json_encode(
                  []
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/blogs/241253187.json",
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
