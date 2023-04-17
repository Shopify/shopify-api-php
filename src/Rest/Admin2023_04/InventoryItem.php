<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace Shopify\Rest\Admin2023_04;

use Shopify\Auth\Session;
use Shopify\Rest\Base;

/**
 * @property string|null $cost
 * @property string|null $country_code_of_origin
 * @property array[]|null $country_harmonized_system_codes
 * @property string|null $created_at
 * @property int|null $harmonized_system_code
 * @property int|null $id
 * @property string|null $province_code_of_origin
 * @property bool|null $requires_shipping
 * @property string|null $sku
 * @property bool|null $tracked
 * @property string|null $updated_at
 */
class InventoryItem extends Base
{
    public static string $API_VERSION = "2023-04";
    protected static array $HAS_ONE = [];
    protected static array $HAS_MANY = [];
    protected static array $PATHS = [
        ["http_method" => "get", "operation" => "get", "ids" => [], "path" => "inventory_items.json"],
        ["http_method" => "get", "operation" => "get", "ids" => ["id"], "path" => "inventory_items/<id>.json"],
        ["http_method" => "put", "operation" => "put", "ids" => ["id"], "path" => "inventory_items/<id>.json"]
    ];

    /**
     * @param Session $session
     * @param int|string $id
     * @param array $urlIds
     * @param mixed[] $params
     *
     * @return InventoryItem|null
     */
    public static function find(
        Session $session,
        $id,
        array $urlIds = [],
        array $params = []
    ): ?InventoryItem {
        $result = parent::baseFind(
            $session,
            array_merge(["id" => $id], $urlIds),
            $params,
        );
        return !empty($result) ? $result[0] : null;
    }

    /**
     * @param Session $session
     * @param array $urlIds
     * @param mixed[] $params Allowed indexes:
     *     ids,
     *     limit
     *
     * @return InventoryItem[]
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
