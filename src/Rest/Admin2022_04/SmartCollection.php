<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace Shopify\Rest\Admin2022_04;

use Shopify\Auth\Session;
use Shopify\Rest\Base;

/**
 * @property array|array[] $rules
 * @property string $title
 * @property string|null $body_html
 * @property bool|null $disjunctive
 * @property string|null $handle
 * @property int|null $id
 * @property string|array|null $image
 * @property string|null $published_at
 * @property string|null $published_scope
 * @property string|null $sort_order
 * @property string|null $template_suffix
 * @property string|null $updated_at
 */
class SmartCollection extends Base
{
    public static string $API_VERSION = "2022-04";
    protected static array $HAS_ONE = [];
    protected static array $HAS_MANY = [];
    protected static array $PATHS = [
        ["http_method" => "delete", "operation" => "delete", "ids" => ["id"], "path" => "smart_collections/<id>.json"],
        ["http_method" => "get", "operation" => "count", "ids" => [], "path" => "smart_collections/count.json"],
        ["http_method" => "get", "operation" => "get", "ids" => [], "path" => "smart_collections.json"],
        ["http_method" => "get", "operation" => "get", "ids" => ["id"], "path" => "smart_collections/<id>.json"],
        ["http_method" => "post", "operation" => "post", "ids" => [], "path" => "smart_collections.json"],
        ["http_method" => "put", "operation" => "order", "ids" => ["id"], "path" => "smart_collections/<id>/order.json"],
        ["http_method" => "put", "operation" => "put", "ids" => ["id"], "path" => "smart_collections/<id>.json"]
    ];

    /**
     * @param Session $session
     * @param int|string $id
     * @param array $urlIds
     * @param mixed[] $params Allowed indexes:
     *     fields
     *
     * @return SmartCollection|null
     */
    public static function find(
        Session $session,
        $id,
        array $urlIds = [],
        array $params = []
    ): ?SmartCollection {
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
     *     ids,
     *     since_id,
     *     title,
     *     product_id,
     *     handle,
     *     updated_at_min,
     *     updated_at_max,
     *     published_at_min,
     *     published_at_max,
     *     published_status,
     *     fields
     *
     * @return SmartCollection[]
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
     *     title,
     *     product_id,
     *     updated_at_min,
     *     updated_at_max,
     *     published_at_min,
     *     published_at_max,
     *     published_status
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
     * @param mixed[] $params Allowed indexes:
     *     products,
     *     sort_order
     * @param array|string $body
     *
     * @return array|null
     */
    public function order(
        array $params = [],
        $body = []
    ): ?array {
        $response = parent::request(
            "put",
            "order",
            $this->session,
            ["id" => $this->id],
            $params,
            $body,
            $this,
        );

        return $response->getDecodedBody();
    }

}
