<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Admin2022_10\Currency;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class Currency202210Test extends BaseTestCase
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
                  ["currencies" => [["currency" => "CAD", "rate_updated_at" => "2018-01-23T19:01:01-05:00", "enabled" => true], ["currency" => "EUR", "rate_updated_at" => "2018-01-23T19:01:01-05:00", "enabled" => true], ["currency" => "JPY", "rate_updated_at" => "2018-01-23T19:01:01-05:00", "enabled" => true]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-10/currencies.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Currency::all(
            $this->test_session,
            [],
            [],
        );
    }

}
