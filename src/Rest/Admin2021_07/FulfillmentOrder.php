<?php

declare(strict_types=1);

namespace Shopify\Rest\Admin2021_07;

use Shopify\Auth\Session;
use Shopify\Rest\Base;

/**
 * @property array|null $assigned_location
 * @property int|null $assigned_location_id
 * @property array|null $delivery_method
 * @property array|null $destination
 * @property string|null $fulfill_at
 * @property int|null $id
 * @property array|null $international_duties
 * @property array[]|null $line_items
 * @property array[]|null $merchant_requests
 * @property int|null $order_id
 * @property string|null $request_status
 * @property int|null $shop_id
 * @property string|null $status
 * @property string[]|null $supported_actions
 */
class FulfillmentOrder extends Base
{
    public static string $API_VERSION = "2021-07";
    protected static array $HAS_ONE = [];
    protected static array $HAS_MANY = [];
    protected static array $PATHS = [
        ["http_method" => "get", "operation" => "get", "ids" => ["id"], "path" => "fulfillment_orders/<id>.json"],
        ["http_method" => "get", "operation" => "get", "ids" => ["order_id"], "path" => "orders/<order_id>/fulfillment_orders.json"],
        ["http_method" => "post", "operation" => "cancel", "ids" => ["id"], "path" => "fulfillment_orders/<id>/cancel.json"],
        ["http_method" => "post", "operation" => "close", "ids" => ["id"], "path" => "fulfillment_orders/<id>/close.json"],
        ["http_method" => "post", "operation" => "move", "ids" => ["id"], "path" => "fulfillment_orders/<id>/move.json"],
        ["http_method" => "post", "operation" => "open", "ids" => ["id"], "path" => "fulfillment_orders/<id>/open.json"],
        ["http_method" => "post", "operation" => "reschedule", "ids" => ["id"], "path" => "fulfillment_orders/<id>/reschedule.json"]
    ];

    /**
     * @param Session $session
     * @param int|string $id
     * @param array $urlIds
     * @param mixed[] $params
     *
     * @return FulfillmentOrder|null
     */
    public static function find(
        Session $session,
        $id,
        array $urlIds = [],
        array $params = []
    ): ?FulfillmentOrder {
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
     * @param mixed[] $params
     *
     * @return FulfillmentOrder[]
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
     * @param mixed[] $params
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
     * @param mixed[] $params Allowed indexes:
     *     message
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
     * @param mixed[] $params Allowed indexes:
     *     new_location_id
     * @param array|string $body
     *
     * @return array|null
     */
    public function move(
        array $params = [],
        $body = []
    ): ?array {
        $response = parent::request(
            "post",
            "move",
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

    /**
     * @param mixed[] $params
     * @param array|string $body
     *
     * @return array|null
     */
    public function reschedule(
        array $params = [],
        $body = []
    ): ?array {
        $response = parent::request(
            "post",
            "reschedule",
            $this->session,
            ["id" => $this->id],
            $params,
            $body,
            $this,
        );

        return $response->getDecodedBody();
    }

}
