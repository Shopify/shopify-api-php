<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Admin2022_10\CollectionListing;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class CollectionListing202210Test extends BaseTestCase
{
    /** @var Session */
    private $test_session;

    public function setUp(): void
    {
        parent::setUp();

        Context::$API_VERSION = "2022-10";

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
                  ["collection_listings" => [["collection_id" => 482865238, "updated_at" => "2023-02-02T09:56:58-05:00", "body_html" => "<p>The best selling ipod ever</p>", "default_product_image" => null, "handle" => "smart-ipods", "image" => ["created_at" => "2023-02-02T09:56:58-05:00", "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/collections/ipod_nano_8gb.jpg?v=1675349818"], "title" => "Smart iPods", "sort_order" => "manual", "published_at" => "2017-08-31T20:00:00-04:00"], ["collection_id" => 841564295, "updated_at" => "2023-02-02T09:56:58-05:00", "body_html" => "<p>The best selling ipod ever</p>", "default_product_image" => null, "handle" => "ipods", "image" => ["created_at" => "2023-02-02T09:56:58-05:00", "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/collections/ipod_nano_8gb.jpg?v=1675349818"], "title" => "IPods", "sort_order" => "manual", "published_at" => "2017-08-31T20:00:00-04:00"], ["collection_id" => 395646240, "updated_at" => "2023-02-02T09:56:58-05:00", "body_html" => "<p>The best selling ipod ever. Again</p>", "default_product_image" => ["id" => 850703190, "created_at" => "2023-02-02T09:56:58-05:00", "position" => 1, "updated_at" => "2023-02-02T09:56:58-05:00", "product_id" => 632910392, "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano.png?v=1675349818", "variant_ids" => [], "width" => 123, "height" => 456], "handle" => "ipods_two", "image" => null, "title" => "IPods Two", "sort_order" => "manual", "published_at" => "2017-08-31T20:00:00-04:00"], ["collection_id" => 691652237, "updated_at" => "2023-02-02T09:56:58-05:00", "body_html" => "<p>No ipods here</p>", "default_product_image" => null, "handle" => "non-ipods", "image" => null, "title" => "Non Ipods", "sort_order" => "manual", "published_at" => "2017-08-31T20:00:00-04:00"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-10/collection_listings.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        CollectionListing::all(
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
                  ["product_ids" => [632910392]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-10/collection_listings/841564295/product_ids.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        CollectionListing::product_ids(
            $this->test_session,
            841564295,
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
                  ["collection_listing" => ["collection_id" => 482865238, "updated_at" => "2023-02-02T09:56:58-05:00", "body_html" => "<p>The best selling ipod ever</p>", "default_product_image" => null, "handle" => "smart-ipods", "image" => ["created_at" => "2023-02-02T09:56:58-05:00", "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/collections/ipod_nano_8gb.jpg?v=1675349818"], "title" => "Smart iPods", "sort_order" => "manual", "published_at" => "2017-08-31T20:00:00-04:00"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-10/collection_listings/482865238.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        CollectionListing::find(
            $this->test_session,
            482865238,
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
                  ["collection_listing" => ["collection_id" => 482865238, "updated_at" => "2023-02-02T09:56:58-05:00", "body_html" => "<p>The best selling ipod ever</p>", "default_product_image" => null, "handle" => "smart-ipods", "image" => ["created_at" => "2023-02-02T09:56:58-05:00", "src" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/collections/ipod_nano_8gb.jpg?v=1675349818"], "title" => "Smart iPods", "sort_order" => "manual", "published_at" => "2017-08-31T20:00:00-04:00"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-10/collection_listings/482865238.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["collection_listing" => []]),
            ),
        ]);

        $collection_listing = new CollectionListing($this->test_session);
        $collection_listing->collection_id = 482865238;
        $collection_listing->save();
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
                  []
                )),
                "https://test-shop.myshopify.io/admin/api/2022-10/collection_listings/482865238.json",
                "DELETE",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        CollectionListing::delete(
            $this->test_session,
            482865238,
            [],
            [],
        );
    }

}
