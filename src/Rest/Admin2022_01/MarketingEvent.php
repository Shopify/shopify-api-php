<?php

declare(strict_types=1);

namespace Shopify\Rest\Admin2022_01;

use Shopify\Auth\Session;
use Shopify\Rest\Base;

/**
 * @property string $event_type
 * @property string $marketing_channel
 * @property bool $paid
 * @property string $started_at
 * @property array|null $UTM_parameters
 * @property string|null $budget
 * @property string|null $budget_type
 * @property string|null $currency
 * @property string|null $description
 * @property string|null $ended_at
 * @property int|null $id
 * @property string|null $manage_url
 * @property array[]|null $marketed_resources
 * @property string|null $preview_url
 * @property string|null $referring_domain
 * @property string|null $remote_id
 * @property string|null $scheduled_to_end_at
 */
class MarketingEvent extends Base
{
    public static string $API_VERSION = "2022-01";
    protected static array $HAS_ONE = [];
    protected static array $HAS_MANY = [];
    protected static array $PATHS = [
        ["http_method" => "delete", "operation" => "delete", "ids" => ["id"], "path" => "marketing_events/<id>.json"],
        ["http_method" => "get", "operation" => "count", "ids" => [], "path" => "marketing_events/count.json"],
        ["http_method" => "get", "operation" => "get", "ids" => [], "path" => "marketing_events.json"],
        ["http_method" => "get", "operation" => "get", "ids" => ["id"], "path" => "marketing_events/<id>.json"],
        ["http_method" => "post", "operation" => "engagements", "ids" => ["id"], "path" => "marketing_events/<id>/engagements.json"],
        ["http_method" => "post", "operation" => "post", "ids" => [], "path" => "marketing_events.json"],
        ["http_method" => "put", "operation" => "put", "ids" => ["id"], "path" => "marketing_events/<id>.json"]
    ];

    /**
     * @param Session $session
     * @param int|string $id
     * @param array $urlIds
     * @param mixed[] $params
     *
     * @return MarketingEvent|null
     */
    public static function find(
        Session $session,
        $id,
        array $urlIds = [],
        array $params = []
    ): ?MarketingEvent {
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
     *     limit,
     *     offset
     *
     * @return MarketingEvent[]
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
     * @param mixed[] $params
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
     * @param mixed[] $params Allowed indexes:
     *     occurred_on,
     *     impressions_count,
     *     views_count,
     *     clicks_count,
     *     shares_count,
     *     favorites_count,
     *     comments_count,
     *     ad_spend,
     *     is_cumulative
     * @param array|string $body
     *
     * @return array|null
     */
    public function engagements(
        array $params = [],
        $body = []
    ): ?array {
        $response = parent::request(
            "post",
            "engagements",
            $this->session,
            ["id" => $this->id],
            $params,
            $body,
            $this,
        );

        return $response->getDecodedBody();
    }

}
