<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace Shopify\Rest\Admin2022_07;

use Shopify\Auth\Session;
use Shopify\Rest\Base;

/**
 * @property string|null $created_at
 * @property array[]|null $duties
 * @property int|null $id
 * @property string|null $note
 * @property array[]|null $order_adjustments
 * @property int|null $order_id
 * @property string|null $processed_at
 * @property array[]|null $refund_duties
 * @property array[]|null $refund_line_items
 * @property bool|null $restock
 * @property Transaction[]|null $transactions
 * @property int|null $user_id
 */
class Refund extends Base
{
    public static string $API_VERSION = "2022-07";
    protected static array $HAS_ONE = [];
    protected static array $HAS_MANY = [
        "transactions" => Transaction::class
    ];
    protected static array $PATHS = [
        ["http_method" => "get", "operation" => "get", "ids" => ["order_id"], "path" => "orders/<order_id>/refunds.json"],
        ["http_method" => "get", "operation" => "get", "ids" => ["order_id", "id"], "path" => "orders/<order_id>/refunds/<id>.json"],
        ["http_method" => "post", "operation" => "calculate", "ids" => ["order_id"], "path" => "orders/<order_id>/refunds/calculate.json"],
        ["http_method" => "post", "operation" => "post", "ids" => ["order_id"], "path" => "orders/<order_id>/refunds.json"]
    ];

    /**
     * @param Session $session
     * @param int|string $id
     * @param array $urlIds Allowed indexes:
     *     order_id
     * @param mixed[] $params Allowed indexes:
     *     fields,
     *     in_shop_currency
     *
     * @return Refund|null
     */
    public static function find(
        Session $session,
        $id,
        array $urlIds = [],
        array $params = []
    ): ?Refund {
        $result = parent::baseFind(
            $session,
            array_merge(["id" => $id], $urlIds),
            $params,
        );
        return !empty($result) ? $result[0] : null;
    }

    /**
     * @param Session $session
     * @param array $urlIds Allowed indexes:
     *     order_id
     * @param mixed[] $params Allowed indexes:
     *     limit,
     *     fields,
     *     in_shop_currency
     *
     * @return Refund[]
     */
    public static function all(
        Session $session,
        array $urlIds = [],
        array $params = []
    ): array {
        return parent::baseFind(
            $session,
            $urlIds,
            $params,
        );
    }

    /**
     * @param mixed[] $params Allowed indexes:
     *     shipping,
     *     refund_line_items,
     *     currency
     * @param array|string $body
     *
     * @return array|null
     */
    public function calculate(
        array $params = [],
        $body = []
    ): ?array {
        $response = parent::request(
            "post",
            "calculate",
            $this->session,
            ["order_id" => $this->order_id],
            $params,
            $body,
            $this,
        );

        return $response->getDecodedBody();
    }

}
