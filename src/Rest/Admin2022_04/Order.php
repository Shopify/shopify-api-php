<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace Shopify\Rest\Admin2022_04;

use Shopify\Auth\Session;
use Shopify\Rest\Base;

/**
 * @property array[] $line_items
 * @property int|null $app_id
 * @property array|null $billing_address
 * @property string|null $browser_ip
 * @property bool|null $buyer_accepts_marketing
 * @property string|null $cancel_reason
 * @property string|null $cancelled_at
 * @property string|null $cart_token
 * @property string|null $checkout_token
 * @property array|null $client_details
 * @property string|null $closed_at
 * @property string|null $created_at
 * @property string|null $currency
 * @property string|null $current_subtotal_price
 * @property array|null $current_subtotal_price_set
 * @property string|null $current_total_discounts
 * @property array|null $current_total_discounts_set
 * @property array|null $current_total_duties_set
 * @property string|null $current_total_price
 * @property array|null $current_total_price_set
 * @property string|null $current_total_tax
 * @property array|null $current_total_tax_set
 * @property Customer|null $customer
 * @property string|null $customer_locale
 * @property array[]|null $discount_applications
 * @property DiscountCode[]|null $discount_codes
 * @property string|null $email
 * @property bool|null $estimated_taxes
 * @property string|null $financial_status
 * @property string|null $fulfillment_status
 * @property Fulfillment[]|null $fulfillments
 * @property string|null $gateway
 * @property int|null $id
 * @property string|null $landing_site
 * @property int|null $location_id
 * @property string|null $name
 * @property string|null $note
 * @property array[]|null $note_attributes
 * @property int|null $number
 * @property int|null $order_number
 * @property string|null $order_status_url
 * @property array|null $original_total_duties_set
 * @property array|null $payment_details
 * @property string[]|null $payment_gateway_names
 * @property array|null $payment_terms
 * @property string|null $phone
 * @property string|null $presentment_currency
 * @property string|null $processed_at
 * @property string|null $processing_method
 * @property string|null $referring_site
 * @property Refund[]|null $refunds
 * @property array|null $shipping_address
 * @property array[]|null $shipping_lines
 * @property string|null $source_identifier
 * @property string|null $source_name
 * @property string|null $source_url
 * @property float|null $subtotal_price
 * @property array|null $subtotal_price_set
 * @property string|null $tags
 * @property array[]|null $tax_lines
 * @property bool|null $taxes_included
 * @property bool|null $test
 * @property string|null $token
 * @property string|null $total_discounts
 * @property array|null $total_discounts_set
 * @property string|null $total_line_items_price
 * @property array|null $total_line_items_price_set
 * @property string|null $total_outstanding
 * @property string|null $total_price
 * @property array|null $total_price_set
 * @property array|null $total_shipping_price_set
 * @property string|float|null $total_tax
 * @property array|null $total_tax_set
 * @property string|null $total_tip_received
 * @property int|null $total_weight
 * @property string|null $updated_at
 * @property int|null $user_id
 */
class Order extends Base
{
    public static string $API_VERSION = "2022-04";
    protected static array $HAS_ONE = [
        "customer" => Customer::class
    ];
    protected static array $HAS_MANY = [
        "discount_codes" => DiscountCode::class,
        "fulfillments" => Fulfillment::class,
        "refunds" => Refund::class
    ];
    protected static array $PATHS = [
        ["http_method" => "delete", "operation" => "delete", "ids" => ["id"], "path" => "orders/<id>.json"],
        ["http_method" => "get", "operation" => "count", "ids" => [], "path" => "orders/count.json"],
        ["http_method" => "get", "operation" => "get", "ids" => [], "path" => "orders.json"],
        ["http_method" => "get", "operation" => "get", "ids" => ["id"], "path" => "orders/<id>.json"],
        ["http_method" => "post", "operation" => "cancel", "ids" => ["id"], "path" => "orders/<id>/cancel.json"],
        ["http_method" => "post", "operation" => "close", "ids" => ["id"], "path" => "orders/<id>/close.json"],
        ["http_method" => "post", "operation" => "open", "ids" => ["id"], "path" => "orders/<id>/open.json"],
        ["http_method" => "post", "operation" => "post", "ids" => [], "path" => "orders.json"],
        ["http_method" => "put", "operation" => "put", "ids" => ["id"], "path" => "orders/<id>.json"]
    ];

    /**
     * @param Session $session
     * @param int|string $id
     * @param array $urlIds
     * @param mixed[] $params Allowed indexes:
     *     fields
     *
     * @return Order|null
     */
    public static function find(
        Session $session,
        $id,
        array $urlIds = [],
        array $params = []
    ): ?Order {
        $result = parent::baseFind(
            $session,
            array_merge(["id" => $id], $urlIds),
            $params,
        );
        return !empty($result) ? $result[0] : null;
    }

    /**
     * @param Session $session
     * @param int|string $id
     * @param array $urlIds
     * @param mixed[] $params
     *
     * @return array|null
     */
    public static function delete(
        Session $session,
        $id,
        array $urlIds = [],
        array $params = []
    ): ?array {
        $response = parent::request(
            "delete",
            "delete",
            $session,
            array_merge(["id" => $id], $urlIds),
            $params,
        );

        return $response->getDecodedBody();
    }

    /**
     * @param Session $session
     * @param array $urlIds
     * @param mixed[] $params Allowed indexes:
     *     ids,
     *     limit,
     *     since_id,
     *     created_at_min,
     *     created_at_max,
     *     updated_at_min,
     *     updated_at_max,
     *     processed_at_min,
     *     processed_at_max,
     *     attribution_app_id,
     *     status,
     *     financial_status,
     *     fulfillment_status,
     *     fields
     *
     * @return Order[]
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

    /**
     * @param Session $session
     * @param array $urlIds
     * @param mixed[] $params Allowed indexes:
     *     created_at_min,
     *     created_at_max,
     *     updated_at_min,
     *     updated_at_max,
     *     status,
     *     financial_status,
     *     fulfillment_status
     *
     * @return array|null
     */
    public static function count(
        Session $session,
        array $urlIds = [],
        array $params = []
    ): ?array {
        $response = parent::request(
            "get",
            "count",
            $session,
            [],
            $params,
            [],
        );

        return $response->getDecodedBody();
    }

    /**
     * @param mixed[] $params Allowed indexes:
     *     amount,
     *     currency,
     *     restock,
     *     reason,
     *     email,
     *     refund
     * @param array|string $body
     *
     * @return array|null
     */
    public function cancel(
        array $params = [],
        $body = []
    ): ?array {
        $response = parent::request(
            "post",
            "cancel",
            $this->session,
            ["id" => $this->id],
            $params,
            $body,
            $this,
        );

        return $response->getDecodedBody();
    }

    /**
     * @param mixed[] $params
     * @param array|string $body
     *
     * @return array|null
     */
    public function close(
        array $params = [],
        $body = []
    ): ?array {
        $response = parent::request(
            "post",
            "close",
            $this->session,
            ["id" => $this->id],
            $params,
            $body,
            $this,
        );

        return $response->getDecodedBody();
    }

    /**
     * @param mixed[] $params
     * @param array|string $body
     *
     * @return array|null
     */
    public function open(
        array $params = [],
        $body = []
    ): ?array {
        $response = parent::request(
            "post",
            "open",
            $this->session,
            ["id" => $this->id],
            $params,
            $body,
            $this,
        );

        return $response->getDecodedBody();
    }

}
