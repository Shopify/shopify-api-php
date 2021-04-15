<?php

declare(strict_types=1);

namespace Shopify\Clients;

class HttpResponse
{

    /**
     * HttpResponse constructor.
     *
     * @param int               $statusCode
     * @param array             $headers
     * @param array|string|null $body
     */
    public function __construct(
        private int $statusCode,
        private array $headers = [],
        private array|string|null $body = null
    ) {
    }

    /**
     * @return int HTTP status code
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @return array HTTP headers
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @return array|string|null Body
     */
    public function getBody(): array|string|null
    {
        return $this->body;
    }
}
