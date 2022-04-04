<?php

declare(strict_types=1);

namespace Shopify\Rest\Admin2021_10;

use Shopify\Auth\Session;
use Shopify\Rest\Base;

/**
 * @property string|null $created_at
 * @property string|null $feedback_generated_at
 * @property string[]|null $messages
 * @property int|null $resource_id
 * @property string|null $resource_type
 * @property string|null $state
 * @property string|null $updated_at
 */
class ResourceFeedback extends Base
{
    public static string $API_VERSION = "2021-10";
    protected static array $HAS_ONE = [];
    protected static array $HAS_MANY = [];
    protected static array $PATHS = [
        ["http_method" => "get", "operation" => "get", "ids" => [], "path" => "resource_feedback.json"],
        ["http_method" => "post", "operation" => "post", "ids" => [], "path" => "resource_feedback.json"]
    ];

    /**
     * @param Session $session
     * @param array $urlIds
     * @param mixed[] $params
     *
     * @return ResourceFeedback[]
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
