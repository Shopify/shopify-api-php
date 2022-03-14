<?php

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Metafield;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class Metafield202107Test extends BaseTestCase
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
                  ["metafields" => [["id" => 721389482, "namespace" => "affiliates", "key" => "app_key", "value" => "app_key", "value_type" => "string", "description" => null, "owner_id" => 548380009, "created_at" => "2022-02-03T16:53:36-05:00", "updated_at" => "2022-02-03T16:53:36-05:00", "owner_resource" => "shop", "type" => "string", "admin_graphql_api_id" => "gid://shopify/Metafield/721389482"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/metafields.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Metafield::all(
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
                  ["metafields" => [["id" => 1063298241, "namespace" => "inventory", "key" => "warehouse", "value" => 25, "value_type" => "integer", "description" => null, "owner_id" => 548380009, "created_at" => "2022-02-03T17:01:04-05:00", "updated_at" => "2022-02-03T17:01:04-05:00", "owner_resource" => "shop", "type" => "number_integer", "admin_graphql_api_id" => "gid://shopify/Metafield/1063298241"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/metafields.json?since_id=721389482",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Metafield::all(
            $this->test_session,
            [],
            ["since_id" => "721389482"],
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
                  ["metafield" => ["id" => 1063298244, "namespace" => "inventory", "key" => "warehouse", "value" => 25, "value_type" => "integer", "description" => null, "owner_id" => 548380009, "created_at" => "2022-02-03T17:01:25-05:00", "updated_at" => "2022-02-03T17:01:25-05:00", "owner_resource" => "shop", "type" => "number_integer", "admin_graphql_api_id" => "gid://shopify/Metafield/1063298244"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/metafields.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["metafield" => ["namespace" => "inventory", "key" => "warehouse", "value" => 25, "type" => "number_integer"]]),
            ),
        ]);

        $metafield = new Metafield($this->test_session);
        $metafield->namespace = "inventory";
        $metafield->key = "warehouse";
        $metafield->value = 25;
        $metafield->type = "number_integer";
        $metafield->save();
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
                  ["metafields" => [["id" => 625663657, "namespace" => "translation", "key" => "title_fr", "value" => "tbn", "description" => "French product image title", "owner_id" => 850703190, "created_at" => "2022-02-03T16:53:36-05:00", "updated_at" => "2022-02-03T16:53:36-05:00", "owner_resource" => "product_image", "type" => "string", "admin_graphql_api_id" => "gid://shopify/Metafield/625663657"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/metafields.json?metafield%5Bowner_id%5D=850703190&metafield%5Bowner_resource%5D=product_image",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Metafield::all(
            $this->test_session,
            [],
            ["metafield" => ["owner_id" => "850703190", "owner_resource" => "product_image"]],
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
                  ["count" => 1]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/metafields/count.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Metafield::count(
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
                  ["metafield" => ["id" => 721389482, "namespace" => "affiliates", "key" => "app_key", "value" => "app_key", "value_type" => "string", "description" => null, "owner_id" => 548380009, "created_at" => "2022-02-03T16:53:36-05:00", "updated_at" => "2022-02-03T16:53:36-05:00", "owner_resource" => "shop", "type" => "string", "admin_graphql_api_id" => "gid://shopify/Metafield/721389482"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/metafields/721389482.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Metafield::find(
            $this->test_session,
            721389482,
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
                  ["metafield" => ["value" => "something new", "value_type" => "string", "namespace" => "affiliates", "key" => "app_key", "id" => 721389482, "description" => null, "owner_id" => 548380009, "created_at" => "2022-02-03T16:53:36-05:00", "updated_at" => "2022-02-03T17:01:32-05:00", "owner_resource" => "shop", "type" => "single_line_text_field", "admin_graphql_api_id" => "gid://shopify/Metafield/721389482"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/metafields/721389482.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["metafield" => ["id" => 721389482, "value" => "something new", "type" => "single_line_text_field"]]),
            ),
        ]);

        $metafield = new Metafield($this->test_session);
        $metafield->id = 721389482;
        $metafield->value = "something new";
        $metafield->type = "single_line_text_field";
        $metafield->save();
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
                "https://test-shop.myshopify.io/admin/api/2021-07/metafields/721389482.json",
                "DELETE",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Metafield::delete(
            $this->test_session,
            721389482,
            [],
            [],
        );
    }

}
