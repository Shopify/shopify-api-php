<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Admin2022_04\StorefrontAccessToken;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class StorefrontAccessToken202204Test extends BaseTestCase
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
                  ["storefront_access_token" => ["access_token" => "d8f6bb8fdd33308a0ef5cba4a72f89d2", "access_scope" => "unauthenticated_read_product_listings", "created_at" => "2023-06-14T14:27:00-04:00", "id" => 1003304090, "admin_graphql_api_id" => "gid://shopify/StorefrontAccessToken/1003304090", "title" => "Test"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/storefront_access_tokens.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["storefront_access_token" => ["title" => "Test"]]),
            ),
        ]);

        $storefront_access_token = new StorefrontAccessToken($this->test_session);
        $storefront_access_token->title = "Test";
        $storefront_access_token->save();
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
                  ["storefront_access_tokens" => [["access_token" => "378d95641257a4ab3feff967ee234f4d", "access_scope" => "unauthenticated_read_product_listings", "created_at" => "2023-06-14T14:13:28-04:00", "id" => 755357713, "admin_graphql_api_id" => "gid://shopify/StorefrontAccessToken/755357713", "title" => "API Client Extension"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/storefront_access_tokens.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        StorefrontAccessToken::all(
            $this->test_session,
            [],
            [],
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
                  []
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/storefront_access_tokens/755357713.json",
                "DELETE",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        StorefrontAccessToken::delete(
            $this->test_session,
            755357713,
            [],
            [],
        );
    }

}
