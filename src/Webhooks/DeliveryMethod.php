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
     * If the $webhookId is null, it is assumed that the mutation name is for creating a new subscription.
     * Otherwise, it is for updating an existing subscription.
     *
     * @param string|null $webhookId
     *
     * @return string
     */
    abstract protected function getMutationName(?string $webhookId): string;

    /**
     * Assembles the webhook subscription arguments based on the callback address.
     * This allows you to customize the structure of the webhook's subscription data.
     *
     * @param string $address The callback address for the webhook.
     *
     * @return string GraphQL formatted string for the webhook subscription arguments.
     */
    abstract protected function queryEndpoint(string $address): string;

    /**
     * Builds a GraphQL query to check whether this topic is already registered for the shop.
     * This query checks for existing webhook subscriptions for a specific topic.
     *
     * @param string $topic The topic to check.
     *
     * @return string GraphQL query string to check if a topic is already registered.
     */
    abstract public function buildCheckQuery(string $topic): string;

    /**
     * Parses the result of the check query and returns the webhookId and current delivery address.
     * This method interprets the response to extract meaningful data, like the webhook ID and its delivery address.
     *
     * @param array $body The response body from the GraphQL query.
     *
     * @return array Array containing the webhookId and current delivery address.
     */
    abstract public function parseCheckQueryResult(array $body): array;

    /**
     * Assembles a GraphQL query for registering or updating a webhook subscription.
     * This method now supports adding additional optional fields and metafield namespaces,
     * which allows further customization of the webhook subscription.
     * The operation (create/update) is determined by the webhookId.
     *
     * @param string      $topic               The topic for the webhook subscription.
     * @param string      $callbackAddress     The callback URL for the webhook.
     * @param string|null $webhookId           Optional webhook ID for updating an existing subscription.
     * @param array       $fields              Optional fields to include in the webhook subscription.
     * @param array       $metafieldNamespaces Optional metafield namespaces to include.
     *
     * @return string The GraphQL query to register or update the webhook.
     */
    public function buildRegisterQuery(
        string $topic,
        string $callbackAddress,
        ?string $webhookId = null,
        array $fields = [],
        array $metafieldNamespaces = []
    ): string {
        $mutationName = $this->getMutationName($webhookId);
        $identifier = $webhookId ? "id: \"$webhookId\"" : "topic: $topic";
        $webhookSubscriptionArgs = $this->queryEndpoint($callbackAddress);

        $query = "$identifier, webhookSubscription: {{$webhookSubscriptionArgs}";

        if (!empty($fields)) {
            $query .= ' fields: [' . implode(',', $fields) . ']';
        }

        if (!empty($metafieldNamespaces)) {
            $query .= ' metafieldNamespaces: [' . implode(',', $metafieldNamespaces) . ']';
        }

        $query .= "}";

        return <<<QUERY
        mutation webhookSubscription {
            $mutationName($query) {
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
     * Checks if the given result indicates a successful registration or update of the webhook subscription.
     * 
     * This method inspects the GraphQL response to determine whether the operation succeeded.
     *
     * @param array       $result    The response array from the GraphQL query.
     * @param string|null $webhookId Optional webhook ID to distinguish between create and update mutations.
     *
     * @return bool True if the operation was successful, otherwise false.
     */
    public function isSuccess(array $result, ?string $webhookId = null): bool
    {
        return !empty($result['data'][$this->getMutationName($webhookId)]['webhookSubscription']);
    }
}
