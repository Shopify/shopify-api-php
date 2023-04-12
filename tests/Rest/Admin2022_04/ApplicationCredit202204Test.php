<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Admin2022_04\ApplicationCredit;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class ApplicationCredit202204Test extends BaseTestCase
{
    /** @var Session */
    private $test_session;

    public function setUp(): void
    {
        parent::setUp();

        Context::$API_VERSION = "2022-04";

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
                  ["application_credit" => ["id" => 1031636125, "amount" => "5.00", "description" => "application credit for refund", "test" => null, "currency" => "USD"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/application_credits.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["application_credit" => ["description" => "application credit for refund", "amount" => 5.0]]),
            ),
        ]);

        $application_credit = new ApplicationCredit($this->test_session);
        $application_credit->description = "application credit for refund";
        $application_credit->amount = 5.0;
        $application_credit->save();
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
                  ["application_credit" => ["id" => 1031636129, "amount" => "5.00", "description" => "application credit for refund", "test" => true, "currency" => "USD"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/application_credits.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["application_credit" => ["description" => "application credit for refund", "amount" => 5.0, "test" => true]]),
            ),
        ]);

        $application_credit = new ApplicationCredit($this->test_session);
        $application_credit->description = "application credit for refund";
        $application_credit->amount = 5.0;
        $application_credit->test = true;
        $application_credit->save();
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
                  ["application_credits" => [["id" => 140583599, "amount" => "5.00", "description" => "credit for application refund", "test" => null, "currency" => "USD"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/application_credits.json",
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

    /**

     *
     * @return void
     */
    public function test_4(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["application_credit" => ["id" => 140583599, "amount" => "5.00", "description" => "credit for application refund", "test" => null, "currency" => "USD"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/application_credits/140583599.json",
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

}
