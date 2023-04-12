<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Admin2022_04\Dispute;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class Dispute202204Test extends BaseTestCase
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
                  ["disputes" => []]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/shopify_payments/disputes.json?initiated_at=2013-05-03",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Dispute::all(
            $this->test_session,
            [],
            ["initiated_at" => "2013-05-03"],
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
                  ["disputes" => [["id" => 1052608616, "order_id" => null, "type" => "chargeback", "amount" => "100.00", "currency" => "USD", "reason" => "fraudulent", "network_reason_code" => "4827", "status" => "won", "evidence_due_by" => "2013-07-03T19:00:00-04:00", "evidence_sent_on" => "2013-07-04T07:00:00-04:00", "finalized_on" => null, "initiated_at" => "2013-05-03T20:00:00-04:00"], ["id" => 815713555, "order_id" => 625362839, "type" => "chargeback", "amount" => "11.50", "currency" => "USD", "reason" => "credit_not_processed", "network_reason_code" => "4827", "status" => "needs_response", "evidence_due_by" => "2023-04-16T20:00:00-04:00", "evidence_sent_on" => null, "finalized_on" => null, "initiated_at" => "2013-05-03T20:00:00-04:00"], ["id" => 782360659, "order_id" => 625362839, "type" => "chargeback", "amount" => "11.50", "currency" => "USD", "reason" => "fraudulent", "network_reason_code" => "4827", "status" => "won", "evidence_due_by" => "2013-07-03T19:00:00-04:00", "evidence_sent_on" => "2013-07-04T07:00:00-04:00", "finalized_on" => null, "initiated_at" => "2013-05-03T20:00:00-04:00"], ["id" => 670893524, "order_id" => 625362839, "type" => "inquiry", "amount" => "11.50", "currency" => "USD", "reason" => "fraudulent", "network_reason_code" => "4827", "status" => "needs_response", "evidence_due_by" => "2023-04-16T20:00:00-04:00", "evidence_sent_on" => null, "finalized_on" => null, "initiated_at" => "2013-05-03T20:00:00-04:00"], ["id" => 598735659, "order_id" => 625362839, "type" => "chargeback", "amount" => "11.50", "currency" => "USD", "reason" => "fraudulent", "network_reason_code" => "4827", "status" => "needs_response", "evidence_due_by" => "2023-04-16T20:00:00-04:00", "evidence_sent_on" => null, "finalized_on" => null, "initiated_at" => "2013-05-03T20:00:00-04:00"], ["id" => 85190714, "order_id" => 625362839, "type" => "chargeback", "amount" => "11.50", "currency" => "USD", "reason" => "fraudulent", "network_reason_code" => "4827", "status" => "under_review", "evidence_due_by" => "2023-04-16T20:00:00-04:00", "evidence_sent_on" => "2023-04-03T20:00:00-04:00", "finalized_on" => null, "initiated_at" => "2013-05-03T20:00:00-04:00"], ["id" => 35982383, "order_id" => 625362839, "type" => "chargeback", "amount" => "11.50", "currency" => "USD", "reason" => "subscription_canceled", "network_reason_code" => "4827", "status" => "needs_response", "evidence_due_by" => "2023-04-16T20:00:00-04:00", "evidence_sent_on" => null, "finalized_on" => null, "initiated_at" => "2013-05-03T20:00:00-04:00"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/shopify_payments/disputes.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Dispute::all(
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
                  ["disputes" => [["id" => 1052608616, "order_id" => null, "type" => "chargeback", "amount" => "100.00", "currency" => "USD", "reason" => "fraudulent", "network_reason_code" => "4827", "status" => "won", "evidence_due_by" => "2013-07-03T19:00:00-04:00", "evidence_sent_on" => "2013-07-04T07:00:00-04:00", "finalized_on" => null, "initiated_at" => "2013-05-03T20:00:00-04:00"], ["id" => 782360659, "order_id" => 625362839, "type" => "chargeback", "amount" => "11.50", "currency" => "USD", "reason" => "fraudulent", "network_reason_code" => "4827", "status" => "won", "evidence_due_by" => "2013-07-03T19:00:00-04:00", "evidence_sent_on" => "2013-07-04T07:00:00-04:00", "finalized_on" => null, "initiated_at" => "2013-05-03T20:00:00-04:00"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/shopify_payments/disputes.json?status=won",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Dispute::all(
            $this->test_session,
            [],
            ["status" => "won"],
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
                  ["dispute" => ["id" => 598735659, "order_id" => 625362839, "type" => "chargeback", "amount" => "11.50", "currency" => "USD", "reason" => "fraudulent", "network_reason_code" => "4827", "status" => "needs_response", "evidence_due_by" => "2023-04-16T20:00:00-04:00", "evidence_sent_on" => null, "finalized_on" => null, "initiated_at" => "2013-05-03T20:00:00-04:00"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/shopify_payments/disputes/598735659.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Dispute::find(
            $this->test_session,
            598735659,
            [],
            [],
        );
    }

}
