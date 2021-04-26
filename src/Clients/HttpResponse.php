<?php

declare(strict_types=1);

namespace Shopify\Clients;

class HttpResponse
{
    private ?string $requestId;

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
        $this->requestId = $this->headers[HttpHeaders::X_REQUEST_ID][0] ?? null;
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

    /**
     * @return string|null request Id
     */
    public function getRequestId(): ?string
    {
        return $this->requestId;
    }
}
