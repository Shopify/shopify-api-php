<?php

declare(strict_types=1);

namespace Shopify\Webhooks;

use Exception;
use Shopify\Clients\Http;
use Shopify\Clients\HttpHeaders;
use Shopify\Context;
use Shopify\Exception\InvalidArgumentException;
use Shopify\Exception\InvalidWebhookException;
use Shopify\Exception\MissingWebhookHandlerException;
use Shopify\Exception\WebhookRegistrationException;
use Shopify\Utils;

/**
 * Handles registering and processing webhook calls.
 */
final class Registry
{
    public const DELIVERY_METHOD_HTTP = 'http';
    public const DELIVERY_METHOD_EVENT_BRIDGE = 'eventbridge';
    private static array $DELIVERY_METHODS = [
        self::DELIVERY_METHOD_HTTP,
        self::DELIVERY_METHOD_EVENT_BRIDGE,
    ];

    /** @var Handler[] */
    private static array $REGISTRY = [];

    /**
     * Sets the handler for the given topic. If a handler was previously set for the same topic, it will be overridden.
     *
     * @param string  $topic   The topic to subscribe to. May be a string or a value from the Topics class
     * @param Handler $handler The handler for this topic
     */
    public static function addHandler(string $topic, Handler $handler): void
    {
        self::$REGISTRY[$topic] = $handler;
    }

    /**
     * Fetches the handler for the given topic. Returns null if no handler was registered.
     *
     * @param string $topic The topic to check
     *
     * @return Handler|null
     */
    public static function getHandler(string $topic): Handler | null
    {
        return self::$REGISTRY[$topic] ?? null;
    }

    /**
     * Registers a new webhook for this app with Shopify.
     *
     * @param string        $path           The URL path for the callback. If using EventBridge, this is the full
     *                                      resource address
     * @param string        $topic          The topic to subscribe to. May be a string or a value from the Topics class
     * @param string        $shop           The shop to use for requests
     * @param string        $accessToken    The access token to use for requests
     * @param string|null   $deliveryMethod The delivery method for this webhook. Defaults to HTTP
     *
     * @return \Shopify\Webhooks\RegisterResponse
     * @throws \Psr\Http\Client\ClientExceptionInterface
     * @throws \Shopify\Exception\InvalidArgumentException
     * @throws \Shopify\Exception\UninitializedContextException
     * @throws \Shopify\Exception\WebhookRegistrationException
     */
    public static function register(
        string $path,
        string $topic,
        string $shop,
        string $accessToken,
        ?string $deliveryMethod = self::DELIVERY_METHOD_HTTP,
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
     * Processes a triggered webhook, calling the appropriate handler.
     *
     * @param array  $rawHeaders The raw HTTP headers for the request
     * @param string $rawBody    The raw body of the HTTP request
     *
     * @return ProcessResponse
     *
     * @throws \Shopify\Exception\InvalidWebhookException
     * @throws \Shopify\Exception\MissingWebhookHandlerException
     */
    public static function process(array $rawHeaders, string $rawBody): ProcessResponse
    {
        if (empty($rawBody)) {
            throw new InvalidWebhookException("No body was received when processing webhook");
        }

        $headers = self::parseProcessHeaders($rawHeaders);

        $topic = $headers->get(HttpHeaders::X_SHOPIFY_TOPIC);
        $shop = $headers->get(HttpHeaders::X_SHOPIFY_DOMAIN);
        $hmac = $headers->get(HttpHeaders::X_SHOPIFY_HMAC);

        self::validateProcessHmac($rawBody, $hmac);

        $body = json_decode($rawBody, true);

        $topic = self::convertTopic($topic);
        $handler = self::getHandler($topic);
        if (!$handler) {
            throw new MissingWebhookHandlerException("No handler was registered for topic '$topic'");
        }

        try {
            $handler->handle($topic, $shop, $body);
            $response = new ProcessResponse(true);
        } catch (Exception $error) {
            $response = new ProcessResponse(false, $error->getMessage());
        }

        return $response;
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
     * @throws \Psr\Http\Client\ClientExceptionInterface
     * @throws \Shopify\Exception\InvalidArgumentException
     * @throws \Shopify\Exception\UninitializedContextException
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
        $checkBody = $checkResponse->getDecodedBody();

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
     * @throws \Psr\Http\Client\ClientExceptionInterface
     * @throws \Shopify\Exception\UninitializedContextException
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
        $body = $registerResponse->getDecodedBody();
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
     * @throws \Shopify\Exception\InvalidArgumentException
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

    /**
     * Checks if all the necessary headers are given for this to be a valid webhook, returning the parsed headers.
     *
     * @param array $rawHeaders The raw HTTP headers from the request
     *
     * @return HttpHeaders The parsed headers
     *
     * @throws \Shopify\Exception\InvalidWebhookException
     */
    private static function parseProcessHeaders(array $rawHeaders): HttpHeaders
    {
        $headers = new HttpHeaders($rawHeaders);

        $missingHeaders = $headers->diff(
            headers: [HttpHeaders::X_SHOPIFY_HMAC, HttpHeaders::X_SHOPIFY_TOPIC, HttpHeaders::X_SHOPIFY_DOMAIN],
            allowEmpty: false,
        );

        if (!empty($missingHeaders)) {
            $missingHeaders = implode(', ', $missingHeaders);
            throw new InvalidWebhookException(
                "Missing one or more of the required HTTP headers to process webhooks: [$missingHeaders]"
            );
        }

        return $headers;
    }

    /**
     * Checks if the given HMAC hash is valid.
     *
     * @param string $rawBody The HTTP request body
     * @param string $hmac    The HMAC from the HTTP headers
     *
     * @throws \Shopify\Exception\InvalidWebhookException
     */
    private static function validateProcessHmac(string $rawBody, string $hmac): void
    {
        if ($hmac !== base64_encode(hash_hmac('sha256', $rawBody, Context::$API_SECRET_KEY, true))) {
            throw new InvalidWebhookException("Could not validate webhook HMAC");
        }
    }

    /**
     * Converts the topic from the webhook post format (e.g. products/create) to the GraphQL format (PRODUCTS_CREATE)
     *
     * @param string $topic The topic to convert
     *
     * @return string
     */
    private static function convertTopic(string $topic): string
    {
        return strtoupper(str_replace('/', '_', $topic));
    }
}
