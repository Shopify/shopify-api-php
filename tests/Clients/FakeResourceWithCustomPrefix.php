<?php

declare(strict_types=1);

namespace ShopifyTest\Clients;

use Shopify\Auth\Session;
use Shopify\Rest\Base;

/**
 * @property int $id
 * @property string $attribute
 */
final class FakeResourceWithCustomPrefix extends Base
{
    public static string $API_VERSION = "unstable";

    /** @var Base[] */
    protected static array $HAS_ONE = [];

    /** @var Base[] */
    protected static array $HAS_MANY = [];

    /** @var array[] */
    protected static array $PATHS = [
        [
            "http_method" => "get", "operation" => "get", "ids" => ["id"],
            "path" => "fake_resource_with_custom_prefix/<id>.json"
        ],
    ];

    protected static ?string $CUSTOM_PREFIX = "/admin/custom_prefix";

    public static function find(Session $session, int $id)
    {
        $result = parent::baseFind($session, ["id" => $id]);
        return !empty($result) ? $result[0] : null;
    }
}
