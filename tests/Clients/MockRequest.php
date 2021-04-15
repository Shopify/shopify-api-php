<?php

declare(strict_types=1);

namespace ShopifyTest\Clients;

final class MockRequest
{
    public function __construct(
        // phpcs:disable
        public string $url,
        public string $method,
        public string $userAgent,
        public array $headers,
        public array $response,
        public ?string $body = null,
        public ?string $error = null,
        public bool $allowOtherHeaders = true,
        // phpcs:enable
    ) {
    }
}
