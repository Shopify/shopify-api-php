<?php

namespace Shopify\Webhooks\Delivery;

use Shopify\Context;
use Shopify\Utils;
use Shopify\Webhooks\DeliveryMethod;

class HttpDelivery extends DeliveryMethod
{
    /**
     * @inheritDoc
     */
    public function getCallbackAddress(string $path): string
    {
        return 'https://' . Context::$HOST_NAME . '/' . ltrim($path, '/');
    }

    /**
     * Builds a GraphQL query to check whether this topic is already registered for the shop.
     *
     * @param string $topic
     *
     * @return string
     * @throws \Shopify\Exception\InvalidArgumentException
     */
    public function buildCheckQuery(string $topic): string
    {
        if (Utils::isApiVersionCompatible('2020-07')) {
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
            if (array_key_exists('endpoint', $node)) {
                $currentAddress = $node['endpoint']['callbackUrl'];
            } else {
                $currentAddress = $node['callbackUrl'];
            }
        }
        return [$webhookId, $currentAddress];
    }

    /**
     * @inheritDoc
     */
    protected function getMutationName(?string $webhookId): string
    {
        return $webhookId ? "webhookSubscriptionUpdate" : "webhookSubscriptionCreate";
    }

    /**
     * @inheritDoc
     */
    protected function queryEndpoint(string $address): string
    {
        return "{callbackUrl: \"$address\"}";
    }
}
