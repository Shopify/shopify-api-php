<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Admin2022_04\DraftOrder;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class DraftOrder202204Test extends BaseTestCase
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
                  ["draft_order" => ["id" => 1069920481, "note" => null, "email" => "bob.norman@mail.example.com", "taxes_included" => false, "currency" => "USD", "invoice_sent_at" => null, "created_at" => "2023-04-04T17:25:08-04:00", "updated_at" => "2023-04-04T17:25:08-04:00", "tax_exempt" => false, "completed_at" => null, "name" => "#D5", "status" => "open", "line_items" => [["id" => 1066630386, "variant_id" => null, "product_id" => null, "title" => "Custom Tee", "variant_title" => null, "sku" => null, "vendor" => null, "quantity" => 2, "requires_shipping" => false, "taxable" => true, "gift_card" => false, "fulfillment_service" => "manual", "grams" => 0, "tax_lines" => [], "applied_discount" => null, "name" => "Custom Tee", "properties" => [], "custom" => true, "price" => "20.00", "admin_graphql_api_id" => "gid://shopify/DraftOrderLineItem/1066630386"]], "shipping_address" => ["first_name" => null, "address1" => "Chestnut Street 92", "phone" => "555-625-1199", "city" => "Louisville", "zip" => "40202", "province" => "Kentucky", "country" => "United States", "last_name" => null, "address2" => "", "company" => null, "latitude" => null, "longitude" => null, "name" => "", "country_code" => "US", "province_code" => "KY"], "billing_address" => ["first_name" => null, "address1" => "Chestnut Street 92", "phone" => "555-625-1199", "city" => "Louisville", "zip" => "40202", "province" => "Kentucky", "country" => "United States", "last_name" => null, "address2" => "", "company" => null, "latitude" => null, "longitude" => null, "name" => "", "country_code" => "US", "province_code" => "KY"], "invoice_url" => "https://jsmith.myshopify.com/548380009/invoices/9663d694dd889ad3ae8b3f0d24092493", "applied_discount" => ["description" => "Custom discount", "value" => "10.0", "title" => "Custom", "amount" => "10.00", "value_type" => "fixed_amount"], "order_id" => null, "shipping_line" => null, "tax_lines" => [], "tags" => "", "note_attributes" => [], "total_price" => "30.00", "subtotal_price" => "30.00", "total_tax" => "0.00", "presentment_currency" => "USD", "total_line_items_price_set" => ["shop_money" => ["amount" => "40.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "40.00", "currency_code" => "USD"]], "total_price_set" => ["shop_money" => ["amount" => "30.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "30.00", "currency_code" => "USD"]], "subtotal_price_set" => ["shop_money" => ["amount" => "30.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "30.00", "currency_code" => "USD"]], "total_tax_set" => ["shop_money" => ["amount" => "0.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "0.00", "currency_code" => "USD"]], "total_discounts_set" => ["shop_money" => ["amount" => "10.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "10.00", "currency_code" => "USD"]], "total_shipping_price_set" => ["shop_money" => ["amount" => "0.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "0.00", "currency_code" => "USD"]], "total_additional_fees_set" => null, "total_duties_set" => null, "payment_terms" => null, "admin_graphql_api_id" => "gid://shopify/DraftOrder/1069920481", "customer" => ["id" => 207119551, "email" => "bob.norman@mail.example.com", "accepts_marketing" => false, "created_at" => "2023-04-04T17:13:27-04:00", "updated_at" => "2023-04-04T17:13:27-04:00", "first_name" => "Bob", "last_name" => "Norman", "orders_count" => 1, "state" => "disabled", "total_spent" => "199.65", "last_order_id" => 450789469, "note" => null, "verified_email" => true, "multipass_identifier" => null, "tax_exempt" => false, "tags" => "L\u00E9on, No\u00EBl", "last_order_name" => "#1001", "currency" => "USD", "phone" => "+16136120707", "accepts_marketing_updated_at" => "2005-06-12T11:57:11-04:00", "marketing_opt_in_level" => null, "tax_exemptions" => [], "email_marketing_consent" => ["state" => "not_subscribed", "opt_in_level" => null, "consent_updated_at" => "2004-06-13T11:57:11-04:00"], "sms_marketing_consent" => ["state" => "not_subscribed", "opt_in_level" => "single_opt_in", "consent_updated_at" => "2023-04-04T17:13:27-04:00", "consent_collected_from" => "OTHER"], "admin_graphql_api_id" => "gid://shopify/Customer/207119551", "default_address" => ["id" => 207119551, "customer_id" => 207119551, "first_name" => null, "last_name" => null, "company" => null, "address1" => "Chestnut Street 92", "address2" => "", "city" => "Louisville", "province" => "Kentucky", "country" => "United States", "zip" => "40202", "phone" => "555-625-1199", "name" => "", "province_code" => "KY", "country_code" => "US", "country_name" => "United States", "default" => true]]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/draft_orders.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["draft_order" => ["line_items" => [["title" => "Custom Tee", "price" => "20.00", "quantity" => 2]], "applied_discount" => ["description" => "Custom discount", "value_type" => "fixed_amount", "value" => "10.0", "amount" => "10.00", "title" => "Custom"], "customer" => ["id" => 207119551], "use_customer_default_address" => true]]),
            ),
        ]);

        $draft_order = new DraftOrder($this->test_session);
        $draft_order->line_items = [
            [
                "title" => "Custom Tee",
                "price" => "20.00",
                "quantity" => 2
            ]
        ];
        $draft_order->applied_discount = [
            "description" => "Custom discount",
            "value_type" => "fixed_amount",
            "value" => "10.0",
            "amount" => "10.00",
            "title" => "Custom"
        ];
        $draft_order->customer = [
            "id" => 207119551
        ];
        $draft_order->use_customer_default_address = true;
        $draft_order->save();
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
                  ["draft_order" => ["id" => 1069920477, "note" => null, "email" => null, "taxes_included" => false, "currency" => "USD", "invoice_sent_at" => null, "created_at" => "2023-04-04T17:24:45-04:00", "updated_at" => "2023-04-04T17:24:45-04:00", "tax_exempt" => false, "completed_at" => null, "name" => "#D5", "status" => "open", "line_items" => [["id" => 1066630382, "variant_id" => null, "product_id" => null, "title" => "Custom Tee", "variant_title" => null, "sku" => null, "vendor" => null, "quantity" => 1, "requires_shipping" => false, "taxable" => true, "gift_card" => false, "fulfillment_service" => "manual", "grams" => 0, "tax_lines" => [["rate" => 0.05, "title" => "GST", "price" => "0.90"], ["rate" => 0.08, "title" => "Tax", "price" => "1.44"]], "applied_discount" => ["description" => "Custom discount", "value" => "10.0", "title" => "Custom", "amount" => "2.00", "value_type" => "percentage"], "name" => "Custom Tee", "properties" => [], "custom" => true, "price" => "20.00", "admin_graphql_api_id" => "gid://shopify/DraftOrderLineItem/1066630382"]], "shipping_address" => null, "billing_address" => null, "invoice_url" => "https://jsmith.myshopify.com/548380009/invoices/03c2d7a8721a601858cfb954090e966e", "applied_discount" => null, "order_id" => null, "shipping_line" => null, "tax_lines" => [["rate" => 0.05, "title" => "GST", "price" => "0.90"], ["rate" => 0.08, "title" => "Tax", "price" => "1.44"]], "tags" => "", "note_attributes" => [], "total_price" => "20.34", "subtotal_price" => "18.00", "total_tax" => "2.34", "presentment_currency" => "USD", "total_line_items_price_set" => ["shop_money" => ["amount" => "20.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "20.00", "currency_code" => "USD"]], "total_price_set" => ["shop_money" => ["amount" => "20.34", "currency_code" => "USD"], "presentment_money" => ["amount" => "20.34", "currency_code" => "USD"]], "subtotal_price_set" => ["shop_money" => ["amount" => "18.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "18.00", "currency_code" => "USD"]], "total_tax_set" => ["shop_money" => ["amount" => "2.34", "currency_code" => "USD"], "presentment_money" => ["amount" => "2.34", "currency_code" => "USD"]], "total_discounts_set" => ["shop_money" => ["amount" => "2.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "2.00", "currency_code" => "USD"]], "total_shipping_price_set" => ["shop_money" => ["amount" => "0.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "0.00", "currency_code" => "USD"]], "total_additional_fees_set" => null, "total_duties_set" => null, "payment_terms" => null, "admin_graphql_api_id" => "gid://shopify/DraftOrder/1069920477"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/draft_orders.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["draft_order" => ["line_items" => [["title" => "Custom Tee", "price" => "20.00", "quantity" => 1, "applied_discount" => ["description" => "Custom discount", "value_type" => "percentage", "value" => "10.0", "amount" => "2.0", "title" => "Custom"]]]]]),
            ),
        ]);

        $draft_order = new DraftOrder($this->test_session);
        $draft_order->line_items = [
            [
                "title" => "Custom Tee",
                "price" => "20.00",
                "quantity" => 1,
                "applied_discount" => [
                    "description" => "Custom discount",
                    "value_type" => "percentage",
                    "value" => "10.0",
                    "amount" => "2.0",
                    "title" => "Custom"
                ]
            ]
        ];
        $draft_order->save();
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
                  ["draft_order" => ["id" => 1069920479, "note" => null, "email" => "bob.norman@mail.example.com", "taxes_included" => false, "currency" => "USD", "invoice_sent_at" => null, "created_at" => "2023-04-04T17:24:54-04:00", "updated_at" => "2023-04-04T17:24:54-04:00", "tax_exempt" => false, "completed_at" => null, "name" => "#D5", "status" => "open", "line_items" => [["id" => 1066630384, "variant_id" => null, "product_id" => null, "title" => "Custom Tee", "variant_title" => null, "sku" => null, "vendor" => null, "quantity" => 2, "requires_shipping" => false, "taxable" => true, "gift_card" => false, "fulfillment_service" => "manual", "grams" => 0, "tax_lines" => [], "applied_discount" => null, "name" => "Custom Tee", "properties" => [], "custom" => true, "price" => "20.00", "admin_graphql_api_id" => "gid://shopify/DraftOrderLineItem/1066630384"]], "shipping_address" => ["first_name" => null, "address1" => "Chestnut Street 92", "phone" => "555-625-1199", "city" => "Louisville", "zip" => "40202", "province" => "Kentucky", "country" => "United States", "last_name" => null, "address2" => "", "company" => null, "latitude" => null, "longitude" => null, "name" => "", "country_code" => "US", "province_code" => "KY"], "billing_address" => ["first_name" => null, "address1" => "Chestnut Street 92", "phone" => "555-625-1199", "city" => "Louisville", "zip" => "40202", "province" => "Kentucky", "country" => "United States", "last_name" => null, "address2" => "", "company" => null, "latitude" => null, "longitude" => null, "name" => "", "country_code" => "US", "province_code" => "KY"], "invoice_url" => "https://jsmith.myshopify.com/548380009/invoices/0028bbe1229838c2639731f4cce93aea", "applied_discount" => null, "order_id" => null, "shipping_line" => null, "tax_lines" => [], "tags" => "", "note_attributes" => [], "total_price" => "40.00", "subtotal_price" => "40.00", "total_tax" => "0.00", "presentment_currency" => "USD", "total_line_items_price_set" => ["shop_money" => ["amount" => "40.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "40.00", "currency_code" => "USD"]], "total_price_set" => ["shop_money" => ["amount" => "40.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "40.00", "currency_code" => "USD"]], "subtotal_price_set" => ["shop_money" => ["amount" => "40.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "40.00", "currency_code" => "USD"]], "total_tax_set" => ["shop_money" => ["amount" => "0.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "0.00", "currency_code" => "USD"]], "total_discounts_set" => ["shop_money" => ["amount" => "0.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "0.00", "currency_code" => "USD"]], "total_shipping_price_set" => ["shop_money" => ["amount" => "0.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "0.00", "currency_code" => "USD"]], "total_additional_fees_set" => null, "total_duties_set" => null, "payment_terms" => null, "admin_graphql_api_id" => "gid://shopify/DraftOrder/1069920479", "customer" => ["id" => 207119551, "email" => "bob.norman@mail.example.com", "accepts_marketing" => false, "created_at" => "2023-04-04T17:13:27-04:00", "updated_at" => "2023-04-04T17:13:27-04:00", "first_name" => "Bob", "last_name" => "Norman", "orders_count" => 1, "state" => "disabled", "total_spent" => "199.65", "last_order_id" => 450789469, "note" => null, "verified_email" => true, "multipass_identifier" => null, "tax_exempt" => false, "tags" => "L\u00E9on, No\u00EBl", "last_order_name" => "#1001", "currency" => "USD", "phone" => "+16136120707", "accepts_marketing_updated_at" => "2005-06-12T11:57:11-04:00", "marketing_opt_in_level" => null, "tax_exemptions" => [], "email_marketing_consent" => ["state" => "not_subscribed", "opt_in_level" => null, "consent_updated_at" => "2004-06-13T11:57:11-04:00"], "sms_marketing_consent" => ["state" => "not_subscribed", "opt_in_level" => "single_opt_in", "consent_updated_at" => "2023-04-04T17:13:27-04:00", "consent_collected_from" => "OTHER"], "admin_graphql_api_id" => "gid://shopify/Customer/207119551", "default_address" => ["id" => 207119551, "customer_id" => 207119551, "first_name" => null, "last_name" => null, "company" => null, "address1" => "Chestnut Street 92", "address2" => "", "city" => "Louisville", "province" => "Kentucky", "country" => "United States", "zip" => "40202", "phone" => "555-625-1199", "name" => "", "province_code" => "KY", "country_code" => "US", "country_name" => "United States", "default" => true]]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/draft_orders.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["draft_order" => ["line_items" => [["title" => "Custom Tee", "price" => "20.00", "quantity" => 2]], "customer" => ["id" => 207119551], "use_customer_default_address" => true]]),
            ),
        ]);

        $draft_order = new DraftOrder($this->test_session);
        $draft_order->line_items = [
            [
                "title" => "Custom Tee",
                "price" => "20.00",
                "quantity" => 2
            ]
        ];
        $draft_order->customer = [
            "id" => 207119551
        ];
        $draft_order->use_customer_default_address = true;
        $draft_order->save();
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
                  ["draft_order" => ["id" => 1069920475, "note" => null, "email" => null, "taxes_included" => false, "currency" => "USD", "invoice_sent_at" => null, "created_at" => "2023-04-04T17:24:40-04:00", "updated_at" => "2023-04-04T17:24:40-04:00", "tax_exempt" => false, "completed_at" => null, "name" => "#D5", "status" => "open", "line_items" => [["id" => 1066630380, "variant_id" => 447654529, "product_id" => 921728736, "title" => "IPod Touch 8GB", "variant_title" => "Black", "sku" => "IPOD2009BLACK", "vendor" => "Apple", "quantity" => 1, "requires_shipping" => true, "taxable" => true, "gift_card" => false, "fulfillment_service" => "shipwire-app", "grams" => 567, "tax_lines" => [["rate" => 0.05, "title" => "GST", "price" => "9.95"], ["rate" => 0.08, "title" => "Tax", "price" => "15.92"]], "applied_discount" => null, "name" => "IPod Touch 8GB - Black", "properties" => [], "custom" => false, "price" => "199.00", "admin_graphql_api_id" => "gid://shopify/DraftOrderLineItem/1066630380"]], "shipping_address" => null, "billing_address" => ["first_name" => "Bob", "address1" => "123 Main St", "phone" => "555-555-5555", "city" => "Anytown", "zip" => "A1B2C3", "province" => "Ontario", "country" => "Canada", "last_name" => "Norman", "address2" => null, "company" => null, "latitude" => null, "longitude" => null, "name" => "Bob Norman", "country_code" => "CA", "province_code" => "ON"], "invoice_url" => "https://jsmith.myshopify.com/548380009/invoices/7c575bc6f3d58df07abbc8da241959b2", "applied_discount" => null, "order_id" => null, "shipping_line" => null, "tax_lines" => [["rate" => 0.05, "title" => "GST", "price" => "9.95"], ["rate" => 0.08, "title" => "Tax", "price" => "15.92"]], "tags" => "", "note_attributes" => [], "total_price" => "224.87", "subtotal_price" => "199.00", "total_tax" => "25.87", "presentment_currency" => "USD", "total_line_items_price_set" => ["shop_money" => ["amount" => "199.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "199.00", "currency_code" => "USD"]], "total_price_set" => ["shop_money" => ["amount" => "224.87", "currency_code" => "USD"], "presentment_money" => ["amount" => "224.87", "currency_code" => "USD"]], "subtotal_price_set" => ["shop_money" => ["amount" => "199.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "199.00", "currency_code" => "USD"]], "total_tax_set" => ["shop_money" => ["amount" => "25.87", "currency_code" => "USD"], "presentment_money" => ["amount" => "25.87", "currency_code" => "USD"]], "total_discounts_set" => ["shop_money" => ["amount" => "0.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "0.00", "currency_code" => "USD"]], "total_shipping_price_set" => ["shop_money" => ["amount" => "0.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "0.00", "currency_code" => "USD"]], "total_additional_fees_set" => null, "total_duties_set" => null, "payment_terms" => null, "admin_graphql_api_id" => "gid://shopify/DraftOrder/1069920475", "customer" => ["id" => 1073339461, "email" => null, "accepts_marketing" => false, "created_at" => "2023-04-04T17:24:39-04:00", "updated_at" => "2023-04-04T17:24:39-04:00", "first_name" => "Bob", "last_name" => "Norman", "orders_count" => 0, "state" => "disabled", "total_spent" => "0.00", "last_order_id" => null, "note" => null, "verified_email" => true, "multipass_identifier" => null, "tax_exempt" => false, "tags" => "", "last_order_name" => null, "currency" => "USD", "phone" => null, "accepts_marketing_updated_at" => "2023-04-04T17:24:39-04:00", "marketing_opt_in_level" => null, "tax_exemptions" => [], "email_marketing_consent" => null, "sms_marketing_consent" => null, "admin_graphql_api_id" => "gid://shopify/Customer/1073339461", "default_address" => ["id" => 1053317294, "customer_id" => 1073339461, "first_name" => "Bob", "last_name" => "Norman", "company" => null, "address1" => "123 Main St", "address2" => null, "city" => "Anytown", "province" => null, "country" => "Canada", "zip" => "A1B2C3", "phone" => "555-555-5555", "name" => "Bob Norman", "province_code" => null, "country_code" => "CA", "country_name" => "Canada", "default" => true]]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/draft_orders.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["draft_order" => ["line_items" => [["variant_id" => 447654529, "quantity" => 1]], "billing_address" => ["first_name" => "Bob", "last_name" => "Norman", "address1" => "123 Main St", "city" => "Anytown", "province" => "ON", "country" => "Canada", "zip" => "A1B2C3", "phone" => "555-555-5555"]]]),
            ),
        ]);

        $draft_order = new DraftOrder($this->test_session);
        $draft_order->line_items = [
            [
                "variant_id" => 447654529,
                "quantity" => 1
            ]
        ];
        $draft_order->billing_address = [
            "first_name" => "Bob",
            "last_name" => "Norman",
            "address1" => "123 Main St",
            "city" => "Anytown",
            "province" => "ON",
            "country" => "Canada",
            "zip" => "A1B2C3",
            "phone" => "555-555-5555"
        ];
        $draft_order->save();
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
                  ["draft_order" => ["id" => 1069920478, "note" => null, "email" => null, "taxes_included" => false, "currency" => "USD", "invoice_sent_at" => null, "created_at" => "2023-04-04T17:24:53-04:00", "updated_at" => "2023-04-04T17:24:53-04:00", "tax_exempt" => false, "completed_at" => null, "name" => "#D5", "status" => "open", "line_items" => [["id" => 1066630383, "variant_id" => 447654529, "product_id" => 921728736, "title" => "IPod Touch 8GB", "variant_title" => "Black", "sku" => "IPOD2009BLACK", "vendor" => "Apple", "quantity" => 1, "requires_shipping" => true, "taxable" => true, "gift_card" => false, "fulfillment_service" => "shipwire-app", "grams" => 567, "tax_lines" => [["rate" => 0.05, "title" => "GST", "price" => "9.95"], ["rate" => 0.08, "title" => "Tax", "price" => "15.92"]], "applied_discount" => null, "name" => "IPod Touch 8GB - Black", "properties" => [], "custom" => false, "price" => "199.00", "admin_graphql_api_id" => "gid://shopify/DraftOrderLineItem/1066630383"]], "shipping_address" => ["first_name" => "Bob", "address1" => "123 Main St", "phone" => "555-555-5555", "city" => "Anytown", "zip" => "A1B2C3", "province" => "Ontario", "country" => "Canada", "last_name" => "Norman", "address2" => null, "company" => null, "latitude" => null, "longitude" => null, "name" => "Bob Norman", "country_code" => "CA", "province_code" => "ON"], "billing_address" => null, "invoice_url" => "https://jsmith.myshopify.com/548380009/invoices/3d8f5b28a85c40d7ed7c193202bc4954", "applied_discount" => null, "order_id" => null, "shipping_line" => null, "tax_lines" => [["rate" => 0.05, "title" => "GST", "price" => "9.95"], ["rate" => 0.08, "title" => "Tax", "price" => "15.92"]], "tags" => "", "note_attributes" => [], "total_price" => "224.87", "subtotal_price" => "199.00", "total_tax" => "25.87", "presentment_currency" => "USD", "total_line_items_price_set" => ["shop_money" => ["amount" => "199.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "199.00", "currency_code" => "USD"]], "total_price_set" => ["shop_money" => ["amount" => "224.87", "currency_code" => "USD"], "presentment_money" => ["amount" => "224.87", "currency_code" => "USD"]], "subtotal_price_set" => ["shop_money" => ["amount" => "199.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "199.00", "currency_code" => "USD"]], "total_tax_set" => ["shop_money" => ["amount" => "25.87", "currency_code" => "USD"], "presentment_money" => ["amount" => "25.87", "currency_code" => "USD"]], "total_discounts_set" => ["shop_money" => ["amount" => "0.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "0.00", "currency_code" => "USD"]], "total_shipping_price_set" => ["shop_money" => ["amount" => "0.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "0.00", "currency_code" => "USD"]], "total_additional_fees_set" => null, "total_duties_set" => null, "payment_terms" => null, "admin_graphql_api_id" => "gid://shopify/DraftOrder/1069920478", "customer" => ["id" => 1073339462, "email" => null, "accepts_marketing" => false, "created_at" => "2023-04-04T17:24:52-04:00", "updated_at" => "2023-04-04T17:24:52-04:00", "first_name" => "Bob", "last_name" => "Norman", "orders_count" => 0, "state" => "disabled", "total_spent" => "0.00", "last_order_id" => null, "note" => null, "verified_email" => true, "multipass_identifier" => null, "tax_exempt" => false, "tags" => "", "last_order_name" => null, "currency" => "USD", "phone" => null, "accepts_marketing_updated_at" => "2023-04-04T17:24:52-04:00", "marketing_opt_in_level" => null, "tax_exemptions" => [], "email_marketing_consent" => null, "sms_marketing_consent" => null, "admin_graphql_api_id" => "gid://shopify/Customer/1073339462", "default_address" => ["id" => 1053317296, "customer_id" => 1073339462, "first_name" => "Bob", "last_name" => "Norman", "company" => null, "address1" => "123 Main St", "address2" => null, "city" => "Anytown", "province" => null, "country" => "Canada", "zip" => "A1B2C3", "phone" => "555-555-5555", "name" => "Bob Norman", "province_code" => null, "country_code" => "CA", "country_name" => "Canada", "default" => true]]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/draft_orders.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["draft_order" => ["line_items" => [["variant_id" => 447654529, "quantity" => 1]], "shipping_address" => ["first_name" => "Bob", "last_name" => "Norman", "address1" => "123 Main St", "city" => "Anytown", "province" => "ON", "country" => "Canada", "zip" => "A1B2C3", "phone" => "555-555-5555"]]]),
            ),
        ]);

        $draft_order = new DraftOrder($this->test_session);
        $draft_order->line_items = [
            [
                "variant_id" => 447654529,
                "quantity" => 1
            ]
        ];
        $draft_order->shipping_address = [
            "first_name" => "Bob",
            "last_name" => "Norman",
            "address1" => "123 Main St",
            "city" => "Anytown",
            "province" => "ON",
            "country" => "Canada",
            "zip" => "A1B2C3",
            "phone" => "555-555-5555"
        ];
        $draft_order->save();
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
                  ["draft_order" => ["id" => 1069920480, "note" => null, "email" => null, "taxes_included" => false, "currency" => "USD", "invoice_sent_at" => null, "created_at" => "2023-04-04T17:24:56-04:00", "updated_at" => "2023-04-04T17:24:56-04:00", "tax_exempt" => false, "completed_at" => null, "name" => "#D5", "status" => "open", "line_items" => [["id" => 1066630385, "variant_id" => null, "product_id" => null, "title" => "Custom Tee", "variant_title" => null, "sku" => null, "vendor" => null, "quantity" => 1, "requires_shipping" => false, "taxable" => true, "gift_card" => false, "fulfillment_service" => "manual", "grams" => 0, "tax_lines" => [["rate" => 0.05, "title" => "GST", "price" => "0.50"], ["rate" => 0.08, "title" => "Tax", "price" => "0.80"]], "applied_discount" => ["description" => "Custom discount", "value" => "10.0", "title" => "Custom", "amount" => "10.00", "value_type" => "fixed_amount"], "name" => "Custom Tee", "properties" => [], "custom" => true, "price" => "20.00", "admin_graphql_api_id" => "gid://shopify/DraftOrderLineItem/1066630385"]], "shipping_address" => null, "billing_address" => null, "invoice_url" => "https://jsmith.myshopify.com/548380009/invoices/3e40d5d74aa49ec786d3ca5b6d0b783d", "applied_discount" => null, "order_id" => null, "shipping_line" => null, "tax_lines" => [["rate" => 0.05, "title" => "GST", "price" => "0.50"], ["rate" => 0.08, "title" => "Tax", "price" => "0.80"]], "tags" => "", "note_attributes" => [], "total_price" => "11.30", "subtotal_price" => "10.00", "total_tax" => "1.30", "presentment_currency" => "USD", "total_line_items_price_set" => ["shop_money" => ["amount" => "20.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "20.00", "currency_code" => "USD"]], "total_price_set" => ["shop_money" => ["amount" => "11.30", "currency_code" => "USD"], "presentment_money" => ["amount" => "11.30", "currency_code" => "USD"]], "subtotal_price_set" => ["shop_money" => ["amount" => "10.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "10.00", "currency_code" => "USD"]], "total_tax_set" => ["shop_money" => ["amount" => "1.30", "currency_code" => "USD"], "presentment_money" => ["amount" => "1.30", "currency_code" => "USD"]], "total_discounts_set" => ["shop_money" => ["amount" => "10.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "10.00", "currency_code" => "USD"]], "total_shipping_price_set" => ["shop_money" => ["amount" => "0.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "0.00", "currency_code" => "USD"]], "total_additional_fees_set" => null, "total_duties_set" => null, "payment_terms" => null, "admin_graphql_api_id" => "gid://shopify/DraftOrder/1069920480"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/draft_orders.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["draft_order" => ["line_items" => [["title" => "Custom Tee", "price" => "20.00", "quantity" => 1, "applied_discount" => ["description" => "Custom discount", "value_type" => "fixed_amount", "value" => "10.0", "amount" => "10.0", "title" => "Custom"]]]]]),
            ),
        ]);

        $draft_order = new DraftOrder($this->test_session);
        $draft_order->line_items = [
            [
                "title" => "Custom Tee",
                "price" => "20.00",
                "quantity" => 1,
                "applied_discount" => [
                    "description" => "Custom discount",
                    "value_type" => "fixed_amount",
                    "value" => "10.0",
                    "amount" => "10.0",
                    "title" => "Custom"
                ]
            ]
        ];
        $draft_order->save();
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
                  ["draft_order" => ["id" => 1069920476, "note" => null, "email" => null, "taxes_included" => false, "currency" => "USD", "invoice_sent_at" => null, "created_at" => "2023-04-04T17:24:43-04:00", "updated_at" => "2023-04-04T17:24:43-04:00", "tax_exempt" => false, "completed_at" => null, "name" => "#D5", "status" => "open", "line_items" => [["id" => 1066630381, "variant_id" => 447654529, "product_id" => 921728736, "title" => "IPod Touch 8GB", "variant_title" => "Black", "sku" => "IPOD2009BLACK", "vendor" => "Apple", "quantity" => 1, "requires_shipping" => true, "taxable" => true, "gift_card" => false, "fulfillment_service" => "shipwire-app", "grams" => 567, "tax_lines" => [["rate" => 0.05, "title" => "GST", "price" => "9.95"], ["rate" => 0.08, "title" => "Tax", "price" => "15.92"]], "applied_discount" => null, "name" => "IPod Touch 8GB - Black", "properties" => [], "custom" => false, "price" => "199.00", "admin_graphql_api_id" => "gid://shopify/DraftOrderLineItem/1066630381"]], "shipping_address" => null, "billing_address" => null, "invoice_url" => "https://jsmith.myshopify.com/548380009/invoices/c3c88aead19e6be2fb21e0e3e57c807f", "applied_discount" => null, "order_id" => null, "shipping_line" => null, "tax_lines" => [["rate" => 0.05, "title" => "GST", "price" => "9.95"], ["rate" => 0.08, "title" => "Tax", "price" => "15.92"]], "tags" => "", "note_attributes" => [], "total_price" => "224.87", "subtotal_price" => "199.00", "total_tax" => "25.87", "presentment_currency" => "USD", "total_line_items_price_set" => ["shop_money" => ["amount" => "199.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "199.00", "currency_code" => "USD"]], "total_price_set" => ["shop_money" => ["amount" => "224.87", "currency_code" => "USD"], "presentment_money" => ["amount" => "224.87", "currency_code" => "USD"]], "subtotal_price_set" => ["shop_money" => ["amount" => "199.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "199.00", "currency_code" => "USD"]], "total_tax_set" => ["shop_money" => ["amount" => "25.87", "currency_code" => "USD"], "presentment_money" => ["amount" => "25.87", "currency_code" => "USD"]], "total_discounts_set" => ["shop_money" => ["amount" => "0.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "0.00", "currency_code" => "USD"]], "total_shipping_price_set" => ["shop_money" => ["amount" => "0.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "0.00", "currency_code" => "USD"]], "total_additional_fees_set" => null, "total_duties_set" => null, "payment_terms" => null, "admin_graphql_api_id" => "gid://shopify/DraftOrder/1069920476"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/draft_orders.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["draft_order" => ["line_items" => [["variant_id" => 447654529, "quantity" => 1]]]]),
            ),
        ]);

        $draft_order = new DraftOrder($this->test_session);
        $draft_order->line_items = [
            [
                "variant_id" => 447654529,
                "quantity" => 1
            ]
        ];
        $draft_order->save();
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
                  ["draft_orders" => [["id" => 72885271, "note" => "rush order", "email" => "bob.norman@mail.example.com", "taxes_included" => true, "currency" => "USD", "invoice_sent_at" => null, "created_at" => "2023-04-04T17:13:27-04:00", "updated_at" => "2023-04-04T17:13:27-04:00", "tax_exempt" => false, "completed_at" => null, "name" => "#D4", "status" => "completed", "line_items" => [["id" => 498266019, "variant_id" => 39072856, "product_id" => 632910392, "title" => "IPod Nano - 8gb", "variant_title" => "green", "sku" => "IPOD2008GREEN", "vendor" => null, "quantity" => 2, "requires_shipping" => true, "taxable" => true, "gift_card" => false, "fulfillment_service" => "manual", "grams" => 567, "tax_lines" => [], "applied_discount" => null, "name" => "IPod Nano - 8gb - green", "properties" => [], "custom" => false, "price" => "199.00", "admin_graphql_api_id" => "gid://shopify/DraftOrderLineItem/498266019"]], "shipping_address" => ["first_name" => "Bob", "address1" => "Chestnut Street 92", "phone" => "+1(502)-459-2181", "city" => "Louisville", "zip" => "40202", "province" => "Kentucky", "country" => "United States", "last_name" => "Norman", "address2" => "", "company" => null, "latitude" => 45.41634, "longitude" => -75.6868, "name" => "Bob Norman", "country_code" => "US", "province_code" => "KY"], "billing_address" => ["first_name" => "Bob", "address1" => "Chestnut Street 92", "phone" => "+1(502)-459-2181", "city" => "Louisville", "zip" => "40202", "province" => "Kentucky", "country" => "United States", "last_name" => "Norman", "address2" => "", "company" => null, "latitude" => 45.41634, "longitude" => -75.6868, "name" => "Bob Norman", "country_code" => "US", "province_code" => "KY"], "invoice_url" => "https://jsmith.myshopify.com/548380009/invoices/f945c7e2b158dbb69fa642cb8d79171f", "applied_discount" => null, "order_id" => 450789469, "shipping_line" => null, "tax_lines" => [], "tags" => "", "note_attributes" => [], "total_price" => "409.94", "subtotal_price" => "398.00", "total_tax" => "11.94", "admin_graphql_api_id" => "gid://shopify/DraftOrder/72885271", "customer" => ["id" => 207119551, "email" => "bob.norman@mail.example.com", "accepts_marketing" => false, "created_at" => "2023-04-04T17:13:27-04:00", "updated_at" => "2023-04-04T17:13:27-04:00", "first_name" => "Bob", "last_name" => "Norman", "orders_count" => 1, "state" => "disabled", "total_spent" => "199.65", "last_order_id" => 450789469, "note" => null, "verified_email" => true, "multipass_identifier" => null, "tax_exempt" => false, "tags" => "L\u00E9on, No\u00EBl", "last_order_name" => "#1001", "currency" => "USD", "phone" => "+16136120707", "accepts_marketing_updated_at" => "2005-06-12T11:57:11-04:00", "marketing_opt_in_level" => null, "tax_exemptions" => [], "admin_graphql_api_id" => "gid://shopify/Customer/207119551", "default_address" => ["id" => 207119551, "customer_id" => 207119551, "first_name" => null, "last_name" => null, "company" => null, "address1" => "Chestnut Street 92", "address2" => "", "city" => "Louisville", "province" => "Kentucky", "country" => "United States", "zip" => "40202", "phone" => "555-625-1199", "name" => "", "province_code" => "KY", "country_code" => "US", "country_name" => "United States", "default" => true]]], ["id" => 622762746, "note" => "rush order", "email" => "bob.norman@mail.example.com", "taxes_included" => false, "currency" => "USD", "invoice_sent_at" => null, "created_at" => "2023-04-04T17:13:27-04:00", "updated_at" => "2023-04-04T17:13:27-04:00", "tax_exempt" => false, "completed_at" => null, "name" => "#D1", "status" => "open", "line_items" => [["id" => 466157049, "variant_id" => 39072856, "product_id" => 632910392, "title" => "IPod Nano - 8gb", "variant_title" => "green", "sku" => "IPOD2008GREEN", "vendor" => null, "quantity" => 1, "requires_shipping" => true, "taxable" => true, "gift_card" => false, "fulfillment_service" => "manual", "grams" => 567, "tax_lines" => [], "applied_discount" => null, "name" => "IPod Nano - 8gb - green", "properties" => [], "custom" => false, "price" => "199.00", "admin_graphql_api_id" => "gid://shopify/DraftOrderLineItem/466157049"], ["id" => 605833968, "variant_id" => null, "product_id" => null, "title" => "IPod Nano Engraving", "variant_title" => null, "sku" => "IPODENGRAVING", "vendor" => null, "quantity" => 1, "requires_shipping" => false, "taxable" => true, "gift_card" => false, "fulfillment_service" => "manual", "grams" => 0, "tax_lines" => [], "applied_discount" => null, "name" => "IPod Nano Engraving", "properties" => [], "custom" => true, "price" => "30.00", "admin_graphql_api_id" => "gid://shopify/DraftOrderLineItem/605833968"], ["id" => 783764327, "variant_id" => 457924702, "product_id" => 632910392, "title" => "IPod Nano - 8gb", "variant_title" => "black", "sku" => "IPOD2008BLACK", "vendor" => null, "quantity" => 3, "requires_shipping" => true, "taxable" => true, "gift_card" => false, "fulfillment_service" => "manual", "grams" => 567, "tax_lines" => [], "applied_discount" => null, "name" => "IPod Nano - 8gb - black", "properties" => [], "custom" => false, "price" => "199.00", "admin_graphql_api_id" => "gid://shopify/DraftOrderLineItem/783764327"]], "shipping_address" => ["first_name" => "Bob", "address1" => "Chestnut Street 92", "phone" => "+1(502)-459-2181", "city" => "Louisville", "zip" => "40202", "province" => "Kentucky", "country" => "United States", "last_name" => "Norman", "address2" => "", "company" => null, "latitude" => 45.41634, "longitude" => -75.6868, "name" => "Bob Norman", "country_code" => "US", "province_code" => "KY"], "billing_address" => ["first_name" => "Bob", "address1" => "Chestnut Street 92", "phone" => "+1(502)-459-2181", "city" => "Louisville", "zip" => "40202", "province" => "Kentucky", "country" => "United States", "last_name" => "Norman", "address2" => "", "company" => null, "latitude" => 45.41634, "longitude" => -75.6868, "name" => "Bob Norman", "country_code" => "US", "province_code" => "KY"], "invoice_url" => "https://jsmith.myshopify.com/548380009/invoices/f1df1a91d10a6d7704cf2f0315461api", "applied_discount" => null, "order_id" => null, "shipping_line" => ["title" => "custom shipping", "custom" => true, "handle" => null, "price" => "10.00"], "tax_lines" => [], "tags" => "", "note_attributes" => [], "total_price" => "836.00", "subtotal_price" => "826.00", "total_tax" => "0.00", "admin_graphql_api_id" => "gid://shopify/DraftOrder/622762746", "customer" => ["id" => 207119551, "email" => "bob.norman@mail.example.com", "accepts_marketing" => false, "created_at" => "2023-04-04T17:13:27-04:00", "updated_at" => "2023-04-04T17:13:27-04:00", "first_name" => "Bob", "last_name" => "Norman", "orders_count" => 1, "state" => "disabled", "total_spent" => "199.65", "last_order_id" => 450789469, "note" => null, "verified_email" => true, "multipass_identifier" => null, "tax_exempt" => false, "tags" => "L\u00E9on, No\u00EBl", "last_order_name" => "#1001", "currency" => "USD", "phone" => "+16136120707", "accepts_marketing_updated_at" => "2005-06-12T11:57:11-04:00", "marketing_opt_in_level" => null, "tax_exemptions" => [], "admin_graphql_api_id" => "gid://shopify/Customer/207119551", "default_address" => ["id" => 207119551, "customer_id" => 207119551, "first_name" => null, "last_name" => null, "company" => null, "address1" => "Chestnut Street 92", "address2" => "", "city" => "Louisville", "province" => "Kentucky", "country" => "United States", "zip" => "40202", "phone" => "555-625-1199", "name" => "", "province_code" => "KY", "country_code" => "US", "country_name" => "United States", "default" => true]]], ["id" => 691042898, "note" => "rush order", "email" => "bob.norman@mail.example.com", "taxes_included" => true, "currency" => "USD", "invoice_sent_at" => "2016-12-31T19:00:00-05:00", "created_at" => "2023-04-04T17:13:27-04:00", "updated_at" => "2023-04-04T17:13:27-04:00", "tax_exempt" => false, "completed_at" => "2016-12-31T19:00:00-05:00", "name" => "#D4", "status" => "completed", "line_items" => [["id" => 158115779, "variant_id" => 39072856, "product_id" => 632910392, "title" => "IPod Nano - 8gb", "variant_title" => "green", "sku" => "IPOD2008GREEN", "vendor" => null, "quantity" => 1, "requires_shipping" => true, "taxable" => true, "gift_card" => false, "fulfillment_service" => "manual", "grams" => 567, "tax_lines" => [], "applied_discount" => null, "name" => "IPod Nano - 8gb - green", "properties" => [], "custom" => false, "price" => "199.00", "admin_graphql_api_id" => "gid://shopify/DraftOrderLineItem/158115779"]], "shipping_address" => ["first_name" => "Bob", "address1" => "Chestnut Street 92", "phone" => "+1(502)-459-2181", "city" => "Louisville", "zip" => "40202", "province" => "Kentucky", "country" => "United States", "last_name" => "Norman", "address2" => "", "company" => null, "latitude" => 45.41634, "longitude" => -75.6868, "name" => "Bob Norman", "country_code" => "US", "province_code" => "KY"], "billing_address" => ["first_name" => "Bob", "address1" => "Chestnut Street 92", "phone" => "+1(502)-459-2181", "city" => "Louisville", "zip" => "40202", "province" => "Kentucky", "country" => "United States", "last_name" => "Norman", "address2" => "", "company" => null, "latitude" => 45.41634, "longitude" => -75.6868, "name" => "Bob Norman", "country_code" => "US", "province_code" => "KY"], "invoice_url" => "https://jsmith.myshopify.com/548380009/invoices/56dd92fb7adc1a2c38402b1aab15b2f4", "applied_discount" => null, "order_id" => 450789469, "shipping_line" => ["title" => "UPS Ground", "custom" => false, "handle" => "ups-3-12.25", "price" => "12.25"], "tax_lines" => [], "tags" => "", "note_attributes" => [], "total_price" => "409.94", "subtotal_price" => "398.00", "total_tax" => "11.94", "admin_graphql_api_id" => "gid://shopify/DraftOrder/691042898", "customer" => ["id" => 207119551, "email" => "bob.norman@mail.example.com", "accepts_marketing" => false, "created_at" => "2023-04-04T17:13:27-04:00", "updated_at" => "2023-04-04T17:13:27-04:00", "first_name" => "Bob", "last_name" => "Norman", "orders_count" => 1, "state" => "disabled", "total_spent" => "199.65", "last_order_id" => 450789469, "note" => null, "verified_email" => true, "multipass_identifier" => null, "tax_exempt" => false, "tags" => "L\u00E9on, No\u00EBl", "last_order_name" => "#1001", "currency" => "USD", "phone" => "+16136120707", "accepts_marketing_updated_at" => "2005-06-12T11:57:11-04:00", "marketing_opt_in_level" => null, "tax_exemptions" => [], "admin_graphql_api_id" => "gid://shopify/Customer/207119551", "default_address" => ["id" => 207119551, "customer_id" => 207119551, "first_name" => null, "last_name" => null, "company" => null, "address1" => "Chestnut Street 92", "address2" => "", "city" => "Louisville", "province" => "Kentucky", "country" => "United States", "zip" => "40202", "phone" => "555-625-1199", "name" => "", "province_code" => "KY", "country_code" => "US", "country_name" => "United States", "default" => true]]], ["id" => 994118539, "note" => "rush order", "email" => "bob.norman@mail.example.com", "taxes_included" => false, "currency" => "USD", "invoice_sent_at" => null, "created_at" => "2023-04-04T17:13:27-04:00", "updated_at" => "2023-04-04T17:13:27-04:00", "tax_exempt" => false, "completed_at" => null, "name" => "#D2", "status" => "open", "line_items" => [["id" => 994118539, "variant_id" => 39072856, "product_id" => 632910392, "title" => "IPod Nano - 8gb", "variant_title" => "green", "sku" => "IPOD2008GREEN", "vendor" => null, "quantity" => 1, "requires_shipping" => false, "taxable" => true, "gift_card" => false, "fulfillment_service" => "manual", "grams" => 567, "tax_lines" => [], "applied_discount" => null, "name" => "IPod Nano - 8gb - green", "properties" => [], "custom" => false, "price" => "199.00", "admin_graphql_api_id" => "gid://shopify/DraftOrderLineItem/994118539"]], "shipping_address" => ["first_name" => "Bob", "address1" => "Chestnut Street 92", "phone" => "+1(502)-459-2181", "city" => "Louisville", "zip" => "40202", "province" => "Kentucky", "country" => "United States", "last_name" => "Norman", "address2" => "", "company" => null, "latitude" => 45.41634, "longitude" => -75.6868, "name" => "Bob Norman", "country_code" => "US", "province_code" => "KY"], "billing_address" => ["first_name" => "Bob", "address1" => "Chestnut Street 92", "phone" => "+1(502)-459-2181", "city" => "Louisville", "zip" => "40202", "province" => "Kentucky", "country" => "United States", "last_name" => "Norman", "address2" => "", "company" => null, "latitude" => 45.41634, "longitude" => -75.6868, "name" => "Bob Norman", "country_code" => "US", "province_code" => "KY"], "invoice_url" => "https://jsmith.myshopify.com/548380009/invoices/ba8dcf6c022ccad3d47e3909e378e33f", "applied_discount" => ["description" => "\$5promo", "value" => "5.0", "title" => null, "amount" => "5.00", "value_type" => "fixed_amount"], "order_id" => null, "shipping_line" => ["title" => "UPS Ground", "custom" => false, "handle" => "ups-3-12.25", "price" => "12.25"], "tax_lines" => [], "tags" => "Wholesale", "note_attributes" => [], "total_price" => "206.25", "subtotal_price" => "194.00", "total_tax" => "0.00", "admin_graphql_api_id" => "gid://shopify/DraftOrder/994118539", "customer" => ["id" => 207119551, "email" => "bob.norman@mail.example.com", "accepts_marketing" => false, "created_at" => "2023-04-04T17:13:27-04:00", "updated_at" => "2023-04-04T17:13:27-04:00", "first_name" => "Bob", "last_name" => "Norman", "orders_count" => 1, "state" => "disabled", "total_spent" => "199.65", "last_order_id" => 450789469, "note" => null, "verified_email" => true, "multipass_identifier" => null, "tax_exempt" => false, "tags" => "L\u00E9on, No\u00EBl", "last_order_name" => "#1001", "currency" => "USD", "phone" => "+16136120707", "accepts_marketing_updated_at" => "2005-06-12T11:57:11-04:00", "marketing_opt_in_level" => null, "tax_exemptions" => [], "admin_graphql_api_id" => "gid://shopify/Customer/207119551", "default_address" => ["id" => 207119551, "customer_id" => 207119551, "first_name" => null, "last_name" => null, "company" => null, "address1" => "Chestnut Street 92", "address2" => "", "city" => "Louisville", "province" => "Kentucky", "country" => "United States", "zip" => "40202", "phone" => "555-625-1199", "name" => "", "province_code" => "KY", "country_code" => "US", "country_name" => "United States", "default" => true]]], ["id" => 1012750869, "note" => "rush order", "email" => "bob.norman@mail.example.com", "taxes_included" => false, "currency" => "USD", "invoice_sent_at" => null, "created_at" => "2023-04-04T17:13:27-04:00", "updated_at" => "2023-04-04T17:13:27-04:00", "tax_exempt" => false, "completed_at" => null, "name" => "#D2", "status" => "open", "line_items" => [["id" => 294997122, "variant_id" => 39072856, "product_id" => 632910392, "title" => "IPod Nano - 8gb", "variant_title" => "green", "sku" => "IPOD2008GREEN", "vendor" => null, "quantity" => 1, "requires_shipping" => true, "taxable" => true, "gift_card" => false, "fulfillment_service" => "manual", "grams" => 567, "tax_lines" => [], "applied_discount" => null, "name" => "IPod Nano - 8gb - green", "properties" => [], "custom" => false, "price" => "199.00", "admin_graphql_api_id" => "gid://shopify/DraftOrderLineItem/294997122"]], "shipping_address" => null, "billing_address" => null, "invoice_url" => "https://jsmith.myshopify.com/548380009/invoices/f1df1a91d10a6d7704cf2f0315461noaddressapi", "applied_discount" => null, "order_id" => null, "shipping_line" => null, "tax_lines" => [], "tags" => "", "note_attributes" => [], "total_price" => "836.00", "subtotal_price" => "826.00", "total_tax" => "0.00", "admin_graphql_api_id" => "gid://shopify/DraftOrder/1012750869"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/draft_orders.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        DraftOrder::all(
            $this->test_session,
            [],
            [],
        );
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
                  ["draft_order" => ["id" => 994118539, "note" => "rush order", "email" => "bob.norman@mail.example.com", "taxes_included" => false, "currency" => "USD", "invoice_sent_at" => null, "created_at" => "2023-04-04T17:13:27-04:00", "updated_at" => "2023-04-04T17:25:12-04:00", "tax_exempt" => false, "completed_at" => null, "name" => "#D2", "status" => "open", "line_items" => [["id" => 994118539, "variant_id" => 39072856, "product_id" => 632910392, "title" => "IPod Nano - 8gb", "variant_title" => "green", "sku" => "IPOD2008GREEN", "vendor" => null, "quantity" => 1, "requires_shipping" => false, "taxable" => true, "gift_card" => false, "fulfillment_service" => "manual", "grams" => 567, "tax_lines" => [], "applied_discount" => null, "name" => "IPod Nano - 8gb - green", "properties" => [], "custom" => false, "price" => "199.00", "admin_graphql_api_id" => "gid://shopify/DraftOrderLineItem/994118539"]], "shipping_address" => ["first_name" => "Bob", "address1" => "Chestnut Street 92", "phone" => "+1(502)-459-2181", "city" => "Louisville", "zip" => "40202", "province" => "Kentucky", "country" => "United States", "last_name" => "Norman", "address2" => "", "company" => null, "latitude" => 45.41634, "longitude" => -75.6868, "name" => "Bob Norman", "country_code" => "US", "province_code" => "KY"], "billing_address" => ["first_name" => "Bob", "address1" => "Chestnut Street 92", "phone" => "+1(502)-459-2181", "city" => "Louisville", "zip" => "40202", "province" => "Kentucky", "country" => "United States", "last_name" => "Norman", "address2" => "", "company" => null, "latitude" => 45.41634, "longitude" => -75.6868, "name" => "Bob Norman", "country_code" => "US", "province_code" => "KY"], "invoice_url" => "https://jsmith.myshopify.com/548380009/invoices/ba8dcf6c022ccad3d47e3909e378e33f", "applied_discount" => ["description" => "Custom discount", "value" => "10.0", "title" => "Custom", "amount" => "19.90", "value_type" => "percentage"], "order_id" => null, "shipping_line" => null, "tax_lines" => [], "tags" => "Wholesale", "note_attributes" => [], "total_price" => "179.10", "subtotal_price" => "179.10", "total_tax" => "0.00", "presentment_currency" => "USD", "total_line_items_price_set" => ["shop_money" => ["amount" => "199.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "199.00", "currency_code" => "USD"]], "total_price_set" => ["shop_money" => ["amount" => "179.10", "currency_code" => "USD"], "presentment_money" => ["amount" => "179.10", "currency_code" => "USD"]], "subtotal_price_set" => ["shop_money" => ["amount" => "179.10", "currency_code" => "USD"], "presentment_money" => ["amount" => "179.10", "currency_code" => "USD"]], "total_tax_set" => ["shop_money" => ["amount" => "0.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "0.00", "currency_code" => "USD"]], "total_discounts_set" => ["shop_money" => ["amount" => "19.90", "currency_code" => "USD"], "presentment_money" => ["amount" => "19.90", "currency_code" => "USD"]], "total_shipping_price_set" => ["shop_money" => ["amount" => "0.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "0.00", "currency_code" => "USD"]], "total_additional_fees_set" => null, "total_duties_set" => null, "payment_terms" => null, "admin_graphql_api_id" => "gid://shopify/DraftOrder/994118539", "customer" => ["id" => 207119551, "email" => "bob.norman@mail.example.com", "accepts_marketing" => false, "created_at" => "2023-04-04T17:13:27-04:00", "updated_at" => "2023-04-04T17:13:27-04:00", "first_name" => "Bob", "last_name" => "Norman", "orders_count" => 1, "state" => "disabled", "total_spent" => "199.65", "last_order_id" => 450789469, "note" => null, "verified_email" => true, "multipass_identifier" => null, "tax_exempt" => false, "tags" => "L\u00E9on, No\u00EBl", "last_order_name" => "#1001", "currency" => "USD", "phone" => "+16136120707", "accepts_marketing_updated_at" => "2005-06-12T11:57:11-04:00", "marketing_opt_in_level" => null, "tax_exemptions" => [], "email_marketing_consent" => ["state" => "not_subscribed", "opt_in_level" => null, "consent_updated_at" => "2004-06-13T11:57:11-04:00"], "sms_marketing_consent" => ["state" => "not_subscribed", "opt_in_level" => "single_opt_in", "consent_updated_at" => "2023-04-04T17:13:27-04:00", "consent_collected_from" => "OTHER"], "admin_graphql_api_id" => "gid://shopify/Customer/207119551", "default_address" => ["id" => 207119551, "customer_id" => 207119551, "first_name" => null, "last_name" => null, "company" => null, "address1" => "Chestnut Street 92", "address2" => "", "city" => "Louisville", "province" => "Kentucky", "country" => "United States", "zip" => "40202", "phone" => "555-625-1199", "name" => "", "province_code" => "KY", "country_code" => "US", "country_name" => "United States", "default" => true]]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/draft_orders/994118539.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["draft_order" => ["applied_discount" => ["description" => "Custom discount", "value_type" => "percentage", "value" => "10.0", "amount" => "19.90", "title" => "Custom"]]]),
            ),
        ]);

        $draft_order = new DraftOrder($this->test_session);
        $draft_order->id = 994118539;
        $draft_order->applied_discount = [
            "description" => "Custom discount",
            "value_type" => "percentage",
            "value" => "10.0",
            "amount" => "19.90",
            "title" => "Custom"
        ];
        $draft_order->save();
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
                  ["draft_order" => ["id" => 994118539, "note" => "Customer contacted us about a custom engraving on this iPod", "email" => "bob.norman@mail.example.com", "taxes_included" => false, "currency" => "USD", "invoice_sent_at" => null, "created_at" => "2023-04-04T17:13:27-04:00", "updated_at" => "2023-04-04T17:25:22-04:00", "tax_exempt" => false, "completed_at" => null, "name" => "#D2", "status" => "open", "line_items" => [["id" => 994118539, "variant_id" => 39072856, "product_id" => 632910392, "title" => "IPod Nano - 8gb", "variant_title" => "green", "sku" => "IPOD2008GREEN", "vendor" => null, "quantity" => 1, "requires_shipping" => false, "taxable" => true, "gift_card" => false, "fulfillment_service" => "manual", "grams" => 567, "tax_lines" => [], "applied_discount" => null, "name" => "IPod Nano - 8gb - green", "properties" => [], "custom" => false, "price" => "199.00", "admin_graphql_api_id" => "gid://shopify/DraftOrderLineItem/994118539"]], "shipping_address" => ["first_name" => "Bob", "address1" => "Chestnut Street 92", "phone" => "+1(502)-459-2181", "city" => "Louisville", "zip" => "40202", "province" => "Kentucky", "country" => "United States", "last_name" => "Norman", "address2" => "", "company" => null, "latitude" => 45.41634, "longitude" => -75.6868, "name" => "Bob Norman", "country_code" => "US", "province_code" => "KY"], "billing_address" => ["first_name" => "Bob", "address1" => "Chestnut Street 92", "phone" => "+1(502)-459-2181", "city" => "Louisville", "zip" => "40202", "province" => "Kentucky", "country" => "United States", "last_name" => "Norman", "address2" => "", "company" => null, "latitude" => 45.41634, "longitude" => -75.6868, "name" => "Bob Norman", "country_code" => "US", "province_code" => "KY"], "invoice_url" => "https://jsmith.myshopify.com/548380009/invoices/ba8dcf6c022ccad3d47e3909e378e33f", "applied_discount" => ["description" => "\$5promo", "value" => "5.0", "title" => null, "amount" => "5.00", "value_type" => "fixed_amount"], "order_id" => null, "shipping_line" => null, "tax_lines" => [], "tags" => "Wholesale", "note_attributes" => [], "total_price" => "194.00", "subtotal_price" => "194.00", "total_tax" => "0.00", "presentment_currency" => "USD", "total_line_items_price_set" => ["shop_money" => ["amount" => "199.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "199.00", "currency_code" => "USD"]], "total_price_set" => ["shop_money" => ["amount" => "194.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "194.00", "currency_code" => "USD"]], "subtotal_price_set" => ["shop_money" => ["amount" => "194.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "194.00", "currency_code" => "USD"]], "total_tax_set" => ["shop_money" => ["amount" => "0.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "0.00", "currency_code" => "USD"]], "total_discounts_set" => ["shop_money" => ["amount" => "5.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "5.00", "currency_code" => "USD"]], "total_shipping_price_set" => ["shop_money" => ["amount" => "0.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "0.00", "currency_code" => "USD"]], "total_additional_fees_set" => null, "total_duties_set" => null, "payment_terms" => null, "admin_graphql_api_id" => "gid://shopify/DraftOrder/994118539", "customer" => ["id" => 207119551, "email" => "bob.norman@mail.example.com", "accepts_marketing" => false, "created_at" => "2023-04-04T17:13:27-04:00", "updated_at" => "2023-04-04T17:13:27-04:00", "first_name" => "Bob", "last_name" => "Norman", "orders_count" => 1, "state" => "disabled", "total_spent" => "199.65", "last_order_id" => 450789469, "note" => null, "verified_email" => true, "multipass_identifier" => null, "tax_exempt" => false, "tags" => "L\u00E9on, No\u00EBl", "last_order_name" => "#1001", "currency" => "USD", "phone" => "+16136120707", "accepts_marketing_updated_at" => "2005-06-12T11:57:11-04:00", "marketing_opt_in_level" => null, "tax_exemptions" => [], "email_marketing_consent" => ["state" => "not_subscribed", "opt_in_level" => null, "consent_updated_at" => "2004-06-13T11:57:11-04:00"], "sms_marketing_consent" => ["state" => "not_subscribed", "opt_in_level" => "single_opt_in", "consent_updated_at" => "2023-04-04T17:13:27-04:00", "consent_collected_from" => "OTHER"], "admin_graphql_api_id" => "gid://shopify/Customer/207119551", "default_address" => ["id" => 207119551, "customer_id" => 207119551, "first_name" => null, "last_name" => null, "company" => null, "address1" => "Chestnut Street 92", "address2" => "", "city" => "Louisville", "province" => "Kentucky", "country" => "United States", "zip" => "40202", "phone" => "555-625-1199", "name" => "", "province_code" => "KY", "country_code" => "US", "country_name" => "United States", "default" => true]]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/draft_orders/994118539.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["draft_order" => ["note" => "Customer contacted us about a custom engraving on this iPod"]]),
            ),
        ]);

        $draft_order = new DraftOrder($this->test_session);
        $draft_order->id = 994118539;
        $draft_order->note = "Customer contacted us about a custom engraving on this iPod";
        $draft_order->save();
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
                  ["draft_order" => ["id" => 994118539, "note" => "rush order", "email" => "bob.norman@mail.example.com", "taxes_included" => false, "currency" => "USD", "invoice_sent_at" => null, "created_at" => "2023-04-04T17:13:27-04:00", "updated_at" => "2023-04-04T17:25:16-04:00", "tax_exempt" => false, "completed_at" => null, "name" => "#D2", "status" => "open", "line_items" => [["id" => 1066630387, "variant_id" => 447654529, "product_id" => 921728736, "title" => "IPod Touch 8GB", "variant_title" => "Black", "sku" => "IPOD2009BLACK", "vendor" => "Apple", "quantity" => 1, "requires_shipping" => true, "taxable" => true, "gift_card" => false, "fulfillment_service" => "shipwire-app", "grams" => 567, "tax_lines" => [], "applied_discount" => null, "name" => "IPod Touch 8GB - Black", "properties" => [], "custom" => false, "price" => "199.00", "admin_graphql_api_id" => "gid://shopify/DraftOrderLineItem/1066630387"]], "shipping_address" => ["first_name" => "Bob", "address1" => "Chestnut Street 92", "phone" => "+1(502)-459-2181", "city" => "Louisville", "zip" => "40202", "province" => "Kentucky", "country" => "United States", "last_name" => "Norman", "address2" => "", "company" => null, "latitude" => 45.41634, "longitude" => -75.6868, "name" => "Bob Norman", "country_code" => "US", "province_code" => "KY"], "billing_address" => ["first_name" => "Bob", "address1" => "Chestnut Street 92", "phone" => "+1(502)-459-2181", "city" => "Louisville", "zip" => "40202", "province" => "Kentucky", "country" => "United States", "last_name" => "Norman", "address2" => "", "company" => null, "latitude" => 45.41634, "longitude" => -75.6868, "name" => "Bob Norman", "country_code" => "US", "province_code" => "KY"], "invoice_url" => "https://jsmith.myshopify.com/548380009/invoices/ba8dcf6c022ccad3d47e3909e378e33f", "applied_discount" => ["description" => "\$5promo", "value" => "5.0", "title" => null, "amount" => "5.00", "value_type" => "fixed_amount"], "order_id" => null, "shipping_line" => ["title" => "UPS Ground", "custom" => false, "handle" => "ups-3-12.25", "price" => "12.25"], "tax_lines" => [], "tags" => "Wholesale", "note_attributes" => [], "total_price" => "206.25", "subtotal_price" => "194.00", "total_tax" => "0.00", "presentment_currency" => "USD", "total_line_items_price_set" => ["shop_money" => ["amount" => "199.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "199.00", "currency_code" => "USD"]], "total_price_set" => ["shop_money" => ["amount" => "206.25", "currency_code" => "USD"], "presentment_money" => ["amount" => "206.25", "currency_code" => "USD"]], "subtotal_price_set" => ["shop_money" => ["amount" => "194.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "194.00", "currency_code" => "USD"]], "total_tax_set" => ["shop_money" => ["amount" => "0.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "0.00", "currency_code" => "USD"]], "total_discounts_set" => ["shop_money" => ["amount" => "5.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "5.00", "currency_code" => "USD"]], "total_shipping_price_set" => ["shop_money" => ["amount" => "12.25", "currency_code" => "USD"], "presentment_money" => ["amount" => "12.25", "currency_code" => "USD"]], "total_additional_fees_set" => null, "total_duties_set" => null, "payment_terms" => null, "admin_graphql_api_id" => "gid://shopify/DraftOrder/994118539", "customer" => ["id" => 207119551, "email" => "bob.norman@mail.example.com", "accepts_marketing" => false, "created_at" => "2023-04-04T17:13:27-04:00", "updated_at" => "2023-04-04T17:13:27-04:00", "first_name" => "Bob", "last_name" => "Norman", "orders_count" => 1, "state" => "disabled", "total_spent" => "199.65", "last_order_id" => 450789469, "note" => null, "verified_email" => true, "multipass_identifier" => null, "tax_exempt" => false, "tags" => "L\u00E9on, No\u00EBl", "last_order_name" => "#1001", "currency" => "USD", "phone" => "+16136120707", "accepts_marketing_updated_at" => "2005-06-12T11:57:11-04:00", "marketing_opt_in_level" => null, "tax_exemptions" => [], "email_marketing_consent" => ["state" => "not_subscribed", "opt_in_level" => null, "consent_updated_at" => "2004-06-13T11:57:11-04:00"], "sms_marketing_consent" => ["state" => "not_subscribed", "opt_in_level" => "single_opt_in", "consent_updated_at" => "2023-04-04T17:13:27-04:00", "consent_collected_from" => "OTHER"], "admin_graphql_api_id" => "gid://shopify/Customer/207119551", "default_address" => ["id" => 207119551, "customer_id" => 207119551, "first_name" => null, "last_name" => null, "company" => null, "address1" => "Chestnut Street 92", "address2" => "", "city" => "Louisville", "province" => "Kentucky", "country" => "United States", "zip" => "40202", "phone" => "555-625-1199", "name" => "", "province_code" => "KY", "country_code" => "US", "country_name" => "United States", "default" => true]]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/draft_orders/994118539.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["draft_order" => ["line_items" => [["variant_id" => 447654529, "quantity" => 1]]]]),
            ),
        ]);

        $draft_order = new DraftOrder($this->test_session);
        $draft_order->id = 994118539;
        $draft_order->line_items = [
            [
                "variant_id" => 447654529,
                "quantity" => 1
            ]
        ];
        $draft_order->save();
    }

    /**

     *
     * @return void
     */
    public function test_12(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["draft_order" => ["id" => 994118539, "note" => "rush order", "email" => "bob.norman@mail.example.com", "taxes_included" => false, "currency" => "USD", "invoice_sent_at" => null, "created_at" => "2023-04-04T17:13:27-04:00", "updated_at" => "2023-04-04T17:13:27-04:00", "tax_exempt" => false, "completed_at" => null, "name" => "#D2", "status" => "open", "line_items" => [["id" => 994118539, "variant_id" => 39072856, "product_id" => 632910392, "title" => "IPod Nano - 8gb", "variant_title" => "green", "sku" => "IPOD2008GREEN", "vendor" => null, "quantity" => 1, "requires_shipping" => false, "taxable" => true, "gift_card" => false, "fulfillment_service" => "manual", "grams" => 567, "tax_lines" => [], "applied_discount" => null, "name" => "IPod Nano - 8gb - green", "properties" => [], "custom" => false, "price" => "199.00", "admin_graphql_api_id" => "gid://shopify/DraftOrderLineItem/994118539"]], "shipping_address" => ["first_name" => "Bob", "address1" => "Chestnut Street 92", "phone" => "+1(502)-459-2181", "city" => "Louisville", "zip" => "40202", "province" => "Kentucky", "country" => "United States", "last_name" => "Norman", "address2" => "", "company" => null, "latitude" => 45.41634, "longitude" => -75.6868, "name" => "Bob Norman", "country_code" => "US", "province_code" => "KY"], "billing_address" => ["first_name" => "Bob", "address1" => "Chestnut Street 92", "phone" => "+1(502)-459-2181", "city" => "Louisville", "zip" => "40202", "province" => "Kentucky", "country" => "United States", "last_name" => "Norman", "address2" => "", "company" => null, "latitude" => 45.41634, "longitude" => -75.6868, "name" => "Bob Norman", "country_code" => "US", "province_code" => "KY"], "invoice_url" => "https://jsmith.myshopify.com/548380009/invoices/ba8dcf6c022ccad3d47e3909e378e33f", "applied_discount" => ["description" => "\$5promo", "value" => "5.0", "title" => null, "amount" => "5.00", "value_type" => "fixed_amount"], "order_id" => null, "shipping_line" => ["title" => "UPS Ground", "custom" => false, "handle" => "ups-3-12.25", "price" => "12.25"], "tax_lines" => [], "tags" => "Wholesale", "note_attributes" => [], "total_price" => "206.25", "subtotal_price" => "194.00", "total_tax" => "0.00", "payment_terms" => null, "admin_graphql_api_id" => "gid://shopify/DraftOrder/994118539", "customer" => ["id" => 207119551, "email" => "bob.norman@mail.example.com", "accepts_marketing" => false, "created_at" => "2023-04-04T17:13:27-04:00", "updated_at" => "2023-04-04T17:13:27-04:00", "first_name" => "Bob", "last_name" => "Norman", "orders_count" => 1, "state" => "disabled", "total_spent" => "199.65", "last_order_id" => 450789469, "note" => null, "verified_email" => true, "multipass_identifier" => null, "tax_exempt" => false, "tags" => "L\u00E9on, No\u00EBl", "last_order_name" => "#1001", "currency" => "USD", "phone" => "+16136120707", "accepts_marketing_updated_at" => "2005-06-12T11:57:11-04:00", "marketing_opt_in_level" => null, "tax_exemptions" => [], "email_marketing_consent" => ["state" => "not_subscribed", "opt_in_level" => null, "consent_updated_at" => "2004-06-13T11:57:11-04:00"], "sms_marketing_consent" => ["state" => "not_subscribed", "opt_in_level" => "single_opt_in", "consent_updated_at" => "2023-04-04T17:13:27-04:00", "consent_collected_from" => "OTHER"], "admin_graphql_api_id" => "gid://shopify/Customer/207119551", "default_address" => ["id" => 207119551, "customer_id" => 207119551, "first_name" => null, "last_name" => null, "company" => null, "address1" => "Chestnut Street 92", "address2" => "", "city" => "Louisville", "province" => "Kentucky", "country" => "United States", "zip" => "40202", "phone" => "555-625-1199", "name" => "", "province_code" => "KY", "country_code" => "US", "country_name" => "United States", "default" => true]]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/draft_orders/994118539.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        DraftOrder::find(
            $this->test_session,
            994118539,
            [],
            [],
        );
    }

    /**

     *
     * @return void
     */
    public function test_13(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  []
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/draft_orders/994118539.json",
                "DELETE",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        DraftOrder::delete(
            $this->test_session,
            994118539,
            [],
            [],
        );
    }

    /**

     *
     * @return void
     */
    public function test_14(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["count" => 5]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/draft_orders/count.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        DraftOrder::count(
            $this->test_session,
            [],
            [],
        );
    }

    /**

     *
     * @return void
     */
    public function test_15(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["draft_order_invoice" => ["to" => "first@example.com", "from" => "j.smith@example.com", "subject" => "Apple Computer Invoice", "custom_message" => "Thank you for ordering!", "bcc" => ["j.smith@example.com"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/draft_orders/994118539/send_invoice.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["draft_order_invoice" => ["to" => "first@example.com", "from" => "j.smith@example.com", "bcc" => ["j.smith@example.com"], "subject" => "Apple Computer Invoice", "custom_message" => "Thank you for ordering!"]]),
            ),
        ]);

        $draft_order = new DraftOrder($this->test_session);
        $draft_order->id = 994118539;
        $draft_order->send_invoice(
            [],
            ["draft_order_invoice" => ["to" => "first@example.com", "from" => "j.smith@example.com", "bcc" => ["j.smith@example.com"], "subject" => "Apple Computer Invoice", "custom_message" => "Thank you for ordering!"]],
        );
    }

    /**

     *
     * @return void
     */
    public function test_16(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["draft_order_invoice" => ["to" => "bob.norman@mail.example.com", "from" => "\"John Smith Test Store\" <j.smith@example.com>", "subject" => "Draft Order #D2", "custom_message" => "", "bcc" => []]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/draft_orders/994118539/send_invoice.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["draft_order_invoice" => []]),
            ),
        ]);

        $draft_order = new DraftOrder($this->test_session);
        $draft_order->id = 994118539;
        $draft_order->send_invoice(
            [],
            ["draft_order_invoice" => []],
        );
    }

    /**

     *
     * @return void
     */
    public function test_17(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["draft_order" => ["id" => 994118539, "note" => "rush order", "email" => "bob.norman@mail.example.com", "taxes_included" => false, "currency" => "USD", "invoice_sent_at" => null, "created_at" => "2023-04-04T17:13:27-04:00", "updated_at" => "2023-04-04T17:24:50-04:00", "tax_exempt" => false, "completed_at" => "2023-04-04T17:24:50-04:00", "name" => "#D2", "status" => "completed", "line_items" => [["id" => 994118539, "variant_id" => 39072856, "product_id" => 632910392, "title" => "IPod Nano - 8gb", "variant_title" => "green", "sku" => "IPOD2008GREEN", "vendor" => null, "quantity" => 1, "requires_shipping" => false, "taxable" => true, "gift_card" => false, "fulfillment_service" => "manual", "grams" => 567, "tax_lines" => [], "applied_discount" => null, "name" => "IPod Nano - 8gb - green", "properties" => [], "custom" => false, "price" => "199.00", "admin_graphql_api_id" => "gid://shopify/DraftOrderLineItem/994118539"]], "shipping_address" => ["first_name" => "Bob", "address1" => "Chestnut Street 92", "phone" => "+1(502)-459-2181", "city" => "Louisville", "zip" => "40202", "province" => "Kentucky", "country" => "United States", "last_name" => "Norman", "address2" => "", "company" => null, "latitude" => 45.41634, "longitude" => -75.6868, "name" => "Bob Norman", "country_code" => "US", "province_code" => "KY"], "billing_address" => ["first_name" => "Bob", "address1" => "Chestnut Street 92", "phone" => "+1(502)-459-2181", "city" => "Louisville", "zip" => "40202", "province" => "Kentucky", "country" => "United States", "last_name" => "Norman", "address2" => "", "company" => null, "latitude" => 45.41634, "longitude" => -75.6868, "name" => "Bob Norman", "country_code" => "US", "province_code" => "KY"], "invoice_url" => "https://jsmith.myshopify.com/548380009/invoices/ba8dcf6c022ccad3d47e3909e378e33f", "applied_discount" => ["description" => "\$5promo", "value" => "5.0", "title" => null, "amount" => "5.00", "value_type" => "fixed_amount"], "order_id" => 1073459975, "shipping_line" => ["title" => "UPS Ground", "custom" => false, "handle" => "ups-3-12.25", "price" => "12.25"], "tax_lines" => [], "tags" => "Wholesale", "note_attributes" => [], "total_price" => "206.25", "subtotal_price" => "194.00", "total_tax" => "0.00", "presentment_currency" => "USD", "total_line_items_price_set" => ["shop_money" => ["amount" => "826.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "826.00", "currency_code" => "USD"]], "total_price_set" => ["shop_money" => ["amount" => "206.25", "currency_code" => "USD"], "presentment_money" => ["amount" => "206.25", "currency_code" => "USD"]], "subtotal_price_set" => ["shop_money" => ["amount" => "194.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "194.00", "currency_code" => "USD"]], "total_tax_set" => ["shop_money" => ["amount" => "0.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "0.00", "currency_code" => "USD"]], "total_discounts_set" => ["shop_money" => ["amount" => "5.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "5.00", "currency_code" => "USD"]], "total_shipping_price_set" => ["shop_money" => ["amount" => "12.25", "currency_code" => "USD"], "presentment_money" => ["amount" => "12.25", "currency_code" => "USD"]], "total_additional_fees_set" => null, "total_duties_set" => null, "payment_terms" => null, "admin_graphql_api_id" => "gid://shopify/DraftOrder/994118539", "customer" => ["id" => 207119551, "email" => "bob.norman@mail.example.com", "accepts_marketing" => false, "created_at" => "2023-04-04T17:13:27-04:00", "updated_at" => "2023-04-04T17:24:50-04:00", "first_name" => "Bob", "last_name" => "Norman", "orders_count" => 2, "state" => "disabled", "total_spent" => "405.90", "last_order_id" => 1073459975, "note" => null, "verified_email" => true, "multipass_identifier" => null, "tax_exempt" => false, "tags" => "L\u00E9on, No\u00EBl", "last_order_name" => "#1002", "currency" => "USD", "phone" => "+16136120707", "accepts_marketing_updated_at" => "2005-06-12T11:57:11-04:00", "marketing_opt_in_level" => null, "tax_exemptions" => [], "email_marketing_consent" => ["state" => "not_subscribed", "opt_in_level" => null, "consent_updated_at" => "2004-06-13T11:57:11-04:00"], "sms_marketing_consent" => ["state" => "not_subscribed", "opt_in_level" => "single_opt_in", "consent_updated_at" => "2023-04-04T17:13:27-04:00", "consent_collected_from" => "OTHER"], "admin_graphql_api_id" => "gid://shopify/Customer/207119551", "default_address" => ["id" => 1053317295, "customer_id" => 207119551, "first_name" => "Bob", "last_name" => "Norman", "company" => null, "address1" => "Chestnut Street 92", "address2" => "", "city" => "Louisville", "province" => "Kentucky", "country" => "United States", "zip" => "40202", "phone" => "+1(502)-459-2181", "name" => "Bob Norman", "province_code" => "KY", "country_code" => "US", "country_name" => "United States", "default" => true]]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/draft_orders/994118539/complete.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        $draft_order = new DraftOrder($this->test_session);
        $draft_order->id = 994118539;
        $draft_order->complete(
            [],
        );
    }

    /**

     *
     * @return void
     */
    public function test_18(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["draft_order" => ["id" => 994118539, "note" => "rush order", "email" => "bob.norman@mail.example.com", "taxes_included" => false, "currency" => "USD", "invoice_sent_at" => null, "created_at" => "2023-04-04T17:13:27-04:00", "updated_at" => "2023-04-04T17:25:00-04:00", "tax_exempt" => false, "completed_at" => "2023-04-04T17:25:00-04:00", "name" => "#D2", "status" => "completed", "line_items" => [["id" => 994118539, "variant_id" => 39072856, "product_id" => 632910392, "title" => "IPod Nano - 8gb", "variant_title" => "green", "sku" => "IPOD2008GREEN", "vendor" => null, "quantity" => 1, "requires_shipping" => false, "taxable" => true, "gift_card" => false, "fulfillment_service" => "manual", "grams" => 567, "tax_lines" => [], "applied_discount" => null, "name" => "IPod Nano - 8gb - green", "properties" => [], "custom" => false, "price" => "199.00", "admin_graphql_api_id" => "gid://shopify/DraftOrderLineItem/994118539"]], "shipping_address" => ["first_name" => "Bob", "address1" => "Chestnut Street 92", "phone" => "+1(502)-459-2181", "city" => "Louisville", "zip" => "40202", "province" => "Kentucky", "country" => "United States", "last_name" => "Norman", "address2" => "", "company" => null, "latitude" => 45.41634, "longitude" => -75.6868, "name" => "Bob Norman", "country_code" => "US", "province_code" => "KY"], "billing_address" => ["first_name" => "Bob", "address1" => "Chestnut Street 92", "phone" => "+1(502)-459-2181", "city" => "Louisville", "zip" => "40202", "province" => "Kentucky", "country" => "United States", "last_name" => "Norman", "address2" => "", "company" => null, "latitude" => 45.41634, "longitude" => -75.6868, "name" => "Bob Norman", "country_code" => "US", "province_code" => "KY"], "invoice_url" => "https://jsmith.myshopify.com/548380009/invoices/ba8dcf6c022ccad3d47e3909e378e33f", "applied_discount" => ["description" => "\$5promo", "value" => "5.0", "title" => null, "amount" => "5.00", "value_type" => "fixed_amount"], "order_id" => 1073459976, "shipping_line" => ["title" => "UPS Ground", "custom" => false, "handle" => "ups-3-12.25", "price" => "12.25"], "tax_lines" => [], "tags" => "Wholesale", "note_attributes" => [], "total_price" => "206.25", "subtotal_price" => "194.00", "total_tax" => "0.00", "presentment_currency" => "USD", "total_line_items_price_set" => ["shop_money" => ["amount" => "826.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "826.00", "currency_code" => "USD"]], "total_price_set" => ["shop_money" => ["amount" => "206.25", "currency_code" => "USD"], "presentment_money" => ["amount" => "206.25", "currency_code" => "USD"]], "subtotal_price_set" => ["shop_money" => ["amount" => "194.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "194.00", "currency_code" => "USD"]], "total_tax_set" => ["shop_money" => ["amount" => "0.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "0.00", "currency_code" => "USD"]], "total_discounts_set" => ["shop_money" => ["amount" => "5.00", "currency_code" => "USD"], "presentment_money" => ["amount" => "5.00", "currency_code" => "USD"]], "total_shipping_price_set" => ["shop_money" => ["amount" => "12.25", "currency_code" => "USD"], "presentment_money" => ["amount" => "12.25", "currency_code" => "USD"]], "total_additional_fees_set" => null, "total_duties_set" => null, "payment_terms" => null, "admin_graphql_api_id" => "gid://shopify/DraftOrder/994118539", "customer" => ["id" => 207119551, "email" => "bob.norman@mail.example.com", "accepts_marketing" => false, "created_at" => "2023-04-04T17:13:27-04:00", "updated_at" => "2023-04-04T17:25:00-04:00", "first_name" => "Bob", "last_name" => "Norman", "orders_count" => 2, "state" => "disabled", "total_spent" => "405.90", "last_order_id" => 1073459976, "note" => null, "verified_email" => true, "multipass_identifier" => null, "tax_exempt" => false, "tags" => "L\u00E9on, No\u00EBl", "last_order_name" => "#1002", "currency" => "USD", "phone" => "+16136120707", "accepts_marketing_updated_at" => "2005-06-12T11:57:11-04:00", "marketing_opt_in_level" => null, "tax_exemptions" => [], "email_marketing_consent" => ["state" => "not_subscribed", "opt_in_level" => null, "consent_updated_at" => "2004-06-13T11:57:11-04:00"], "sms_marketing_consent" => ["state" => "not_subscribed", "opt_in_level" => "single_opt_in", "consent_updated_at" => "2023-04-04T17:13:27-04:00", "consent_collected_from" => "OTHER"], "admin_graphql_api_id" => "gid://shopify/Customer/207119551", "default_address" => ["id" => 1053317297, "customer_id" => 207119551, "first_name" => "Bob", "last_name" => "Norman", "company" => null, "address1" => "Chestnut Street 92", "address2" => "", "city" => "Louisville", "province" => "Kentucky", "country" => "United States", "zip" => "40202", "phone" => "+1(502)-459-2181", "name" => "Bob Norman", "province_code" => "KY", "country_code" => "US", "country_name" => "United States", "default" => true]]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/draft_orders/994118539/complete.json?payment_pending=true",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        $draft_order = new DraftOrder($this->test_session);
        $draft_order->id = 994118539;
        $draft_order->complete(
            ["payment_pending" => "true"],
        );
    }

}
