<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace Shopify\Rest\Admin2022_10;

use Shopify\Auth\Session;
use Shopify\Rest\Base;

/**
 * @property mixed $carrier_shipping_rate_providers
 * @property Country[]|null $countries
 * @property int|null $id
 * @property int|null $location_group_id
 * @property string|null $name
 * @property array|null $price_based_shipping_rates
 * @property int|null $profile_id
 * @property Province[]|null $provinces
 * @property array|null $weight_based_shipping_rates
 */
class ShippingZone extends Base
{
    public static string $API_VERSION = "2022-10";
    protected static array $HAS_ONE = [];
    protected static array $HAS_MANY = [
        "countries" => Country::class,
        "provinces" => Province::class
    ];
    protected static array $PATHS = [
        ["http_method" => "get", "operation" => "get", "ids" => [], "path" => "shipping_zones.json"]
    ];

    /**
     * @param Session $session
     * @param array $urlIds
     * @param mixed[] $params Allowed indexes:
     *     fields
     *
     * @return ShippingZone[]
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
