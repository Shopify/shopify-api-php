<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Admin2023_01\Theme;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class Theme202301Test extends BaseTestCase
{
    /** @var Session */
    private $test_session;

    public function setUp(): void
    {
        parent::setUp();

        Context::$API_VERSION = "2023-01";

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
                  ["themes" => [["id" => 828155753, "name" => "Comfort", "created_at" => "2023-01-03T12:21:36-05:00", "updated_at" => "2023-01-03T12:21:36-05:00", "role" => "main", "theme_store_id" => null, "previewable" => true, "processing" => false, "admin_graphql_api_id" => "gid://shopify/Theme/828155753"], ["id" => 976877075, "name" => "Preview of Parallax", "created_at" => "2023-01-03T12:21:36-05:00", "updated_at" => "2023-01-03T12:21:36-05:00", "role" => "demo", "theme_store_id" => 688, "previewable" => true, "processing" => false, "admin_graphql_api_id" => "gid://shopify/Theme/976877075"], ["id" => 752253240, "name" => "Sandbox", "created_at" => "2023-01-03T12:21:36-05:00", "updated_at" => "2023-01-03T12:21:36-05:00", "role" => "unpublished", "theme_store_id" => null, "previewable" => true, "processing" => false, "admin_graphql_api_id" => "gid://shopify/Theme/752253240"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2023-01/themes.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Theme::all(
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
                  ["theme" => ["id" => 1049083723, "name" => "Lemongrass", "created_at" => "2023-01-03T12:25:57-05:00", "updated_at" => "2023-01-03T12:25:57-05:00", "role" => "unpublished", "theme_store_id" => null, "previewable" => false, "processing" => true, "admin_graphql_api_id" => "gid://shopify/Theme/1049083723"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2023-01/themes.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["theme" => ["name" => "Lemongrass", "src" => "http://themes.shopify.com/theme.zip", "role" => "main"]]),
            ),
        ]);

        $theme = new Theme($this->test_session);
        $theme->name = "Lemongrass";
        $theme->src = "http://themes.shopify.com/theme.zip";
        $theme->role = "main";
        $theme->save();
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
                  ["theme" => ["id" => 828155753, "name" => "Comfort", "created_at" => "2023-01-03T12:21:36-05:00", "updated_at" => "2023-01-03T12:21:36-05:00", "role" => "main", "theme_store_id" => null, "previewable" => true, "processing" => false, "admin_graphql_api_id" => "gid://shopify/Theme/828155753"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2023-01/themes/828155753.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Theme::find(
            $this->test_session,
            828155753,
            [],
            [],
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
                  ["theme" => ["role" => "main", "id" => 752253240, "name" => "Sandbox", "created_at" => "2023-01-03T12:21:36-05:00", "updated_at" => "2023-01-03T12:25:51-05:00", "theme_store_id" => null, "previewable" => true, "processing" => false, "admin_graphql_api_id" => "gid://shopify/Theme/752253240"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2023-01/themes/752253240.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["theme" => ["role" => "main"]]),
            ),
        ]);

        $theme = new Theme($this->test_session);
        $theme->id = 752253240;
        $theme->role = "main";
        $theme->save();
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
                  ["theme" => ["name" => "Experimental", "role" => "unpublished", "id" => 752253240, "created_at" => "2023-01-03T12:21:36-05:00", "updated_at" => "2023-01-03T12:26:01-05:00", "theme_store_id" => null, "previewable" => true, "processing" => false, "admin_graphql_api_id" => "gid://shopify/Theme/752253240"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2023-01/themes/752253240.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["theme" => ["name" => "Experimental"]]),
            ),
        ]);

        $theme = new Theme($this->test_session);
        $theme->id = 752253240;
        $theme->name = "Experimental";
        $theme->save();
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
                  ["id" => 752253240, "name" => "Sandbox", "created_at" => "2023-01-03T12:21:36-05:00", "updated_at" => "2023-01-03T12:21:36-05:00", "role" => "unpublished", "theme_store_id" => null, "previewable" => true, "processing" => false, "admin_graphql_api_id" => "gid://shopify/Theme/752253240"]
                )),
                "https://test-shop.myshopify.io/admin/api/2023-01/themes/752253240.json",
                "DELETE",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Theme::delete(
            $this->test_session,
            752253240,
            [],
            [],
        );
    }

}
