<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Admin2024_04\ApplicationCredit;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class ApplicationCredit202404Test extends BaseTestCase
{
    /** @var Session */
    private $test_session;

    public function setUp(): void
    {
        parent::setUp();

        Context::$API_VERSION = "2024-04";

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
                  ["application_credit" => ["id" => 140583599, "amount" => "5.00", "description" => "credit for application refund", "test" => null, "currency" => "USD"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2024-04/application_credits/140583599.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        ApplicationCredit::find(
            $this->test_session,
            140583599,
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
                  ["application_credits" => [["id" => 140583599, "amount" => "5.00", "description" => "credit for application refund", "test" => null, "currency" => "USD"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2024-04/application_credits.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        ApplicationCredit::all(
            $this->test_session,
            [],
            [],
        );
    }

}
