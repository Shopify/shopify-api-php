<?php

declare(strict_types=1);

namespace Shopify\Webhooks;

interface Handler
{
    /**
     * Handles a webhook event from Shopify. If this method finishes executing, the webhook is considered successful.
     *
     * @param string $topic The webhook topic that was triggered
     * @param string $shop  The shop that triggered the event
     * @param array  $body  The payload of the webhook request from Shopify
     */
    public function handle(string $topic, string $shop, array $body): void;
}
