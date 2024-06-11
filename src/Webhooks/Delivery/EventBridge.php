<?php

namespace Shopify\Webhooks\Delivery;

use Shopify\Context;
use Shopify\Exception\InvalidArgumentException;
use Shopify\Utils;
use Shopify\Webhooks\DeliveryMethod;

class EventBridge extends DeliveryMethod
{
    /**
     * @throws InvalidArgumentException
     */
    public function __construct()
    {
        if (!Utils::isApiVersionCompatible('2020-07')) {
            throw new InvalidArgumentException(
                "EventBridge webhooks are not supported in API version " . Context::$API_VERSION
            );
        }
    }

    /**
     * @inheritDoc
     */
    public function getCallbackAddress(string $path): string
    {
        return $path;
    }

    /**
     * @inheritDoc
     */
    public function parseCheckQueryResult(array $body): array
    {
        $edges = $body['data']['webhookSubscriptions']['edges'] ?? [];

        $webhookId = null;
        $currentAddress = null;
        if (count($edges ?? [])) {
            $node = $edges[0]['node'];
            $webhookId = (string)$node['id'];
            $currentAddress = $node['endpoint']['arn'];
        }
        return [$webhookId, $currentAddress];
    }

    /**
     * @inheritDoc
     */
    public function buildCheckQuery(string $topic): string
    {
        return <<<QUERY
            {
                webhookSubscriptions(first: 1, topics: $topic) {
                    edges {
                        node {
                            id
                            endpoint {
                                __typename
                                ... on WebhookEventBridgeEndpoint {
                                    arn
                                }
                            }
                        }
                    }
                }
            }
            QUERY;
    }

    /**
     * @inheritDoc
     */
    protected function getMutationName(?string $webhookId): string
    {
        return $webhookId ? "eventBridgeWebhookSubscriptionUpdate" : "eventBridgeWebhookSubscriptionCreate";
    }

    /**
     * @inheritDoc
     */
    protected function queryEndpoint(string $address): string
    {
        return "{arn: \"$address\"}";
    }
}
