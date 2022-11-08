<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Admin2022_01\User;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class User202201Test extends BaseTestCase
{
    /** @var Session */
    private $test_session;

    public function setUp(): void
    {
        parent::setUp();

        Context::$API_VERSION = "2022-01";

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
                  ["users" => [["id" => 548380009, "first_name" => "John", "email" => "j.smith@example.com", "url" => "www.example.com", "im" => null, "screen_name" => null, "phone" => null, "last_name" => "Smith", "account_owner" => true, "receive_announcements" => 1, "bio" => null, "permissions" => ["applications", "beacons", "billing_application_charges", "channels", "content", "content_entries_delete", "content_entries_edit", "content_entries_view", "content_models_delete", "content_models_edit", "content_models_view", "custom_pixels_management", "custom_pixels_view", "customers", "dashboard", "domains", "draft_orders", "edit_orders", "edit_private_apps", "gift_cards", "links", "locations", "marketing", "marketing_section", "orders", "overviews", "pages", "pay_draft_orders_by_credit_card", "pay_orders_by_credit_card", "pay_orders_by_vaulted_card", "preferences", "products", "refund_orders", "reports", "translations", "themes", "view_private_apps", "shopify_payments_accounts", "shopify_payments_transfers", "staff_audit_log_view", "staff_management_update", "applications_billing", "attestation_authority", "authentication_management", "balance_bank_accounts_management", "billing_charges", "billing_invoices_pay", "billing_invoices_view", "billing_payment_methods_manage", "billing_payment_methods_view", "billing_settings", "billing_subscriptions", "capital", "shopify_credit", "customer_private_data", "erase_customer_data", "request_customer_data", "domains_management", "enable_private_apps", "experiments_management", "gdpr_actions", "payment_settings", "shopify_payments", "staff_api_permission_management", "staff_management", "staff_management_activation", "staff_management_create", "staff_management_delete", "support_methods", "collaborator_request_management", "collaborator_request_settings", "export_customers", "export_draft_orders", "export_orders", "export_products"], "locale" => "en", "user_type" => "regular", "admin_graphql_api_id" => "gid://shopify/StaffMember/548380009", "tfa_enabled?" => false], ["id" => 930143300, "first_name" => "John", "email" => "j.limited@example.com", "url" => "www.example.com", "im" => null, "screen_name" => null, "phone" => null, "last_name" => "Limited", "account_owner" => false, "receive_announcements" => 1, "bio" => null, "permissions" => [], "locale" => "en", "user_type" => "regular", "admin_graphql_api_id" => "gid://shopify/StaffMember/930143300", "tfa_enabled?" => false]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-01/users.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        User::all(
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
                  ["user" => ["id" => 548380009, "first_name" => "John", "email" => "j.smith@example.com", "url" => "www.example.com", "im" => null, "screen_name" => null, "phone" => null, "last_name" => "Smith", "account_owner" => true, "receive_announcements" => 1, "bio" => null, "permissions" => ["applications", "beacons", "billing_application_charges", "channels", "content", "content_entries_delete", "content_entries_edit", "content_entries_view", "content_models_delete", "content_models_edit", "content_models_view", "custom_pixels_management", "custom_pixels_view", "customers", "dashboard", "domains", "draft_orders", "edit_orders", "edit_private_apps", "gift_cards", "links", "locations", "marketing", "marketing_section", "orders", "overviews", "pages", "pay_draft_orders_by_credit_card", "pay_orders_by_credit_card", "pay_orders_by_vaulted_card", "preferences", "products", "refund_orders", "reports", "translations", "themes", "view_private_apps", "shopify_payments_accounts", "shopify_payments_transfers", "staff_audit_log_view", "staff_management_update", "applications_billing", "attestation_authority", "authentication_management", "balance_bank_accounts_management", "billing_charges", "billing_invoices_pay", "billing_invoices_view", "billing_payment_methods_manage", "billing_payment_methods_view", "billing_settings", "billing_subscriptions", "capital", "shopify_credit", "customer_private_data", "erase_customer_data", "request_customer_data", "domains_management", "enable_private_apps", "experiments_management", "gdpr_actions", "payment_settings", "shopify_payments", "staff_api_permission_management", "staff_management", "staff_management_activation", "staff_management_create", "staff_management_delete", "support_methods", "collaborator_request_management", "collaborator_request_settings", "export_customers", "export_draft_orders", "export_orders", "export_products"], "locale" => "en", "user_type" => "regular", "admin_graphql_api_id" => "gid://shopify/StaffMember/548380009", "tfa_enabled?" => false]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-01/users/548380009.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        User::find(
            $this->test_session,
            548380009,
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
                  ["user" => ["id" => 548380009, "first_name" => "John", "email" => "j.smith@example.com", "url" => "www.example.com", "im" => null, "screen_name" => null, "phone" => null, "last_name" => "Smith", "account_owner" => true, "receive_announcements" => 1, "bio" => null, "permissions" => ["applications", "beacons", "billing_application_charges", "channels", "content", "content_entries_delete", "content_entries_edit", "content_entries_view", "content_models_delete", "content_models_edit", "content_models_view", "custom_pixels_management", "custom_pixels_view", "customers", "dashboard", "domains", "draft_orders", "edit_orders", "edit_private_apps", "gift_cards", "links", "locations", "marketing", "marketing_section", "orders", "overviews", "pages", "pay_draft_orders_by_credit_card", "pay_orders_by_credit_card", "pay_orders_by_vaulted_card", "preferences", "products", "refund_orders", "reports", "translations", "themes", "view_private_apps", "shopify_payments_accounts", "shopify_payments_transfers", "staff_audit_log_view", "staff_management_update", "applications_billing", "attestation_authority", "authentication_management", "balance_bank_accounts_management", "billing_charges", "billing_invoices_pay", "billing_invoices_view", "billing_payment_methods_manage", "billing_payment_methods_view", "billing_settings", "billing_subscriptions", "capital", "shopify_credit", "customer_private_data", "erase_customer_data", "request_customer_data", "domains_management", "enable_private_apps", "experiments_management", "gdpr_actions", "payment_settings", "shopify_payments", "staff_api_permission_management", "staff_management", "staff_management_activation", "staff_management_create", "staff_management_delete", "support_methods", "collaborator_request_management", "collaborator_request_settings", "export_customers", "export_draft_orders", "export_orders", "export_products"], "locale" => "en", "user_type" => "regular", "admin_graphql_api_id" => "gid://shopify/StaffMember/548380009", "tfa_enabled?" => false]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-01/users/current.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        User::current(
            $this->test_session,
            [],
            [],
        );
    }

}
