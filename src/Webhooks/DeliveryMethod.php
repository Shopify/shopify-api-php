<?php

namespace Shopify\Webhooks;

abstract class DeliveryMethod
{
    /**
     * Builds the full address to be used for the webhook, depending on the delivery method.
     *
     * @param string $path
     *
     * @return string
     */
    abstract public function getCallbackAddress(string $path): string;

    /**
     * Builds the mutation name to be used depending on the delivery method and webhook id.
     *
     * @param string|null $webhookId
     *
     * @return string
     */
    abstract protected function getMutationName(?string $webhookId): string;

    /**
     * Assembles a GraphQL query for registering a webhook.
     *
     * @param string $address
     *
     * @return string
     */
    abstract protected function queryEndpoint(string $address): string;

    /**
     * Builds a GraphQL query to check whether this topic is already registered for the shop.
     *
     * @param string $topic
     *
     * @return string
     */
    abstract public function buildCheckQuery(string $topic): string;

    /**
     * @param array $body
     *
     * @return array Array of the webhookId and current delivery address
     */
    abstract public function parseCheckQueryResult(array $body): array;

    /**
     * Assembles a GraphQL query for registering a webhook.
     *
     * @param string      $topic
     * @param string      $callbackAddress
     * @param string|null $webhookId
     *
     * @return string
     */
    public function buildRegisterQuery(
        string $topic,
        string $callbackAddress,
        ?string $webhookId = null
    ): string {
        $mutationName = $this->getMutationName($webhookId);
        $identifier = $webhookId ? "id: \"$webhookId\"" : "topic: $topic";
        $webhookSubscriptionArgs = $this->queryEndpoint($callbackAddress);

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
     * @param string|null $webhookId
     *
     * @return bool
     */
    public function isSuccess(array $result, ?string $webhookId = null): bool
    {
        return !empty($result['data'][$this->getMutationName($webhookId)]['webhookSubscription']);
    }
}
