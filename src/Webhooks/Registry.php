<?php

declare(strict_types=1);

namespace Shopify\Webhooks;

use Shopify\Clients\Http;
use Shopify\Context;
use Shopify\Exception\InvalidArgumentException;
use Shopify\Exception\WebhookRegistrationException;
use Shopify\Utils;

/**
 * Handles registering and processing webhook calls.
 */
final class Registry
{
    public const DELIVERY_METHOD_HTTP = 'http';
    public const DELIVERY_METHOD_EVENT_BRIDGE = 'eventbridge';
    private static $DELIVERY_METHODS = [
        self::DELIVERY_METHOD_HTTP,
        self::DELIVERY_METHOD_EVENT_BRIDGE,
    ];

    private static array $REGISTRY = [];

    /**
     * Sets the handler for the given topic. If a handler was previously set for the same topic, it will be overridden.
     *
     * @param string       $topic   The topic to subscribe to. May be a string or a value from the Topics class
     * @param string|array $handler The method that will handle this topic. Must map to a callable static function, e.g.
     *                              ['Class', 'method'], where 'Class' has a static method named 'method'
     */
    public static function addHandler(string $topic, string | array $handler): void
    {
        self::$REGISTRY[$topic] = $handler;
    }

    /**
     * Fetches the handler for the given topic. Returns null if no handler was registered.
     *
     * @param string $topic The topic to check
     *
     * @return string|array|null
     */
    public static function getHandler(string $topic): string | array | null
    {
        return self::$REGISTRY[$topic] ?? null;
    }

    /**
     * Registers a new webhook for this app with Shopify.
     *
     * @param string $path           The URL path for the callback. If using EventBridge, this is the full resource
     *                               address.
     * @param string $topic          The topic to subscribe to. May be a string or a value from the Topics class
     * @param string $shop           The shop to use for requests
     * @param string $accessToken    The access token to use for requests
     * @param string $deliveryMethod The delivery method for this webhook. Defaults to HTTP
     *
     * @return \Shopify\Webhooks\RegisterResponse
     * @throws \Shopify\Exception\HttpRequestException
     * @throws \Shopify\Exception\InvalidArgumentException
     * @throws \Shopify\Exception\WebhookRegistrationException
     */
    public static function register(
        // phpcs:disable
        string $path,
        string $topic,
        string $shop,
        string $accessToken,
        string $deliveryMethod = self::DELIVERY_METHOD_HTTP,
        // phpcs:enable
    ): RegisterResponse {
        if (!in_array($deliveryMethod, self::$DELIVERY_METHODS)) {
            throw new InvalidArgumentException("Unrecognized delivery method '$deliveryMethod'");
        }

        if ($deliveryMethod === self::DELIVERY_METHOD_EVENT_BRIDGE && !self::isEventBridgeSupported()) {
            throw new InvalidArgumentException(
                "EventBridge webhooks are not supported in API version " . Context::$API_VERSION
            );
        }

        $callbackAddress = self::getCallbackAddress($deliveryMethod, $path);

        // TODO Refactor this to use the GraphQL client once that's available
        $client = new Http(Utils::sanitizeShopDomain($shop));

        list($webhookId, $mustRegister) = self::isWebhookRegistrationNeeded(
            $client,
            $topic,
            $accessToken,
            $callbackAddress
        );

        $registered = true;
        $body = null;
        if ($mustRegister) {
            $body = self::sendRegisterRequest(
                $client,
                $topic,
                $callbackAddress,
                $deliveryMethod,
                $accessToken,
                $webhookId
            );
            $registered = self::isSuccess($body, $deliveryMethod, $webhookId);
        }

        return new RegisterResponse($registered, $body);
    }

    /**
     * Builds the full address to be used for the webhook, depending on the delivery method.
     *
     * @param string $deliveryMethod
     * @param string $path
     *
     * @return string
     */
    private static function getCallbackAddress(string $deliveryMethod, string $path): string
    {
        return ($deliveryMethod === self::DELIVERY_METHOD_EVENT_BRIDGE) ?
            $path :
            'https://' . Context::$HOST_NAME . '/' . ltrim($path, '/');
    }

    /**
     * Checks if Shopify already has a callback set for this webhook via a GraphQL check, and checks if we need to
     * update our subscription if one exists.
     *
     * @param Http   $client
     * @param string $topic
     * @param string $accessToken
     * @param string $callbackAddress
     *
     * @return array
     *
     * @throws \Shopify\Exception\HttpRequestException
     * @throws \Shopify\Exception\WebhookRegistrationException
     */
    private static function isWebhookRegistrationNeeded(
        Http $client,
        string $topic,
        string $accessToken,
        string $callbackAddress,
    ): array {
        $checkResponse = $client->post(
            path: 'admin/api/' . Context::$API_VERSION . '/graphql.json',
            body: self::buildCheckQuery($topic),
            dataType: Http::DATA_TYPE_GRAPHQL,
            headers: ['X-Shopify-Access-Token' => $accessToken],
        );

        $checkStatusCode = $checkResponse->getStatusCode();
        $checkBody = $checkResponse->getBody();

        if ($checkStatusCode !== 200) {
            throw new WebhookRegistrationException(
                <<<ERROR
                Failed to check if webhook was already registered (status code $checkStatusCode):
                $checkBody
                ERROR
            );
        }

        $edges = $checkBody['data']['webhookSubscriptions']['edges'] ?? [];

        $mustRegister = true;
        $webhookId = null;
        if (count($edges ?? [])) {
            $node = $edges[0]['node'];

            $webhookId = (string)$node['id'];

            if (array_key_exists('endpoint', $node)) {
                $currentAddress = ($node['endpoint']['__typename'] === 'WebhookHttpEndpoint') ?
                    $node['endpoint']['callbackUrl'] :
                    $node['endpoint']['arn'];
            } else {
                $currentAddress = $node['callbackUrl'];
            }

            $mustRegister = ($currentAddress !== $callbackAddress);
        }

        return [$webhookId, $mustRegister];
    }

    /**
     * Creates or updates a webhook subscription in Shopify by firing the appropriate GraphQL query.
     *
     * @param Http        $client
     * @param string      $topic
     * @param string      $callbackAddress
     * @param string      $deliveryMethod
     * @param string      $accessToken
     * @param string|null $webhookId
     *
     * @return array
     *
     * @throws \Shopify\Exception\HttpRequestException
     * @throws \Shopify\Exception\WebhookRegistrationException
     */
    private static function sendRegisterRequest(
        Http $client,
        string $topic,
        string $callbackAddress,
        string $deliveryMethod,
        string $accessToken,
        ?string $webhookId,
    ): array {
        $registerResponse = $client->post(
            path: 'admin/api/' . Context::$API_VERSION . '/graphql.json',
            body: self::buildRegisterQuery($topic, $callbackAddress, $deliveryMethod, $webhookId),
            dataType: Http::DATA_TYPE_GRAPHQL,
            headers: ['X-Shopify-Access-Token' => $accessToken],
        );

        $statusCode = $registerResponse->getStatusCode();
        $body = $registerResponse->getBody();
        if ($statusCode !== 200) {
            throw new WebhookRegistrationException(
                <<<ERROR
                Failed to register webhook with Shopify (status code $statusCode):
                $body
                ERROR
            );
        }

        return $body;
    }

    /**
     * Determines whether the current API version is compatible with EventBridge webhooks.
     *
     * @return bool
     *
     * @throws \Shopify\Exception\InvalidArgumentException
     */
    private static function isEventBridgeSupported(): bool
    {
        return Utils::isApiVersionCompatible('2020-07');
    }


    /**
     * Builds a GraphQL query to check whether this topic is already registered for the shop.
     *
     * @param string $topic
     *
     * @return string
     */
    private static function buildCheckQuery(string $topic): string
    {
        if (self::isEventBridgeSupported()) {
            return <<<QUERY
            {
                webhookSubscriptions(first: 1, topics: $topic) {
                    edges {
                        node {
                            id
                            endpoint {
                                __typename
                                ... on WebhookHttpEndpoint {
                                    callbackUrl
                                }
                                ... on WebhookEventBridgeEndpoint {
                                    arn
                                }
                            }
                        }
                    }
                }
            }
            QUERY;
        } else {
            return <<<LEGACY_QUERY
            {
                webhookSubscriptions(first: 1, topics: $topic) {
                    edges {
                        node {
                            id
                            callbackUrl
                        }
                    }
                }
            }
            LEGACY_QUERY;
        }
    }

    /**
     * Assembles a GraphQL query for registering a webhook.
     *
     * @param string      $topic
     * @param string      $callbackAddress
     * @param string      $deliveryMethod
     * @param string|null $webhookId
     *
     * @return string
     */
    private static function buildRegisterQuery(
        string $topic,
        string $callbackAddress,
        string $deliveryMethod,
        ?string $webhookId = null
    ): string {
        $mutationName = self::getMutationName($deliveryMethod, $webhookId);
        $identifier = $webhookId ? "id: \"$webhookId\"" : "topic: $topic";
        $webhookSubscriptionArgs = match ($deliveryMethod) {
            self::DELIVERY_METHOD_HTTP => "{callbackUrl: \"$callbackAddress\"}",
            self::DELIVERY_METHOD_EVENT_BRIDGE => "{arn: \"$callbackAddress\"}",
        };

        return <<<QUERY
        mutation webhookSubscription {
            $mutationName($identifier, webhookSubscription: $webhookSubscriptionArgs) {
                userErrors {
                    field
                    message
                }
                webhookSubscription {
                    id
                }
            }
        }
        QUERY;
    }

    /**
     * Checks if the given result was successful.
     *
     * @param array       $result
     * @param string      $deliveryMethod
     * @param string|null $webhookId
     *
     * @return bool
     */
    private static function isSuccess(array $result, string $deliveryMethod, ?string $webhookId = null): bool
    {
        return !empty($result['data'][self::getMutationName($deliveryMethod, $webhookId)]['webhookSubscription']);
    }

    /**
     * Builds the mutation name to be used depending on the delivery method and webhook id.
     *
     * @param string      $deliveryMethod
     * @param string|null $webhookId
     *
     * @return string
     */
    private static function getMutationName(string $deliveryMethod, ?string $webhookId = null): string
    {
        return match (true) {
            ($deliveryMethod === self::DELIVERY_METHOD_HTTP && !$webhookId) =>
                'webhookSubscriptionCreate',
            ($deliveryMethod === self::DELIVERY_METHOD_HTTP && $webhookId) =>
                'webhookSubscriptionUpdate',
            ($deliveryMethod === self::DELIVERY_METHOD_EVENT_BRIDGE && !$webhookId) =>
                'eventBridgeWebhookSubscriptionCreate',
            ($deliveryMethod === self::DELIVERY_METHOD_EVENT_BRIDGE && $webhookId) =>
                'eventBridgeWebhookSubscriptionUpdate',
        };
    }
}
