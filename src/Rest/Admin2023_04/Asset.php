<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace Shopify\Rest\Admin2023_04;

use Shopify\Auth\Session;
use Shopify\Rest\Base;

/**
 * @property string|null $attachment
 * @property string|null $checksum
 * @property string|null $content_type
 * @property string|null $created_at
 * @property string|null $key
 * @property string|null $public_url
 * @property int|null $size
 * @property int|null $theme_id
 * @property string|null $updated_at
 * @property string|null $value
 */
class Asset extends Base
{
    public static string $API_VERSION = "2023-04";
    protected static array $HAS_ONE = [];
    protected static array $HAS_MANY = [];
    protected static array $PATHS = [
        ["http_method" => "delete", "operation" => "delete", "ids" => ["theme_id"], "path" => "themes/<theme_id>/assets.json"],
        ["http_method" => "get", "operation" => "get", "ids" => ["theme_id"], "path" => "themes/<theme_id>/assets.json"],
        ["http_method" => "get", "operation" => "get", "ids" => ["theme_id"], "path" => "themes/<theme_id>/assets.json"],
        ["http_method" => "put", "operation" => "put", "ids" => ["theme_id"], "path" => "themes/<theme_id>/assets.json"]
    ];
    protected static string $PRIMARY_KEY = "key";

    /**
     * @param Session $session
     * @param array $urlIds Allowed indexes:
     *     theme_id
     * @param mixed[] $params Allowed indexes:
     *     asset
     *
     * @return array|null
     */
    public static function delete(
        Session $session,
        array $urlIds = [],
        array $params = []
    ): ?array {
        $response = parent::request(
            "delete",
            "delete",
            $session,
            $urlIds,
            $params,
        );

        return $response->getDecodedBody();
    }

    /**
     * @param Session $session
     * @param array $urlIds Allowed indexes:
     *     theme_id
     * @param mixed[] $params Allowed indexes:
     *     fields,
     *     asset
     *
     * @return Asset[]
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

}
