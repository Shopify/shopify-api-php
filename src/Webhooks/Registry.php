<?php

declare(strict_types=1);

namespace Shopify\Webhooks;

use Exception;
use Shopify\Clients\Graphql;
use Shopify\Clients\HttpHeaders;
use Shopify\Context;
use Shopify\Exception\InvalidArgumentException;
use Shopify\Exception\InvalidWebhookException;
use Shopify\Exception\MissingWebhookHandlerException;
use Shopify\Exception\WebhookRegistrationException;
use Shopify\Utils;
use Shopify\Webhooks\Delivery\EventBridge;
use Shopify\Webhooks\Delivery\HttpDelivery;
use Shopify\Webhooks\Delivery\PubSub;

/**
 * Handles registering and processing webhook calls.
 */
final class Registry
{
    public const DELIVERY_METHOD_HTTP = 'http';
    public const DELIVERY_METHOD_EVENT_BRIDGE = 'eventbridge';
    public const DELIVERY_METHOD_PUB_SUB = 'pubsub';

    /** @var Handler[] */
    private static $REGISTRY = [];

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
    public static function getHandler(string $topic): ?Handler
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
        ?string $deliveryMethod = self::DELIVERY_METHOD_HTTP
    ): RegisterResponse {
        /** @var DeliveryMethod */
        $method = null;
        switch ($deliveryMethod) {
            case self::DELIVERY_METHOD_EVENT_BRIDGE:
                $method = new EventBridge();
                break;
            case self::DELIVERY_METHOD_PUB_SUB:
                $method = new PubSub();
                break;
            case self::DELIVERY_METHOD_HTTP:
                $method = new HttpDelivery();
                break;
            default:
                throw new InvalidArgumentException("Unrecognized delivery method '$deliveryMethod'");
        }

        $callbackAddress = $method->getCallbackAddress($path);

        $client = new Graphql(Utils::sanitizeShopDomain($shop), $accessToken);

        list($webhookId, $mustRegister) = self::isWebhookRegistrationNeeded(
            $client,
            $topic,
            $callbackAddress,
            $method
        );

        $registered = true;
        $body = null;
        if ($mustRegister) {
            $body = self::sendRegisterRequest(
                $client,
                $topic,
                $callbackAddress,
                $method,
                $webhookId
            );
            $registered = $method->isSuccess($body, $webhookId);
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
     * Checks if Shopify already has a callback set for this webhook via a GraphQL check, and checks if we need to
     * update our subscription if one exists.
     *
     * @param \Shopify\Clients\Graphql         $client
     * @param string                           $topic
     * @param string                           $callbackAddress
     * @param \Shopify\Webhooks\DeliveryMethod $method
     *
     * @return array
     *
     * @throws \Shopify\Exception\HttpRequestException
     * @throws \Shopify\Exception\MissingArgumentException
     * @throws \Shopify\Exception\WebhookRegistrationException
     */
    private static function isWebhookRegistrationNeeded(
        Graphql $client,
        string $topic,
        string $callbackAddress,
        DeliveryMethod $method
    ): array {
        $checkResponse = $client->query($method->buildCheckQuery($topic));

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

        list($webhookId, $currentAddress) = $method->parseCheckQueryResult($checkBody);

        $mustRegister = ($currentAddress !== $callbackAddress);

        return [$webhookId, $mustRegister];
    }

    /**
     * Creates or updates a webhook subscription in Shopify by firing the appropriate GraphQL query.
     *
     * @param \Shopify\Clients\Graphql         $client
     * @param string                           $topic
     * @param string                           $callbackAddress
     * @param \Shopify\Webhooks\DeliveryMethod $deliveryMethod
     * @param string|null                      $webhookId
     *
     * @return array
     *
     * @throws \Shopify\Exception\HttpRequestException
     * @throws \Shopify\Exception\MissingArgumentException
     * @throws \Shopify\Exception\WebhookRegistrationException
     */
    private static function sendRegisterRequest(
        Graphql $client,
        string $topic,
        string $callbackAddress,
        DeliveryMethod $deliveryMethod,
        ?string $webhookId
    ): array {
        $registerResponse = $client->query($deliveryMethod->buildRegisterQuery($topic, $callbackAddress, $webhookId));

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
            [HttpHeaders::X_SHOPIFY_HMAC, HttpHeaders::X_SHOPIFY_TOPIC, HttpHeaders::X_SHOPIFY_DOMAIN],
            false,
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
