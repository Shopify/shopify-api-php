<?php

declare(strict_types=1);

namespace Shopify\Rest\Admin2022_01;

use Shopify\Auth\Session;
use Shopify\Rest\Base;

/**
 * @property string|null $address1
 * @property string|null $address2
 * @property bool|null $checkout_api_supported
 * @property string|null $city
 * @property string|null $cookie_consent_level
 * @property string|null $country
 * @property string|null $country_code
 * @property string|null $country_name
 * @property string|null $county_taxes
 * @property string|null $created_at
 * @property string|null $currency
 * @property string|null $customer_email
 * @property string|null $domain
 * @property bool|null $eligible_for_card_reader_giveaway
 * @property bool|null $eligible_for_payments
 * @property string|null $email
 * @property string[]|null $enabled_presentment_currencies
 * @property bool|null $finances
 * @property bool|null $force_ssl
 * @property string|null $google_apps_domain
 * @property string|null $google_apps_login_enabled
 * @property bool|null $has_discounts
 * @property bool|null $has_gift_cards
 * @property bool|null $has_storefront
 * @property string|null $iana_timezone
 * @property int|null $id
 * @property float|null $latitude
 * @property float|null $longitude
 * @property string|null $money_format
 * @property string|null $money_in_emails_format
 * @property string|null $money_with_currency_format
 * @property string|null $money_with_currency_in_emails_format
 * @property bool|null $multi_location_enabled
 * @property string|null $myshopify_domain
 * @property string|null $name
 * @property bool|null $password_enabled
 * @property string|null $phone
 * @property string|null $plan_display_name
 * @property string|null $plan_name
 * @property bool|null $pre_launch_enabled
 * @property string|null $primary_locale
 * @property int|null $primary_location_id
 * @property string|null $province
 * @property string|null $province_code
 * @property bool|null $requires_extra_payments_agreement
 * @property bool|null $setup_required
 * @property string|null $shop_owner
 * @property string|null $source
 * @property string|null $tax_shipping
 * @property string|null $taxes_included
 * @property string|null $timezone
 * @property bool|null $transactional_sms_disabled
 * @property string|null $updated_at
 * @property string|null $weight_unit
 * @property string|null $zip
 */
class Shop extends Base
{
    public static string $API_VERSION = "2022-01";
    protected static array $HAS_ONE = [];
    protected static array $HAS_MANY = [];
    protected static array $PATHS = [
        ["http_method" => "get", "operation" => "get", "ids" => [], "path" => "shop.json"]
    ];

    /**
     * @param Session $session
     * @param array $urlIds
     * @param mixed[] $params Allowed indexes:
     *     fields
     *
     * @return Shop[]
     */
    public static function all(
        Session $session,
        array $urlIds = [],
        array $params = []
    ): array {
        return parent::baseFind(
            $session,
            [],
            $params,
        );
    }

}
