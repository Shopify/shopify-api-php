<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Admin2023_04\ScriptTag;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class ScriptTag202304Test extends BaseTestCase
{
    /** @var Session */
    private $test_session;

    public function setUp(): void
    {
        parent::setUp();

        Context::$API_VERSION = "2023-04";

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
                  ["script_tags" => [["id" => 421379493, "src" => "https://js.example.org/bar.js", "event" => "onload", "created_at" => "2023-04-04T17:13:27-04:00", "updated_at" => "2023-04-04T17:13:27-04:00", "display_scope" => "all"], ["id" => 596726825, "src" => "https://js.example.org/foo.js", "event" => "onload", "created_at" => "2023-04-04T17:13:27-04:00", "updated_at" => "2023-04-04T17:13:27-04:00", "display_scope" => "all"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2023-04/script_tags.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        ScriptTag::all(
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
                  ["script_tags" => [["id" => 596726825, "src" => "https://js.example.org/foo.js", "event" => "onload", "created_at" => "2023-04-04T17:13:27-04:00", "updated_at" => "2023-04-04T17:13:27-04:00", "display_scope" => "all"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2023-04/script_tags.json?since_id=421379493",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        ScriptTag::all(
            $this->test_session,
            [],
            ["since_id" => "421379493"],
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
                  ["script_tags" => [["id" => 596726825, "src" => "https://js.example.org/foo.js", "event" => "onload", "created_at" => "2023-04-04T17:13:27-04:00", "updated_at" => "2023-04-04T17:13:27-04:00", "display_scope" => "all"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2023-04/script_tags.json?src=https%3A%2F%2Fjs.example.org%2Ffoo.js",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        ScriptTag::all(
            $this->test_session,
            [],
            ["src" => "https://js.example.org/foo.js"],
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
                  ["script_tag" => ["id" => 870402687, "src" => "https://example.com/my_script.js", "event" => "onload", "created_at" => "2023-04-04T17:17:15-04:00", "updated_at" => "2023-04-04T17:17:15-04:00", "display_scope" => "all", "cache" => false]]
                )),
                "https://test-shop.myshopify.io/admin/api/2023-04/script_tags.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["script_tag" => ["event" => "onload", "src" => "https://example.com/my_script.js"]]),
            ),
        ]);

        $script_tag = new ScriptTag($this->test_session);
        $script_tag->event = "onload";
        $script_tag->src = "https://example.com/my_script.js";
        $script_tag->save();
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
                "https://test-shop.myshopify.io/admin/api/2023-04/script_tags/count.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        ScriptTag::count(
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
                  ["script_tag" => ["id" => 596726825, "src" => "https://js.example.org/foo.js", "event" => "onload", "created_at" => "2023-04-04T17:13:27-04:00", "updated_at" => "2023-04-04T17:13:27-04:00", "display_scope" => "all", "cache" => false]]
                )),
                "https://test-shop.myshopify.io/admin/api/2023-04/script_tags/596726825.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        ScriptTag::find(
            $this->test_session,
            596726825,
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
                  ["script_tag" => ["src" => "https://somewhere-else.com/another.js", "cache" => false, "id" => 596726825, "event" => "onload", "created_at" => "2023-04-04T17:13:27-04:00", "updated_at" => "2023-04-04T17:17:18-04:00", "display_scope" => "all"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2023-04/script_tags/596726825.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["script_tag" => ["src" => "https://somewhere-else.com/another.js"]]),
            ),
        ]);

        $script_tag = new ScriptTag($this->test_session);
        $script_tag->id = 596726825;
        $script_tag->src = "https://somewhere-else.com/another.js";
        $script_tag->save();
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
                  []
                )),
                "https://test-shop.myshopify.io/admin/api/2023-04/script_tags/596726825.json",
                "DELETE",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        ScriptTag::delete(
            $this->test_session,
            596726825,
            [],
            [],
        );
    }

}
