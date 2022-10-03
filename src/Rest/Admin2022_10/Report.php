<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace Shopify\Rest\Admin2022_10;

use Shopify\Auth\Session;
use Shopify\Rest\Base;

/**
 * @property string|null $category
 * @property int|null $id
 * @property string|null $name
 * @property string|null $shopify_ql
 * @property string|null $updated_at
 */
class Report extends Base
{
    public static string $API_VERSION = "2022-10";
    protected static array $HAS_ONE = [];
    protected static array $HAS_MANY = [];
    protected static array $PATHS = [
        ["http_method" => "delete", "operation" => "delete", "ids" => ["id"], "path" => "reports/<id>.json"],
        ["http_method" => "get", "operation" => "get", "ids" => [], "path" => "reports.json"],
        ["http_method" => "get", "operation" => "get", "ids" => ["id"], "path" => "reports/<id>.json"],
        ["http_method" => "post", "operation" => "post", "ids" => [], "path" => "reports.json"],
        ["http_method" => "put", "operation" => "put", "ids" => ["id"], "path" => "reports/<id>.json"]
    ];

    /**
     * @param Session $session
     * @param int|string $id
     * @param array $urlIds
     * @param mixed[] $params Allowed indexes:
     *     fields
     *
     * @return Report|null
     */
    public static function find(
        Session $session,
        $id,
        array $urlIds = [],
        array $params = []
    ): ?Report {
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
     *     ids,
     *     limit,
     *     since_id,
     *     updated_at_min,
     *     updated_at_max,
     *     fields
     *
     * @return Report[]
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
