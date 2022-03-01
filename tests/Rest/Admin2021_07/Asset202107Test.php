<?php

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Asset;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class Asset202107Test extends BaseTestCase
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
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-07/themes/828155753/assets.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Asset::all(
            $this->test_session,
            ["theme_id" => 828155753],
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
                "https://test-shop.myshopify.io/admin/api/2021-07/themes/828155753/assets.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["asset" => ["key" => "templates/index.liquid", "value" => "<img src='backsoon-postit.png'><p>We are busy updating the store for you and will be back within the hour.</p>"]]),
            ),
        ]);

        $asset = new Asset($this->test_session);
        $asset->theme_id = 828155753;
        $asset->key = "templates/index.liquid";
        $asset->value = "<img src='backsoon-postit.png'><p>We are busy updating the store for you and will be back within the hour.</p>";
        $asset->save();
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
                "https://test-shop.myshopify.io/admin/api/2021-07/themes/828155753/assets.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["asset" => ["key" => "assets/empty.gif", "attachment" => "R0lGODlhAQABAPABAP///wAAACH5BAEKAAAALAAAAAABAAEAAAICRAEAOw==\n"]]),
            ),
        ]);

        $asset = new Asset($this->test_session);
        $asset->theme_id = 828155753;
        $asset->key = "assets/empty.gif";
        $asset->attachment = "R0lGODlhAQABAPABAP///wAAACH5BAEKAAAALAAAAAABAAEAAAICRAEAOw==\n";
        $asset->save();
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
                "https://test-shop.myshopify.io/admin/api/2021-07/themes/828155753/assets.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["asset" => ["key" => "assets/bg-body.gif", "src" => "http://apple.com/new_bg.gif"]]),
            ),
        ]);

        $asset = new Asset($this->test_session);
        $asset->theme_id = 828155753;
        $asset->key = "assets/bg-body.gif";
        $asset->src = "http://apple.com/new_bg.gif";
        $asset->save();
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
                "https://test-shop.myshopify.io/admin/api/2021-07/themes/828155753/assets.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["asset" => ["key" => "layout/alternate.liquid", "source_key" => "layout/theme.liquid"]]),
            ),
        ]);

        $asset = new Asset($this->test_session);
        $asset->theme_id = 828155753;
        $asset->key = "layout/alternate.liquid";
        $asset->source_key = "layout/theme.liquid";
        $asset->save();
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
                "https://test-shop.myshopify.io/admin/api/2021-07/themes/828155753/assets.json?asset%5Bkey%5D=templates%2Findex.liquid",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Asset::all(
            $this->test_session,
            ["theme_id" => 828155753],
            ["asset" => ["key" => "templates/index.liquid"]],
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
                "https://test-shop.myshopify.io/admin/api/2021-07/themes/828155753/assets.json?asset%5Bkey%5D=assets%2Fbg-body.gif",
                "DELETE",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Asset::delete(
            $this->test_session,
            ["theme_id" => 828155753],
            ["asset" => ["key" => "assets/bg-body.gif"]],
        );
    }

}
