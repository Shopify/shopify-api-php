<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Admin2022_07\DisputeEvidence;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class DisputeEvidence202207Test extends BaseTestCase
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
                  ["dispute_evidence" => ["id" => 819974671, "payments_dispute_id" => 598735659, "access_activity_log" => null, "billing_address" => ["id" => 867402159, "address1" => "123 Amoebobacterieae St", "address2" => "", "city" => "Ottawa", "province" => "Ontario", "province_code" => "ON", "country" => "Canada", "country_code" => "CA", "zip" => "K2P0V6"], "cancellation_policy_disclosure" => null, "cancellation_rebuttal" => null, "customer_email_address" => "example@shopify.com", "customer_first_name" => "Kermit", "customer_last_name" => "the Frog", "product_description" => "Product name: Draft\nTitle: 151cm\nPrice: \$10.00\nQuantity: 1\nProduct Description: good board", "refund_policy_disclosure" => null, "refund_refusal_explanation" => null, "shipping_address" => ["id" => 867402159, "address1" => "123 Amoebobacterieae St", "address2" => "", "city" => "Ottawa", "province" => "Ontario", "province_code" => "ON", "country" => "Canada", "country_code" => "CA", "zip" => "K2P0V6"], "uncategorized_text" => "Sample uncategorized text", "created_at" => "2022-07-02T01:30:21-04:00", "updated_at" => "2022-07-02T01:31:13-04:00", "submitted_by_merchant_on" => null, "fulfillments" => [["shipping_carrier" => "UPS", "shipping_tracking_number" => "1234", "shipping_date" => "2017-01-01"], ["shipping_carrier" => "FedEx", "shipping_tracking_number" => "4321", "shipping_date" => "2017-01-02"]], "dispute_evidence_files" => ["cancellation_policy_file_id" => null, "customer_communication_file_id" => 539650252, "customer_signature_file_id" => 799719586, "refund_policy_file_id" => null, "service_documentation_file_id" => null, "shipping_documentation_file_id" => 799719586, "uncategorized_file_id" => 567271523]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/shopify_payments/disputes/598735659/dispute_evidences.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        DisputeEvidence::find(
            $this->test_session,
            598735659,
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
                  ["dispute_evidence" => ["id" => 819974671, "payments_dispute_id" => 598735659, "access_activity_log" => null, "billing_address" => ["id" => 867402159, "address1" => "123 Amoebobacterieae St", "address2" => "", "city" => "Ottawa", "province" => "Ontario", "province_code" => "ON", "country" => "Canada", "country_code" => "CA", "zip" => "K2P0V6"], "cancellation_policy_disclosure" => null, "cancellation_rebuttal" => null, "customer_email_address" => "example@shopify.com", "customer_first_name" => "Kermit", "customer_last_name" => "the Frog", "product_description" => "Product name: Draft\nTitle: 151cm\nPrice: \$10.00\nQuantity: 1\nProduct Description: good board", "refund_policy_disclosure" => null, "refund_refusal_explanation" => "Product must have receipt of proof of purchase", "shipping_address" => ["id" => 867402159, "address1" => "123 Amoebobacterieae St", "address2" => "", "city" => "Ottawa", "province" => "Ontario", "province_code" => "ON", "country" => "Canada", "country_code" => "CA", "zip" => "K2P0V6"], "uncategorized_text" => "Sample uncategorized text", "created_at" => "2022-07-02T01:30:21-04:00", "updated_at" => "2022-07-02T01:31:17-04:00", "submitted_by_merchant_on" => null, "fulfillments" => [["shipping_carrier" => "UPS", "shipping_tracking_number" => "1234", "shipping_date" => "2017-01-01"], ["shipping_carrier" => "FedEx", "shipping_tracking_number" => "4321", "shipping_date" => "2017-01-02"]], "dispute_evidence_files" => ["cancellation_policy_file_id" => null, "customer_communication_file_id" => 539650252, "customer_signature_file_id" => 799719586, "refund_policy_file_id" => null, "service_documentation_file_id" => null, "shipping_documentation_file_id" => 799719586, "uncategorized_file_id" => 567271523]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/shopify_payments/disputes/598735659/dispute_evidences.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["dispute_evidence" => ["refund_refusal_explanation" => "Product must have receipt of proof of purchase"]]),
            ),
        ]);

        $dispute_evidence = new DisputeEvidence($this->test_session);
        $dispute_evidence->dispute_id = 598735659;
        $dispute_evidence->refund_refusal_explanation = "Product must have receipt of proof of purchase";
        $dispute_evidence->save();
    }

}
