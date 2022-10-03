<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace Shopify\Rest\Admin2022_01;

use Shopify\Auth\Session;
use Shopify\Rest\Base;

/**
 * @property string $handle
 * @property array[]|null $access_scopes
 */
class AccessScope extends Base
{
    public static string $API_VERSION = "2022-01";
    protected static array $HAS_ONE = [];
    protected static array $HAS_MANY = [];
    protected static ?string $CUSTOM_PREFIX = "/admin/oauth";
    protected static array $PATHS = [
        ["http_method" => "get", "operation" => "get", "ids" => [], "path" => "access_scopes.json"]
    ];

    /**
     * @param Session $session
     * @param array $urlIds
     * @param mixed[] $params
     *
     * @return AccessScope[]
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
