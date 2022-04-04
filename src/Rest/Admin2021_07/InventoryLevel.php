<?php

declare(strict_types=1);

namespace Shopify\Rest\Admin2021_07;

use Shopify\Auth\Session;
use Shopify\Rest\Base;

/**
 * @property int|null $available
 * @property int|null $inventory_item_id
 * @property int|null $location_id
 * @property string|null $updated_at
 */
class InventoryLevel extends Base
{
    public static string $API_VERSION = "2021-07";
    protected static array $HAS_ONE = [];
    protected static array $HAS_MANY = [];
    protected static array $PATHS = [
        ["http_method" => "delete", "operation" => "delete", "ids" => [], "path" => "inventory_levels.json"],
        ["http_method" => "get", "operation" => "get", "ids" => [], "path" => "inventory_levels.json"],
        ["http_method" => "post", "operation" => "adjust", "ids" => [], "path" => "inventory_levels/adjust.json"],
        ["http_method" => "post", "operation" => "connect", "ids" => [], "path" => "inventory_levels/connect.json"],
        ["http_method" => "post", "operation" => "set", "ids" => [], "path" => "inventory_levels/set.json"]
    ];

    /**
     * @param Session $session
     * @param array $urlIds
     * @param mixed[] $params Allowed indexes:
     *     inventory_item_id,
     *     location_id
     *
     * @return array|null
     */
    public static function delete(
        Session $session,
        array $urlIds = [],
        array $params = []
    ): ?array {
        $response = parent::request(
            "delete",
            "delete",
            $session,
            [],
            $params,
        );

        return $response->getDecodedBody();
    }

    /**
     * @param Session $session
     * @param array $urlIds
     * @param mixed[] $params Allowed indexes:
     *     inventory_item_ids,
     *     location_ids,
     *     limit,
     *     updated_at_min
     *
     * @return InventoryLevel[]
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
     * @param mixed[] $params Allowed indexes:
     *     inventory_item_id,
     *     location_id,
     *     available_adjustment
     * @param array|string $body
     *
     * @return array|null
     */
    public function adjust(
        array $params = [],
        $body = []
    ): ?array {
        $response = parent::request(
            "post",
            "adjust",
            $this->session,
            [],
            $params,
            $body,
            $this,
        );

        return $response->getDecodedBody();
    }

    /**
     * @param mixed[] $params Allowed indexes:
     *     inventory_item_id,
     *     location_id,
     *     relocate_if_necessary
     * @param array|string $body
     *
     * @return array|null
     */
    public function connect(
        array $params = [],
        $body = []
    ): ?array {
        $response = parent::request(
            "post",
            "connect",
            $this->session,
            [],
            $params,
            $body,
            $this,
        );

        return $response->getDecodedBody();
    }

    /**
     * @param mixed[] $params Allowed indexes:
     *     inventory_item_id,
     *     location_id,
     *     available,
     *     disconnect_if_necessary
     * @param array|string $body
     *
     * @return array|null
     */
    public function set(
        array $params = [],
        $body = []
    ): ?array {
        $response = parent::request(
            "post",
            "set",
            $this->session,
            [],
            $params,
            $body,
            $this,
        );

        return $response->getDecodedBody();
    }

}
