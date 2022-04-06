<?php

declare(strict_types=1);

namespace ShopifyTest\Clients;

final class MockRequest
{
    /** @var array */
    public $response;
    /** @var string|null */
    public $url = null;
    /** @var string|null */
    public $method = null;
    /** @var string|null */
    public $userAgent = null;
    /** @var array */
    public $headers = [];
    /** @var string|null */
    public $body = null;
    /** @var string|null */
    public $error = null;
    /** @var bool */
    public $allowOtherHeaders = true;
    /** @var bool */
    public $isRetry = false;
    /** @var bool */
    public $identicalBody = false;

    public function __construct(
        array $response,
        ?string $url = null,
        ?string $method = null,
        ?string $userAgent = null,
        array $headers = [],
        ?string $body = null,
        ?string $error = null,
        bool $allowOtherHeaders = true,
        bool $isRetry = false,
        bool $identicalBody = false
    ) {
        $this->response = $response;
        $this->url = $url;
        $this->method = $method;
        $this->userAgent = $userAgent;
        $this->headers = $headers;
        $this->body = $body;
        $this->error = $error;
        $this->allowOtherHeaders = $allowOtherHeaders;
        $this->isRetry = $isRetry;
        $this->identicalBody = $identicalBody;

        array_unshift($this->headers, 'Host: test-shop.myshopify.io');
    }
}
