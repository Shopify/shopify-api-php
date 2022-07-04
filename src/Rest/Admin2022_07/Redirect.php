<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace Shopify\Rest\Admin2022_07;

use Shopify\Auth\Session;
use Shopify\Rest\Base;

/**
 * @property int|null $id
 * @property string|null $path
 * @property string|null $target
 */
class Redirect extends Base
{
    public static string $API_VERSION = "2022-07";
    protected static array $HAS_ONE = [];
    protected static array $HAS_MANY = [];
    protected static array $PATHS = [
        ["http_method" => "delete", "operation" => "delete", "ids" => ["id"], "path" => "redirects/<id>.json"],
        ["http_method" => "get", "operation" => "count", "ids" => [], "path" => "redirects/count.json"],
        ["http_method" => "get", "operation" => "get", "ids" => [], "path" => "redirects.json"],
        ["http_method" => "get", "operation" => "get", "ids" => ["id"], "path" => "redirects/<id>.json"],
        ["http_method" => "post", "operation" => "post", "ids" => [], "path" => "redirects.json"],
        ["http_method" => "put", "operation" => "put", "ids" => ["id"], "path" => "redirects/<id>.json"]
    ];

    /**
     * @param Session $session
     * @param int|string $id
     * @param array $urlIds
     * @param mixed[] $params Allowed indexes:
     *     fields
     *
     * @return Redirect|null
     */
    public static function find(
        Session $session,
        $id,
        array $urlIds = [],
        array $params = []
    ): ?Redirect {
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
     *     path,
     *     target,
     *     fields
     *
     * @return Redirect[]
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
     *     path,
     *     target
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
