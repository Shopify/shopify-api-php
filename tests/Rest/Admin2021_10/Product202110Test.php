<?php

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Product;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class Product202110Test extends BaseTestCase
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
                "https://test-shop.myshopify.io/admin/api/2021-10/products.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Product::all(
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
                "https://test-shop.myshopify.io/admin/api/2021-10/products.json?ids=632910392%2C921728736",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Product::all(
            $this->test_session,
            [],
            ["ids" => "632910392,921728736"],
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
                "https://test-shop.myshopify.io/admin/api/2021-10/products.json?fields=id%2Cimages%2Ctitle",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Product::all(
            $this->test_session,
            [],
            ["fields" => "id,images,title"],
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
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-10/products.json?collection_id=841564295",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Product::all(
            $this->test_session,
            [],
            ["collection_id" => "841564295"],
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
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-10/products.json?since_id=632910392",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Product::all(
            $this->test_session,
            [],
            ["since_id" => "632910392"],
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
                "https://test-shop.myshopify.io/admin/api/2021-10/products.json?presentment_currencies=USD",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Product::all(
            $this->test_session,
            [],
            ["presentment_currencies" => "USD"],
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
                "https://test-shop.myshopify.io/admin/api/2021-10/products.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["product" => ["title" => "Burton Custom Freestyle 151", "body_html" => "<strong>Good snowboard!</strong>", "vendor" => "Burton", "product_type" => "Snowboard", "tags" => ["Barnes & Noble", "Big Air", "John's Fav"]]]),
            ),
        ]);

        $product = new Product($this->test_session);
        $product->title = "Burton Custom Freestyle 151";
        $product->body_html = "<strong>Good snowboard!</strong>";
        $product->vendor = "Burton";
        $product->product_type = "Snowboard";
        $product->tags = [
            "Barnes & Noble",
            "Big Air",
            "John's Fav"
        ];
        $product->save();
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
                "https://test-shop.myshopify.io/admin/api/2021-10/products.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["product" => ["title" => "Burton Custom Freestyle 151", "body_html" => "<strong>Good snowboard!</strong>", "vendor" => "Burton", "product_type" => "Snowboard", "published" => false]]),
            ),
        ]);

        $product = new Product($this->test_session);
        $product->title = "Burton Custom Freestyle 151";
        $product->body_html = "<strong>Good snowboard!</strong>";
        $product->vendor = "Burton";
        $product->product_type = "Snowboard";
        $product->published = false;
        $product->save();
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
                "https://test-shop.myshopify.io/admin/api/2021-10/products.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["product" => ["title" => "Burton Custom Freestyle 151", "body_html" => "<strong>Good snowboard!</strong>", "vendor" => "Burton", "product_type" => "Snowboard", "status" => "draft"]]),
            ),
        ]);

        $product = new Product($this->test_session);
        $product->title = "Burton Custom Freestyle 151";
        $product->body_html = "<strong>Good snowboard!</strong>";
        $product->vendor = "Burton";
        $product->product_type = "Snowboard";
        $product->status = "draft";
        $product->save();
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
                "https://test-shop.myshopify.io/admin/api/2021-10/products.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["product" => ["title" => "Burton Custom Freestyle 151", "body_html" => "<strong>Good snowboard!</strong>", "vendor" => "Burton", "product_type" => "Snowboard", "variants" => [["option1" => "First", "price" => "10.00", "sku" => "123"], ["option1" => "Second", "price" => "20.00", "sku" => "123"]]]]),
            ),
        ]);

        $product = new Product($this->test_session);
        $product->title = "Burton Custom Freestyle 151";
        $product->body_html = "<strong>Good snowboard!</strong>";
        $product->vendor = "Burton";
        $product->product_type = "Snowboard";
        $product->variants = [
            [
                "option1" => "First",
                "price" => "10.00",
                "sku" => "123"
            ],
            [
                "option1" => "Second",
                "price" => "20.00",
                "sku" => "123"
            ]
        ];
        $product->save();
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
                "https://test-shop.myshopify.io/admin/api/2021-10/products.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["product" => ["title" => "Burton Custom Freestyle 151", "body_html" => "<strong>Good snowboard!</strong>", "vendor" => "Burton", "product_type" => "Snowboard", "variants" => [["option1" => "Blue", "option2" => "155"], ["option1" => "Black", "option2" => "159"]], "options" => [["name" => "Color", "values" => ["Blue", "Black"]], ["name" => "Size", "values" => ["155", "159"]]]]]),
            ),
        ]);

        $product = new Product($this->test_session);
        $product->title = "Burton Custom Freestyle 151";
        $product->body_html = "<strong>Good snowboard!</strong>";
        $product->vendor = "Burton";
        $product->product_type = "Snowboard";
        $product->variants = [
            [
                "option1" => "Blue",
                "option2" => "155"
            ],
            [
                "option1" => "Black",
                "option2" => "159"
            ]
        ];
        $product->options = [
            [
                "name" => "Color",
                "values" => [
                    "Blue",
                    "Black"
                ]
            ],
            [
                "name" => "Size",
                "values" => [
                    "155",
                    "159"
                ]
            ]
        ];
        $product->save();
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
                "https://test-shop.myshopify.io/admin/api/2021-10/products.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["product" => ["title" => "Burton Custom Freestyle 151", "body_html" => "<strong>Good snowboard!</strong>", "vendor" => "Burton", "product_type" => "Snowboard", "images" => [["attachment" => "R0lGODlhAQABAIAAAAAAAAAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==\n"]]]]),
            ),
        ]);

        $product = new Product($this->test_session);
        $product->title = "Burton Custom Freestyle 151";
        $product->body_html = "<strong>Good snowboard!</strong>";
        $product->vendor = "Burton";
        $product->product_type = "Snowboard";
        $product->images = [
            [
                "attachment" => "R0lGODlhAQABAIAAAAAAAAAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==\n"
            ]
        ];
        $product->save();
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
                "https://test-shop.myshopify.io/admin/api/2021-10/products.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["product" => ["title" => "Burton Custom Freestyle 151", "body_html" => "<strong>Good snowboard!</strong>", "vendor" => "Burton", "product_type" => "Snowboard", "images" => [["src" => "http://example.com/rails_logo.gif"]]]]),
            ),
        ]);

        $product = new Product($this->test_session);
        $product->title = "Burton Custom Freestyle 151";
        $product->body_html = "<strong>Good snowboard!</strong>";
        $product->vendor = "Burton";
        $product->product_type = "Snowboard";
        $product->images = [
            [
                "src" => "http://example.com/rails_logo.gif"
            ]
        ];
        $product->save();
    }

    /**

     *
     * @return void
     */
    public function test_14(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-10/products.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["product" => ["title" => "Burton Custom Freestyle 151", "body_html" => "<strong>Good snowboard!</strong>", "vendor" => "Burton", "product_type" => "Snowboard", "metafields_global_title_tag" => "Product SEO Title", "metafields_global_description_tag" => "Product SEO Description"]]),
            ),
        ]);

        $product = new Product($this->test_session);
        $product->title = "Burton Custom Freestyle 151";
        $product->body_html = "<strong>Good snowboard!</strong>";
        $product->vendor = "Burton";
        $product->product_type = "Snowboard";
        $product->metafields_global_title_tag = "Product SEO Title";
        $product->metafields_global_description_tag = "Product SEO Description";
        $product->save();
    }

    /**

     *
     * @return void
     */
    public function test_15(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-10/products.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["product" => ["title" => "Burton Custom Freestyle 151", "body_html" => "<strong>Good snowboard!</strong>", "vendor" => "Burton", "product_type" => "Snowboard", "metafields" => [["key" => "new", "value" => "newvalue", "type" => "single_line_text_field", "namespace" => "global"]]]]),
            ),
        ]);

        $product = new Product($this->test_session);
        $product->title = "Burton Custom Freestyle 151";
        $product->body_html = "<strong>Good snowboard!</strong>";
        $product->vendor = "Burton";
        $product->product_type = "Snowboard";
        $product->metafields = [
            [
                "key" => "new",
                "value" => "newvalue",
                "type" => "single_line_text_field",
                "namespace" => "global"
            ]
        ];
        $product->save();
    }

    /**

     *
     * @return void
     */
    public function test_16(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-10/products/count.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Product::count(
            $this->test_session,
            [],
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
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-10/products/count.json?collection_id=841564295",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Product::count(
            $this->test_session,
            [],
            ["collection_id" => "841564295"],
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
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-10/products/632910392.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Product::find(
            $this->test_session,
            632910392,
            [],
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
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-10/products/632910392.json?fields=id%2Cimages%2Ctitle",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Product::find(
            $this->test_session,
            632910392,
            [],
            ["fields" => "id,images,title"],
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
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-10/products/632910392.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["product" => ["id" => 632910392, "title" => "New product title"]]),
            ),
        ]);

        $product = new Product($this->test_session);
        $product->id = 632910392;
        $product->title = "New product title";
        $product->save();
    }

    /**

     *
     * @return void
     */
    public function test_21(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-10/products/632910392.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["product" => ["id" => 632910392, "status" => "draft"]]),
            ),
        ]);

        $product = new Product($this->test_session);
        $product->id = 632910392;
        $product->status = "draft";
        $product->save();
    }

    /**

     *
     * @return void
     */
    public function test_22(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-10/products/632910392.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["product" => ["id" => 632910392, "tags" => "Barnes & Noble, John's Fav"]]),
            ),
        ]);

        $product = new Product($this->test_session);
        $product->id = 632910392;
        $product->tags = "Barnes & Noble, John's Fav";
        $product->save();
    }

    /**

     *
     * @return void
     */
    public function test_23(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-10/products/632910392.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["product" => ["id" => 632910392, "images" => []]]),
            ),
        ]);

        $product = new Product($this->test_session);
        $product->id = 632910392;
        $product->images = [];
        $product->save();
    }

    /**

     *
     * @return void
     */
    public function test_24(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-10/products/632910392.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["product" => ["id" => 632910392, "images" => [["id" => 850703190], ["id" => 562641783], ["id" => 378407906], ["src" => "http://example.com/rails_logo.gif"]]]]),
            ),
        ]);

        $product = new Product($this->test_session);
        $product->id = 632910392;
        $product->images = [
            [
                "id" => 850703190
            ],
            [
                "id" => 562641783
            ],
            [
                "id" => 378407906
            ],
            [
                "src" => "http://example.com/rails_logo.gif"
            ]
        ];
        $product->save();
    }

    /**

     *
     * @return void
     */
    public function test_25(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-10/products/632910392.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["product" => ["id" => 632910392, "images" => [["id" => 850703190, "position" => 3], ["id" => 562641783, "position" => 2], ["id" => 378407906, "position" => 1]]]]),
            ),
        ]);

        $product = new Product($this->test_session);
        $product->id = 632910392;
        $product->images = [
            [
                "id" => 850703190,
                "position" => 3
            ],
            [
                "id" => 562641783,
                "position" => 2
            ],
            [
                "id" => 378407906,
                "position" => 1
            ]
        ];
        $product->save();
    }

    /**

     *
     * @return void
     */
    public function test_26(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-10/products/632910392.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["product" => ["id" => 632910392, "variants" => [["id" => 457924702], ["id" => 39072856], ["id" => 49148385], ["id" => 808950810]]]]),
            ),
        ]);

        $product = new Product($this->test_session);
        $product->id = 632910392;
        $product->variants = [
            [
                "id" => 457924702
            ],
            [
                "id" => 39072856
            ],
            [
                "id" => 49148385
            ],
            [
                "id" => 808950810
            ]
        ];
        $product->save();
    }

    /**

     *
     * @return void
     */
    public function test_27(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-10/products/632910392.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["product" => ["id" => 632910392, "title" => "Updated Product Title", "variants" => [["id" => 808950810, "price" => "2000.00", "sku" => "Updating the Product SKU"], ["id" => 49148385], ["id" => 39072856], ["id" => 457924702]]]]),
            ),
        ]);

        $product = new Product($this->test_session);
        $product->id = 632910392;
        $product->title = "Updated Product Title";
        $product->variants = [
            [
                "id" => 808950810,
                "price" => "2000.00",
                "sku" => "Updating the Product SKU"
            ],
            [
                "id" => 49148385
            ],
            [
                "id" => 39072856
            ],
            [
                "id" => 457924702
            ]
        ];
        $product->save();
    }

    /**

     *
     * @return void
     */
    public function test_28(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-10/products/632910392.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["product" => ["id" => 632910392, "metafields_global_title_tag" => "Brand new title", "metafields_global_description_tag" => "Brand new description"]]),
            ),
        ]);

        $product = new Product($this->test_session);
        $product->id = 632910392;
        $product->metafields_global_title_tag = "Brand new title";
        $product->metafields_global_description_tag = "Brand new description";
        $product->save();
    }

    /**

     *
     * @return void
     */
    public function test_29(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-10/products/632910392.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["product" => ["id" => 632910392, "published" => true]]),
            ),
        ]);

        $product = new Product($this->test_session);
        $product->id = 632910392;
        $product->published = true;
        $product->save();
    }

    /**

     *
     * @return void
     */
    public function test_30(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-10/products/632910392.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["product" => ["id" => 632910392, "published" => false]]),
            ),
        ]);

        $product = new Product($this->test_session);
        $product->id = 632910392;
        $product->published = false;
        $product->save();
    }

    /**

     *
     * @return void
     */
    public function test_31(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-10/products/632910392.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["product" => ["id" => 632910392, "metafields" => [["key" => "new", "value" => "newvalue", "type" => "single_line_text_field", "namespace" => "global"]]]]),
            ),
        ]);

        $product = new Product($this->test_session);
        $product->id = 632910392;
        $product->metafields = [
            [
                "key" => "new",
                "value" => "newvalue",
                "type" => "single_line_text_field",
                "namespace" => "global"
            ]
        ];
        $product->save();
    }

    /**

     *
     * @return void
     */
    public function test_32(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-10/products/632910392.json",
                "DELETE",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Product::delete(
            $this->test_session,
            632910392,
            [],
            [],
        );
    }

}
