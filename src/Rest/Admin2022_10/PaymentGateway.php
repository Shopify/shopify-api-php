<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace Shopify\Rest\Admin2022_10;

use Shopify\Auth\Session;
use Shopify\Rest\Base;

/**
 * @property string|null $attachment
 * @property string|null $created_at
 * @property string|null $credential1
 * @property string|null $credential2
 * @property string|null $credential3
 * @property string|null $credential4
 * @property bool|null $disabled
 * @property string[]|null $enabled_card_brands
 * @property int|null $id
 * @property string|null $name
 * @property string|null $processing_method
 * @property int|null $provider_id
 * @property bool|null $sandbox
 * @property string|null $service_name
 * @property bool|null $supports_network_tokenization
 * @property string|null $type
 * @property string|null $updated_at
 */
class PaymentGateway extends Base
{
    public static string $API_VERSION = "2022-10";
    protected static array $HAS_ONE = [];
    protected static array $HAS_MANY = [];
    protected static array $PATHS = [
        ["http_method" => "delete", "operation" => "delete", "ids" => ["id"], "path" => "payment_gateways/<id>.json"],
        ["http_method" => "get", "operation" => "get", "ids" => [], "path" => "payment_gateways.json"],
        ["http_method" => "get", "operation" => "get", "ids" => ["id"], "path" => "payment_gateways/<id>.json"],
        ["http_method" => "post", "operation" => "post", "ids" => [], "path" => "payment_gateways.json"],
        ["http_method" => "put", "operation" => "put", "ids" => ["id"], "path" => "payment_gateways/<id>.json"]
    ];

    /**
     * @param Session $session
     * @param int|string $id
     * @param array $urlIds
     * @param mixed[] $params
     *
     * @return PaymentGateway|null
     */
    public static function find(
        Session $session,
        $id,
        array $urlIds = [],
        array $params = []
    ): ?PaymentGateway {
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
     * @return PaymentGateway[]
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
