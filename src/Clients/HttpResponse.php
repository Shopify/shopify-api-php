<?php

declare(strict_types=1);

namespace Shopify\Clients;

class HttpResponse
{

    private ?string $requestId;

    /**
     * HttpResponse constructor.
     *
     * @param int                          $statusCode
     * @param \Shopify\Clients\HttpHeaders $headers
     * @param array|string|null            $body
     */
    public function __construct(
        private int $statusCode,
        private HttpHeaders $headers,
        private array|string|null $body = null
    ) {
        $this->requestId = $this->headers->get(HttpHeaders::X_REQUEST_ID);
    }

    /**
     * @return int HTTP status code
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @return \Shopify\Clients\HttpHeaders HTTP headers
     */
    public function getHeaders(): HttpHeaders
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
