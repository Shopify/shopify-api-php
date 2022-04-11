<?php

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Admin2021_07\StorefrontAccessToken;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class StorefrontAccessToken202107Test extends BaseTestCase
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
                  ["storefront_access_token" => ["access_token" => "acb63aef87d74a49eb3f4b994a5e342b", "access_scope" => "unauthenticated_read_product_listings", "created_at" => "2022-04-05T12:56:06-04:00", "id" => 1003303990, "admin_graphql_api_id" => "gid://shopify/StorefrontAccessToken/1003303990", "title" => "Test"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/storefront_access_tokens.json",
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
                  ["storefront_access_tokens" => [["access_token" => "378d95641257a4ab3feff967ee234f4d", "access_scope" => "unauthenticated_read_product_listings", "created_at" => "2022-04-05T12:51:55-04:00", "id" => 755357713, "admin_graphql_api_id" => "gid://shopify/StorefrontAccessToken/755357713", "title" => "API Client Extension"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/storefront_access_tokens.json",
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
                "https://test-shop.myshopify.io/admin/api/2021-07/storefront_access_tokens/755357713.json",
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
