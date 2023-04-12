<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace Shopify\Rest\Admin2023_01;

use Shopify\Auth\Session;
use Shopify\Rest\Base;

/**
 * @property int|null $dispute_evidence_id
 * @property string|null $dispute_evidence_type
 * @property int|null $file_size
 * @property string|null $file_type
 * @property string|null $filename
 * @property int|null $id
 * @property string|null $original_filename
 * @property int|null $shop_id
 * @property string|null $url
 */
class DisputeFileUpload extends Base
{
    public static string $API_VERSION = "2023-01";
    protected static array $HAS_ONE = [];
    protected static array $HAS_MANY = [];
    protected static array $PATHS = [
        ["http_method" => "delete", "operation" => "delete", "ids" => ["dispute_id", "id"], "path" => "shopify_payments/disputes/<dispute_id>/dispute_file_uploads/<id>.json"],
        ["http_method" => "post", "operation" => "post", "ids" => ["dispute_id"], "path" => "shopify_payments/disputes/<dispute_id>/dispute_file_uploads.json"]
    ];

    /**
     * @param Session $session
     * @param int|string $id
     * @param array $urlIds Allowed indexes:
     *     dispute_id
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

}
