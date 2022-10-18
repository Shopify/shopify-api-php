<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace Shopify\Rest\Admin2022_10;

use Shopify\Auth\Session;
use Shopify\Rest\Base;

/**
 * @property string $address
 * @property string $topic
 * @property string|null $api_version
 * @property string|null $created_at
 * @property string[]|null $fields
 * @property string|null $format
 * @property int|null $id
 * @property string[]|null $metafield_namespaces
 * @property string[]|null $private_metafield_namespaces
 * @property string|null $updated_at
 */
class Webhook extends Base
{
    public static string $API_VERSION = "2022-10";
    protected static array $HAS_ONE = [];
    protected static array $HAS_MANY = [];
    protected static array $PATHS = [
        ["http_method" => "delete", "operation" => "delete", "ids" => ["id"], "path" => "webhooks/<id>.json"],
        ["http_method" => "get", "operation" => "count", "ids" => [], "path" => "webhooks/count.json"],
        ["http_method" => "get", "operation" => "get", "ids" => [], "path" => "webhooks.json"],
        ["http_method" => "get", "operation" => "get", "ids" => ["id"], "path" => "webhooks/<id>.json"],
        ["http_method" => "post", "operation" => "post", "ids" => [], "path" => "webhooks.json"],
        ["http_method" => "put", "operation" => "put", "ids" => ["id"], "path" => "webhooks/<id>.json"]
    ];

    /**
     * @param Session $session
     * @param int|string $id
     * @param array $urlIds
     * @param mixed[] $params Allowed indexes:
     *     fields
     *
     * @return Webhook|null
     */
    public static function find(
        Session $session,
        $id,
        array $urlIds = [],
        array $params = []
    ): ?Webhook {
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
     *     address,
     *     created_at_max,
     *     created_at_min,
     *     fields,
     *     limit,
     *     since_id,
     *     topic,
     *     updated_at_min,
     *     updated_at_max
     *
     * @return Webhook[]
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
     *     address,
     *     topic
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
