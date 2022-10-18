<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace Shopify\Rest\Admin2022_07;

use Shopify\Auth\Session;
use Shopify\Rest\Base;

/**
 * @property float|null $amount
 * @property int|null $api_client_id
 * @property string|null $created_at
 * @property int|null $gift_card_id
 * @property int|null $id
 * @property string|null $note
 * @property int|null $number
 * @property int|null $order_transaction_id
 * @property string|null $processed_at
 * @property string|null $remote_transaction_ref
 * @property string|null $remote_transaction_url
 * @property int|null $user_id
 */
class GiftCardAdjustment extends Base
{
    public static string $API_VERSION = "2022-07";
    protected static array $HAS_ONE = [];
    protected static array $HAS_MANY = [];
    protected static array $PATHS = [
        ["http_method" => "get", "operation" => "get", "ids" => ["gift_card_id"], "path" => "gift_cards/<gift_card_id>/adjustments.json"],
        ["http_method" => "get", "operation" => "get", "ids" => ["gift_card_id", "id"], "path" => "gift_cards/<gift_card_id>/adjustments/<id>.json"],
        ["http_method" => "post", "operation" => "post", "ids" => ["gift_card_id"], "path" => "gift_cards/<gift_card_id>/adjustments.json"]
    ];

    /**

     *
     * @return string
     */
    protected static function getJsonBodyName(): string
    {
        return "adjustment";
    }

    /**
     * @param Session $session
     * @param int|string $id
     * @param array $urlIds Allowed indexes:
     *     gift_card_id
     * @param mixed[] $params
     *
     * @return GiftCardAdjustment|null
     */
    public static function find(
        Session $session,
        $id,
        array $urlIds = [],
        array $params = []
    ): ?GiftCardAdjustment {
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
     *     gift_card_id
     * @param mixed[] $params
     *
     * @return GiftCardAdjustment[]
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

}
