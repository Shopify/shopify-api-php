<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace Shopify\Rest\Admin2022_04;

use Shopify\Auth\Session;
use Shopify\Rest\Base;

/**
 * @property string|null $address1
 * @property string|null $address2
 * @property string|null $city
 * @property string|null $company
 * @property string|null $country
 * @property string|null $country_code
 * @property string|null $country_name
 * @property int|null $customer_id
 * @property string|null $first_name
 * @property int|null $id
 * @property string|null $last_name
 * @property string|null $name
 * @property string|null $phone
 * @property string|null $province
 * @property string|null $province_code
 * @property string|null $zip
 */
class CustomerAddress extends Base
{
    public static string $API_VERSION = "2022-04";
    protected static array $HAS_ONE = [];
    protected static array $HAS_MANY = [];
    protected static array $PATHS = [
        ["http_method" => "delete", "operation" => "delete", "ids" => ["customer_id", "id"], "path" => "customers/<customer_id>/addresses/<id>.json"],
        ["http_method" => "get", "operation" => "get", "ids" => ["customer_id"], "path" => "customers/<customer_id>/addresses.json"],
        ["http_method" => "get", "operation" => "get", "ids" => ["customer_id", "id"], "path" => "customers/<customer_id>/addresses/<id>.json"],
        ["http_method" => "post", "operation" => "post", "ids" => ["customer_id"], "path" => "customers/<customer_id>/addresses.json"],
        ["http_method" => "put", "operation" => "default", "ids" => ["customer_id", "id"], "path" => "customers/<customer_id>/addresses/<id>/default.json"],
        ["http_method" => "put", "operation" => "put", "ids" => ["customer_id", "id"], "path" => "customers/<customer_id>/addresses/<id>.json"],
        ["http_method" => "put", "operation" => "set", "ids" => ["customer_id"], "path" => "customers/<customer_id>/addresses/set.json"]
    ];

    /**

     *
     * @return string
     */
    protected static function getJsonBodyName(): string
    {
        return "address";
    }

    /**
     * @param Session $session
     * @param int|string $id
     * @param array $urlIds Allowed indexes:
     *     customer_id
     * @param mixed[] $params
     *
     * @return CustomerAddress|null
     */
    public static function find(
        Session $session,
        $id,
        array $urlIds = [],
        array $params = []
    ): ?CustomerAddress {
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
     * @param array $urlIds Allowed indexes:
     *     customer_id
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
     * @param array $urlIds Allowed indexes:
     *     customer_id
     * @param mixed[] $params
     *
     * @return CustomerAddress[]
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
     * @param mixed[] $params
     * @param array|string $body
     *
     * @return array|null
     */
    public function default(
        array $params = [],
        $body = []
    ): ?array {
        $response = parent::request(
            "put",
            "default",
            $this->session,
            ["customer_id" => $this->customer_id, "id" => $this->id],
            $params,
            $body,
            $this,
        );

        return $response->getDecodedBody();
    }

    /**
     * @param mixed[] $params Allowed indexes:
     *     address_ids,
     *     operation
     * @param array|string $body
     *
     * @return array|null
     */
    public function set(
        array $params = [],
        $body = []
    ): ?array {
        $response = parent::request(
            "put",
            "set",
            $this->session,
            ["customer_id" => $this->customer_id],
            $params,
            $body,
            $this,
        );

        return $response->getDecodedBody();
    }

}
