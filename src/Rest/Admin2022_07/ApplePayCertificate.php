<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace Shopify\Rest\Admin2022_07;

use Shopify\Auth\Session;
use Shopify\Rest\Base;

/**
 * @property int|null $id
 * @property string|null $merchant_id
 * @property string|null $status
 */
class ApplePayCertificate extends Base
{
    public static string $API_VERSION = "2022-07";
    protected static array $HAS_ONE = [];
    protected static array $HAS_MANY = [];
    protected static array $PATHS = [
        ["http_method" => "delete", "operation" => "delete", "ids" => ["id"], "path" => "apple_pay_certificates/<id>.json"],
        ["http_method" => "get", "operation" => "csr", "ids" => ["id"], "path" => "apple_pay_certificates/<id>/csr.json"],
        ["http_method" => "get", "operation" => "get", "ids" => ["id"], "path" => "apple_pay_certificates/<id>.json"],
        ["http_method" => "post", "operation" => "post", "ids" => [], "path" => "apple_pay_certificates.json"],
        ["http_method" => "put", "operation" => "put", "ids" => ["id"], "path" => "apple_pay_certificates/<id>.json"]
    ];

    /**
     * @param Session $session
     * @param int|string $id
     * @param array $urlIds
     * @param mixed[] $params
     *
     * @return ApplePayCertificate|null
     */
    public static function find(
        Session $session,
        $id,
        array $urlIds = [],
        array $params = []
    ): ?ApplePayCertificate {
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
     * @param int|string $id
     * @param array $urlIds
     * @param mixed[] $params
     *
     * @return array|null
     */
    public static function csr(
        Session $session,
        $id,
        array $urlIds = [],
        array $params = []
    ): ?array {
        $response = parent::request(
            "get",
            "csr",
            $session,
            array_merge(["id" => $id], $urlIds),
            $params,
            [],
        );

        return $response->getDecodedBody();
    }

}
