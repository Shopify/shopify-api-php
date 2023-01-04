<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Admin2022_07\Redirect;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class Redirect202207Test extends BaseTestCase
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
                  ["redirects" => [["id" => 950115854, "path" => "/ibook", "target" => "/products/macbook"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/redirects.json?since_id=668809255",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Redirect::all(
            $this->test_session,
            [],
            ["since_id" => "668809255"],
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
                  ["redirects" => [["id" => 304339089, "path" => "/products.php", "target" => "/products"], ["id" => 668809255, "path" => "/leopard", "target" => "/pages/macosx"], ["id" => 950115854, "path" => "/ibook", "target" => "/products/macbook"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/redirects.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Redirect::all(
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
                  ["count" => 3]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/redirects/count.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Redirect::count(
            $this->test_session,
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
                  ["redirect" => ["id" => 668809255, "path" => "/leopard", "target" => "/pages/macosx"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/redirects/668809255.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Redirect::find(
            $this->test_session,
            668809255,
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
                  ["redirect" => ["path" => "/powermac", "target" => "/pages/macpro", "id" => 950115854]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/redirects/950115854.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["redirect" => ["path" => "/powermac", "target" => "/pages/macpro"]]),
            ),
        ]);

        $redirect = new Redirect($this->test_session);
        $redirect->id = 950115854;
        $redirect->path = "/powermac";
        $redirect->target = "/pages/macpro";
        $redirect->save();
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
                  ["redirect" => ["path" => "/tiger", "target" => "/pages/macosx", "id" => 668809255]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/redirects/668809255.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["redirect" => ["path" => "/tiger"]]),
            ),
        ]);

        $redirect = new Redirect($this->test_session);
        $redirect->id = 668809255;
        $redirect->path = "/tiger";
        $redirect->save();
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
                  ["redirect" => ["target" => "/pages/macpro", "path" => "/leopard", "id" => 668809255]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/redirects/668809255.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["redirect" => ["target" => "/pages/macpro"]]),
            ),
        ]);

        $redirect = new Redirect($this->test_session);
        $redirect->id = 668809255;
        $redirect->target = "/pages/macpro";
        $redirect->save();
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
                "https://test-shop.myshopify.io/admin/api/2022-07/redirects/668809255.json",
                "DELETE",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Redirect::delete(
            $this->test_session,
            668809255,
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
                  ["redirect" => ["id" => 984542200, "path" => "/ipod", "target" => "/pages/itunes"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/redirects.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["redirect" => ["path" => "/ipod", "target" => "/pages/itunes"]]),
            ),
        ]);

        $redirect = new Redirect($this->test_session);
        $redirect->path = "/ipod";
        $redirect->target = "/pages/itunes";
        $redirect->save();
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
                  ["redirect" => ["id" => 984542199, "path" => "/forums", "target" => "http://forums.apple.com/"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/redirects.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["redirect" => ["path" => "http://www.apple.com/forums", "target" => "http://forums.apple.com"]]),
            ),
        ]);

        $redirect = new Redirect($this->test_session);
        $redirect->path = "http://www.apple.com/forums";
        $redirect->target = "http://forums.apple.com";
        $redirect->save();
    }

}
