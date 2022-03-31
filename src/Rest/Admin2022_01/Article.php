<?php

declare(strict_types=1);

namespace Shopify\Rest\Admin2022_01;

use Shopify\Auth\Session;
use Shopify\Rest\Base;

/**
 * @property string|null $author
 * @property int|null $blog_id
 * @property string|null $body_html
 * @property string|null $created_at
 * @property string|null $handle
 * @property int|null $id
 * @property string|array|null $image
 * @property Metafield[]|null $metafields
 * @property bool|null $published
 * @property string|null $published_at
 * @property string|null $summary_html
 * @property string|null $tags
 * @property string|null $template_suffix
 * @property string|null $title
 * @property string|null $updated_at
 * @property int|null $user_id
 */
class Article extends Base
{
    public static string $API_VERSION = "2022-01";
    protected static array $HAS_ONE = [];
    protected static array $HAS_MANY = [
        "metafields" => Metafield::class
    ];
    protected static array $PATHS = [
        ["http_method" => "delete", "operation" => "delete", "ids" => ["blog_id", "id"], "path" => "blogs/<blog_id>/articles/<id>.json"],
        ["http_method" => "get", "operation" => "authors", "ids" => [], "path" => "articles/authors.json"],
        ["http_method" => "get", "operation" => "count", "ids" => ["blog_id"], "path" => "blogs/<blog_id>/articles/count.json"],
        ["http_method" => "get", "operation" => "get", "ids" => ["blog_id"], "path" => "blogs/<blog_id>/articles.json"],
        ["http_method" => "get", "operation" => "get", "ids" => ["blog_id", "id"], "path" => "blogs/<blog_id>/articles/<id>.json"],
        ["http_method" => "get", "operation" => "tags", "ids" => [], "path" => "articles/tags.json"],
        ["http_method" => "post", "operation" => "post", "ids" => ["blog_id"], "path" => "blogs/<blog_id>/articles.json"],
        ["http_method" => "put", "operation" => "put", "ids" => ["blog_id", "id"], "path" => "blogs/<blog_id>/articles/<id>.json"]
    ];

    /**
     * @param Session $session
     * @param int|string $id
     * @param array $urlIds Allowed indexes:
     *     blog_id
     * @param mixed[] $params Allowed indexes:
     *     fields
     *
     * @return Article|null
     */
    public static function find(
        Session $session,
        $id,
        array $urlIds = [],
        array $params = []
    ): ?Article {
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
     *     blog_id
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
     *     blog_id
     * @param mixed[] $params Allowed indexes:
     *     limit,
     *     since_id,
     *     created_at_min,
     *     created_at_max,
     *     updated_at_min,
     *     updated_at_max,
     *     published_at_min,
     *     published_at_max,
     *     published_status,
     *     handle,
     *     tag,
     *     author,
     *     fields
     *
     * @return Article[]
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
     * @param array $urlIds
     * @param mixed[] $params
     *
     * @return array|null
     */
    public static function authors(
        Session $session,
        array $urlIds = [],
        array $params = []
    ): ?array {
        $response = parent::request(
            "get",
            "authors",
            $session,
            [],
            $params,
            [],
        );

        return $response->getDecodedBody();
    }

    /**
     * @param Session $session
     * @param array $urlIds Allowed indexes:
     *     blog_id
     * @param mixed[] $params Allowed indexes:
     *     created_at_min,
     *     created_at_max,
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
            $urlIds,
            $params,
            [],
        );

        return $response->getDecodedBody();
    }

    /**
     * @param Session $session
     * @param array $urlIds
     * @param mixed[] $params
     *
     * @return array|null
     */
    public static function tags(
        Session $session,
        array $urlIds = [],
        array $params = []
    ): ?array {
        $response = parent::request(
            "get",
            "tags",
            $session,
            [],
            $params,
            [],
        );

        return $response->getDecodedBody();
    }

}
