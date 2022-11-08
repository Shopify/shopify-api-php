<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Admin2022_07\Payout;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class Payout202207Test extends BaseTestCase
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
                  ["payouts" => [["id" => 867808544, "status" => "paid", "date" => "2012-11-12", "currency" => "USD", "amount" => "41.90", "summary" => ["adjustments_fee_amount" => "0.12", "adjustments_gross_amount" => "2.13", "charges_fee_amount" => "1.32", "charges_gross_amount" => "44.52", "refunds_fee_amount" => "-0.23", "refunds_gross_amount" => "-3.54", "reserved_funds_fee_amount" => "0.00", "reserved_funds_gross_amount" => "0.00", "retried_payouts_fee_amount" => "0.00", "retried_payouts_gross_amount" => "0.00"]], ["id" => 725076685, "status" => "paid", "date" => "2012-11-12", "currency" => "USD", "amount" => "41.90", "summary" => ["adjustments_fee_amount" => "0.12", "adjustments_gross_amount" => "2.13", "charges_fee_amount" => "1.32", "charges_gross_amount" => "44.52", "refunds_fee_amount" => "-0.23", "refunds_gross_amount" => "-3.54", "reserved_funds_fee_amount" => "0.00", "reserved_funds_gross_amount" => "0.00", "retried_payouts_fee_amount" => "0.00", "retried_payouts_gross_amount" => "0.00"]], ["id" => 714327683, "status" => "failed", "date" => "2012-11-12", "currency" => "USD", "amount" => "41.90", "summary" => ["adjustments_fee_amount" => "0.12", "adjustments_gross_amount" => "2.13", "charges_fee_amount" => "1.32", "charges_gross_amount" => "44.52", "refunds_fee_amount" => "-0.23", "refunds_gross_amount" => "-3.54", "reserved_funds_fee_amount" => "0.00", "reserved_funds_gross_amount" => "0.00", "retried_payouts_fee_amount" => "0.00", "retried_payouts_gross_amount" => "0.00"]], ["id" => 631321250, "status" => "scheduled", "date" => "2012-11-12", "currency" => "USD", "amount" => "41.90", "summary" => ["adjustments_fee_amount" => "0.12", "adjustments_gross_amount" => "2.13", "charges_fee_amount" => "1.32", "charges_gross_amount" => "44.52", "refunds_fee_amount" => "-0.23", "refunds_gross_amount" => "-3.54", "reserved_funds_fee_amount" => "0.00", "reserved_funds_gross_amount" => "0.00", "retried_payouts_fee_amount" => "0.00", "retried_payouts_gross_amount" => "0.00"]], ["id" => 623721858, "status" => "paid", "date" => "2012-11-12", "currency" => "USD", "amount" => "41.90", "summary" => ["adjustments_fee_amount" => "0.12", "adjustments_gross_amount" => "2.13", "charges_fee_amount" => "1.32", "charges_gross_amount" => "44.52", "refunds_fee_amount" => "-0.23", "refunds_gross_amount" => "-3.54", "reserved_funds_fee_amount" => "0.00", "reserved_funds_gross_amount" => "0.00", "retried_payouts_fee_amount" => "0.00", "retried_payouts_gross_amount" => "0.00"]]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/shopify_payments/payouts.json?date_max=2012-11-12",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Payout::all(
            $this->test_session,
            [],
            ["date_max" => "2012-11-12"],
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
                  ["payouts" => [["id" => 854088011, "status" => "scheduled", "date" => "2013-11-01", "currency" => "USD", "amount" => "43.12", "summary" => ["adjustments_fee_amount" => "0.12", "adjustments_gross_amount" => "2.13", "charges_fee_amount" => "1.32", "charges_gross_amount" => "45.52", "refunds_fee_amount" => "-0.23", "refunds_gross_amount" => "-3.54", "reserved_funds_fee_amount" => "0.00", "reserved_funds_gross_amount" => "0.00", "retried_payouts_fee_amount" => "0.00", "retried_payouts_gross_amount" => "0.00"]], ["id" => 512467833, "status" => "failed", "date" => "2013-11-01", "currency" => "USD", "amount" => "43.12", "summary" => ["adjustments_fee_amount" => "0.12", "adjustments_gross_amount" => "2.13", "charges_fee_amount" => "1.32", "charges_gross_amount" => "45.52", "refunds_fee_amount" => "-0.23", "refunds_gross_amount" => "-3.54", "reserved_funds_fee_amount" => "0.00", "reserved_funds_gross_amount" => "0.00", "retried_payouts_fee_amount" => "0.00", "retried_payouts_gross_amount" => "0.00"]], ["id" => 39438702, "status" => "in_transit", "date" => "2013-11-01", "currency" => "USD", "amount" => "43.12", "summary" => ["adjustments_fee_amount" => "0.12", "adjustments_gross_amount" => "2.13", "charges_fee_amount" => "1.32", "charges_gross_amount" => "45.52", "refunds_fee_amount" => "-0.23", "refunds_gross_amount" => "-3.54", "reserved_funds_fee_amount" => "0.00", "reserved_funds_gross_amount" => "0.00", "retried_payouts_fee_amount" => "0.00", "retried_payouts_gross_amount" => "0.00"]], ["id" => 710174591, "status" => "paid", "date" => "2012-12-12", "currency" => "USD", "amount" => "41.90", "summary" => ["adjustments_fee_amount" => "0.12", "adjustments_gross_amount" => "2.13", "charges_fee_amount" => "1.32", "charges_gross_amount" => "44.52", "refunds_fee_amount" => "-0.23", "refunds_gross_amount" => "-3.54", "reserved_funds_fee_amount" => "0.00", "reserved_funds_gross_amount" => "0.00", "retried_payouts_fee_amount" => "0.00", "retried_payouts_gross_amount" => "0.00"]], ["id" => 974708905, "status" => "paid", "date" => "2012-11-13", "currency" => "CAD", "amount" => "51.69", "summary" => ["adjustments_fee_amount" => "0.12", "adjustments_gross_amount" => "2.13", "charges_fee_amount" => "6.46", "charges_gross_amount" => "58.15", "refunds_fee_amount" => "-0.23", "refunds_gross_amount" => "-3.54", "reserved_funds_fee_amount" => "0.00", "reserved_funds_gross_amount" => "0.00", "retried_payouts_fee_amount" => "0.00", "retried_payouts_gross_amount" => "0.00"]], ["id" => 867808544, "status" => "paid", "date" => "2012-11-12", "currency" => "USD", "amount" => "41.90", "summary" => ["adjustments_fee_amount" => "0.12", "adjustments_gross_amount" => "2.13", "charges_fee_amount" => "1.32", "charges_gross_amount" => "44.52", "refunds_fee_amount" => "-0.23", "refunds_gross_amount" => "-3.54", "reserved_funds_fee_amount" => "0.00", "reserved_funds_gross_amount" => "0.00", "retried_payouts_fee_amount" => "0.00", "retried_payouts_gross_amount" => "0.00"]], ["id" => 725076685, "status" => "paid", "date" => "2012-11-12", "currency" => "USD", "amount" => "41.90", "summary" => ["adjustments_fee_amount" => "0.12", "adjustments_gross_amount" => "2.13", "charges_fee_amount" => "1.32", "charges_gross_amount" => "44.52", "refunds_fee_amount" => "-0.23", "refunds_gross_amount" => "-3.54", "reserved_funds_fee_amount" => "0.00", "reserved_funds_gross_amount" => "0.00", "retried_payouts_fee_amount" => "0.00", "retried_payouts_gross_amount" => "0.00"]], ["id" => 714327683, "status" => "failed", "date" => "2012-11-12", "currency" => "USD", "amount" => "41.90", "summary" => ["adjustments_fee_amount" => "0.12", "adjustments_gross_amount" => "2.13", "charges_fee_amount" => "1.32", "charges_gross_amount" => "44.52", "refunds_fee_amount" => "-0.23", "refunds_gross_amount" => "-3.54", "reserved_funds_fee_amount" => "0.00", "reserved_funds_gross_amount" => "0.00", "retried_payouts_fee_amount" => "0.00", "retried_payouts_gross_amount" => "0.00"]], ["id" => 631321250, "status" => "scheduled", "date" => "2012-11-12", "currency" => "USD", "amount" => "41.90", "summary" => ["adjustments_fee_amount" => "0.12", "adjustments_gross_amount" => "2.13", "charges_fee_amount" => "1.32", "charges_gross_amount" => "44.52", "refunds_fee_amount" => "-0.23", "refunds_gross_amount" => "-3.54", "reserved_funds_fee_amount" => "0.00", "reserved_funds_gross_amount" => "0.00", "retried_payouts_fee_amount" => "0.00", "retried_payouts_gross_amount" => "0.00"]], ["id" => 623721858, "status" => "paid", "date" => "2012-11-12", "currency" => "USD", "amount" => "41.90", "summary" => ["adjustments_fee_amount" => "0.12", "adjustments_gross_amount" => "2.13", "charges_fee_amount" => "1.32", "charges_gross_amount" => "44.52", "refunds_fee_amount" => "-0.23", "refunds_gross_amount" => "-3.54", "reserved_funds_fee_amount" => "0.00", "reserved_funds_gross_amount" => "0.00", "retried_payouts_fee_amount" => "0.00", "retried_payouts_gross_amount" => "0.00"]]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/shopify_payments/payouts.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Payout::all(
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
                  ["payout" => ["id" => 623721858, "status" => "paid", "date" => "2012-11-12", "currency" => "USD", "amount" => "41.90", "summary" => ["adjustments_fee_amount" => "0.12", "adjustments_gross_amount" => "2.13", "charges_fee_amount" => "1.32", "charges_gross_amount" => "44.52", "refunds_fee_amount" => "-0.23", "refunds_gross_amount" => "-3.54", "reserved_funds_fee_amount" => "0.00", "reserved_funds_gross_amount" => "0.00", "retried_payouts_fee_amount" => "0.00", "retried_payouts_gross_amount" => "0.00"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/shopify_payments/payouts/623721858.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Payout::find(
            $this->test_session,
            623721858,
            [],
            [],
        );
    }

}
