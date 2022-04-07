<?php

declare(strict_types=1);

namespace ShopifyTest\Clients;

use Shopify\Auth\Session;
use Shopify\Rest\Base;

/**
 * @property int $id
 * @property string $attribute
 * @property FakeResource $has_one_attribute
 * @property FakeResource[] $has_many_attribute
 * @property int $other_resource_id
 */
final class FakeResource extends Base
{
    public static string $API_VERSION = "unstable";

    protected static array $HAS_ONE = [
        "has_one_attribute" => FakeResource::class,
    ];

    protected static array $HAS_MANY = [
        "has_many_attribute" => FakeResource::class,
    ];

    protected static array $READ_ONLY_ATTRIBUTES = ["unsaveable_attribute"];

    protected static array $PATHS = [
        ["http_method" => "get", "operation" => "get", "ids" => [], "path" => "fake_resources.json"],
        ["http_method" => "post", "operation" => "post", "ids" => [], "path" => "fake_resources.json"],
        ["http_method" => "get", "operation" => "get", "ids" => ["id"], "path" => "fake_resources/<id>.json"],
        ["http_method" => "put", "operation" => "put", "ids" => ["id"], "path" => "fake_resources/<id>.json"],
        ["http_method" => "delete", "operation" => "delete", "ids" => ["id"], "path" => "fake_resources/<id>.json"],
        [
            "http_method" => "get", "operation" => "custom", "ids" => ["other_resource_id", "id"],
            "path" => "other_resources/<other_resource_id>/fake_resources/<id>/custom.json",
        ],
        [
            "http_method" => "delete", "operation" => "delete", "ids" => ["other_resource_id", "id"],
            "path" => "other_resources/<other_resource_id>/fake_resources/<id>.json",
        ],
    ];

    public static function find(Session $session, int $id, array $params = []): FakeResource
    {
        $result = parent::baseFind($session, ["id" => $id], $params);
        return !empty($result) ? $result[0] : null;
    }

    /**
     * @return FakeResource[]
     */
    public static function all(Session $session, array $params = []): array
    {
        return parent::baseFind($session, [], $params);
    }

    public static function delete(Session $session, int $id, array $otherIds = [])
    {
        parent::request("delete", "delete", $session, array_merge(["id" => $id], $otherIds));
    }

    public static function custom(Session $session, int $id, array $otherIds = []): array
    {
        return parent::request("get", "custom", $session, array_merge(["id" => $id], $otherIds))->getDecodedBody();
    }
}
