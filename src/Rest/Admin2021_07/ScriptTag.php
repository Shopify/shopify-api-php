<?php

declare(strict_types=1);

namespace Shopify\Rest\Admin2021_07;

use Shopify\Auth\Session;
use Shopify\Rest\Base;

/**
 * @property string $event
 * @property string $src
 * @property bool|null $cache
 * @property string|null $created_at
 * @property string|null $display_scope
 * @property int|null $id
 * @property string|null $updated_at
 */
class ScriptTag extends Base
{
    public static string $API_VERSION = "2021-07";
    protected static array $HAS_ONE = [];
    protected static array $HAS_MANY = [];
    protected static array $PATHS = [
        ["http_method" => "delete", "operation" => "delete", "ids" => ["id"], "path" => "script_tags/<id>.json"],
        ["http_method" => "get", "operation" => "count", "ids" => [], "path" => "script_tags/count.json"],
        ["http_method" => "get", "operation" => "get", "ids" => [], "path" => "script_tags.json"],
        ["http_method" => "get", "operation" => "get", "ids" => ["id"], "path" => "script_tags/<id>.json"],
        ["http_method" => "post", "operation" => "post", "ids" => [], "path" => "script_tags.json"],
        ["http_method" => "put", "operation" => "put", "ids" => ["id"], "path" => "script_tags/<id>.json"]
    ];

    /**
     * @param Session $session
     * @param int|string $id
     * @param array $urlIds
     * @param mixed[] $params Allowed indexes:
     *     fields
     *
     * @return ScriptTag|null
     */
    public static function find(
        Session $session,
        $id,
        array $urlIds = [],
        array $params = []
    ): ?ScriptTag {
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
     *     src,
     *     fields
     *
     * @return ScriptTag[]
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
     * @param mixed[] $params Allowed indexes:
     *     src
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
