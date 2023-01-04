<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Admin2022_04\PaymentGateway;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class PaymentGateway202204Test extends BaseTestCase
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
                  ["payment_gateways" => [["disabled" => false, "id" => 431363653, "name" => "shopify_payments", "provider_id" => 87, "sandbox" => false, "supports_network_tokenization" => null, "type" => "DirectPaymentGateway", "enabled_card_brands" => ["visa", "master", "american_express", "discover", "diners_club"], "processing_method" => "direct", "service_name" => "Shopify Payments", "metadata" => ["google_pay_merchant_id" => 548380009], "created_at" => "2011-12-31T19:00:00-05:00", "updated_at" => "2023-01-03T12:21:58-05:00", "credential4" => null, "attachment" => null], ["disabled" => true, "id" => 170508070, "name" => "Cash on Delivery (COD)", "provider_id" => 140, "sandbox" => false, "supports_network_tokenization" => null, "type" => "ManualPaymentGateway", "enabled_card_brands" => [], "processing_method" => "manual", "service_name" => "Cash on Delivery (COD)", "metadata" => [], "created_at" => "2023-01-03T12:21:36-05:00", "updated_at" => "2023-01-03T12:21:36-05:00"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/payment_gateways.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        PaymentGateway::all(
            $this->test_session,
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
                  ["payment_gateways" => [["disabled" => false, "id" => 431363653, "name" => "shopify_payments", "provider_id" => 87, "sandbox" => false, "supports_network_tokenization" => null, "type" => "DirectPaymentGateway", "enabled_card_brands" => ["visa", "master", "american_express", "discover", "diners_club"], "processing_method" => "direct", "service_name" => "Shopify Payments", "metadata" => ["google_pay_merchant_id" => 548380009], "created_at" => "2011-12-31T19:00:00-05:00", "updated_at" => "2023-01-03T12:21:52-05:00", "credential4" => null, "attachment" => null]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/payment_gateways.json?disabled=false",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        PaymentGateway::all(
            $this->test_session,
            [],
            ["disabled" => "false"],
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
                  ["payment_gateway" => ["disabled" => false, "id" => 1048196722, "name" => "authorize_net", "provider_id" => 7, "sandbox" => false, "supports_network_tokenization" => null, "type" => "DirectPaymentGateway", "enabled_card_brands" => ["visa", "master", "american_express", "discover", "diners_club", "jcb"], "processing_method" => "direct", "service_name" => "Authorize.net", "metadata" => [], "created_at" => "2023-01-03T12:21:57-05:00", "updated_at" => "2023-01-03T12:21:57-05:00", "credential1" => "someone@example.com", "credential3" => null, "credential4" => null, "attachment" => null]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/payment_gateways.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["payment_gateway" => ["credential1" => "someone@example.com", "provider_id" => 7]]),
            ),
        ]);

        $payment_gateway = new PaymentGateway($this->test_session);
        $payment_gateway->credential1 = "someone@example.com";
        $payment_gateway->provider_id = 7;
        $payment_gateway->save();
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
                  ["payment" => ["disabled" => false, "id" => 431363653, "name" => "shopify_payments", "provider_id" => 87, "sandbox" => false, "supports_network_tokenization" => null, "type" => "DirectPaymentGateway", "enabled_card_brands" => ["visa", "master", "american_express", "discover", "diners_club"], "processing_method" => "direct", "service_name" => "Shopify Payments", "metadata" => ["google_pay_merchant_id" => 548380009], "created_at" => "2011-12-31T19:00:00-05:00", "updated_at" => "2023-01-03T12:21:54-05:00", "credential4" => null, "attachment" => null]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/payment_gateways/431363653.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        PaymentGateway::find(
            $this->test_session,
            431363653,
            [],
            [],
        );
    }

    /**

     *
     * @return void
     */
    public function test_5(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["payment_gateway" => ["disabled" => false, "id" => 170508070, "name" => "Cash on Delivery (COD)", "provider_id" => 140, "sandbox" => true, "supports_network_tokenization" => null, "type" => "ManualPaymentGateway", "enabled_card_brands" => [], "processing_method" => "manual", "service_name" => "Cash on Delivery (COD)", "metadata" => [], "created_at" => "2023-01-03T12:21:36-05:00", "updated_at" => "2023-01-03T12:22:03-05:00"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/payment_gateways/170508070.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["payment_gateway" => ["sandbox" => true]]),
            ),
        ]);

        $payment_gateway = new PaymentGateway($this->test_session);
        $payment_gateway->id = 170508070;
        $payment_gateway->sandbox = true;
        $payment_gateway->save();
    }

    /**

     *
     * @return void
     */
    public function test_6(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  []
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/payment_gateways/170508070.json",
                "DELETE",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        PaymentGateway::delete(
            $this->test_session,
            170508070,
            [],
            [],
        );
    }

}
