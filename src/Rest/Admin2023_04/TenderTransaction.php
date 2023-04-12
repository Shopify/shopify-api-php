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
 * @property string|null $currency
 * @property int|null $id
 * @property int|null $order_id
 * @property array|null $payment_details
 * @property string|null $payment_method
 * @property string|null $processed_at
 * @property string|null $remote_reference
 * @property bool|null $test
 * @property int|null $user_id
 */
class TenderTransaction extends Base
{
    public static string $API_VERSION = "2023-04";
    protected static array $HAS_ONE = [];
    protected static array $HAS_MANY = [];
    protected static array $PATHS = [
        ["http_method" => "get", "operation" => "get", "ids" => [], "path" => "tender_transactions.json"]
    ];

    /**
     * @param Session $session
     * @param array $urlIds
     * @param mixed[] $params Allowed indexes:
     *     limit,
     *     since_id,
     *     processed_at_min,
     *     processed_at_max,
     *     processed_at,
     *     order
     *
     * @return TenderTransaction[]
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
