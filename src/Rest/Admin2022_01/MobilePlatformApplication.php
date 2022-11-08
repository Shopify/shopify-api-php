<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace Shopify\Rest\Admin2022_01;

use Shopify\Auth\Session;
use Shopify\Rest\Base;

/**
 * @property string|null $application_id
 * @property bool|null $enabled_shared_webcredentials
 * @property bool|null $enabled_universal_or_app_links
 * @property int|null $id
 * @property string|null $platform
 * @property string[]|null $sha256_cert_fingerprints
 */
class MobilePlatformApplication extends Base
{
    public static string $API_VERSION = "2022-01";
    protected static array $HAS_ONE = [];
    protected static array $HAS_MANY = [];
    protected static array $PATHS = [
        ["http_method" => "delete", "operation" => "delete", "ids" => ["id"], "path" => "mobile_platform_applications/<id>.json"],
        ["http_method" => "get", "operation" => "get", "ids" => [], "path" => "mobile_platform_applications.json"],
        ["http_method" => "get", "operation" => "get", "ids" => ["id"], "path" => "mobile_platform_applications/<id>.json"],
        ["http_method" => "post", "operation" => "post", "ids" => [], "path" => "mobile_platform_applications.json"],
        ["http_method" => "put", "operation" => "put", "ids" => ["id"], "path" => "mobile_platform_applications/<id>.json"]
    ];

    /**
     * @param Session $session
     * @param int|string $id
     * @param array $urlIds
     * @param mixed[] $params
     *
     * @return MobilePlatformApplication|null
     */
    public static function find(
        Session $session,
        $id,
        array $urlIds = [],
        array $params = []
    ): ?MobilePlatformApplication {
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
     * @param mixed[] $params
     *
     * @return MobilePlatformApplication[]
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
