<?php

declare(strict_types=1);

namespace Shopify\Rest\Admin2021_10;

use Shopify\Auth\Session;
use Shopify\Rest\Base;

/**
 * @property Checkout|null $checkout
 * @property array|null $credit_card
 * @property int|null $id
 * @property array|null $next_action
 * @property string|null $payment_processing_error_message
 * @property Transaction|null $transaction
 * @property string|null $unique_token
 */
class Payment extends Base
{
    public static string $API_VERSION = "2021-10";
    protected static array $HAS_ONE = [
        "transaction" => Transaction::class,
        "checkout" => Checkout::class
    ];
    protected static array $HAS_MANY = [];
    protected static array $PATHS = [
        ["http_method" => "get", "operation" => "count", "ids" => ["checkout_id"], "path" => "checkouts/<checkout_id>/payments/count.json"],
        ["http_method" => "get", "operation" => "get", "ids" => ["checkout_id"], "path" => "checkouts/<checkout_id>/payments.json"],
        ["http_method" => "get", "operation" => "get", "ids" => ["checkout_id", "id"], "path" => "checkouts/<checkout_id>/payments/<id>.json"],
        ["http_method" => "post", "operation" => "post", "ids" => ["checkout_id"], "path" => "checkouts/<checkout_id>/payments.json"]
    ];

    /**
     * @param Session $session
     * @param int|string $id
     * @param array $urlIds Allowed indexes:
     *     checkout_id
     * @param mixed[] $params
     *
     * @return Payment|null
     */
    public static function find(
        Session $session,
        $id,
        array $urlIds = [],
        array $params = []
    ): ?Payment {
        $result = parent::baseFind(
            $session,
            array_merge(["id" => $id], $urlIds),
            $params,
        );
        return !empty($result) ? $result[0] : null;
    }

    /**
     * @param Session $session
     * @param array $urlIds Allowed indexes:
     *     checkout_id
     * @param mixed[] $params
     *
     * @return Payment[]
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
     *     checkout_id
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

    /**
     * @param string $name
     *
     * @return mixed
     */
    public function __get(string $name): mixed
    {
        if ($name == "token") {
          return $this->checkout ? $this->checkout->token : null;
        }

        return parent::__get($name);
    }

    /**
     * @param string $name
     * @param mixed $value
     *
     * @return void
     */
    public function __set(
        string $name,
        $value
    ): void {
        if ($name == "token") {
          $this->checkout = $this->checkout ?: new Checkout($this->session);
          $this->checkout->token = $value;

          return;
        }

        parent::__set($name, $value);
    }

}
