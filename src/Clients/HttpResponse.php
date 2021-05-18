<?php

declare(strict_types=1);

namespace Shopify\Clients;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;

class HttpResponse extends Response
{
    private ?string $requestId;

    /**
     * {@inheritDoc}
     */
    public function __construct(
        $status = 200,
        array $headers = [],
        $body = null,
        $version = '1.1',
        $reason = null
    ) {
        parent::__construct($status, $headers, $body, $version, $reason);
        $requestIdHeaderValue = $this->getHeaderLine(HttpHeaders::X_REQUEST_ID);
        $this->requestId = empty($requestIdHeaderValue) ? null : $requestIdHeaderValue;
    }

    public static function fromResponse(ResponseInterface $response): HttpResponse
    {
        return new HttpResponse(
            $response->getStatusCode(),
            $response->getHeaders(),
            $response->getBody(),
            $response->getProtocolVersion(),
            $response->getReasonPhrase()
        );
    }

    /**
     * @return array|string|null Body
     */
    public function getDecodedBody(): array|string|null
    {
        $this->getBody()->rewind();
        $responseBody = $this->getBody()->getContents();
        return $responseBody
            ? json_decode(json: $responseBody, associative: true, flags: JSON_THROW_ON_ERROR)
            : null;
    }

    /**
     * @return string|null request Id
     */
    public function getRequestId(): ?string
    {
        return $this->requestId;
    }
}
