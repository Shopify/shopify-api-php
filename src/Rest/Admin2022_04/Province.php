<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace Shopify\Rest\Admin2022_04;

use Shopify\Auth\Session;
use Shopify\Rest\Base;

/**
 * @property string|null $code
 * @property int|null $country_id
 * @property int|null $id
 * @property string|null $name
 * @property int|null $shipping_zone_id
 * @property float|null $tax
 * @property string|null $tax_name
 * @property float|null $tax_percentage
 * @property string|null $tax_type
 */
class Province extends Base
{
    public static string $API_VERSION = "2022-04";
    protected static array $HAS_ONE = [];
    protected static array $HAS_MANY = [];
    protected static array $PATHS = [
        ["http_method" => "get", "operation" => "count", "ids" => ["country_id"], "path" => "countries/<country_id>/provinces/count.json"],
        ["http_method" => "get", "operation" => "get", "ids" => ["country_id"], "path" => "countries/<country_id>/provinces.json"],
        ["http_method" => "get", "operation" => "get", "ids" => ["country_id", "id"], "path" => "countries/<country_id>/provinces/<id>.json"],
        ["http_method" => "put", "operation" => "put", "ids" => ["country_id", "id"], "path" => "countries/<country_id>/provinces/<id>.json"]
    ];

    /**
     * @param Session $session
     * @param int|string $id
     * @param array $urlIds Allowed indexes:
     *     country_id
     * @param mixed[] $params Allowed indexes:
     *     fields
     *
     * @return Province|null
     */
    public static function find(
        Session $session,
        $id,
        array $urlIds = [],
        array $params = []
    ): ?Province {
        $result = parent::baseFind(
            $session,
            array_merge(["id" => $id], $urlIds),
            $params,
        );
        return !empty($result) ? $result[0] : null;
    }

    /**
     * @param Session $session
     * @param array $urlIds Allowed indexes:
     *     country_id
     * @param mixed[] $params Allowed indexes:
     *     since_id,
     *     fields
     *
     * @return Province[]
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
     * @param array $urlIds Allowed indexes:
     *     country_id
     * @param mixed[] $params
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

}
