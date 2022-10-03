<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace Shopify\Rest\Admin2022_04;

use Shopify\Auth\Session;
use Shopify\Rest\Base;

/**
 * @property string|null $code
 * @property int|null $id
 * @property string|null $name
 * @property Province[]|null $provinces
 * @property float|null $tax
 */
class Country extends Base
{
    public static string $API_VERSION = "2022-04";
    protected static array $HAS_ONE = [];
    protected static array $HAS_MANY = [
        "provinces" => Province::class
    ];
    protected static array $PATHS = [
        ["http_method" => "delete", "operation" => "delete", "ids" => ["id"], "path" => "countries/<id>.json"],
        ["http_method" => "get", "operation" => "count", "ids" => [], "path" => "countries/count.json"],
        ["http_method" => "get", "operation" => "get", "ids" => [], "path" => "countries.json"],
        ["http_method" => "get", "operation" => "get", "ids" => ["id"], "path" => "countries/<id>.json"],
        ["http_method" => "post", "operation" => "post", "ids" => [], "path" => "countries.json"],
        ["http_method" => "put", "operation" => "put", "ids" => ["id"], "path" => "countries/<id>.json"]
    ];

    /**
     * @param Session $session
     * @param int|string $id
     * @param array $urlIds
     * @param mixed[] $params Allowed indexes:
     *     fields
     *
     * @return Country|null
     */
    public static function find(
        Session $session,
        $id,
        array $urlIds = [],
        array $params = []
    ): ?Country {
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
     *     since_id,
     *     fields
     *
     * @return Country[]
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
