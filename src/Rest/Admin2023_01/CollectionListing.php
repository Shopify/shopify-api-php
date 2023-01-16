<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace Shopify\Rest\Admin2023_01;

use Shopify\Auth\Session;
use Shopify\Rest\Base;

/**
 * @property string|null $body_html
 * @property int|null $collection_id
 * @property array[]|null $default_product_image
 * @property string|null $handle
 * @property Image|null $image
 * @property string|null $published_at
 * @property string|null $sort_order
 * @property string|null $title
 * @property string|null $updated_at
 */
class CollectionListing extends Base
{
    public static string $API_VERSION = "2023-01";
    protected static array $HAS_ONE = [
        "image" => Image::class
    ];
    protected static array $HAS_MANY = [];
    protected static array $PATHS = [
        ["http_method" => "delete", "operation" => "delete", "ids" => ["collection_id"], "path" => "collection_listings/<collection_id>.json"],
        ["http_method" => "get", "operation" => "get", "ids" => [], "path" => "collection_listings.json"],
        ["http_method" => "get", "operation" => "get", "ids" => ["collection_id"], "path" => "collection_listings/<collection_id>.json"],
        ["http_method" => "get", "operation" => "product_ids", "ids" => ["collection_id"], "path" => "collection_listings/<collection_id>/product_ids.json"],
        ["http_method" => "put", "operation" => "put", "ids" => ["collection_id"], "path" => "collection_listings/<collection_id>.json"]
    ];
    protected static string $PRIMARY_KEY = "collection_id";

    /**
     * @param Session $session
     * @param int|string $collection_id
     * @param array $urlIds
     * @param mixed[] $params
     *
     * @return CollectionListing|null
     */
    public static function find(
        Session $session,
        $collection_id,
        array $urlIds = [],
        array $params = []
    ): ?CollectionListing {
        $result = parent::baseFind(
            $session,
            array_merge(["collection_id" => $collection_id], $urlIds),
            $params,
        );
        return !empty($result) ? $result[0] : null;
    }

    /**
     * @param Session $session
     * @param int|string $collection_id
     * @param array $urlIds
     * @param mixed[] $params
     *
     * @return array|null
     */
    public static function delete(
        Session $session,
        $collection_id,
        array $urlIds = [],
        array $params = []
    ): ?array {
        $response = parent::request(
            "delete",
            "delete",
            $session,
            array_merge(["collection_id" => $collection_id], $urlIds),
            $params,
        );

        return $response->getDecodedBody();
    }

    /**
     * @param Session $session
     * @param array $urlIds
     * @param mixed[] $params Allowed indexes:
     *     limit
     *
     * @return CollectionListing[]
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
     * @param int|string $collection_id
     * @param array $urlIds
     * @param mixed[] $params Allowed indexes:
     *     limit
     *
     * @return array|null
     */
    public static function product_ids(
        Session $session,
        $collection_id,
        array $urlIds = [],
        array $params = []
    ): ?array {
        $response = parent::request(
            "get",
            "product_ids",
            $session,
            array_merge(["collection_id" => $collection_id], $urlIds),
            $params,
            [],
        );

        return $response->getDecodedBody();
    }

}
