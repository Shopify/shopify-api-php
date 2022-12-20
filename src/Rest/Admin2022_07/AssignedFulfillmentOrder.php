<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace Shopify\Rest\Admin2022_07;

use Shopify\Auth\Session;
use Shopify\Rest\Base;

/**
 * @property int|null $assigned_location_id
 * @property array|null $destination
 * @property int|null $id
 * @property array[]|null $line_items
 * @property int|null $order_id
 * @property string|null $request_status
 * @property int|null $shop_id
 * @property string|null $status
 */
class AssignedFulfillmentOrder extends Base
{
    public static string $API_VERSION = "2022-07";
    protected static array $HAS_ONE = [];
    protected static array $HAS_MANY = [];
    protected static array $PATHS = [
        ["http_method" => "get", "operation" => "get", "ids" => [], "path" => "assigned_fulfillment_orders.json"]
    ];

    /**

     *
     * @return string
     */
    protected static function getJsonResponseBodyName(): string
    {
        return "fulfillment_order";
    }

    /**
     * @param Session $session
     * @param array $urlIds
     * @param mixed[] $params Allowed indexes:
     *     assignment_status,
     *     location_ids
     *
     * @return AssignedFulfillmentOrder[]
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
