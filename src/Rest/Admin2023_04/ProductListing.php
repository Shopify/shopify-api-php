<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace Shopify\Rest\Admin2023_04;

use Shopify\Auth\Session;
use Shopify\Rest\Base;

/**
 * @property string|null $body_html
 * @property string|null $created_at
 * @property string|null $handle
 * @property Image[]|null $images
 * @property array[]|null $options
 * @property int|null $product_id
 * @property string|null $product_type
 * @property string|null $published_at
 * @property string|null $tags
 * @property string|null $title
 * @property string|null $updated_at
 * @property Variant[]|null $variants
 * @property string|null $vendor
 */
class ProductListing extends Base
{
    public static string $API_VERSION = "2023-04";
    protected static array $HAS_ONE = [];
    protected static array $HAS_MANY = [
        "images" => Image::class,
        "variants" => Variant::class
    ];
    protected static array $PATHS = [
        ["http_method" => "delete", "operation" => "delete", "ids" => ["product_id"], "path" => "product_listings/<product_id>.json"],
        ["http_method" => "get", "operation" => "count", "ids" => [], "path" => "product_listings/count.json"],
        ["http_method" => "get", "operation" => "get", "ids" => [], "path" => "product_listings.json"],
        ["http_method" => "get", "operation" => "get", "ids" => ["product_id"], "path" => "product_listings/<product_id>.json"],
        ["http_method" => "get", "operation" => "product_ids", "ids" => [], "path" => "product_listings/product_ids.json"],
        ["http_method" => "put", "operation" => "put", "ids" => ["product_id"], "path" => "product_listings/<product_id>.json"]
    ];
    protected static string $PRIMARY_KEY = "product_id";

    /**
     * @param Session $session
     * @param int|string $product_id
     * @param array $urlIds
     * @param mixed[] $params
     *
     * @return ProductListing|null
     */
    public static function find(
        Session $session,
        $product_id,
        array $urlIds = [],
        array $params = []
    ): ?ProductListing {
        $result = parent::baseFind(
            $session,
            array_merge(["product_id" => $product_id], $urlIds),
            $params,
        );
        return !empty($result) ? $result[0] : null;
    }

    /**
     * @param Session $session
     * @param int|string $product_id
     * @param array $urlIds
     * @param mixed[] $params
     *
     * @return array|null
     */
    public static function delete(
        Session $session,
        $product_id,
        array $urlIds = [],
        array $params = []
    ): ?array {
        $response = parent::request(
            "delete",
            "delete",
            $session,
            array_merge(["product_id" => $product_id], $urlIds),
            $params,
        );

        return $response->getDecodedBody();
    }

    /**
     * @param Session $session
     * @param array $urlIds
     * @param mixed[] $params Allowed indexes:
     *     product_ids,
     *     limit,
     *     collection_id,
     *     updated_at_min,
     *     handle
     *
     * @return ProductListing[]
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

    /**
     * @param Session $session
     * @param array $urlIds
     * @param mixed[] $params Allowed indexes:
     *     limit
     *
     * @return array|null
     */
    public static function product_ids(
        Session $session,
        array $urlIds = [],
        array $params = []
    ): ?array {
        $response = parent::request(
            "get",
            "product_ids",
            $session,
            [],
            $params,
            [],
        );

        return $response->getDecodedBody();
    }

}
