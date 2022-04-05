<?php

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Admin2021_10\AccessScope;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class AccessScope202110Test extends BaseTestCase
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
                $this->buildMockHttpResponse(200, json_encode(
                  ["access_scopes" => [["handle" => "read_products"], ["handle" => "write_orders"], ["handle" => "read_orders"]]]
                )),
                "https://test-shop.myshopify.io/admin/oauth/access_scopes.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        AccessScope::all(
            $this->test_session,
            [],
            [],
        );
    }

}
