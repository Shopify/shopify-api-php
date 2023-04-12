<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Admin2022_10\User;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class User202210Test extends BaseTestCase
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
                  ["users" => [["id" => 548380009, "first_name" => "John", "email" => "j.smith@example.com", "url" => "www.example.com", "im" => null, "screen_name" => null, "phone" => null, "last_name" => "Smith", "account_owner" => true, "receive_announcements" => 1, "bio" => null, "permissions" => ["applications", "beacons", "billing_application_charges", "channels", "content", "content_entries_delete", "content_entries_edit", "content_entries_view", "content_models_delete", "content_models_edit", "content_models_view", "custom_pixels_management", "custom_pixels_view", "customers", "dashboard", "delete_products", "domains", "draft_orders", "create_and_edit_draft_orders", "apply_discounts_to_draft_orders", "process_payment_for_draft_orders", "mark_draft_orders_as_paid", "set_payment_terms_for_draft_orders", "delete_draft_orders", "edit_orders", "edit_private_apps", "edit_product_cost", "edit_product_price", "edit_theme_code", "gift_cards", "links", "locations", "manage_delivery_settings", "manage_inventory", "manage_policies", "manage_product_tags", "manage_products", "manage_taxes_settings", "marketing", "marketing_section", "metaobjects_delete", "metaobjects_edit", "metaobjects_view", "metaobject_definitions_delete", "metaobject_definitions_edit", "metaobject_definitions_view", "merge_customers", "orders", "overviews", "pages", "pay_draft_orders_by_credit_card", "pay_orders_by_credit_card", "pay_orders_by_vaulted_card", "preferences", "products", "refund_orders", "reports", "translations", "themes", "view_balance_bank_accounts", "view_private_apps", "view_product_costs", "apply_discounts_to_orders", "fulfill_and_ship_orders", "buy_shipping_labels", "return_and_restock_orders", "manage_abandoned_checkouts", "cancel_orders", "delete_orders", "shopify_payments_accounts", "shopify_payments_transfers", "staff_audit_log_view", "staff_management_update", "applications_billing", "attestation_authority", "authentication_management", "balance_bank_accounts_management", "billing_charges", "billing_invoices_pay", "billing_invoices_view", "billing_payment_methods_manage", "billing_payment_methods_view", "billing_settings", "billing_subscriptions", "capital", "shopify_credit", "customer_private_data", "erase_customer_data", "request_customer_data", "domains_management", "domains_transfer_out", "enable_private_apps", "experiments_management", "gdpr_actions", "manage_tap_to_pay", "payment_settings", "upgrade_to_plus_plan", "shopify_payments", "staff_api_permission_management", "staff_management", "staff_management_activation", "staff_management_create", "staff_management_delete", "support_methods", "collaborator_request_management", "collaborator_request_settings", "export_customers", "export_draft_orders", "export_orders", "export_products", "view_price_lists", "delete_price_lists", "create_and_edit_price_lists"], "locale" => "en", "user_type" => "regular", "admin_graphql_api_id" => "gid://shopify/StaffMember/548380009", "tfa_enabled?" => false], ["id" => 930143300, "first_name" => "John", "email" => "j.limited@example.com", "url" => "www.example.com", "im" => null, "screen_name" => null, "phone" => null, "last_name" => "Limited", "account_owner" => false, "receive_announcements" => 1, "bio" => null, "permissions" => [], "locale" => "en", "user_type" => "regular", "admin_graphql_api_id" => "gid://shopify/StaffMember/930143300", "tfa_enabled?" => false]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-10/users.json",
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
                  ["user" => ["id" => 548380009, "first_name" => "John", "email" => "j.smith@example.com", "url" => "www.example.com", "im" => null, "screen_name" => null, "phone" => null, "last_name" => "Smith", "account_owner" => true, "receive_announcements" => 1, "bio" => null, "permissions" => ["applications", "beacons", "billing_application_charges", "channels", "content", "content_entries_delete", "content_entries_edit", "content_entries_view", "content_models_delete", "content_models_edit", "content_models_view", "custom_pixels_management", "custom_pixels_view", "customers", "dashboard", "delete_products", "domains", "draft_orders", "create_and_edit_draft_orders", "apply_discounts_to_draft_orders", "process_payment_for_draft_orders", "mark_draft_orders_as_paid", "set_payment_terms_for_draft_orders", "delete_draft_orders", "edit_orders", "edit_private_apps", "edit_product_cost", "edit_product_price", "edit_theme_code", "gift_cards", "links", "locations", "manage_delivery_settings", "manage_inventory", "manage_policies", "manage_product_tags", "manage_products", "manage_taxes_settings", "marketing", "marketing_section", "metaobjects_delete", "metaobjects_edit", "metaobjects_view", "metaobject_definitions_delete", "metaobject_definitions_edit", "metaobject_definitions_view", "merge_customers", "orders", "overviews", "pages", "pay_draft_orders_by_credit_card", "pay_orders_by_credit_card", "pay_orders_by_vaulted_card", "preferences", "products", "refund_orders", "reports", "translations", "themes", "view_balance_bank_accounts", "view_private_apps", "view_product_costs", "apply_discounts_to_orders", "fulfill_and_ship_orders", "buy_shipping_labels", "return_and_restock_orders", "manage_abandoned_checkouts", "cancel_orders", "delete_orders", "shopify_payments_accounts", "shopify_payments_transfers", "staff_audit_log_view", "staff_management_update", "applications_billing", "attestation_authority", "authentication_management", "balance_bank_accounts_management", "billing_charges", "billing_invoices_pay", "billing_invoices_view", "billing_payment_methods_manage", "billing_payment_methods_view", "billing_settings", "billing_subscriptions", "capital", "shopify_credit", "customer_private_data", "erase_customer_data", "request_customer_data", "domains_management", "domains_transfer_out", "enable_private_apps", "experiments_management", "gdpr_actions", "manage_tap_to_pay", "payment_settings", "upgrade_to_plus_plan", "shopify_payments", "staff_api_permission_management", "staff_management", "staff_management_activation", "staff_management_create", "staff_management_delete", "support_methods", "collaborator_request_management", "collaborator_request_settings", "export_customers", "export_draft_orders", "export_orders", "export_products", "view_price_lists", "delete_price_lists", "create_and_edit_price_lists"], "locale" => "en", "user_type" => "regular", "admin_graphql_api_id" => "gid://shopify/StaffMember/548380009", "tfa_enabled?" => false]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-10/users/548380009.json",
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
                  ["user" => ["id" => 548380009, "first_name" => "John", "email" => "j.smith@example.com", "url" => "www.example.com", "im" => null, "screen_name" => null, "phone" => null, "last_name" => "Smith", "account_owner" => true, "receive_announcements" => 1, "bio" => null, "permissions" => ["applications", "beacons", "billing_application_charges", "channels", "content", "content_entries_delete", "content_entries_edit", "content_entries_view", "content_models_delete", "content_models_edit", "content_models_view", "custom_pixels_management", "custom_pixels_view", "customers", "dashboard", "delete_products", "domains", "draft_orders", "create_and_edit_draft_orders", "apply_discounts_to_draft_orders", "process_payment_for_draft_orders", "mark_draft_orders_as_paid", "set_payment_terms_for_draft_orders", "delete_draft_orders", "edit_orders", "edit_private_apps", "edit_product_cost", "edit_product_price", "edit_theme_code", "gift_cards", "links", "locations", "manage_delivery_settings", "manage_inventory", "manage_policies", "manage_product_tags", "manage_products", "manage_taxes_settings", "marketing", "marketing_section", "metaobjects_delete", "metaobjects_edit", "metaobjects_view", "metaobject_definitions_delete", "metaobject_definitions_edit", "metaobject_definitions_view", "merge_customers", "orders", "overviews", "pages", "pay_draft_orders_by_credit_card", "pay_orders_by_credit_card", "pay_orders_by_vaulted_card", "preferences", "products", "refund_orders", "reports", "translations", "themes", "view_balance_bank_accounts", "view_private_apps", "view_product_costs", "apply_discounts_to_orders", "fulfill_and_ship_orders", "buy_shipping_labels", "return_and_restock_orders", "manage_abandoned_checkouts", "cancel_orders", "delete_orders", "shopify_payments_accounts", "shopify_payments_transfers", "staff_audit_log_view", "staff_management_update", "applications_billing", "attestation_authority", "authentication_management", "balance_bank_accounts_management", "billing_charges", "billing_invoices_pay", "billing_invoices_view", "billing_payment_methods_manage", "billing_payment_methods_view", "billing_settings", "billing_subscriptions", "capital", "shopify_credit", "customer_private_data", "erase_customer_data", "request_customer_data", "domains_management", "domains_transfer_out", "enable_private_apps", "experiments_management", "gdpr_actions", "manage_tap_to_pay", "payment_settings", "upgrade_to_plus_plan", "shopify_payments", "staff_api_permission_management", "staff_management", "staff_management_activation", "staff_management_create", "staff_management_delete", "support_methods", "collaborator_request_management", "collaborator_request_settings", "export_customers", "export_draft_orders", "export_orders", "export_products", "view_price_lists", "delete_price_lists", "create_and_edit_price_lists"], "locale" => "en", "user_type" => "regular", "admin_graphql_api_id" => "gid://shopify/StaffMember/548380009", "tfa_enabled?" => false]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-10/users/current.json",
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
