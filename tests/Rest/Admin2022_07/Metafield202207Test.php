<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Admin2022_07\Metafield;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class Metafield202207Test extends BaseTestCase
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
                  ["metafields" => []]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/metafields.json?metafield%5Bowner_id%5D=382285388&metafield%5Bowner_resource%5D=blog",
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
            ["metafield" => ["owner_id" => "382285388", "owner_resource" => "blog"]],
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
                  ["metafields" => [["id" => 51714266, "namespace" => "my_namespace", "key" => "my_key", "value" => "Hello", "description" => null, "owner_id" => 632910392, "created_at" => "2022-10-03T12:15:55-04:00", "updated_at" => "2022-10-03T12:15:55-04:00", "owner_resource" => "product", "type" => "single_line_text_field", "admin_graphql_api_id" => "gid://shopify/Metafield/51714266"], ["id" => 116539875, "namespace" => "descriptors", "key" => "subtitle", "value" => "The best ipod", "description" => null, "owner_id" => 632910392, "created_at" => "2022-10-03T12:15:55-04:00", "updated_at" => "2022-10-03T12:15:55-04:00", "owner_resource" => "product", "type" => "single_line_text_field", "admin_graphql_api_id" => "gid://shopify/Metafield/116539875"], ["id" => 263497237, "namespace" => "installments", "key" => "disable", "value" => true, "description" => null, "owner_id" => 632910392, "created_at" => "2022-10-03T12:15:55-04:00", "updated_at" => "2022-10-03T12:15:55-04:00", "owner_resource" => "product", "type" => "boolean", "admin_graphql_api_id" => "gid://shopify/Metafield/263497237"], ["id" => 273160493, "namespace" => "facts", "key" => "isbn", "value" => "978-0-14-004259-7", "description" => null, "owner_id" => 632910392, "created_at" => "2022-10-03T12:15:55-04:00", "updated_at" => "2022-10-03T12:15:55-04:00", "owner_resource" => "product", "type" => "single_line_text_field", "admin_graphql_api_id" => "gid://shopify/Metafield/273160493"], ["id" => 524118066, "namespace" => "facts", "key" => "ean", "value" => "0123456789012", "description" => null, "owner_id" => 632910392, "created_at" => "2022-10-03T12:15:55-04:00", "updated_at" => "2022-10-03T12:15:55-04:00", "owner_resource" => "product", "type" => "single_line_text_field", "admin_graphql_api_id" => "gid://shopify/Metafield/524118066"], ["id" => 543636738, "namespace" => "reviews", "key" => "rating_count", "value" => 1, "description" => null, "owner_id" => 632910392, "created_at" => "2022-10-03T12:15:55-04:00", "updated_at" => "2022-10-03T12:15:55-04:00", "owner_resource" => "product", "type" => "number_integer", "admin_graphql_api_id" => "gid://shopify/Metafield/543636738"], ["id" => 572384404, "namespace" => "reviews", "key" => "rating", "value" => "{\"value\": \"3.5\", \"scale_min\": \"1.0\", \"scale_max\": \"5.0\"}", "description" => null, "owner_id" => 632910392, "created_at" => "2022-10-03T12:15:55-04:00", "updated_at" => "2022-10-03T12:15:55-04:00", "owner_resource" => "product", "type" => "rating", "admin_graphql_api_id" => "gid://shopify/Metafield/572384404"], ["id" => 613330208, "namespace" => "shopify_filter", "key" => "display", "value" => "retina", "description" => "This field keeps track of the type of display", "owner_id" => 632910392, "created_at" => "2022-10-03T12:15:55-04:00", "updated_at" => "2022-10-03T12:15:55-04:00", "owner_resource" => "product", "type" => "string", "admin_graphql_api_id" => "gid://shopify/Metafield/613330208"], ["id" => 779326701, "namespace" => "facts", "key" => "upc", "value" => "012345678901", "description" => null, "owner_id" => 632910392, "created_at" => "2022-10-03T12:15:55-04:00", "updated_at" => "2022-10-03T12:15:55-04:00", "owner_resource" => "product", "type" => "single_line_text_field", "admin_graphql_api_id" => "gid://shopify/Metafield/779326701"], ["id" => 845366454, "namespace" => "translations", "key" => "title_fr", "value" => "produit", "description" => "French product title", "owner_id" => 632910392, "created_at" => "2022-10-03T12:15:55-04:00", "updated_at" => "2022-10-03T12:15:55-04:00", "owner_resource" => "product", "type" => "string", "admin_graphql_api_id" => "gid://shopify/Metafield/845366454"], ["id" => 861799889, "namespace" => "my_other_fields", "key" => "organic", "value" => true, "description" => null, "owner_id" => 632910392, "created_at" => "2022-10-03T12:15:55-04:00", "updated_at" => "2022-10-03T12:15:55-04:00", "owner_resource" => "product", "type" => "boolean", "admin_graphql_api_id" => "gid://shopify/Metafield/861799889"], ["id" => 870326793, "namespace" => "descriptors", "key" => "care_guide", "value" => "Wash in cold water", "description" => null, "owner_id" => 632910392, "created_at" => "2022-10-03T12:15:55-04:00", "updated_at" => "2022-10-03T12:15:55-04:00", "owner_resource" => "product", "type" => null, "admin_graphql_api_id" => "gid://shopify/Metafield/870326793"], ["id" => 908250163, "namespace" => "my_other_fields", "key" => "shipping_policy", "value" => "Ships for free in Canada", "description" => null, "owner_id" => 632910392, "created_at" => "2022-10-03T12:15:55-04:00", "updated_at" => "2022-10-03T12:15:55-04:00", "owner_resource" => "product", "type" => "multi_line_text_field", "admin_graphql_api_id" => "gid://shopify/Metafield/908250163"], ["id" => 925288667, "namespace" => "my_other_fields", "key" => "year_released", "value" => 2019, "description" => null, "owner_id" => 632910392, "created_at" => "2022-10-03T12:15:55-04:00", "updated_at" => "2022-10-03T12:15:55-04:00", "owner_resource" => "product", "type" => "number_integer", "admin_graphql_api_id" => "gid://shopify/Metafield/925288667"], ["id" => 1001077698, "namespace" => "my_fields", "key" => "best_for", "value" => "travel", "description" => null, "owner_id" => 632910392, "created_at" => "2022-10-03T12:15:55-04:00", "updated_at" => "2022-10-03T12:15:55-04:00", "owner_resource" => "product", "type" => "single_line_text_field", "admin_graphql_api_id" => "gid://shopify/Metafield/1001077698"], ["id" => 1029402048, "namespace" => "my_other_fields", "key" => "ingredients", "value" => "[\"apple\", \"music\", \"u2\"]", "description" => null, "owner_id" => 632910392, "created_at" => "2022-10-03T12:15:55-04:00", "updated_at" => "2022-10-03T12:15:55-04:00", "owner_resource" => "product", "type" => "list.single_line_text_field", "admin_graphql_api_id" => "gid://shopify/Metafield/1029402048"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/metafields.json?metafield%5Bowner_id%5D=632910392&metafield%5Bowner_resource%5D=product",
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
            ["metafield" => ["owner_id" => "632910392", "owner_resource" => "product"]],
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
                  ["metafields" => [["id" => 220591908, "namespace" => "discounts", "key" => "returning_customer", "value" => "no", "description" => "Customer deserves discount", "owner_id" => 207119551, "created_at" => "2022-10-03T12:15:55-04:00", "updated_at" => "2022-10-03T12:15:55-04:00", "owner_resource" => "customer", "type" => "single_line_text_field", "admin_graphql_api_id" => "gid://shopify/Metafield/220591908"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/metafields.json?metafield%5Bowner_id%5D=207119551&metafield%5Bowner_resource%5D=customer",
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
            ["metafield" => ["owner_id" => "207119551", "owner_resource" => "customer"]],
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
                  ["metafields" => [["id" => 106172460, "namespace" => "notes", "key" => "note", "value" => "B flat", "description" => "This is for notes", "owner_id" => 622762746, "created_at" => "2022-10-03T12:15:55-04:00", "updated_at" => "2022-10-03T12:15:55-04:00", "owner_resource" => "draft_order", "type" => "single_line_text_field", "admin_graphql_api_id" => "gid://shopify/Metafield/106172460"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/metafields.json?metafield%5Bowner_id%5D=622762746&metafield%5Bowner_resource%5D=draft_order",
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
            ["metafield" => ["owner_id" => "622762746", "owner_resource" => "draft_order"]],
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
                  ["metafields" => [["id" => 290519330, "namespace" => "translation", "key" => "title_fr", "value" => "Le TOS", "description" => "Page French title translation", "owner_id" => 131092082, "created_at" => "2022-10-03T12:15:55-04:00", "updated_at" => "2022-10-03T12:15:55-04:00", "owner_resource" => "page", "type" => "single_line_text_field", "admin_graphql_api_id" => "gid://shopify/Metafield/290519330"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/metafields.json?metafield%5Bowner_id%5D=131092082&metafield%5Bowner_resource%5D=page",
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
            ["metafield" => ["owner_id" => "131092082", "owner_resource" => "page"]],
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
                  ["metafields" => [["id" => 1063298188, "namespace" => "inventory", "key" => "warehouse", "value" => 25, "description" => null, "owner_id" => 548380009, "created_at" => "2022-10-03T12:17:58-04:00", "updated_at" => "2022-10-03T12:17:58-04:00", "owner_resource" => "shop", "type" => "number_integer", "admin_graphql_api_id" => "gid://shopify/Metafield/1063298188"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/metafields.json?since_id=721389482",
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
    public function test_7(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["metafields" => []]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/metafields.json?metafield%5Bowner_id%5D=674387490&metafield%5Bowner_resource%5D=article",
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
            ["metafield" => ["owner_id" => "674387490", "owner_resource" => "article"]],
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
                  ["metafields" => [["id" => 519046726, "namespace" => "notes", "key" => "descriptionription", "value" => "Collection description", "description" => "Custom Collection notes", "owner_id" => 482865238, "created_at" => "2022-10-03T12:15:55-04:00", "updated_at" => "2022-10-03T12:15:55-04:00", "owner_resource" => "collection", "type" => "string", "admin_graphql_api_id" => "gid://shopify/Metafield/519046726"], ["id" => 624849518, "namespace" => "global", "key" => "description_tag", "value" => "Some seo description value", "description" => null, "owner_id" => 482865238, "created_at" => "2022-10-03T12:15:55-04:00", "updated_at" => "2022-10-03T12:15:55-04:00", "owner_resource" => "collection", "type" => "string", "admin_graphql_api_id" => "gid://shopify/Metafield/624849518"], ["id" => 1010236510, "namespace" => "global", "key" => "title_tag", "value" => "Some seo title value", "description" => null, "owner_id" => 482865238, "created_at" => "2022-10-03T12:15:55-04:00", "updated_at" => "2022-10-03T12:15:55-04:00", "owner_resource" => "collection", "type" => "single_line_text_field", "admin_graphql_api_id" => "gid://shopify/Metafield/1010236510"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/metafields.json?metafield%5Bowner_id%5D=482865238&metafield%5Bowner_resource%5D=collection",
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
            ["metafield" => ["owner_id" => "482865238", "owner_resource" => "collection"]],
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
                  ["metafields" => []]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/metafields.json?metafield%5Bowner_id%5D=49148385&metafield%5Bowner_resource%5D=variants",
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
            ["metafield" => ["owner_id" => "49148385", "owner_resource" => "variants"]],
        );
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
                  ["metafields" => [["id" => 721389482, "namespace" => "affiliates", "key" => "app_key", "value" => "app_key", "description" => null, "owner_id" => 548380009, "created_at" => "2022-10-03T12:15:55-04:00", "updated_at" => "2022-10-03T12:15:55-04:00", "owner_resource" => "shop", "type" => "string", "admin_graphql_api_id" => "gid://shopify/Metafield/721389482"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/metafields.json",
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
    public function test_11(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["metafields" => [["id" => 915396079, "namespace" => "notes", "key" => "buyer", "value" => "Notes about this buyer", "description" => "This field is for buyer notes", "owner_id" => 450789469, "created_at" => "2022-10-03T12:15:55-04:00", "updated_at" => "2022-10-03T12:15:55-04:00", "owner_resource" => "order", "type" => "single_line_text_field", "admin_graphql_api_id" => "gid://shopify/Metafield/915396079"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/metafields.json?metafield%5Bowner_id%5D=450789469&metafield%5Bowner_resource%5D=order",
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
            ["metafield" => ["owner_id" => "450789469", "owner_resource" => "order"]],
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
                  ["metafields" => [["id" => 625663657, "namespace" => "translation", "key" => "title_fr", "value" => "tbn", "description" => "French product image title", "owner_id" => 850703190, "created_at" => "2022-10-03T12:15:55-04:00", "updated_at" => "2022-10-03T12:15:55-04:00", "owner_resource" => "product_image", "type" => "single_line_text_field", "admin_graphql_api_id" => "gid://shopify/Metafield/625663657"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/metafields.json?metafield%5Bowner_id%5D=850703190&metafield%5Bowner_resource%5D=product_image",
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
    public function test_13(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["count" => 1]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/pages/131092082/metafields/count.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Metafield::count(
            $this->test_session,
            ["page_id" => "131092082"],
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
                  ["count" => 3]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/collections/482865238/metafields/count.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Metafield::count(
            $this->test_session,
            ["collection_id" => "482865238"],
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
                  ["count" => 0]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/variants/49148385/metafields/count.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Metafield::count(
            $this->test_session,
            ["variant_id" => "49148385"],
            [],
        );
    }

    /**

     *
     * @return void
     */
    public function test_16(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["count" => 1]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/orders/450789469/metafields/count.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Metafield::count(
            $this->test_session,
            ["order_id" => "450789469"],
            [],
        );
    }

    /**

     *
     * @return void
     */
    public function test_17(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["count" => 1]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/metafields/count.json",
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
    public function test_18(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["count" => 1]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/draft_orders/622762746/metafields/count.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Metafield::count(
            $this->test_session,
            ["draft_order_id" => "622762746"],
            [],
        );
    }

    /**

     *
     * @return void
     */
    public function test_19(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["count" => 0]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/blogs/382285388/metafields/count.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Metafield::count(
            $this->test_session,
            ["blog_id" => "382285388"],
            [],
        );
    }

    /**

     *
     * @return void
     */
    public function test_20(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["count" => 1]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/customers/207119551/metafields/count.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Metafield::count(
            $this->test_session,
            ["customer_id" => "207119551"],
            [],
        );
    }

    /**

     *
     * @return void
     */
    public function test_21(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["count" => 16]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/products/632910392/metafields/count.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Metafield::count(
            $this->test_session,
            ["product_id" => "632910392"],
            [],
        );
    }

    /**

     *
     * @return void
     */
    public function test_22(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["count" => 0]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/articles/674387490/metafields/count.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Metafield::count(
            $this->test_session,
            ["article_id" => "674387490"],
            [],
        );
    }

    /**

     *
     * @return void
     */
    public function test_23(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["count" => 1]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/product_images/850703190/metafields/count.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Metafield::count(
            $this->test_session,
            ["product_image_id" => "850703190"],
            [],
        );
    }

    /**

     *
     * @return void
     */
    public function test_24(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["metafield" => ["id" => 323119633, "namespace" => "my_fields", "key" => "color", "value" => "Pink", "description" => null, "owner_id" => 808950810, "created_at" => "2022-10-03T12:15:55-04:00", "updated_at" => "2022-10-03T12:15:55-04:00", "owner_resource" => "variant", "type" => "single_line_text_field", "admin_graphql_api_id" => "gid://shopify/Metafield/323119633"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/variants/49148385/metafields/323119633.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Metafield::find(
            $this->test_session,
            323119633,
            ["variant_id" => "49148385"],
            [],
        );
    }

    /**

     *
     * @return void
     */
    public function test_25(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["metafield" => ["id" => 625663657, "namespace" => "translation", "key" => "title_fr", "value" => "tbn", "description" => "French product image title", "owner_id" => 850703190, "created_at" => "2022-10-03T12:15:55-04:00", "updated_at" => "2022-10-03T12:15:55-04:00", "owner_resource" => "product_image", "type" => "single_line_text_field", "admin_graphql_api_id" => "gid://shopify/Metafield/625663657"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/product_images/850703190/metafields/625663657.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Metafield::find(
            $this->test_session,
            625663657,
            ["product_image_id" => "850703190"],
            [],
        );
    }

    /**

     *
     * @return void
     */
    public function test_26(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["metafield" => ["id" => 1010236510, "namespace" => "global", "key" => "title_tag", "value" => "Some seo title value", "description" => null, "owner_id" => 482865238, "created_at" => "2022-10-03T12:15:55-04:00", "updated_at" => "2022-10-03T12:15:55-04:00", "owner_resource" => "collection", "type" => "single_line_text_field", "admin_graphql_api_id" => "gid://shopify/Metafield/1010236510"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/collections/482865238/metafields/1010236510.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Metafield::find(
            $this->test_session,
            1010236510,
            ["collection_id" => "482865238"],
            [],
        );
    }

    /**

     *
     * @return void
     */
    public function test_27(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["metafield" => ["id" => 106172460, "namespace" => "notes", "key" => "note", "value" => "B flat", "description" => "This is for notes", "owner_id" => 622762746, "created_at" => "2022-10-03T12:15:55-04:00", "updated_at" => "2022-10-03T12:15:55-04:00", "owner_resource" => "draft_order", "type" => "single_line_text_field", "admin_graphql_api_id" => "gid://shopify/Metafield/106172460"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/draft_orders/622762746/metafields/106172460.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Metafield::find(
            $this->test_session,
            106172460,
            ["draft_order_id" => "622762746"],
            [],
        );
    }

    /**

     *
     * @return void
     */
    public function test_28(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["metafield" => ["id" => 1001077698, "namespace" => "my_fields", "key" => "best_for", "value" => "travel", "description" => null, "owner_id" => 632910392, "created_at" => "2022-10-03T12:15:55-04:00", "updated_at" => "2022-10-03T12:15:55-04:00", "owner_resource" => "product", "type" => "single_line_text_field", "admin_graphql_api_id" => "gid://shopify/Metafield/1001077698"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/products/632910392/metafields/1001077698.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Metafield::find(
            $this->test_session,
            1001077698,
            ["product_id" => "632910392"],
            [],
        );
    }

    /**

     *
     * @return void
     */
    public function test_29(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["metafield" => ["id" => 721389482, "namespace" => "affiliates", "key" => "app_key", "value" => "app_key", "description" => null, "owner_id" => 548380009, "created_at" => "2022-10-03T12:15:55-04:00", "updated_at" => "2022-10-03T12:15:55-04:00", "owner_resource" => "shop", "type" => "string", "admin_graphql_api_id" => "gid://shopify/Metafield/721389482"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/metafields/721389482.json",
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
    public function test_30(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["metafield" => ["id" => 220591908, "namespace" => "discounts", "key" => "returning_customer", "value" => "no", "description" => "Customer deserves discount", "owner_id" => 207119551, "created_at" => "2022-10-03T12:15:55-04:00", "updated_at" => "2022-10-03T12:15:55-04:00", "owner_resource" => "customer", "type" => "single_line_text_field", "admin_graphql_api_id" => "gid://shopify/Metafield/220591908"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/customers/207119551/metafields/220591908.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Metafield::find(
            $this->test_session,
            220591908,
            ["customer_id" => "207119551"],
            [],
        );
    }

    /**

     *
     * @return void
     */
    public function test_31(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["metafield" => ["id" => 534526895, "namespace" => "translation", "key" => "title_fr", "value" => "Le iPod", "description" => "Blog French title translation", "owner_id" => 241253187, "created_at" => "2022-10-03T12:15:55-04:00", "updated_at" => "2022-10-03T12:15:55-04:00", "owner_resource" => "blog", "type" => "single_line_text_field", "admin_graphql_api_id" => "gid://shopify/Metafield/534526895"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/blogs/382285388/metafields/534526895.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Metafield::find(
            $this->test_session,
            534526895,
            ["blog_id" => "382285388"],
            [],
        );
    }

    /**

     *
     * @return void
     */
    public function test_32(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["metafield" => ["id" => 290519330, "namespace" => "translation", "key" => "title_fr", "value" => "Le TOS", "description" => "Page French title translation", "owner_id" => 131092082, "created_at" => "2022-10-03T12:15:55-04:00", "updated_at" => "2022-10-03T12:15:55-04:00", "owner_resource" => "page", "type" => "single_line_text_field", "admin_graphql_api_id" => "gid://shopify/Metafield/290519330"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/pages/131092082/metafields/290519330.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Metafield::find(
            $this->test_session,
            290519330,
            ["page_id" => "131092082"],
            [],
        );
    }

    /**

     *
     * @return void
     */
    public function test_33(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["metafield" => ["id" => 915396079, "namespace" => "notes", "key" => "buyer", "value" => "Notes about this buyer", "description" => "This field is for buyer notes", "owner_id" => 450789469, "created_at" => "2022-10-03T12:15:55-04:00", "updated_at" => "2022-10-03T12:15:55-04:00", "owner_resource" => "order", "type" => "single_line_text_field", "admin_graphql_api_id" => "gid://shopify/Metafield/915396079"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/orders/450789469/metafields/915396079.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Metafield::find(
            $this->test_session,
            915396079,
            ["order_id" => "450789469"],
            [],
        );
    }

    /**

     *
     * @return void
     */
    public function test_34(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["metafield" => ["id" => 838981074, "namespace" => "translation", "key" => "title_fr", "value" => "Le Article", "description" => "Article French title translation", "owner_id" => 134645308, "created_at" => "2022-10-03T12:15:55-04:00", "updated_at" => "2022-10-03T12:15:55-04:00", "owner_resource" => "article", "type" => "single_line_text_field", "admin_graphql_api_id" => "gid://shopify/Metafield/838981074"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/articles/674387490/metafields/838981074.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Metafield::find(
            $this->test_session,
            838981074,
            ["article_id" => "674387490"],
            [],
        );
    }

    /**

     *
     * @return void
     */
    public function test_35(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  []
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/product_images/850703190/metafields/625663657.json",
                "DELETE",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Metafield::delete(
            $this->test_session,
            625663657,
            ["product_image_id" => "850703190"],
            [],
        );
    }

    /**

     *
     * @return void
     */
    public function test_36(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  []
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/draft_orders/622762746/metafields/106172460.json",
                "DELETE",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Metafield::delete(
            $this->test_session,
            106172460,
            ["draft_order_id" => "622762746"],
            [],
        );
    }

    /**

     *
     * @return void
     */
    public function test_37(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  []
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/customers/207119551/metafields/220591908.json",
                "DELETE",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Metafield::delete(
            $this->test_session,
            220591908,
            ["customer_id" => "207119551"],
            [],
        );
    }

    /**

     *
     * @return void
     */
    public function test_38(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  []
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/collections/482865238/metafields/1010236510.json",
                "DELETE",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Metafield::delete(
            $this->test_session,
            1010236510,
            ["collection_id" => "482865238"],
            [],
        );
    }

    /**

     *
     * @return void
     */
    public function test_39(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  []
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/blogs/382285388/metafields/534526895.json",
                "DELETE",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Metafield::delete(
            $this->test_session,
            534526895,
            ["blog_id" => "382285388"],
            [],
        );
    }

    /**

     *
     * @return void
     */
    public function test_40(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  []
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/metafields/721389482.json",
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

    /**

     *
     * @return void
     */
    public function test_41(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  []
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/variants/49148385/metafields/323119633.json",
                "DELETE",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Metafield::delete(
            $this->test_session,
            323119633,
            ["variant_id" => "49148385"],
            [],
        );
    }

    /**

     *
     * @return void
     */
    public function test_42(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  []
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/pages/131092082/metafields/290519330.json",
                "DELETE",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Metafield::delete(
            $this->test_session,
            290519330,
            ["page_id" => "131092082"],
            [],
        );
    }

    /**

     *
     * @return void
     */
    public function test_43(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  []
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/products/632910392/metafields/1001077698.json",
                "DELETE",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Metafield::delete(
            $this->test_session,
            1001077698,
            ["product_id" => "632910392"],
            [],
        );
    }

    /**

     *
     * @return void
     */
    public function test_44(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  []
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/orders/450789469/metafields/915396079.json",
                "DELETE",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Metafield::delete(
            $this->test_session,
            915396079,
            ["order_id" => "450789469"],
            [],
        );
    }

    /**

     *
     * @return void
     */
    public function test_45(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  []
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/articles/674387490/metafields/838981074.json",
                "DELETE",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Metafield::delete(
            $this->test_session,
            838981074,
            ["article_id" => "674387490"],
            [],
        );
    }

}
