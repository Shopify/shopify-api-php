<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace Shopify\Rest\Admin2022_07;

use Shopify\Auth\Session;
use Shopify\Rest\Base;

/**
 * @property string|null $access_activity_log
 * @property array|null $billing_address
 * @property string|null $cancellation_policy_disclosure
 * @property string|null $cancellation_rebuttal
 * @property string|null $created_at
 * @property string|null $customer_email_address
 * @property string|null $customer_first_name
 * @property string|null $customer_last_name
 * @property array|null $dispute_evidence_files
 * @property Fulfillment[]|null $fulfillments
 * @property int|null $id
 * @property int|null $payments_dispute_id
 * @property array|null $product_description
 * @property string|null $refund_policy_disclosure
 * @property string|null $refund_refusal_explanation
 * @property array|null $shipping_address
 * @property bool|null $submitted
 * @property string|null $uncategorized_text
 * @property string|null $updated_on
 */
class DisputeEvidence extends Base
{
    public static string $API_VERSION = "2022-07";
    protected static array $HAS_ONE = [];
    protected static array $HAS_MANY = [
        "fulfillments" => Fulfillment::class
    ];
    protected static array $PATHS = [
        ["http_method" => "get", "operation" => "get", "ids" => ["dispute_id"], "path" => "shopify_payments/disputes/<dispute_id>/dispute_evidences.json"],
        ["http_method" => "put", "operation" => "put", "ids" => ["dispute_id"], "path" => "shopify_payments/disputes/<dispute_id>/dispute_evidences.json"]
    ];
    protected static string $PRIMARY_KEY = "dispute_id";

    /**
     * @param Session $session
     * @param int|string $dispute_id
     * @param array $urlIds
     * @param mixed[] $params
     *
     * @return DisputeEvidence|null
     */
    public static function find(
        Session $session,
        $dispute_id,
        array $urlIds = [],
        array $params = []
    ): ?DisputeEvidence {
        $result = parent::baseFind(
            $session,
            array_merge(["dispute_id" => $dispute_id], $urlIds),
            $params,
        );
        return !empty($result) ? $result[0] : null;
    }

}
