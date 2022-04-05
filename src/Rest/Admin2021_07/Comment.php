<?php

declare(strict_types=1);

namespace Shopify\Rest\Admin2021_07;

use Shopify\Auth\Session;
use Shopify\Rest\Base;

/**
 * @property int|null $article_id
 * @property string|null $author
 * @property int|null $blog_id
 * @property string|null $body
 * @property string|null $body_html
 * @property string|null $created_at
 * @property string|null $email
 * @property int|null $id
 * @property string|null $ip
 * @property string|null $published_at
 * @property string|null $status
 * @property string|null $updated_at
 * @property string|null $user_agent
 */
class Comment extends Base
{
    public static string $API_VERSION = "2021-07";
    protected static array $HAS_ONE = [];
    protected static array $HAS_MANY = [];
    protected static array $PATHS = [
        ["http_method" => "get", "operation" => "count", "ids" => [], "path" => "comments/count.json"],
        ["http_method" => "get", "operation" => "get", "ids" => [], "path" => "comments.json"],
        ["http_method" => "get", "operation" => "get", "ids" => ["id"], "path" => "comments/<id>.json"],
        ["http_method" => "post", "operation" => "approve", "ids" => ["id"], "path" => "comments/<id>/approve.json"],
        ["http_method" => "post", "operation" => "not_spam", "ids" => ["id"], "path" => "comments/<id>/not_spam.json"],
        ["http_method" => "post", "operation" => "post", "ids" => [], "path" => "comments.json"],
        ["http_method" => "post", "operation" => "remove", "ids" => ["id"], "path" => "comments/<id>/remove.json"],
        ["http_method" => "post", "operation" => "restore", "ids" => ["id"], "path" => "comments/<id>/restore.json"],
        ["http_method" => "post", "operation" => "spam", "ids" => ["id"], "path" => "comments/<id>/spam.json"],
        ["http_method" => "put", "operation" => "put", "ids" => ["id"], "path" => "comments/<id>.json"]
    ];

    /**
     * @param Session $session
     * @param int|string $id
     * @param array $urlIds
     * @param mixed[] $params Allowed indexes:
     *     fields
     *
     * @return Comment|null
     */
    public static function find(
        Session $session,
        $id,
        array $urlIds = [],
        array $params = []
    ): ?Comment {
        $result = parent::baseFind(
            $session,
            array_merge(["id" => $id], $urlIds),
            $params,
        );
        return !empty($result) ? $result[0] : null;
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
     *     published_at_min,
     *     published_at_max,
     *     fields,
     *     published_status,
     *     status
     *
     * @return Comment[]
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
     *     created_at_min,
     *     created_at_max,
     *     updated_at_min,
     *     updated_at_max,
     *     published_at_min,
     *     published_at_max,
     *     published_status,
     *     status
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
     * @param mixed[] $params
     * @param array|string $body
     *
     * @return array|null
     */
    public function approve(
        array $params = [],
        $body = []
    ): ?array {
        $response = parent::request(
            "post",
            "approve",
            $this->session,
            ["id" => $this->id],
            $params,
            $body,
            $this,
        );

        return $response->getDecodedBody();
    }

    /**
     * @param mixed[] $params
     * @param array|string $body
     *
     * @return array|null
     */
    public function not_spam(
        array $params = [],
        $body = []
    ): ?array {
        $response = parent::request(
            "post",
            "not_spam",
            $this->session,
            ["id" => $this->id],
            $params,
            $body,
            $this,
        );

        return $response->getDecodedBody();
    }

    /**
     * @param mixed[] $params
     * @param array|string $body
     *
     * @return array|null
     */
    public function remove(
        array $params = [],
        $body = []
    ): ?array {
        $response = parent::request(
            "post",
            "remove",
            $this->session,
            ["id" => $this->id],
            $params,
            $body,
            $this,
        );

        return $response->getDecodedBody();
    }

    /**
     * @param mixed[] $params
     * @param array|string $body
     *
     * @return array|null
     */
    public function restore(
        array $params = [],
        $body = []
    ): ?array {
        $response = parent::request(
            "post",
            "restore",
            $this->session,
            ["id" => $this->id],
            $params,
            $body,
            $this,
        );

        return $response->getDecodedBody();
    }

    /**
     * @param mixed[] $params
     * @param array|string $body
     *
     * @return array|null
     */
    public function spam(
        array $params = [],
        $body = []
    ): ?array {
        $response = parent::request(
            "post",
            "spam",
            $this->session,
            ["id" => $this->id],
            $params,
            $body,
            $this,
        );

        return $response->getDecodedBody();
    }

}
