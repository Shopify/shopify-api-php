<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Admin2022_07\Collect;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class Collect202207Test extends BaseTestCase
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
                  ["collect" => ["id" => 1071559576, "collection_id" => 841564295, "product_id" => 921728736, "created_at" => "2023-01-03T12:45:21-05:00", "updated_at" => "2023-01-03T12:45:21-05:00", "position" => 2, "sort_value" => "0000000002"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/collects.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["collect" => ["product_id" => 921728736, "collection_id" => 841564295]]),
            ),
        ]);

        $collect = new Collect($this->test_session);
        $collect->product_id = 921728736;
        $collect->collection_id = 841564295;
        $collect->save();
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
                  ["collects" => [["id" => 358268117, "collection_id" => 482865238, "product_id" => 632910392, "created_at" => null, "updated_at" => null, "position" => 1, "sort_value" => "0000000001"], ["id" => 455204334, "collection_id" => 841564295, "product_id" => 632910392, "created_at" => null, "updated_at" => null, "position" => 1, "sort_value" => "0000000001"], ["id" => 773559378, "collection_id" => 395646240, "product_id" => 632910392, "created_at" => null, "updated_at" => null, "position" => 1, "sort_value" => "0000000001"], ["id" => 800915878, "collection_id" => 482865238, "product_id" => 921728736, "created_at" => null, "updated_at" => null, "position" => 1, "sort_value" => "0000000001"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/collects.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Collect::all(
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
                  ["collects" => [["id" => 455204334, "collection_id" => 841564295, "product_id" => 632910392, "created_at" => null, "updated_at" => null, "position" => 1, "sort_value" => "0000000001"], ["id" => 1071559574, "collection_id" => 841564295, "product_id" => 921728736, "created_at" => "2023-01-03T12:45:12-05:00", "updated_at" => "2023-01-03T12:45:12-05:00", "position" => 2, "sort_value" => "0000000002"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/collects.json?collection_id=841564295",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Collect::all(
            $this->test_session,
            [],
            ["collection_id" => "841564295"],
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
                  ["collects" => [["id" => 358268117, "collection_id" => 482865238, "product_id" => 632910392, "created_at" => null, "updated_at" => null, "position" => 1, "sort_value" => "0000000001"], ["id" => 455204334, "collection_id" => 841564295, "product_id" => 632910392, "created_at" => null, "updated_at" => null, "position" => 1, "sort_value" => "0000000001"], ["id" => 773559378, "collection_id" => 395646240, "product_id" => 632910392, "created_at" => null, "updated_at" => null, "position" => 1, "sort_value" => "0000000001"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/collects.json?product_id=632910392",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Collect::all(
            $this->test_session,
            [],
            ["product_id" => "632910392"],
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
                  []
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/collects/455204334.json",
                "DELETE",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Collect::delete(
            $this->test_session,
            455204334,
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
                  ["collect" => ["id" => 455204334, "collection_id" => 841564295, "product_id" => 632910392, "created_at" => null, "updated_at" => null, "position" => 1, "sort_value" => "0000000001"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/collects/455204334.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Collect::find(
            $this->test_session,
            455204334,
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
                  ["count" => 2]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/collects/count.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Collect::count(
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
                  ["count" => 1]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/collects/count.json?collection_id=841564295",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Collect::count(
            $this->test_session,
            [],
            ["collection_id" => "841564295"],
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
                  ["count" => 2]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/collects/count.json?product_id=632910392",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Collect::count(
            $this->test_session,
            [],
            ["product_id" => "632910392"],
        );
    }

}
