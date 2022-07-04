<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace Shopify\Rest\Admin2022_07;

use Shopify\Auth\Session;
use Shopify\Rest\Base;

/**
 * @property string|null $barcode
 * @property string|null $compare_at_price
 * @property string|null $created_at
 * @property string|null $fulfillment_service
 * @property int|null $grams
 * @property int|null $id
 * @property int|null $image_id
 * @property int|null $inventory_item_id
 * @property string|null $inventory_management
 * @property string|null $inventory_policy
 * @property int|null $inventory_quantity
 * @property int|null $inventory_quantity_adjustment
 * @property int|null $old_inventory_quantity
 * @property array|null $option
 * @property int|null $position
 * @property array[]|null $presentment_prices
 * @property string|null $price
 * @property int|null $product_id
 * @property bool|null $requires_shipping
 * @property string|null $sku
 * @property string|null $tax_code
 * @property bool|null $taxable
 * @property string|null $title
 * @property string|null $updated_at
 * @property float|null $weight
 * @property string|null $weight_unit
 */
class Variant extends Base
{
    public static string $API_VERSION = "2022-07";
    protected static array $HAS_ONE = [];
    protected static array $HAS_MANY = [];
    protected static array $PATHS = [
        ["http_method" => "delete", "operation" => "delete", "ids" => ["product_id", "id"], "path" => "products/<product_id>/variants/<id>.json"],
        ["http_method" => "get", "operation" => "count", "ids" => ["product_id"], "path" => "products/<product_id>/variants/count.json"],
        ["http_method" => "get", "operation" => "get", "ids" => ["product_id"], "path" => "products/<product_id>/variants.json"],
        ["http_method" => "get", "operation" => "get", "ids" => ["id"], "path" => "variants/<id>.json"],
        ["http_method" => "post", "operation" => "post", "ids" => ["product_id"], "path" => "products/<product_id>/variants.json"],
        ["http_method" => "put", "operation" => "put", "ids" => ["id"], "path" => "variants/<id>.json"]
    ];
    protected static array $READ_ONLY_ATTRIBUTES = [
        "inventory_quantity",
        "inventory_quantity_adjustment"
    ];

    /**
     * @param Session $session
     * @param int|string $id
     * @param array $urlIds
     * @param mixed[] $params Allowed indexes:
     *     fields
     *
     * @return Variant|null
     */
    public static function find(
        Session $session,
        $id,
        array $urlIds = [],
        array $params = []
    ): ?Variant {
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
     *     product_id
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
     *     product_id
     * @param mixed[] $params Allowed indexes:
     *     limit,
     *     presentment_currencies,
     *     since_id,
     *     fields
     *
     * @return Variant[]
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
     *     product_id
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
            $urlIds,
            $params,
            [],
        );

        return $response->getDecodedBody();
    }

}
