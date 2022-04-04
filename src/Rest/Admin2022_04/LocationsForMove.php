<?php

declare(strict_types=1);

namespace Shopify\Rest\Admin2022_04;

use Shopify\Auth\Session;
use Shopify\Rest\Base;

/**
 * @property array[]|null $locations_for_move
 */
class LocationsForMove extends Base
{
    public static string $API_VERSION = "2022-04";
    protected static array $HAS_ONE = [];
    protected static array $HAS_MANY = [];
    protected static array $PATHS = [
        ["http_method" => "get", "operation" => "get", "ids" => ["fulfillment_order_id"], "path" => "fulfillment_orders/<fulfillment_order_id>/locations_for_move.json"]
    ];

    /**
     * @param Session $session
     * @param array $urlIds Allowed indexes:
     *     fulfillment_order_id
     * @param mixed[] $params
     *
     * @return LocationsForMove[]
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
