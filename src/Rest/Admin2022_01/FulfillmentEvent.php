<?php

declare(strict_types=1);

namespace Shopify\Rest\Admin2022_01;

use Shopify\Auth\Session;
use Shopify\Rest\Base;

/**
 * @property string|null $address1
 * @property string|null $city
 * @property Country|null $country
 * @property string|null $created_at
 * @property string|null $estimated_delivery_at
 * @property int|null $fulfillment_id
 * @property string|null $happened_at
 * @property int|null $id
 * @property float|null $latitude
 * @property float|null $longitude
 * @property string|null $message
 * @property int|null $order_id
 * @property Province|null $province
 * @property int|null $shop_id
 * @property string|null $status
 * @property string|null $updated_at
 * @property string|null $zip
 */
class FulfillmentEvent extends Base
{
    public static string $API_VERSION = "2022-01";
    protected static array $HAS_ONE = [
        "country" => Country::class,
        "province" => Province::class
    ];
    protected static array $HAS_MANY = [];
    protected static array $PATHS = [
        ["http_method" => "delete", "operation" => "delete", "ids" => ["order_id", "fulfillment_id", "id"], "path" => "orders/<order_id>/fulfillments/<fulfillment_id>/events/<id>.json"],
        ["http_method" => "get", "operation" => "get", "ids" => ["order_id", "fulfillment_id"], "path" => "orders/<order_id>/fulfillments/<fulfillment_id>/events.json"],
        ["http_method" => "get", "operation" => "get", "ids" => ["order_id", "fulfillment_id", "id"], "path" => "orders/<order_id>/fulfillments/<fulfillment_id>/events/<id>.json"],
        ["http_method" => "post", "operation" => "post", "ids" => ["order_id", "fulfillment_id"], "path" => "orders/<order_id>/fulfillments/<fulfillment_id>/events.json"]
    ];

    /**

     *
     * @return string
     */
    protected static function getJsonBodyName(): string
    {
        return "event";
    }

    /**
     * @param Session $session
     * @param int|string $id
     * @param array $urlIds Allowed indexes:
     *     order_id
     *     fulfillment_id
     * @param mixed[] $params Allowed indexes:
     *     event_id
     *
     * @return FulfillmentEvent|null
     */
    public static function find(
        Session $session,
        $id,
        array $urlIds = [],
        array $params = []
    ): ?FulfillmentEvent {
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
     * @param array $urlIds Allowed indexes:
     *     order_id
     *     fulfillment_id
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
     * @param array $urlIds Allowed indexes:
     *     order_id
     *     fulfillment_id
     * @param mixed[] $params
     *
     * @return FulfillmentEvent[]
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

}
