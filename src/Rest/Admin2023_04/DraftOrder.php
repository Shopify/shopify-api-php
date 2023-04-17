<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace Shopify\Rest\Admin2023_04;

use Shopify\Auth\Session;
use Shopify\Rest\Base;

/**
 * @property array|null $applied_discount
 * @property array|null $billing_address
 * @property string|null $completed_at
 * @property string|null $created_at
 * @property string|null $currency
 * @property Customer|null $customer
 * @property string|null $email
 * @property int|null $id
 * @property string|null $invoice_sent_at
 * @property string|null $invoice_url
 * @property array[]|null $line_items
 * @property string|null $name
 * @property string|null $note
 * @property array[]|null $note_attributes
 * @property int|null $order_id
 * @property array|null $payment_terms
 * @property array|null $shipping_address
 * @property array|null $shipping_line
 * @property string|null $source_name
 * @property string|null $status
 * @property float|null $subtotal_price
 * @property string|null $tags
 * @property bool|null $tax_exempt
 * @property string[]|null $tax_exemptions
 * @property array[]|null $tax_lines
 * @property bool|null $taxes_included
 * @property string|null $total_price
 * @property string|null $total_tax
 * @property string|null $updated_at
 */
class DraftOrder extends Base
{
    public static string $API_VERSION = "2023-04";
    protected static array $HAS_ONE = [
        "customer" => Customer::class
    ];
    protected static array $HAS_MANY = [];
    protected static array $PATHS = [
        ["http_method" => "delete", "operation" => "delete", "ids" => ["id"], "path" => "draft_orders/<id>.json"],
        ["http_method" => "get", "operation" => "count", "ids" => [], "path" => "draft_orders/count.json"],
        ["http_method" => "get", "operation" => "get", "ids" => [], "path" => "draft_orders.json"],
        ["http_method" => "get", "operation" => "get", "ids" => ["id"], "path" => "draft_orders/<id>.json"],
        ["http_method" => "post", "operation" => "post", "ids" => [], "path" => "draft_orders.json"],
        ["http_method" => "post", "operation" => "send_invoice", "ids" => ["id"], "path" => "draft_orders/<id>/send_invoice.json"],
        ["http_method" => "put", "operation" => "complete", "ids" => ["id"], "path" => "draft_orders/<id>/complete.json"],
        ["http_method" => "put", "operation" => "put", "ids" => ["id"], "path" => "draft_orders/<id>.json"]
    ];

    /**
     * @param Session $session
     * @param int|string $id
     * @param array $urlIds
     * @param mixed[] $params Allowed indexes:
     *     fields
     *
     * @return DraftOrder|null
     */
    public static function find(
        Session $session,
        $id,
        array $urlIds = [],
        array $params = []
    ): ?DraftOrder {
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
     *     fields,
     *     limit,
     *     since_id,
     *     updated_at_min,
     *     updated_at_max,
     *     ids,
     *     status
     *
     * @return DraftOrder[]
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
     *     since_id,
     *     status,
     *     updated_at_max,
     *     updated_at_min
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
     * @param mixed[] $params
     * @param array|string $body
     *
     * @return array|null
     */
    public function send_invoice(
        array $params = [],
        $body = []
    ): ?array {
        $response = parent::request(
            "post",
            "send_invoice",
            $this->session,
            ["id" => $this->id],
            $params,
            $body,
            $this,
        );

        return $response->getDecodedBody();
    }

    /**
     * @param mixed[] $params Allowed indexes:
     *     payment_gateway_id,
     *     payment_pending
     * @param array|string $body
     *
     * @return array|null
     */
    public function complete(
        array $params = [],
        $body = []
    ): ?array {
        $response = parent::request(
            "put",
            "complete",
            $this->session,
            ["id" => $this->id],
            $params,
            $body,
            $this,
        );

        return $response->getDecodedBody();
    }

}
