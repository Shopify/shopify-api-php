<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Admin2025_04\Checkout;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class Checkout202504Test extends BaseTestCase
{
    /** @var Session */
    private $test_session;

    public function setUp(): void
    {
        parent::setUp();

        Context::$API_VERSION = "2025-04";

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
                  ["checkout" => ["completed_at" => null, "created_at" => "2024-01-02T08:56:42-05:00", "currency" => "USD", "presentment_currency" => "USD", "customer_id" => null, "customer_locale" => "en", "device_id" => null, "discount_code" => null, "discount_codes" => [], "email" => null, "legal_notice_url" => null, "location_id" => null, "name" => "#1066348317", "note" => "", "note_attributes" => [], "order_id" => null, "order_status_url" => null, "order" => null, "payment_due" => "995.00", "payment_url" => "https://app.local/cardserver/sessions", "payments" => [], "phone" => null, "shopify_payments_account_id" => null, "privacy_policy_url" => null, "refund_policy_url" => null, "requires_shipping" => true, "reservation_time_left" => 0, "reservation_time" => null, "source_identifier" => null, "source_name" => "755357713", "source_url" => null, "subscription_policy_url" => null, "subtotal_price" => "995.00", "shipping_policy_url" => null, "tax_exempt" => false, "taxes_included" => false, "terms_of_sale_url" => null, "terms_of_service_url" => null, "token" => "f6d029d9d85858636669c7c865ab9e0c", "total_price" => "995.00", "total_tax" => "0.00", "total_tip_received" => "0.00", "total_line_items_price" => "995.00", "updated_at" => "2024-01-02T08:56:42-05:00", "user_id" => null, "web_url" => "https://jsmith.myshopify.com/548380009/checkouts/f6d029d9d85858636669c7c865ab9e0c", "total_duties" => null, "total_additional_fees" => null, "line_items" => [["id" => "72dab3c1ccce1aec9f79e19dd4151bca", "key" => "72dab3c1ccce1aec9f79e19dd4151bca", "product_id" => 632910392, "variant_id" => 39072856, "sku" => "IPOD2008GREEN", "vendor" => "Apple", "title" => "IPod Nano - 8GB", "variant_title" => "Green", "image_url" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano.png?v=1704203764", "taxable" => true, "requires_shipping" => true, "gift_card" => false, "price" => "199.00", "compare_at_price" => null, "line_price" => "995.00", "properties" => [], "quantity" => 5, "grams" => 567, "fulfillment_service" => "manual", "applied_discounts" => [], "discount_allocations" => [], "tax_lines" => []]], "gift_cards" => [], "tax_lines" => [], "tax_manipulations" => [], "shipping_line" => null, "shipping_rate" => null, "shipping_address" => null, "credit_card" => null, "billing_address" => null, "applied_discount" => null, "applied_discounts" => [], "discount_violations" => []]]
                )),
                "https://test-shop.myshopify.io/admin/api/2025-04/checkouts.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["checkout" => ["line_items" => [["variant_id" => 39072856, "quantity" => 5]]]]),
            ),
        ]);

        $checkout = new Checkout($this->test_session);
        $checkout->line_items = [
            [
                "variant_id" => 39072856,
                "quantity" => 5
            ]
        ];
        $checkout->save();
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
                  ["checkout" => ["completed_at" => null, "created_at" => "2024-01-02T08:56:54-05:00", "currency" => "USD", "presentment_currency" => "USD", "customer_id" => 1073339456, "customer_locale" => "en", "device_id" => null, "discount_code" => null, "discount_codes" => [], "email" => "me@example.com", "legal_notice_url" => null, "location_id" => null, "name" => "#1066348318", "note" => "", "note_attributes" => [], "order_id" => null, "order_status_url" => null, "order" => null, "payment_due" => "0.00", "payment_url" => "https://app.local/cardserver/sessions", "payments" => [], "phone" => null, "shopify_payments_account_id" => null, "privacy_policy_url" => null, "refund_policy_url" => null, "requires_shipping" => false, "reservation_time_left" => 0, "reservation_time" => null, "source_identifier" => null, "source_name" => "755357713", "source_url" => null, "subscription_policy_url" => null, "subtotal_price" => "0.00", "shipping_policy_url" => null, "tax_exempt" => false, "taxes_included" => false, "terms_of_sale_url" => null, "terms_of_service_url" => null, "token" => "9f1e4b3471a65b92e7cbc7664bea0294", "total_price" => "0.00", "total_tax" => "0.00", "total_tip_received" => "0.00", "total_line_items_price" => "0.00", "updated_at" => "2024-01-02T08:56:54-05:00", "user_id" => null, "web_url" => "https://jsmith.myshopify.com/548380009/checkouts/9f1e4b3471a65b92e7cbc7664bea0294", "total_duties" => null, "total_additional_fees" => null, "line_items" => [], "gift_cards" => [], "tax_lines" => [], "tax_manipulations" => [], "shipping_line" => null, "shipping_rate" => null, "shipping_address" => null, "credit_card" => null, "billing_address" => null, "applied_discount" => null, "applied_discounts" => [], "discount_violations" => []]]
                )),
                "https://test-shop.myshopify.io/admin/api/2025-04/checkouts.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["checkout" => ["email" => "me@example.com"]]),
            ),
        ]);

        $checkout = new Checkout($this->test_session);
        $checkout->email = "me@example.com";
        $checkout->save();
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
                  ["checkout" => ["completed_at" => null, "created_at" => "2012-10-12T07:05:27-04:00", "currency" => "USD", "presentment_currency" => "USD", "customer_id" => 207119551, "customer_locale" => "en", "device_id" => null, "discount_code" => null, "discount_codes" => [], "email" => "bob.norman@mail.example.com", "legal_notice_url" => null, "location_id" => null, "name" => "#86568385", "note" => "", "note_attributes" => ["custom engraving" => "Happy Birthday", "colour" => "green"], "order_id" => null, "order_status_url" => null, "order" => null, "payment_due" => "0.00", "payment_url" => "https://app.local/cardserver/sessions", "payments" => [], "phone" => null, "shopify_payments_account_id" => null, "privacy_policy_url" => null, "refund_policy_url" => null, "requires_shipping" => false, "reservation_time_left" => 0, "reservation_time" => null, "source_identifier" => null, "source_name" => "web", "source_url" => null, "subscription_policy_url" => null, "subtotal_price" => "0.00", "shipping_policy_url" => null, "tax_exempt" => false, "taxes_included" => false, "terms_of_sale_url" => null, "terms_of_service_url" => null, "token" => "b490a9220cd14d7344024f4874f640a6", "total_price" => "0.00", "total_tax" => "0.00", "total_tip_received" => "0.00", "total_line_items_price" => "0.00", "updated_at" => "2024-01-02T08:57:11-05:00", "user_id" => null, "web_url" => "https://checkout.local/548380009/checkouts/b490a9220cd14d7344024f4874f640a6", "total_duties" => null, "total_additional_fees" => null, "line_items" => [["id" => 49148385, "key" => 49148385, "product_id" => 632910392, "variant_id" => 49148385, "sku" => "IPOD2008RED", "vendor" => "Apple", "title" => "IPod Nano - 8GB", "variant_title" => "Red", "image_url" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano.png?v=1704203764", "taxable" => true, "requires_shipping" => false, "gift_card" => false, "price" => "0.00", "compare_at_price" => null, "line_price" => "0.00", "properties" => [], "quantity" => 1, "grams" => 200, "fulfillment_service" => "manual", "applied_discounts" => [], "discount_allocations" => [], "tax_lines" => []]], "gift_cards" => [], "tax_lines" => [], "tax_manipulations" => [], "shipping_line" => null, "shipping_rate" => null, "shipping_address" => ["id" => 550558813, "first_name" => "Bob", "last_name" => "Norman", "phone" => "+1(502)-459-2181", "company" => null, "address1" => "Chestnut Street 92", "address2" => "", "city" => "Louisville", "province" => "Kentucky", "province_code" => "KY", "country" => "United States", "country_code" => "US", "zip" => "40202"], "credit_card" => null, "billing_address" => ["id" => 550558813, "first_name" => "Bob", "last_name" => "Norman", "phone" => "+1(502)-459-2181", "company" => null, "address1" => "Chestnut Street 92", "address2" => "", "city" => "Louisville", "province" => "Kentucky", "province_code" => "KY", "country" => "United States", "country_code" => "US", "zip" => "40202"], "applied_discount" => null, "applied_discounts" => [], "discount_violations" => []]]
                )),
                "https://test-shop.myshopify.io/admin/api/2025-04/checkouts/b490a9220cd14d7344024f4874f640a6/complete.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        $checkout = new Checkout($this->test_session);
        $checkout->token = "b490a9220cd14d7344024f4874f640a6";
        $checkout->complete(
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
                  ["checkout" => ["completed_at" => "2005-07-31T11:57:11-04:00", "created_at" => "2012-10-12T07:05:27-04:00", "currency" => "USD", "presentment_currency" => "USD", "customer_id" => 207119551, "customer_locale" => "en", "device_id" => null, "discount_code" => null, "discount_codes" => [], "email" => "bob.norman@mail.example.com", "legal_notice_url" => null, "location_id" => null, "name" => "#901414060", "note" => "", "note_attributes" => ["custom engraving" => "Happy Birthday", "colour" => "green"], "order_id" => 450789469, "order_status_url" => "https://checkout.local/548380009/checkouts/bd5a8aa1ecd019dd3520ff791ee3a24c/thank_you", "order" => ["id" => 450789469, "name" => "#1001", "status_url" => "https://checkout.local/548380009/checkouts/bd5a8aa1ecd019dd3520ff791ee3a24c/thank_you"], "payment_due" => "398.00", "payment_url" => "https://app.local/cardserver/sessions", "payments" => [], "phone" => null, "shopify_payments_account_id" => null, "privacy_policy_url" => null, "refund_policy_url" => null, "requires_shipping" => true, "reservation_time_left" => 0, "reservation_time" => null, "source_identifier" => null, "source_name" => "web", "source_url" => null, "subscription_policy_url" => null, "subtotal_price" => "398.00", "shipping_policy_url" => null, "tax_exempt" => false, "taxes_included" => false, "terms_of_sale_url" => null, "terms_of_service_url" => null, "token" => "bd5a8aa1ecd019dd3520ff791ee3a24c", "total_price" => "398.00", "total_tax" => "0.00", "total_tip_received" => "0.00", "total_line_items_price" => "398.00", "updated_at" => "2012-10-12T07:05:27-04:00", "user_id" => null, "web_url" => "https://checkout.local/548380009/checkouts/bd5a8aa1ecd019dd3520ff791ee3a24c", "total_duties" => null, "total_additional_fees" => null, "line_items" => [["id" => "ca272ce1748d7f8b", "key" => "ca272ce1748d7f8b", "product_id" => 632910392, "variant_id" => 49148385, "sku" => "IPOD2008RED", "vendor" => "Apple", "title" => "IPod Nano - 8GB", "variant_title" => "Red", "image_url" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano.png?v=1704203764", "taxable" => true, "requires_shipping" => true, "gift_card" => false, "price" => "199.00", "compare_at_price" => null, "line_price" => "199.00", "properties" => [], "quantity" => 1, "grams" => 200, "fulfillment_service" => "manual", "applied_discounts" => [], "discount_allocations" => [], "tax_lines" => []], ["id" => "c59c18c66dea596d", "key" => "c59c18c66dea596d", "product_id" => 632910392, "variant_id" => 808950810, "sku" => "IPOD2008PINK", "vendor" => "Apple", "title" => "IPod Nano - 8GB", "variant_title" => "Pink", "image_url" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano-2.png?v=1704203764", "taxable" => true, "requires_shipping" => true, "gift_card" => false, "price" => "199.00", "compare_at_price" => null, "line_price" => "199.00", "properties" => [], "quantity" => 1, "grams" => 200, "fulfillment_service" => "manual", "applied_discounts" => [], "discount_allocations" => [], "tax_lines" => []]], "gift_cards" => [], "tax_lines" => [], "tax_manipulations" => [], "shipping_line" => ["handle" => "shopify-Free%20Shipping-0.00", "price" => "0.00", "title" => "Free Shipping", "tax_lines" => []], "shipping_rate" => ["id" => "shopify-Free%20Shipping-0.00", "price" => "0.00", "title" => "Free Shipping"], "shipping_address" => ["id" => 550558813, "first_name" => "Bob", "last_name" => "Norman", "phone" => "+1(502)-459-2181", "company" => null, "address1" => "Chestnut Street 92", "address2" => "", "city" => "Louisville", "province" => "Kentucky", "province_code" => "KY", "country" => "United States", "country_code" => "US", "zip" => "40202"], "credit_card" => null, "billing_address" => ["id" => 550558813, "first_name" => "Bob", "last_name" => "Norman", "phone" => "+1(502)-459-2181", "company" => null, "address1" => "Chestnut Street 92", "address2" => "", "city" => "Louisville", "province" => "Kentucky", "province_code" => "KY", "country" => "United States", "country_code" => "US", "zip" => "40202"], "applied_discount" => null, "applied_discounts" => [], "discount_violations" => []]]
                )),
                "https://test-shop.myshopify.io/admin/api/2025-04/checkouts/bd5a8aa1ecd019dd3520ff791ee3a24c.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Checkout::find(
            $this->test_session,
            "bd5a8aa1ecd019dd3520ff791ee3a24c",
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
                  ["checkout" => ["completed_at" => null, "created_at" => "2012-10-12T07:05:27-04:00", "currency" => "USD", "presentment_currency" => "USD", "customer_id" => 207119551, "customer_locale" => "en", "device_id" => null, "discount_code" => null, "discount_codes" => [], "email" => "bob.norman@mail.example.com", "legal_notice_url" => null, "location_id" => null, "name" => "#446514532", "note" => "", "note_attributes" => ["custom engraving" => "Happy Birthday", "colour" => "green"], "order_id" => null, "order_status_url" => null, "order" => null, "payment_due" => "419.49", "payment_url" => "https://app.local/cardserver/sessions", "payments" => [["id" => 25428999, "unique_token" => "e01e661f4a99acd9dcdg6f1422d0d6f7", "payment_processing_error_message" => null, "fraudulent" => false, "transaction" => ["amount" => "598.94", "amount_in" => null, "amount_out" => null, "amount_rounding" => null, "authorization" => "authorization-key", "created_at" => "2005-08-01T11:57:11-04:00", "currency" => "USD", "error_code" => null, "parent_id" => null, "gateway" => "bogus", "id" => 389404469, "kind" => "authorization", "message" => null, "status" => "success", "test" => false, "receipt" => ["testcase" => true, "authorization" => "123456"], "location_id" => null, "user_id" => null, "transaction_group_id" => null, "device_id" => null, "payment_details" => ["credit_card_bin" => null, "avs_result_code" => null, "cvv_result_code" => null, "credit_card_number" => "\u2022\u2022\u2022\u2022 \u2022\u2022\u2022\u2022 \u2022\u2022\u2022\u2022 4242", "credit_card_company" => "Visa", "buyer_action_info" => null, "credit_card_name" => null, "credit_card_wallet" => null, "credit_card_expiration_month" => null, "credit_card_expiration_year" => null, "payment_method_name" => "visa"]], "credit_card" => null]], "phone" => null, "shopify_payments_account_id" => null, "privacy_policy_url" => null, "refund_policy_url" => null, "requires_shipping" => true, "reservation_time_left" => 0, "reservation_time" => null, "source_identifier" => null, "source_name" => "web", "source_url" => null, "subscription_policy_url" => null, "subtotal_price" => "398.00", "shipping_policy_url" => null, "tax_exempt" => false, "taxes_included" => false, "terms_of_sale_url" => null, "terms_of_service_url" => null, "token" => "7yjf4v2we7gamku6a6h7tvm8h3mmvs4x", "total_price" => "419.49", "total_tax" => "21.49", "total_tip_received" => "0.00", "total_line_items_price" => "398.00", "updated_at" => "2012-10-12T07:05:27-04:00", "user_id" => null, "web_url" => "https://checkout.local/548380009/checkouts/7yjf4v2we7gamku6a6h7tvm8h3mmvs4x", "total_duties" => null, "total_additional_fees" => null, "line_items" => [["id" => "ca272ce1748d7f8b", "key" => "ca272ce1748d7f8b", "product_id" => 632910392, "variant_id" => 49148385, "sku" => "IPOD2008RED", "vendor" => "Apple", "title" => "IPod Nano - 8GB", "variant_title" => "Red", "image_url" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano.png?v=1704203764", "taxable" => true, "requires_shipping" => true, "gift_card" => false, "price" => "199.00", "compare_at_price" => null, "line_price" => "199.00", "properties" => [], "quantity" => 1, "grams" => 200, "fulfillment_service" => "manual", "applied_discounts" => [], "discount_allocations" => [], "tax_lines" => []], ["id" => "c59c18c66dea596d", "key" => "c59c18c66dea596d", "product_id" => 632910392, "variant_id" => 808950810, "sku" => "IPOD2008PINK", "vendor" => "Apple", "title" => "IPod Nano - 8GB", "variant_title" => "Pink", "image_url" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano-2.png?v=1704203764", "taxable" => true, "requires_shipping" => true, "gift_card" => false, "price" => "199.00", "compare_at_price" => null, "line_price" => "199.00", "properties" => [], "quantity" => 1, "grams" => 200, "fulfillment_service" => "manual", "applied_discounts" => [], "discount_allocations" => [], "tax_lines" => []]], "gift_cards" => [], "tax_lines" => [["price" => "21.49", "rate" => 0.06, "title" => "State Tax", "compare_at" => 0.06]], "tax_manipulations" => [], "shipping_line" => ["handle" => "shopify-Free%20Shipping-0.00", "price" => "0.00", "title" => "Free Shipping", "tax_lines" => []], "shipping_rate" => ["id" => "shopify-Free%20Shipping-0.00", "price" => "0.00", "title" => "Free Shipping"], "shipping_address" => ["id" => 550558813, "first_name" => "Bob", "last_name" => "Norman", "phone" => "+1(502)-459-2181", "company" => null, "address1" => "Chestnut Street 92", "address2" => "", "city" => "Louisville", "province" => "Kentucky", "province_code" => "KY", "country" => "United States", "country_code" => "US", "zip" => "40202"], "credit_card" => ["first_name" => "Bob", "last_name" => "Norman", "first_digits" => "1", "last_digits" => "1", "brand" => "bogus", "expiry_month" => 8, "expiry_year" => 2042, "customer_id" => null], "billing_address" => ["id" => 550558813, "first_name" => "Bob", "last_name" => "Norman", "phone" => "+1(502)-459-2181", "company" => null, "address1" => "Chestnut Street 92", "address2" => "", "city" => "Louisville", "province" => "Kentucky", "province_code" => "KY", "country" => "United States", "country_code" => "US", "zip" => "40202"], "applied_discount" => null, "applied_discounts" => [], "discount_violations" => []]]
                )),
                "https://test-shop.myshopify.io/admin/api/2025-04/checkouts/7yjf4v2we7gamku6a6h7tvm8h3mmvs4x.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Checkout::find(
            $this->test_session,
            "7yjf4v2we7gamku6a6h7tvm8h3mmvs4x",
            [],
            [],
        );
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
                  ["checkout" => ["completed_at" => null, "created_at" => "2012-10-12T07:05:27-04:00", "currency" => "USD", "presentment_currency" => "USD", "customer_id" => 207119551, "customer_locale" => "en", "device_id" => null, "discount_code" => null, "discount_codes" => [], "email" => "bob.norman@mail.example.com", "legal_notice_url" => null, "location_id" => null, "name" => "#862052962", "note" => "", "note_attributes" => ["custom engraving" => "Happy Birthday", "colour" => "green"], "order_id" => null, "order_status_url" => null, "order" => null, "payment_due" => "419.49", "payment_url" => "https://app.local/cardserver/sessions", "payments" => [], "phone" => null, "shopify_payments_account_id" => null, "privacy_policy_url" => null, "refund_policy_url" => null, "requires_shipping" => true, "reservation_time_left" => 0, "reservation_time" => null, "source_identifier" => null, "source_name" => "web", "source_url" => null, "subscription_policy_url" => null, "subtotal_price" => "398.00", "shipping_policy_url" => null, "tax_exempt" => false, "taxes_included" => false, "terms_of_sale_url" => null, "terms_of_service_url" => null, "token" => "exuw7apwoycchjuwtiqg8nytfhphr62a", "total_price" => "419.49", "total_tax" => "21.49", "total_tip_received" => "0.00", "total_line_items_price" => "398.00", "updated_at" => "2012-10-12T07:05:27-04:00", "user_id" => null, "web_url" => "https://checkout.local/548380009/checkouts/exuw7apwoycchjuwtiqg8nytfhphr62a", "total_duties" => null, "total_additional_fees" => null, "line_items" => [["id" => "ca272ce1748d7f8b", "key" => "ca272ce1748d7f8b", "product_id" => 632910392, "variant_id" => 49148385, "sku" => "IPOD2008RED", "vendor" => "Apple", "title" => "IPod Nano - 8GB", "variant_title" => "Red", "image_url" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano.png?v=1704203764", "taxable" => true, "requires_shipping" => true, "gift_card" => false, "price" => "199.00", "compare_at_price" => null, "line_price" => "199.00", "properties" => [], "quantity" => 1, "grams" => 200, "fulfillment_service" => "manual", "applied_discounts" => [], "discount_allocations" => [], "tax_lines" => []], ["id" => "c59c18c66dea596d", "key" => "c59c18c66dea596d", "product_id" => 632910392, "variant_id" => 808950810, "sku" => "IPOD2008PINK", "vendor" => "Apple", "title" => "IPod Nano - 8GB", "variant_title" => "Pink", "image_url" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano-2.png?v=1704203764", "taxable" => true, "requires_shipping" => true, "gift_card" => false, "price" => "199.00", "compare_at_price" => null, "line_price" => "199.00", "properties" => [], "quantity" => 1, "grams" => 200, "fulfillment_service" => "manual", "applied_discounts" => [], "discount_allocations" => [], "tax_lines" => []]], "gift_cards" => [], "tax_lines" => [["price" => "21.49", "rate" => 0.06, "title" => "State Tax", "compare_at" => 0.06]], "tax_manipulations" => [], "shipping_line" => ["handle" => "shopify-Free%20Shipping-0.00", "price" => "0.00", "title" => "Free Shipping", "tax_lines" => []], "shipping_rate" => ["id" => "shopify-Free%20Shipping-0.00", "price" => "0.00", "title" => "Free Shipping"], "shipping_address" => ["id" => 550558813, "first_name" => "Bob", "last_name" => "Norman", "phone" => "+1(502)-459-2181", "company" => null, "address1" => "Chestnut Street 92", "address2" => "", "city" => "Louisville", "province" => "Kentucky", "province_code" => "KY", "country" => "United States", "country_code" => "US", "zip" => "40202"], "credit_card" => null, "billing_address" => ["id" => 550558813, "first_name" => "Bob", "last_name" => "Norman", "phone" => "+1(502)-459-2181", "company" => null, "address1" => "Chestnut Street 92", "address2" => "", "city" => "Louisville", "province" => "Kentucky", "province_code" => "KY", "country" => "United States", "country_code" => "US", "zip" => "40202"], "applied_discount" => null, "applied_discounts" => [], "discount_violations" => []]]
                )),
                "https://test-shop.myshopify.io/admin/api/2025-04/checkouts/exuw7apwoycchjuwtiqg8nytfhphr62a.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Checkout::find(
            $this->test_session,
            "exuw7apwoycchjuwtiqg8nytfhphr62a",
            [],
            [],
        );
    }

    /**

     *
     * @return void
     */
    public function test_7(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["checkout" => ["completed_at" => null, "created_at" => "2012-10-12T07:05:27-04:00", "currency" => "USD", "presentment_currency" => "USD", "customer_id" => 207119551, "customer_locale" => "en", "device_id" => null, "discount_code" => null, "discount_codes" => [], "email" => "bob.norman@mail.example.com", "legal_notice_url" => null, "location_id" => null, "name" => "#862052962", "note" => "", "note_attributes" => ["custom engraving" => "Happy Birthday", "colour" => "green"], "order_id" => null, "order_status_url" => null, "order" => null, "payment_due" => "398.00", "payment_url" => "https://app.local/cardserver/sessions", "payments" => [], "phone" => null, "shopify_payments_account_id" => null, "privacy_policy_url" => null, "refund_policy_url" => null, "requires_shipping" => true, "reservation_time_left" => 0, "reservation_time" => null, "source_identifier" => null, "source_name" => "web", "source_url" => null, "subscription_policy_url" => null, "subtotal_price" => "398.00", "shipping_policy_url" => null, "tax_exempt" => false, "taxes_included" => false, "terms_of_sale_url" => null, "terms_of_service_url" => null, "token" => "exuw7apwoycchjuwtiqg8nytfhphr62a", "total_price" => "398.00", "total_tax" => "0.00", "total_tip_received" => "0.00", "total_line_items_price" => "398.00", "updated_at" => "2024-01-02T08:56:58-05:00", "user_id" => null, "web_url" => "https://checkout.local/548380009/checkouts/exuw7apwoycchjuwtiqg8nytfhphr62a", "total_duties" => null, "total_additional_fees" => null, "line_items" => [["id" => "ca272ce1748d7f8b", "key" => "ca272ce1748d7f8b", "product_id" => 632910392, "variant_id" => 49148385, "sku" => "IPOD2008RED", "vendor" => "Apple", "title" => "IPod Nano - 8GB", "variant_title" => "Red", "image_url" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano.png?v=1704203764", "taxable" => true, "requires_shipping" => true, "gift_card" => false, "price" => "199.00", "compare_at_price" => null, "line_price" => "199.00", "properties" => [], "quantity" => 1, "grams" => 200, "fulfillment_service" => "manual", "applied_discounts" => [], "discount_allocations" => [], "tax_lines" => []], ["id" => "c59c18c66dea596d", "key" => "c59c18c66dea596d", "product_id" => 632910392, "variant_id" => 808950810, "sku" => "IPOD2008PINK", "vendor" => "Apple", "title" => "IPod Nano - 8GB", "variant_title" => "Pink", "image_url" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano-2.png?v=1704203764", "taxable" => true, "requires_shipping" => true, "gift_card" => false, "price" => "199.00", "compare_at_price" => null, "line_price" => "199.00", "properties" => [], "quantity" => 1, "grams" => 200, "fulfillment_service" => "manual", "applied_discounts" => [], "discount_allocations" => [], "tax_lines" => []]], "gift_cards" => [], "tax_lines" => [], "tax_manipulations" => [], "shipping_line" => ["handle" => "shopify-Free%20Shipping-0.00", "price" => "0.00", "title" => "Free Shipping", "tax_lines" => []], "shipping_rate" => ["id" => "shopify-Free%20Shipping-0.00", "price" => "0.00", "title" => "Free Shipping"], "shipping_address" => ["id" => 550558813, "first_name" => "Bob", "last_name" => "Norman", "phone" => "+1(502)-459-2181", "company" => null, "address1" => "Chestnut Street 92", "address2" => "", "city" => "Louisville", "province" => "Kentucky", "province_code" => "KY", "country" => "United States", "country_code" => "US", "zip" => "40202"], "credit_card" => null, "billing_address" => ["id" => 550558813, "first_name" => "Bob", "last_name" => "Norman", "phone" => "+1(502)-459-2181", "company" => null, "address1" => "Chestnut Street 92", "address2" => "", "city" => "Louisville", "province" => "Kentucky", "province_code" => "KY", "country" => "United States", "country_code" => "US", "zip" => "40202"], "applied_discount" => null, "applied_discounts" => [], "discount_violations" => []]]
                )),
                "https://test-shop.myshopify.io/admin/api/2025-04/checkouts/exuw7apwoycchjuwtiqg8nytfhphr62a.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["checkout" => ["shipping_line" => ["handle" => "shopify-Free%20Shipping-0.00"]]]),
            ),
        ]);

        $checkout = new Checkout($this->test_session);
        $checkout->token = "exuw7apwoycchjuwtiqg8nytfhphr62a";
        $checkout->shipping_line = [
            "handle" => "shopify-Free%20Shipping-0.00"
        ];
        $checkout->save();
    }

    /**

     *
     * @return void
     */
    public function test_8(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["checkout" => ["completed_at" => null, "created_at" => "2012-10-12T07:05:27-04:00", "currency" => "USD", "presentment_currency" => "USD", "customer_id" => 1073339457, "customer_locale" => "en", "device_id" => null, "discount_code" => null, "discount_codes" => [], "email" => "john.smith@example.com", "legal_notice_url" => null, "location_id" => null, "name" => "#862052962", "note" => "", "note_attributes" => ["custom engraving" => "Happy Birthday", "colour" => "green"], "order_id" => null, "order_status_url" => null, "order" => null, "payment_due" => "398.00", "payment_url" => "https://app.local/cardserver/sessions", "payments" => [], "phone" => null, "shopify_payments_account_id" => null, "privacy_policy_url" => null, "refund_policy_url" => null, "requires_shipping" => true, "reservation_time_left" => 0, "reservation_time" => null, "source_identifier" => null, "source_name" => "web", "source_url" => null, "subscription_policy_url" => null, "subtotal_price" => "398.00", "shipping_policy_url" => null, "tax_exempt" => false, "taxes_included" => false, "terms_of_sale_url" => null, "terms_of_service_url" => null, "token" => "exuw7apwoycchjuwtiqg8nytfhphr62a", "total_price" => "398.00", "total_tax" => "0.00", "total_tip_received" => "0.00", "total_line_items_price" => "398.00", "updated_at" => "2024-01-02T08:57:03-05:00", "user_id" => null, "web_url" => "https://checkout.local/548380009/checkouts/exuw7apwoycchjuwtiqg8nytfhphr62a?key=4a50784c4d35b6f40589ffb5011e1457", "total_duties" => null, "total_additional_fees" => null, "line_items" => [["id" => "ca272ce1748d7f8b", "key" => "ca272ce1748d7f8b", "product_id" => 632910392, "variant_id" => 49148385, "sku" => "IPOD2008RED", "vendor" => "Apple", "title" => "IPod Nano - 8GB", "variant_title" => "Red", "image_url" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano.png?v=1704203764", "taxable" => true, "requires_shipping" => true, "gift_card" => false, "price" => "199.00", "compare_at_price" => null, "line_price" => "199.00", "properties" => [], "quantity" => 1, "grams" => 200, "fulfillment_service" => "manual", "applied_discounts" => [], "discount_allocations" => [], "tax_lines" => []], ["id" => "c59c18c66dea596d", "key" => "c59c18c66dea596d", "product_id" => 632910392, "variant_id" => 808950810, "sku" => "IPOD2008PINK", "vendor" => "Apple", "title" => "IPod Nano - 8GB", "variant_title" => "Pink", "image_url" => "https://cdn.shopify.com/s/files/1/0005/4838/0009/products/ipod-nano-2.png?v=1704203764", "taxable" => true, "requires_shipping" => true, "gift_card" => false, "price" => "199.00", "compare_at_price" => null, "line_price" => "199.00", "properties" => [], "quantity" => 1, "grams" => 200, "fulfillment_service" => "manual", "applied_discounts" => [], "discount_allocations" => [], "tax_lines" => []]], "gift_cards" => [], "tax_lines" => [], "tax_manipulations" => [], "shipping_line" => null, "shipping_rate" => null, "shipping_address" => ["id" => 550558813, "first_name" => "John", "last_name" => "Smith", "phone" => "(123)456-7890", "company" => null, "address1" => "126 York St.", "address2" => "", "city" => "Los Angeles", "province" => "California", "province_code" => "CA", "country" => "United States", "country_code" => "US", "zip" => "90002"], "credit_card" => null, "billing_address" => ["id" => 550558813, "first_name" => "Bob", "last_name" => "Norman", "phone" => "+1(502)-459-2181", "company" => null, "address1" => "Chestnut Street 92", "address2" => "", "city" => "Louisville", "province" => "Kentucky", "province_code" => "KY", "country" => "United States", "country_code" => "US", "zip" => "40202"], "applied_discount" => null, "applied_discounts" => [], "discount_violations" => []]]
                )),
                "https://test-shop.myshopify.io/admin/api/2025-04/checkouts/exuw7apwoycchjuwtiqg8nytfhphr62a.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["checkout" => ["email" => "john.smith@example.com", "shipping_address" => ["first_name" => "John", "last_name" => "Smith", "address1" => "126 York St.", "city" => "Los Angeles", "province_code" => "CA", "country_code" => "US", "phone" => "(123)456-7890", "zip" => "90002"]]]),
            ),
        ]);

        $checkout = new Checkout($this->test_session);
        $checkout->token = "exuw7apwoycchjuwtiqg8nytfhphr62a";
        $checkout->email = "john.smith@example.com";
        $checkout->shipping_address = [
            "first_name" => "John",
            "last_name" => "Smith",
            "address1" => "126 York St.",
            "city" => "Los Angeles",
            "province_code" => "CA",
            "country_code" => "US",
            "phone" => "(123)456-7890",
            "zip" => "90002"
        ];
        $checkout->save();
    }

    /**

     *
     * @return void
     */
    public function test_9(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["shipping_rates" => [["id" => "shopify-Free%20Shipping-0.00", "price" => "0.00", "title" => "Free Shipping", "checkout" => ["total_tax" => "0.00", "total_price" => "398.00", "subtotal_price" => "398.00"], "phone_required" => false, "delivery_range" => null, "estimated_time_in_transit" => null, "handle" => "shopify-Free%20Shipping-0.00"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2025-04/checkouts/exuw7apwoycchjuwtiqg8nytfhphr62a/shipping_rates.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Checkout::shipping_rates(
            $this->test_session,
            "exuw7apwoycchjuwtiqg8nytfhphr62a",
            [],
            [],
        );
    }

    /**

     *
     * @return void
     */
    public function test_10(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["shipping_rates" => []]
                )),
                "https://test-shop.myshopify.io/admin/api/2025-04/checkouts/exuw7apwoycchjuwtiqg8nytfhphr62a/shipping_rates.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Checkout::shipping_rates(
            $this->test_session,
            "exuw7apwoycchjuwtiqg8nytfhphr62a",
            [],
            [],
        );
    }

    /**

     *
     * @return void
     */
    public function test_11(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["shipping_rates" => []]
                )),
                "https://test-shop.myshopify.io/admin/api/2025-04/checkouts/zs9ru89kuqcdagk8bz4r9hnxt22wwd42/shipping_rates.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Checkout::shipping_rates(
            $this->test_session,
            "zs9ru89kuqcdagk8bz4r9hnxt22wwd42",
            [],
            [],
        );
    }

}
