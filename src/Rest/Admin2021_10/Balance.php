<?php

declare(strict_types=1);

namespace Shopify\Rest\Admin2021_10;

use Shopify\Auth\Session;
use Shopify\Rest\Base;

/**

 */
class Balance extends Base
{
    public static string $API_VERSION = "2021-10";
    protected static array $HAS_ONE = [];
    protected static array $HAS_MANY = [];
    protected static array $PATHS = [
        ["http_method" => "get", "operation" => "get", "ids" => [], "path" => "shopify_payments/balance.json"]
    ];

    /**
     * @param Session $session
     * @param array $urlIds
     * @param mixed[] $params
     *
     * @return Balance[]
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
