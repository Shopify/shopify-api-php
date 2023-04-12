<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace Shopify\Rest\Admin2023_04;

use Shopify\Auth\Session;
use Shopify\Rest\Base;

/**
 * @property string|null $created_at
 * @property string|null $feedback_generated_at
 * @property string[]|null $messages
 * @property int|null $product_id
 * @property int|null $resource_id
 * @property string|null $resource_type
 * @property string|null $resource_updated_at
 * @property string|null $state
 * @property string|null $updated_at
 */
class ProductResourceFeedback extends Base
{
    public static string $API_VERSION = "2023-04";
    protected static array $HAS_ONE = [];
    protected static array $HAS_MANY = [];
    protected static array $PATHS = [
        ["http_method" => "get", "operation" => "get", "ids" => ["product_id"], "path" => "products/<product_id>/resource_feedback.json"],
        ["http_method" => "post", "operation" => "post", "ids" => ["product_id"], "path" => "products/<product_id>/resource_feedback.json"]
    ];

    /**

     *
     * @return string
     */
    protected static function getJsonBodyName(): string
    {
        return "resource_feedback";
    }

    /**
     * @param Session $session
     * @param array $urlIds Allowed indexes:
     *     product_id
     * @param mixed[] $params
     *
     * @return ProductResourceFeedback[]
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
