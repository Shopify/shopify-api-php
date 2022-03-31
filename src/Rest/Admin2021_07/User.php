<?php

declare(strict_types=1);

namespace Shopify\Rest\Admin2021_07;

use Shopify\Auth\Session;
use Shopify\Rest\Base;

/**
 * @property bool|null $account_owner
 * @property string|null $bio
 * @property string|null $email
 * @property string|null $first_name
 * @property int|null $id
 * @property string|null $im
 * @property string|null $last_name
 * @property string|null $locale
 * @property string[]|null $permissions
 * @property string|null $phone
 * @property int|null $receive_announcements
 * @property string|null $screen_name
 * @property string|null $url
 * @property string|null $user_type
 */
class User extends Base
{
    public static string $API_VERSION = "2021-07";
    protected static array $HAS_ONE = [];
    protected static array $HAS_MANY = [];
    protected static array $PATHS = [
        ["http_method" => "get", "operation" => "current", "ids" => [], "path" => "users/current.json"],
        ["http_method" => "get", "operation" => "get", "ids" => [], "path" => "users.json"],
        ["http_method" => "get", "operation" => "get", "ids" => ["id"], "path" => "users/<id>.json"]
    ];

    /**
     * @param Session $session
     * @param int|string $id
     * @param array $urlIds
     * @param mixed[] $params
     *
     * @return User|null
     */
    public static function find(
        Session $session,
        $id,
        array $urlIds = [],
        array $params = []
    ): ?User {
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
     *     page_info
     *
     * @return User[]
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
    public static function current(
        Session $session,
        array $urlIds = [],
        array $params = []
    ): ?array {
        $response = parent::request(
            "get",
            "current",
            $session,
            [],
            $params,
            [],
        );

        return $response->getDecodedBody();
    }

}
