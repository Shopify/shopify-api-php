<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace Shopify\Rest\Admin2023_01;

use Shopify\Auth\Session;
use Shopify\Rest\Base;

/**
 * @property int|null $api_client_id
 * @property float|null $balance
 * @property string|null $code
 * @property string|null $created_at
 * @property string|null $currency
 * @property int|null $customer_id
 * @property string|null $disabled_at
 * @property string|null $expires_on
 * @property int|null $id
 * @property float|null $initial_value
 * @property string|null $last_characters
 * @property int|null $line_item_id
 * @property string|null $note
 * @property int|null $order_id
 * @property string|null $template_suffix
 * @property string|null $updated_at
 * @property int|null $user_id
 */
class GiftCard extends Base
{
    public static string $API_VERSION = "2023-01";
    protected static array $HAS_ONE = [];
    protected static array $HAS_MANY = [];
    protected static array $PATHS = [
        ["http_method" => "get", "operation" => "count", "ids" => [], "path" => "gift_cards/count.json"],
        ["http_method" => "get", "operation" => "get", "ids" => [], "path" => "gift_cards.json"],
        ["http_method" => "get", "operation" => "get", "ids" => ["id"], "path" => "gift_cards/<id>.json"],
        ["http_method" => "get", "operation" => "search", "ids" => [], "path" => "gift_cards/search.json"],
        ["http_method" => "post", "operation" => "disable", "ids" => ["id"], "path" => "gift_cards/<id>/disable.json"],
        ["http_method" => "post", "operation" => "post", "ids" => [], "path" => "gift_cards.json"],
        ["http_method" => "put", "operation" => "put", "ids" => ["id"], "path" => "gift_cards/<id>.json"]
    ];

    /**
     * @param Session $session
     * @param int|string $id
     * @param array $urlIds
     * @param mixed[] $params
     *
     * @return GiftCard|null
     */
    public static function find(
        Session $session,
        $id,
        array $urlIds = [],
        array $params = []
    ): ?GiftCard {
        $result = parent::baseFind(
            $session,
            array_merge(["id" => $id], $urlIds),
            $params,
        );
        return !empty($result) ? $result[0] : null;
    }

    /**
     * @param Session $session
     * @param array $urlIds
     * @param mixed[] $params Allowed indexes:
     *     status,
     *     limit,
     *     since_id,
     *     fields
     *
     * @return GiftCard[]
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
     * @param Session $session
     * @param array $urlIds
     * @param mixed[] $params Allowed indexes:
     *     status
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
            [],
            $params,
            [],
        );

        return $response->getDecodedBody();
    }

    /**
     * @param Session $session
     * @param array $urlIds
     * @param mixed[] $params Allowed indexes:
     *     order,
     *     query,
     *     limit,
     *     fields,
     *     created_at_min,
     *     created_at_max,
     *     updated_at_min,
     *     updated_at_max
     *
     * @return array|null
     */
    public static function search(
        Session $session,
        array $urlIds = [],
        array $params = []
    ): ?array {
        $response = parent::request(
            "get",
            "search",
            $session,
            [],
            $params,
            [],
        );

        return $response->getDecodedBody();
    }

    /**
     * @param mixed[] $params
     * @param array|string $body
     *
     * @return array|null
     */
    public function disable(
        array $params = [],
        $body = []
    ): ?array {
        $response = parent::request(
            "post",
            "disable",
            $this->session,
            ["id" => $this->id],
            $params,
            $body,
            $this,
        );

        return $response->getDecodedBody();
    }

}
