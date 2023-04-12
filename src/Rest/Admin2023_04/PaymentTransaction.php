<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace Shopify\Rest\Admin2023_04;

use Shopify\Auth\Session;
use Shopify\Rest\Base;

/**
 * @property string|null $amount
 * @property Currency|null $currency
 * @property string|null $fee
 * @property int|null $id
 * @property string|null $net
 * @property int|null $payout_id
 * @property string|null $payout_status
 * @property string|null $processed_at
 * @property int|null $source_id
 * @property int|null $source_order_id
 * @property int|null $source_order_transaction_id
 * @property string|null $source_type
 * @property bool|null $test
 * @property string|null $type
 */
class PaymentTransaction extends Base
{
    public static string $API_VERSION = "2023-04";
    protected static array $HAS_ONE = [
        "currency" => Currency::class
    ];
    protected static array $HAS_MANY = [];
    protected static array $PATHS = [
        ["http_method" => "get", "operation" => "transactions", "ids" => [], "path" => "shopify_payments/balance/transactions.json"]
    ];

    /**
     * @param Session $session
     * @param array $urlIds
     * @param mixed[] $params Allowed indexes:
     *     since_id,
     *     last_id,
     *     test,
     *     payout_id,
     *     payout_status
     *
     * @return array|null
     */
    public static function transactions(
        Session $session,
        array $urlIds = [],
        array $params = []
    ): ?array {
        $response = parent::request(
            "get",
            "transactions",
            $session,
            [],
            $params,
            [],
        );

        return $response->getDecodedBody();
    }

}
