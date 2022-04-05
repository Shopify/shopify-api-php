<?php

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Admin2021_10\DeprecatedApiCall;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class DeprecatedApiCall202110Test extends BaseTestCase
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
                  ["data_updated_at" => "2020-10-13T00:15:30Z", "deprecated_api_calls" => [["api_type" => "REST", "description" => "The page filter has been removed from multiple endpoints. Use cursor-based pagination instead.", "documentation_url" => "https://shopify.dev/tutorials/make-paginated-requests-to-rest-admin-api", "endpoint" => "Product", "last_call_at" => "2020-06-12T03:46:18Z", "migration_deadline" => "2020-07-02T13:00:00Z", "graphql_schema_name" => null, "version" => "2019-07"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-10/deprecated_api_calls.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        DeprecatedApiCall::all(
            $this->test_session,
            [],
            [],
        );
    }

}
