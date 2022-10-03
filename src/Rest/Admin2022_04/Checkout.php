<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace Shopify\Rest\Admin2022_04;

use Shopify\Auth\Session;
use Shopify\Rest\Base;

/**
 * @property array $billing_address
 * @property array[] $line_items
 * @property array|null $applied_discount
 * @property bool|null $buyer_accepts_marketing
 * @property string|null $created_at
 * @property string|null $currency
 * @property int|null $customer_id
 * @property DiscountCode|null $discount_code
 * @property string|null $email
 * @property GiftCard[]|null $gift_cards
 * @property Order|null $order
 * @property string|null $payment_due
 * @property string|null $payment_url
 * @property string|null $phone
 * @property string|null $presentment_currency
 * @property bool|null $requires_shipping
 * @property string|null $reservation_time
 * @property int|null $reservation_time_left
 * @property array|null $shipping_address
 * @property array|null $shipping_line
 * @property array|null $shipping_rate
 * @property string|null $source_identifier
 * @property string|null $source_name
 * @property string|null $source_url
 * @property string|null $subtotal_price
 * @property array[]|null $tax_lines
 * @property bool|null $taxes_included
 * @property string|null $token
 * @property string|null $total_price
 * @property string|null $total_tax
 * @property string|null $updated_at
 * @property int|null $user_id
 * @property string|null $web_url
 */
class Checkout extends Base
{
    public static string $API_VERSION = "2022-04";
    protected static array $HAS_ONE = [
        "discount_code" => DiscountCode::class,
        "order" => Order::class
    ];
    protected static array $HAS_MANY = [
        "gift_cards" => GiftCard::class
    ];
    protected static array $PATHS = [
        ["http_method" => "get", "operation" => "get", "ids" => ["token"], "path" => "checkouts/<token>.json"],
        ["http_method" => "get", "operation" => "shipping_rates", "ids" => ["token"], "path" => "checkouts/<token>/shipping_rates.json"],
        ["http_method" => "post", "operation" => "complete", "ids" => ["token"], "path" => "checkouts/<token>/complete.json"],
        ["http_method" => "post", "operation" => "post", "ids" => [], "path" => "checkouts.json"],
        ["http_method" => "put", "operation" => "put", "ids" => ["token"], "path" => "checkouts/<token>.json"]
    ];
    protected static string $PRIMARY_KEY = "token";

    /**
     * @param Session $session
     * @param int|string $token
     * @param array $urlIds
     * @param mixed[] $params
     *
     * @return Checkout|null
     */
    public static function find(
        Session $session,
        $token,
        array $urlIds = [],
        array $params = []
    ): ?Checkout {
        $result = parent::baseFind(
            $session,
            array_merge(["token" => $token], $urlIds),
            $params,
        );
        return !empty($result) ? $result[0] : null;
    }

    /**
     * @param Session $session
     * @param int|string $token
     * @param array $urlIds
     * @param mixed[] $params
     *
     * @return array|null
     */
    public static function shipping_rates(
        Session $session,
        $token,
        array $urlIds = [],
        array $params = []
    ): ?array {
        $response = parent::request(
            "get",
            "shipping_rates",
            $session,
            array_merge(["token" => $token], $urlIds),
            $params,
            [],
        );

        return $response->getDecodedBody();
    }

    /**
     * @param mixed[] $params
     * @param array|string $body
     *
     * @return array|null
     */
    public function complete(
        array $params = [],
        $body = []
    ): ?array {
        $response = parent::request(
            "post",
            "complete",
            $this->session,
            ["token" => $this->token],
            $params,
            $body,
            $this,
        );

        return $response->getDecodedBody();
    }

}
