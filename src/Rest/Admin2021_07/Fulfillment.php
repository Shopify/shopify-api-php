<?php

declare(strict_types=1);

namespace Shopify\Rest\Admin2021_07;

use Shopify\Auth\Session;
use Shopify\Rest\Base;

/**
 * @property string|null $created_at
 * @property int|null $id
 * @property array[]|null $line_items
 * @property int|null $location_id
 * @property string|null $name
 * @property bool|null $notify_customer
 * @property int|null $order_id
 * @property array|null $receipt
 * @property string|null $service
 * @property string|null $shipment_status
 * @property string|null $status
 * @property string|null $tracking_company
 * @property string[]|null $tracking_numbers
 * @property string[]|null $tracking_urls
 * @property string|null $updated_at
 * @property string|null $variant_inventory_management
 */
class Fulfillment extends Base
{
    public static string $API_VERSION = "2021-07";
    protected static array $HAS_ONE = [];
    protected static array $HAS_MANY = [];
    protected static array $PATHS = [
        ["http_method" => "get", "operation" => "count", "ids" => ["order_id"], "path" => "orders/<order_id>/fulfillments/count.json"],
        ["http_method" => "get", "operation" => "get", "ids" => ["fulfillment_order_id"], "path" => "fulfillment_orders/<fulfillment_order_id>/fulfillments.json"],
        ["http_method" => "get", "operation" => "get", "ids" => ["order_id"], "path" => "orders/<order_id>/fulfillments.json"],
        ["http_method" => "get", "operation" => "get", "ids" => ["order_id", "id"], "path" => "orders/<order_id>/fulfillments/<id>.json"],
        ["http_method" => "post", "operation" => "update_tracking", "ids" => ["id"], "path" => "fulfillments/<id>/update_tracking.json"]
    ];

    /**
     * @param Session $session
     * @param int|string $id
     * @param array $urlIds Allowed indexes:
     *     order_id
     * @param mixed[] $params Allowed indexes:
     *     fields
     *
     * @return Fulfillment|null
     */
    public static function find(
        Session $session,
        $id,
        array $urlIds = [],
        array $params = []
    ): ?Fulfillment {
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
     *     fulfillment_order_id
     *     order_id
     * @param mixed[] $params Allowed indexes:
     *     created_at_max,
     *     created_at_min,
     *     fields,
     *     limit,
     *     since_id,
     *     updated_at_max,
     *     updated_at_min
     *
     * @return Fulfillment[]
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
     * @param Session $session
     * @param array $urlIds Allowed indexes:
     *     order_id
     * @param mixed[] $params Allowed indexes:
     *     created_at_min,
     *     created_at_max,
     *     updated_at_min,
     *     updated_at_max
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
            $urlIds,
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
    public function update_tracking(
        array $params = [],
        $body = []
    ): ?array {
        $response = parent::request(
            "post",
            "update_tracking",
            $this->session,
            ["id" => $this->id],
            $params,
            $body,
            $this,
        );

        return $response->getDecodedBody();
    }

}
