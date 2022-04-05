<?php

declare(strict_types=1);

namespace Shopify\Rest\Admin2021_10;

use Shopify\Auth\Session;
use Shopify\Rest\Base;

/**
 * @property string $key
 * @property string $namespace
 * @property string|int|float $value
 * @property int|null $article_id
 * @property int|null $blog_id
 * @property int|null $collection_id
 * @property string|null $created_at
 * @property int|null $customer_id
 * @property string|null $description
 * @property int|null $draft_order_id
 * @property int|null $id
 * @property int|null $order_id
 * @property int|null $owner_id
 * @property string|null $owner_resource
 * @property int|null $page_id
 * @property int|null $product_id
 * @property int|null $product_image_id
 * @property string|null $type
 * @property string|null $updated_at
 * @property string|null $value_type
 * @property int|null $variant_id
 */
class Metafield extends Base
{
    public static string $API_VERSION = "2021-10";
    protected static array $HAS_ONE = [];
    protected static array $HAS_MANY = [];
    protected static array $PATHS = [
        ["http_method" => "delete", "operation" => "delete", "ids" => ["article_id", "id"], "path" => "articles/<article_id>/metafields/<id>.json"],
        ["http_method" => "delete", "operation" => "delete", "ids" => ["blog_id", "id"], "path" => "blogs/<blog_id>/metafields/<id>.json"],
        ["http_method" => "delete", "operation" => "delete", "ids" => ["collection_id", "id"], "path" => "collections/<collection_id>/metafields/<id>.json"],
        ["http_method" => "delete", "operation" => "delete", "ids" => ["customer_id", "id"], "path" => "customers/<customer_id>/metafields/<id>.json"],
        ["http_method" => "delete", "operation" => "delete", "ids" => ["draft_order_id", "id"], "path" => "draft_orders/<draft_order_id>/metafields/<id>.json"],
        ["http_method" => "delete", "operation" => "delete", "ids" => ["id"], "path" => "metafields/<id>.json"],
        ["http_method" => "delete", "operation" => "delete", "ids" => ["order_id", "id"], "path" => "orders/<order_id>/metafields/<id>.json"],
        ["http_method" => "delete", "operation" => "delete", "ids" => ["page_id", "id"], "path" => "pages/<page_id>/metafields/<id>.json"],
        ["http_method" => "delete", "operation" => "delete", "ids" => ["product_image_id", "id"], "path" => "product_images/<product_image_id>/metafields/<id>.json"],
        ["http_method" => "delete", "operation" => "delete", "ids" => ["product_id", "id"], "path" => "products/<product_id>/metafields/<id>.json"],
        ["http_method" => "delete", "operation" => "delete", "ids" => ["variant_id", "id"], "path" => "variants/<variant_id>/metafields/<id>.json"],
        ["http_method" => "get", "operation" => "count", "ids" => ["article_id"], "path" => "articles/<article_id>/metafields/count.json"],
        ["http_method" => "get", "operation" => "count", "ids" => ["blog_id"], "path" => "blogs/<blog_id>/metafields/count.json"],
        ["http_method" => "get", "operation" => "count", "ids" => ["collection_id"], "path" => "collections/<collection_id>/metafields/count.json"],
        ["http_method" => "get", "operation" => "count", "ids" => ["customer_id"], "path" => "customers/<customer_id>/metafields/count.json"],
        ["http_method" => "get", "operation" => "count", "ids" => ["draft_order_id"], "path" => "draft_orders/<draft_order_id>/metafields/count.json"],
        ["http_method" => "get", "operation" => "count", "ids" => [], "path" => "metafields/count.json"],
        ["http_method" => "get", "operation" => "count", "ids" => ["order_id"], "path" => "orders/<order_id>/metafields/count.json"],
        ["http_method" => "get", "operation" => "count", "ids" => ["page_id"], "path" => "pages/<page_id>/metafields/count.json"],
        ["http_method" => "get", "operation" => "count", "ids" => ["product_image_id"], "path" => "product_images/<product_image_id>/metafields/count.json"],
        ["http_method" => "get", "operation" => "count", "ids" => ["product_id"], "path" => "products/<product_id>/metafields/count.json"],
        ["http_method" => "get", "operation" => "count", "ids" => ["variant_id"], "path" => "variants/<variant_id>/metafields/count.json"],
        ["http_method" => "get", "operation" => "get", "ids" => ["article_id"], "path" => "articles/<article_id>/metafields.json"],
        ["http_method" => "get", "operation" => "get", "ids" => ["article_id", "id"], "path" => "articles/<article_id>/metafields/<id>.json"],
        ["http_method" => "get", "operation" => "get", "ids" => ["blog_id"], "path" => "blogs/<blog_id>/metafields.json"],
        ["http_method" => "get", "operation" => "get", "ids" => ["blog_id", "id"], "path" => "blogs/<blog_id>/metafields/<id>.json"],
        ["http_method" => "get", "operation" => "get", "ids" => ["collection_id"], "path" => "collections/<collection_id>/metafields.json"],
        ["http_method" => "get", "operation" => "get", "ids" => ["collection_id", "id"], "path" => "collections/<collection_id>/metafields/<id>.json"],
        ["http_method" => "get", "operation" => "get", "ids" => ["customer_id"], "path" => "customers/<customer_id>/metafields.json"],
        ["http_method" => "get", "operation" => "get", "ids" => ["customer_id", "id"], "path" => "customers/<customer_id>/metafields/<id>.json"],
        ["http_method" => "get", "operation" => "get", "ids" => ["draft_order_id"], "path" => "draft_orders/<draft_order_id>/metafields.json"],
        ["http_method" => "get", "operation" => "get", "ids" => ["draft_order_id", "id"], "path" => "draft_orders/<draft_order_id>/metafields/<id>.json"],
        ["http_method" => "get", "operation" => "get", "ids" => [], "path" => "metafields.json"],
        ["http_method" => "get", "operation" => "get", "ids" => [], "path" => "metafields.json"],
        ["http_method" => "get", "operation" => "get", "ids" => ["id"], "path" => "metafields/<id>.json"],
        ["http_method" => "get", "operation" => "get", "ids" => ["order_id"], "path" => "orders/<order_id>/metafields.json"],
        ["http_method" => "get", "operation" => "get", "ids" => ["order_id", "id"], "path" => "orders/<order_id>/metafields/<id>.json"],
        ["http_method" => "get", "operation" => "get", "ids" => ["page_id"], "path" => "pages/<page_id>/metafields.json"],
        ["http_method" => "get", "operation" => "get", "ids" => ["page_id", "id"], "path" => "pages/<page_id>/metafields/<id>.json"],
        ["http_method" => "get", "operation" => "get", "ids" => ["product_image_id"], "path" => "product_images/<product_image_id>/metafields.json"],
        ["http_method" => "get", "operation" => "get", "ids" => ["product_image_id", "id"], "path" => "product_images/<product_image_id>/metafields/<id>.json"],
        ["http_method" => "get", "operation" => "get", "ids" => ["product_id"], "path" => "products/<product_id>/metafields.json"],
        ["http_method" => "get", "operation" => "get", "ids" => ["product_id", "id"], "path" => "products/<product_id>/metafields/<id>.json"],
        ["http_method" => "get", "operation" => "get", "ids" => ["variant_id"], "path" => "variants/<variant_id>/metafields.json"],
        ["http_method" => "get", "operation" => "get", "ids" => ["variant_id", "id"], "path" => "variants/<variant_id>/metafields/<id>.json"],
        ["http_method" => "post", "operation" => "post", "ids" => ["article_id"], "path" => "articles/<article_id>/metafields.json"],
        ["http_method" => "post", "operation" => "post", "ids" => ["blog_id"], "path" => "blogs/<blog_id>/metafields.json"],
        ["http_method" => "post", "operation" => "post", "ids" => ["collection_id"], "path" => "collections/<collection_id>/metafields.json"],
        ["http_method" => "post", "operation" => "post", "ids" => ["customer_id"], "path" => "customers/<customer_id>/metafields.json"],
        ["http_method" => "post", "operation" => "post", "ids" => ["draft_order_id"], "path" => "draft_orders/<draft_order_id>/metafields.json"],
        ["http_method" => "post", "operation" => "post", "ids" => [], "path" => "metafields.json"],
        ["http_method" => "post", "operation" => "post", "ids" => ["order_id"], "path" => "orders/<order_id>/metafields.json"],
        ["http_method" => "post", "operation" => "post", "ids" => ["page_id"], "path" => "pages/<page_id>/metafields.json"],
        ["http_method" => "post", "operation" => "post", "ids" => ["product_image_id"], "path" => "product_images/<product_image_id>/metafields.json"],
        ["http_method" => "post", "operation" => "post", "ids" => ["product_id"], "path" => "products/<product_id>/metafields.json"],
        ["http_method" => "post", "operation" => "post", "ids" => ["variant_id"], "path" => "variants/<variant_id>/metafields.json"],
        ["http_method" => "put", "operation" => "put", "ids" => ["article_id", "id"], "path" => "articles/<article_id>/metafields/<id>.json"],
        ["http_method" => "put", "operation" => "put", "ids" => ["blog_id", "id"], "path" => "blogs/<blog_id>/metafields/<id>.json"],
        ["http_method" => "put", "operation" => "put", "ids" => ["collection_id", "id"], "path" => "collections/<collection_id>/metafields/<id>.json"],
        ["http_method" => "put", "operation" => "put", "ids" => ["customer_id", "id"], "path" => "customers/<customer_id>/metafields/<id>.json"],
        ["http_method" => "put", "operation" => "put", "ids" => ["draft_order_id", "id"], "path" => "draft_orders/<draft_order_id>/metafields/<id>.json"],
        ["http_method" => "put", "operation" => "put", "ids" => ["id"], "path" => "metafields/<id>.json"],
        ["http_method" => "put", "operation" => "put", "ids" => ["order_id", "id"], "path" => "orders/<order_id>/metafields/<id>.json"],
        ["http_method" => "put", "operation" => "put", "ids" => ["page_id", "id"], "path" => "pages/<page_id>/metafields/<id>.json"],
        ["http_method" => "put", "operation" => "put", "ids" => ["product_image_id", "id"], "path" => "product_images/<product_image_id>/metafields/<id>.json"],
        ["http_method" => "put", "operation" => "put", "ids" => ["product_id", "id"], "path" => "products/<product_id>/metafields/<id>.json"],
        ["http_method" => "put", "operation" => "put", "ids" => ["variant_id", "id"], "path" => "variants/<variant_id>/metafields/<id>.json"]
    ];

    /**
     * @param Session $session
     * @param int|string $id
     * @param array $urlIds Allowed indexes:
     *     article_id
     *     blog_id
     *     collection_id
     *     customer_id
     *     draft_order_id
     *     order_id
     *     page_id
     *     product_image_id
     *     product_id
     *     variant_id
     * @param mixed[] $params
     *
     * @return Metafield|null
     */
    public static function find(
        Session $session,
        $id,
        array $urlIds = [],
        array $params = []
    ): ?Metafield {
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
     * @param array $urlIds Allowed indexes:
     *     article_id
     *     blog_id
     *     collection_id
     *     customer_id
     *     draft_order_id
     *     order_id
     *     page_id
     *     product_image_id
     *     product_id
     *     variant_id
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
     * @param array $urlIds Allowed indexes:
     *     article_id
     *     blog_id
     *     collection_id
     *     customer_id
     *     draft_order_id
     *     order_id
     *     page_id
     *     product_image_id
     *     product_id
     *     variant_id
     * @param mixed[] $params Allowed indexes:
     *     limit,
     *     since_id,
     *     created_at_min,
     *     created_at_max,
     *     updated_at_min,
     *     updated_at_max,
     *     namespace,
     *     key,
     *     type,
     *     value_type,
     *     fields,
     *     metafield
     *
     * @return Metafield[]
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

    /**
     * @param Session $session
     * @param array $urlIds Allowed indexes:
     *     article_id
     *     blog_id
     *     collection_id
     *     customer_id
     *     draft_order_id
     *     order_id
     *     page_id
     *     product_image_id
     *     product_id
     *     variant_id
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
            $urlIds,
            $params,
            [],
        );

        return $response->getDecodedBody();
    }

}
