<?php

declare(strict_types=1);

namespace Shopify\Rest\Admin2021_10;

use Shopify\Auth\Session;
use Shopify\Rest\Base;

/**
 * @property string|null $admin_graphql_api_id
 * @property string|null $commentable
 * @property string|null $created_at
 * @property string|null $feedburner
 * @property string|null $feedburner_location
 * @property string|null $handle
 * @property int|null $id
 * @property Metafield[]|null $metafields
 * @property string|null $tags
 * @property string|null $template_suffix
 * @property string|null $title
 * @property string|null $updated_at
 */
class Blog extends Base
{
    public static string $API_VERSION = "2021-10";
    protected static array $HAS_ONE = [];
    protected static array $HAS_MANY = [
        "metafields" => Metafield::class
    ];
    protected static array $PATHS = [
        ["http_method" => "delete", "operation" => "delete", "ids" => ["id"], "path" => "blogs/<id>.json"],
        ["http_method" => "get", "operation" => "count", "ids" => [], "path" => "blogs/count.json"],
        ["http_method" => "get", "operation" => "get", "ids" => [], "path" => "blogs.json"],
        ["http_method" => "get", "operation" => "get", "ids" => ["id"], "path" => "blogs/<id>.json"],
        ["http_method" => "post", "operation" => "post", "ids" => [], "path" => "blogs.json"],
        ["http_method" => "put", "operation" => "put", "ids" => ["id"], "path" => "blogs/<id>.json"]
    ];

    /**
     * @param Session $session
     * @param int|string $id
     * @param array $urlIds
     * @param mixed[] $params Allowed indexes:
     *     fields
     *
     * @return Blog|null
     */
    public static function find(
        Session $session,
        $id,
        array $urlIds = [],
        array $params = []
    ): ?Blog {
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
     *     handle,
     *     fields
     *
     * @return Blog[]
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
