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
 * @property int|null $height
 * @property int|null $id
 * @property int|null $position
 * @property int|null $product_id
 * @property string|null $src
 * @property string|null $updated_at
 * @property int[]|null $variant_ids
 * @property int|null $width
 */
class Image extends Base
{
    public static string $API_VERSION = "2022-07";
    protected static array $HAS_ONE = [];
    protected static array $HAS_MANY = [];
    protected static array $PATHS = [
        ["http_method" => "delete", "operation" => "delete", "ids" => ["product_id", "id"], "path" => "products/<product_id>/images/<id>.json"],
        ["http_method" => "get", "operation" => "count", "ids" => ["product_id"], "path" => "products/<product_id>/images/count.json"],
        ["http_method" => "get", "operation" => "get", "ids" => ["product_id"], "path" => "products/<product_id>/images.json"],
        ["http_method" => "get", "operation" => "get", "ids" => ["product_id", "id"], "path" => "products/<product_id>/images/<id>.json"],
        ["http_method" => "post", "operation" => "post", "ids" => ["product_id"], "path" => "products/<product_id>/images.json"],
        ["http_method" => "put", "operation" => "put", "ids" => ["product_id", "id"], "path" => "products/<product_id>/images/<id>.json"]
    ];

    /**
     * @param Session $session
     * @param int|string $id
     * @param array $urlIds Allowed indexes:
     *     product_id
     * @param mixed[] $params Allowed indexes:
     *     fields
     *
     * @return Image|null
     */
    public static function find(
        Session $session,
        $id,
        array $urlIds = [],
        array $params = []
    ): ?Image {
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
     *     since_id,
     *     fields
     *
     * @return Image[]
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
     * @param mixed[] $params Allowed indexes:
     *     since_id
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
