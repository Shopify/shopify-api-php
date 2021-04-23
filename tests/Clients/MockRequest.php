<?php

declare(strict_types=1);

namespace ShopifyTest\Clients;

final class MockRequest
{
    public function __construct(
        public array $response,
        public ?string $url = null,
        public ?string $method = null,
        public ?string $userAgent = null,
        public array $headers = [],
        public ?string $body = null,
        public ?string $error = null,
        public bool $allowOtherHeaders = true,
        public bool $isRetry = false,
    ) {

        array_unshift($this->headers, 'Host: test-shop.myshopify.io');
    }
}
