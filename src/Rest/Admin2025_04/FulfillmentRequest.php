<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace Shopify\Rest\Admin2025_04;

use Shopify\Auth\Session;
use Shopify\Rest\Base;

/**
 * @property int|null $fulfillment_order_id
 * @property string|null $kind
 * @property string|null $message
 * @property array|null $request_options
 * @property array|null $response_data
 * @property string|null $sent_at
 */
class FulfillmentRequest extends Base
{
    public static string $API_VERSION = "2025-04";
    protected static array $HAS_ONE = [];
    protected static array $HAS_MANY = [];
    protected static array $PATHS = [
        ["http_method" => "post", "operation" => "accept", "ids" => ["fulfillment_order_id"], "path" => "fulfillment_orders/<fulfillment_order_id>/fulfillment_request/accept.json"],
        ["http_method" => "post", "operation" => "post", "ids" => ["fulfillment_order_id"], "path" => "fulfillment_orders/<fulfillment_order_id>/fulfillment_request.json"],
        ["http_method" => "post", "operation" => "reject", "ids" => ["fulfillment_order_id"], "path" => "fulfillment_orders/<fulfillment_order_id>/fulfillment_request/reject.json"]
    ];

    /**

     *
     * @return string[]
     */
    protected static function getJsonResponseBodyNames(): array
    {
        return [
            "submitted_fulfillment_order",
            "fulfillment_order"
        ];
    }

    /**
     * @param mixed[] $params Allowed indexes:
     *     message
     * @param array|string $body
     *
     * @return array|null
     */
    public function accept(
        array $params = [],
        $body = []
    ): ?array {
        $response = parent::request(
            "post",
            "accept",
            $this->session,
            ["fulfillment_order_id" => $this->fulfillment_order_id],
            $params,
            $body,
            $this,
        );

        return $response->getDecodedBody();
    }

    /**
     * @param mixed[] $params Allowed indexes:
     *     message,
     *     reason,
     *     line_items
     * @param array|string $body
     *
     * @return array|null
     */
    public function reject(
        array $params = [],
        $body = []
    ): ?array {
        $response = parent::request(
            "post",
            "reject",
            $this->session,
            ["fulfillment_order_id" => $this->fulfillment_order_id],
            $params,
            $body,
            $this,
        );

        return $response->getDecodedBody();
    }

}
