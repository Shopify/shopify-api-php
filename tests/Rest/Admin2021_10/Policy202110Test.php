<?php

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Admin2021_10\Policy;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class Policy202110Test extends BaseTestCase
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
                  ["policies" => [["body" => "You have 30 days to get a refund", "created_at" => "2022-03-30T19:16:52-04:00", "updated_at" => "2022-03-30T19:16:52-04:00", "handle" => "refund-policy", "title" => "Refund policy", "url" => "https://jsmith.myshopify.com/548380009/policies/878590288"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-10/policies.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Policy::all(
            $this->test_session,
            [],
            [],
        );
    }

}
