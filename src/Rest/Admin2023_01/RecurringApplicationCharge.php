<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace Shopify\Rest\Admin2023_01;

use Shopify\Auth\Session;
use Shopify\Rest\Base;

/**
 * @property string|null $activated_on
 * @property string|null $billing_on
 * @property string|null $cancelled_on
 * @property string|int|null $capped_amount
 * @property string|null $confirmation_url
 * @property string|null $created_at
 * @property Currency|null $currency
 * @property int|null $id
 * @property string|null $name
 * @property string|float|null $price
 * @property string|null $return_url
 * @property string|null $status
 * @property string|null $terms
 * @property bool|null $test
 * @property int|null $trial_days
 * @property string|null $trial_ends_on
 * @property string|null $updated_at
 */
class RecurringApplicationCharge extends Base
{
    public static string $API_VERSION = "2023-01";
    protected static array $HAS_ONE = [
        "currency" => Currency::class
    ];
    protected static array $HAS_MANY = [];
    protected static array $PATHS = [
        ["http_method" => "delete", "operation" => "delete", "ids" => ["id"], "path" => "recurring_application_charges/<id>.json"],
        ["http_method" => "get", "operation" => "get", "ids" => [], "path" => "recurring_application_charges.json"],
        ["http_method" => "get", "operation" => "get", "ids" => ["id"], "path" => "recurring_application_charges/<id>.json"],
        ["http_method" => "post", "operation" => "post", "ids" => [], "path" => "recurring_application_charges.json"],
        ["http_method" => "put", "operation" => "customize", "ids" => ["id"], "path" => "recurring_application_charges/<id>/customize.json"]
    ];

    /**
     * @param Session $session
     * @param int|string $id
     * @param array $urlIds
     * @param mixed[] $params Allowed indexes:
     *     fields
     *
     * @return RecurringApplicationCharge|null
     */
    public static function find(
        Session $session,
        $id,
        array $urlIds = [],
        array $params = []
    ): ?RecurringApplicationCharge {
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
     * @param mixed[] $params Allowed indexes:
     *     since_id,
     *     fields
     *
     * @return RecurringApplicationCharge[]
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

    /**
     * @param mixed[] $params
     * @param array|string $body
     *
     * @return array|null
     */
    public function customize(
        array $params = [],
        $body = []
    ): ?array {
        $response = parent::request(
            "put",
            "customize",
            $this->session,
            ["id" => $this->id],
            $params,
            $body,
            $this,
        );

        return $response->getDecodedBody();
    }

}
