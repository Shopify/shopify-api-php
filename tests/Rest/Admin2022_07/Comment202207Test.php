<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Admin2022_07\Comment;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class Comment202207Test extends BaseTestCase
{
    /** @var Session */
    private $test_session;

    public function setUp(): void
    {
        parent::setUp();

        Context::$API_VERSION = "2022-07";

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
                  ["comments" => [["id" => 653537639, "body" => "Hi author, I really _like_ what you're doing there.", "body_html" => "<p>Hi author, I really <em>like</em> what you're doing there.</p>", "author" => "Soleone", "email" => "soleone@example.net", "status" => "unapproved", "article_id" => 134645308, "blog_id" => 241253187, "created_at" => "2023-01-03T12:05:09-05:00", "updated_at" => "2023-01-03T12:05:09-05:00", "ip" => "127.0.0.1", "user_agent" => "Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_5_4; en-us) AppleWebKit/525.18 (KHTML, like Gecko) Version/3.1.2 Safari/525.20.1", "published_at" => null]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/comments.json?since_id=118373535",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Comment::all(
            $this->test_session,
            [],
            ["since_id" => "118373535"],
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
                  ["comments" => [["id" => 653537639, "body" => "Hi author, I really _like_ what you're doing there.", "body_html" => "<p>Hi author, I really <em>like</em> what you're doing there.</p>", "author" => "Soleone", "email" => "soleone@example.net", "status" => "unapproved", "article_id" => 134645308, "blog_id" => 241253187, "created_at" => "2023-01-03T12:05:09-05:00", "updated_at" => "2023-01-03T12:05:09-05:00", "ip" => "127.0.0.1", "user_agent" => "Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_5_4; en-us) AppleWebKit/525.18 (KHTML, like Gecko) Version/3.1.2 Safari/525.20.1", "published_at" => null], ["id" => 118373535, "body" => "Hi author, I really _like_ what you're doing there.", "body_html" => "<p>Hi author, I really <em>like</em> what you're doing there.</p>", "author" => "Soleone", "email" => "soleone@example.net", "status" => "published", "article_id" => 134645308, "blog_id" => 241253187, "created_at" => "2023-01-03T12:05:09-05:00", "updated_at" => "2023-01-03T12:05:09-05:00", "ip" => "127.0.0.1", "user_agent" => "Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_5_4; en-us) AppleWebKit/525.18 (KHTML, like Gecko) Version/3.1.2 Safari/525.20.1", "published_at" => null]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/comments.json?article_id=134645308&blog_id=241253187",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Comment::all(
            $this->test_session,
            [],
            ["article_id" => "134645308", "blog_id" => "241253187"],
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
                  ["comments" => [["id" => 653537639, "body" => "Hi author, I really _like_ what you're doing there.", "body_html" => "<p>Hi author, I really <em>like</em> what you're doing there.</p>", "author" => "Soleone", "email" => "soleone@example.net", "status" => "unapproved", "article_id" => 134645308, "blog_id" => 241253187, "created_at" => "2023-01-03T12:05:09-05:00", "updated_at" => "2023-01-03T12:05:09-05:00", "ip" => "127.0.0.1", "user_agent" => "Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_5_4; en-us) AppleWebKit/525.18 (KHTML, like Gecko) Version/3.1.2 Safari/525.20.1", "published_at" => null], ["id" => 118373535, "body" => "Hi author, I really _like_ what you're doing there.", "body_html" => "<p>Hi author, I really <em>like</em> what you're doing there.</p>", "author" => "Soleone", "email" => "soleone@example.net", "status" => "published", "article_id" => 134645308, "blog_id" => 241253187, "created_at" => "2023-01-03T12:05:09-05:00", "updated_at" => "2023-01-03T12:05:09-05:00", "ip" => "127.0.0.1", "user_agent" => "Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_5_4; en-us) AppleWebKit/525.18 (KHTML, like Gecko) Version/3.1.2 Safari/525.20.1", "published_at" => null]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/comments.json?blog_id=241253187",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Comment::all(
            $this->test_session,
            [],
            ["blog_id" => "241253187"],
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
                  ["comments" => [["id" => 653537639, "body" => "Hi author, I really _like_ what you're doing there.", "body_html" => "<p>Hi author, I really <em>like</em> what you're doing there.</p>", "author" => "Soleone", "email" => "soleone@example.net", "status" => "unapproved", "article_id" => 134645308, "blog_id" => 241253187, "created_at" => "2023-01-03T12:05:09-05:00", "updated_at" => "2023-01-03T12:05:09-05:00", "ip" => "127.0.0.1", "user_agent" => "Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_5_4; en-us) AppleWebKit/525.18 (KHTML, like Gecko) Version/3.1.2 Safari/525.20.1", "published_at" => null], ["id" => 118373535, "body" => "Hi author, I really _like_ what you're doing there.", "body_html" => "<p>Hi author, I really <em>like</em> what you're doing there.</p>", "author" => "Soleone", "email" => "soleone@example.net", "status" => "published", "article_id" => 134645308, "blog_id" => 241253187, "created_at" => "2023-01-03T12:05:09-05:00", "updated_at" => "2023-01-03T12:05:09-05:00", "ip" => "127.0.0.1", "user_agent" => "Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_5_4; en-us) AppleWebKit/525.18 (KHTML, like Gecko) Version/3.1.2 Safari/525.20.1", "published_at" => null]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/comments.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Comment::all(
            $this->test_session,
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
                $this->buildMockHttpResponse(200, json_encode(
                  ["count" => 2]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/comments/count.json?article_id=134645308&blog_id=241253187",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Comment::count(
            $this->test_session,
            [],
            ["article_id" => "134645308", "blog_id" => "241253187"],
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
                  ["count" => 2]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/comments/count.json?blog_id=241253187",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Comment::count(
            $this->test_session,
            [],
            ["blog_id" => "241253187"],
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
                  ["count" => 2]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/comments/count.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Comment::count(
            $this->test_session,
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
                  ["comment" => ["id" => 118373535, "body" => "Hi author, I really _like_ what you're doing there.", "body_html" => "<p>Hi author, I really <em>like</em> what you're doing there.</p>", "author" => "Soleone", "email" => "soleone@example.net", "status" => "published", "article_id" => 134645308, "blog_id" => 241253187, "created_at" => "2023-01-03T12:05:09-05:00", "updated_at" => "2023-01-03T12:05:09-05:00", "ip" => "127.0.0.1", "user_agent" => "Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_5_4; en-us) AppleWebKit/525.18 (KHTML, like Gecko) Version/3.1.2 Safari/525.20.1", "published_at" => null]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/comments/118373535.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Comment::find(
            $this->test_session,
            118373535,
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
                  ["comment" => ["author" => "Your new name", "body" => "You can even update through a web service.", "email" => "your@updated-email.com", "published_at" => "2023-01-03T12:06:05-05:00", "id" => 118373535, "body_html" => "<p>You can even update through a web service.</p>", "status" => "published", "article_id" => 134645308, "blog_id" => 241253187, "created_at" => "2023-01-03T12:05:09-05:00", "updated_at" => "2023-01-03T12:06:06-05:00", "ip" => "127.0.0.1", "user_agent" => "Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_5_4; en-us) AppleWebKit/525.18 (KHTML, like Gecko) Version/3.1.2 Safari/525.20.1"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/comments/118373535.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["comment" => ["body" => "You can even update through a web service.", "author" => "Your new name", "email" => "your@updated-email.com", "published_at" => "2023-01-03T17:06:05.929Z"]]),
            ),
        ]);

        $comment = new Comment($this->test_session);
        $comment->id = 118373535;
        $comment->body = "You can even update through a web service.";
        $comment->author = "Your new name";
        $comment->email = "your@updated-email.com";
        $comment->published_at = "2023-01-03T17:06:05.929Z";
        $comment->save();
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
                  ["comment" => ["id" => 757536352, "body" => "I like comments\nAnd I like posting them *RESTfully*.", "body_html" => "<p>I like comments<br>\nAnd I like posting them <strong>RESTfully</strong>.</p>", "author" => "Your name", "email" => "your@email.com", "status" => "pending", "article_id" => 134645308, "blog_id" => 241253187, "created_at" => "2023-01-03T12:06:09-05:00", "updated_at" => "2023-01-03T12:06:09-05:00", "ip" => "107.20.160.121", "user_agent" => null, "published_at" => null]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/comments.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["comment" => ["body" => "I like comments\nAnd I like posting them *RESTfully*.", "author" => "Your name", "email" => "your@email.com", "ip" => "107.20.160.121", "blog_id" => 241253187, "article_id" => 134645308]]),
            ),
        ]);

        $comment = new Comment($this->test_session);
        $comment->body = "I like comments\nAnd I like posting them *RESTfully*.";
        $comment->author = "Your name";
        $comment->email = "your@email.com";
        $comment->ip = "107.20.160.121";
        $comment->blog_id = 241253187;
        $comment->article_id = 134645308;
        $comment->save();
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
                  ["published_at" => null, "status" => "spam", "id" => 653537639, "body" => "Hi author, I really _like_ what you're doing there.", "body_html" => "<p>Hi author, I really <em>like</em> what you're doing there.</p>", "author" => "Soleone", "email" => "soleone@example.net", "article_id" => 134645308, "blog_id" => 241253187, "created_at" => "2023-01-03T12:05:09-05:00", "updated_at" => "2023-01-03T12:05:59-05:00", "ip" => "127.0.0.1", "user_agent" => "Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_5_4; en-us) AppleWebKit/525.18 (KHTML, like Gecko) Version/3.1.2 Safari/525.20.1"]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/comments/653537639/spam.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        $comment = new Comment($this->test_session);
        $comment->id = 653537639;
        $comment->spam(
            [],
        );
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
                  ["published_at" => "2023-01-03T12:06:19-05:00", "status" => "published", "id" => 653537639, "body" => "Hi author, I really _like_ what you're doing there.", "body_html" => "<p>Hi author, I really <em>like</em> what you're doing there.</p>", "author" => "Soleone", "email" => "soleone@example.net", "article_id" => 134645308, "blog_id" => 241253187, "created_at" => "2023-01-03T12:05:09-05:00", "updated_at" => "2023-01-03T12:06:19-05:00", "ip" => "127.0.0.1", "user_agent" => "Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_5_4; en-us) AppleWebKit/525.18 (KHTML, like Gecko) Version/3.1.2 Safari/525.20.1"]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/comments/653537639/not_spam.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        $comment = new Comment($this->test_session);
        $comment->id = 653537639;
        $comment->not_spam(
            [],
        );
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
                  ["published_at" => "2023-01-03T12:06:30-05:00", "status" => "published", "id" => 653537639, "body" => "Hi author, I really _like_ what you're doing there.", "body_html" => "<p>Hi author, I really <em>like</em> what you're doing there.</p>", "author" => "Soleone", "email" => "soleone@example.net", "article_id" => 134645308, "blog_id" => 241253187, "created_at" => "2023-01-03T12:05:09-05:00", "updated_at" => "2023-01-03T12:06:30-05:00", "ip" => "127.0.0.1", "user_agent" => "Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_5_4; en-us) AppleWebKit/525.18 (KHTML, like Gecko) Version/3.1.2 Safari/525.20.1"]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/comments/653537639/approve.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        $comment = new Comment($this->test_session);
        $comment->id = 653537639;
        $comment->approve(
            [],
        );
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
                  ["published_at" => null, "status" => "removed", "id" => 653537639, "body" => "Hi author, I really _like_ what you're doing there.", "body_html" => "<p>Hi author, I really <em>like</em> what you're doing there.</p>", "author" => "Soleone", "email" => "soleone@example.net", "article_id" => 134645308, "blog_id" => 241253187, "created_at" => "2023-01-03T12:05:09-05:00", "updated_at" => "2023-01-03T12:06:12-05:00", "ip" => "127.0.0.1", "user_agent" => "Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_5_4; en-us) AppleWebKit/525.18 (KHTML, like Gecko) Version/3.1.2 Safari/525.20.1"]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/comments/653537639/remove.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        $comment = new Comment($this->test_session);
        $comment->id = 653537639;
        $comment->remove(
            [],
        );
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
                  ["published_at" => "2023-01-03T12:05:56-05:00", "status" => "published", "id" => 653537639, "body" => "Hi author, I really _like_ what you're doing there.", "body_html" => "<p>Hi author, I really <em>like</em> what you're doing there.</p>", "author" => "Soleone", "email" => "soleone@example.net", "article_id" => 134645308, "blog_id" => 241253187, "created_at" => "2023-01-03T12:05:09-05:00", "updated_at" => "2023-01-03T12:05:56-05:00", "ip" => "127.0.0.1", "user_agent" => "Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_5_4; en-us) AppleWebKit/525.18 (KHTML, like Gecko) Version/3.1.2 Safari/525.20.1"]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/comments/653537639/restore.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        $comment = new Comment($this->test_session);
        $comment->id = 653537639;
        $comment->restore(
            [],
        );
    }

}
