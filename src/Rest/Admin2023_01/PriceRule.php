<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace Shopify\Rest\Admin2023_01;

use Shopify\Auth\Session;
use Shopify\Rest\Base;

/**
 * @property int|null $allocation_limit
 * @property string|null $allocation_method
 * @property string|null $created_at
 * @property int[]|null $customer_segment_prerequisite_ids
 * @property string|null $customer_selection
 * @property string|null $ends_at
 * @property int[]|null $entitled_collection_ids
 * @property int[]|null $entitled_country_ids
 * @property int[]|null $entitled_product_ids
 * @property int[]|null $entitled_variant_ids
 * @property int|null $id
 * @property bool|null $once_per_customer
 * @property int[]|null $prerequisite_collection_ids
 * @property int[]|null $prerequisite_customer_ids
 * @property int[]|null $prerequisite_product_ids
 * @property array|null $prerequisite_quantity_range
 * @property array|null $prerequisite_shipping_price_range
 * @property array|null $prerequisite_subtotal_range
 * @property array|null $prerequisite_to_entitlement_purchase
 * @property array|null $prerequisite_to_entitlement_quantity_ratio
 * @property int[]|null $prerequisite_variant_ids
 * @property string|null $starts_at
 * @property string|null $target_selection
 * @property string|null $target_type
 * @property string|null $title
 * @property string|null $updated_at
 * @property int|null $usage_limit
 * @property string|null $value
 * @property string|null $value_type
 */
class PriceRule extends Base
{
    public static string $API_VERSION = "2023-01";
    protected static array $HAS_ONE = [];
    protected static array $HAS_MANY = [];
    protected static array $PATHS = [
        ["http_method" => "delete", "operation" => "delete", "ids" => ["id"], "path" => "price_rules/<id>.json"],
        ["http_method" => "get", "operation" => "count", "ids" => [], "path" => "price_rules/count.json"],
        ["http_method" => "get", "operation" => "get", "ids" => [], "path" => "price_rules.json"],
        ["http_method" => "get", "operation" => "get", "ids" => ["id"], "path" => "price_rules/<id>.json"],
        ["http_method" => "post", "operation" => "post", "ids" => [], "path" => "price_rules.json"],
        ["http_method" => "put", "operation" => "put", "ids" => ["id"], "path" => "price_rules/<id>.json"]
    ];

    /**
     * @param Session $session
     * @param int|string $id
     * @param array $urlIds
     * @param mixed[] $params
     *
     * @return PriceRule|null
     */
    public static function find(
        Session $session,
        $id,
        array $urlIds = [],
        array $params = []
    ): ?PriceRule {
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
     *     limit,
     *     since_id,
     *     created_at_min,
     *     created_at_max,
     *     updated_at_min,
     *     updated_at_max,
     *     starts_at_min,
     *     starts_at_max,
     *     ends_at_min,
     *     ends_at_max,
     *     times_used
     *
     * @return PriceRule[]
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
     * @param mixed[] $params
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

}
