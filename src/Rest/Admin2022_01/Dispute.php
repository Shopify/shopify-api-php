<?php

declare(strict_types=1);

namespace Shopify\Rest\Admin2022_01;

use Shopify\Auth\Session;
use Shopify\Rest\Base;

/**
 * @property string|null $amount
 * @property string|null $currency
 * @property string|null $evidence_due_by
 * @property string|null $evidence_sent_on
 * @property string|null $finalized_on
 * @property int|null $id
 * @property int|null $network_reason_code
 * @property int|null $order_id
 * @property string|null $reason
 * @property string|null $status
 * @property string|null $type
 */
class Dispute extends Base
{
    public static string $API_VERSION = "2022-01";
    protected static array $HAS_ONE = [];
    protected static array $HAS_MANY = [];
    protected static array $PATHS = [
        ["http_method" => "get", "operation" => "get", "ids" => [], "path" => "shopify_payments/disputes.json"],
        ["http_method" => "get", "operation" => "get", "ids" => ["id"], "path" => "shopify_payments/disputes/<id>.json"]
    ];

    /**
     * @param Session $session
     * @param int|string $id
     * @param array $urlIds
     * @param mixed[] $params
     *
     * @return Dispute|null
     */
    public static function find(
        Session $session,
        $id,
        array $urlIds = [],
        array $params = []
    ): ?Dispute {
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
     *     since_id,
     *     last_id,
     *     status,
     *     initiated_at
     *
     * @return Dispute[]
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
