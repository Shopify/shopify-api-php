<?php

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Admin2021_07\Shop;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class Shop202107Test extends BaseTestCase
{
    /** @var Session */
    private $test_session;

    public function setUp(): void
    {
        parent::setUp();

        Context::$API_VERSION = "2021-07";

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
                  ["shop" => ["id" => 548380009, "name" => "John Smith Test Store", "email" => "j.smith@example.com", "domain" => "shop.apple.com", "province" => "California", "country" => "US", "address1" => "1 Infinite Loop", "zip" => "95014", "city" => "Cupertino", "source" => null, "phone" => "1231231234", "latitude" => 45.45, "longitude" => -75.43, "primary_locale" => "en", "address2" => "Suite 100", "created_at" => "2007-12-31T19:00:00-05:00", "updated_at" => "2022-03-30T19:41:51-04:00", "country_code" => "US", "country_name" => "United States", "currency" => "USD", "customer_email" => "customers@apple.com", "timezone" => "(GMT-05:00) Eastern Time (US & Canada)", "iana_timezone" => "America/New_York", "shop_owner" => "John Smith", "money_format" => "\${{amount}}", "money_with_currency_format" => "\${{amount}} USD", "weight_unit" => "lb", "province_code" => "CA", "taxes_included" => null, "auto_configure_tax_inclusivity" => null, "tax_shipping" => null, "county_taxes" => true, "plan_display_name" => "Shopify Plus", "plan_name" => "enterprise", "has_discounts" => true, "has_gift_cards" => true, "myshopify_domain" => "jsmith.myshopify.com", "google_apps_domain" => null, "google_apps_login_enabled" => null, "money_in_emails_format" => "\${{amount}}", "money_with_currency_in_emails_format" => "\${{amount}} USD", "eligible_for_payments" => true, "requires_extra_payments_agreement" => false, "password_enabled" => false, "has_storefront" => true, "eligible_for_card_reader_giveaway" => false, "finances" => true, "primary_location_id" => 655441491, "cookie_consent_level" => "implicit", "visitor_tracking_consent_preference" => "allow_all", "checkout_api_supported" => true, "multi_location_enabled" => false, "setup_required" => false, "pre_launch_enabled" => false, "enabled_presentment_currencies" => ["USD"], "transactional_sms_disabled" => false]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/shop.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Shop::all(
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
                  ["shop" => ["province" => "California", "country" => "US", "address1" => "1 Infinite Loop", "city" => "Cupertino", "address2" => "Suite 100"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/shop.json?fields=address1%2Caddress2%2Ccity%2Cprovince%2Ccountry",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Shop::all(
            $this->test_session,
            [],
            ["fields" => "address1,address2,city,province,country"],
        );
    }

}
