<?php

declare(strict_types=1);

namespace Shopify\Clients;

/**
 * Value object used to represent a set of HTTP headers received in a request.
 */
final class HttpHeaders
{
    public const X_SHOPIFY_ACCESS_TOKEN = "X-Shopify-Access-Token";
    public const X_REQUEST_ID = "x-request-id";

    private array $headerSet = [];

    /**
     * Loads a set of HTTP headers.
     *
     * @param array $headers HTTP request headers, from which the set will be loaded. This must be a hash of
     *                       header => value pairs. Value will be forcibly cast to string so objects that implement
     *                       toString are also valid.
     */
    public function __construct(array $headers)
    {
        $this->normalizeAndLoadHeaders($headers);
    }

    /**
     * Checks if this set contains the given header.
     *
     * @param string $header The header to check
     *
     * @return bool
     */
    public function has(string $header): bool
    {
        list($header) = $this->normalizeHeader($header);
        return array_key_exists($header, $this->headerSet);
    }

    /**
     * Fetches the given header, returning null if it does not exist.
     *
     * @param string $header The header to fetch
     *
     * @return string|null
     */
    public function get(string $header): string | null
    {
        if (!$this->has($header)) {
            return null;
        }

        list($header) = $this->normalizeHeader($header);
        return implode(',', $this->headerSet[$header]);
    }

    /**
     * Returns the set of normalized headers as an array of header => value pairs.
     *
     * @return array
     */
    public function toArray(): array
    {
        return $this->headerSet;
    }

    /**
     * Normalizes and then loads the given set of headers, to make sure we're always working with a consistent object.
     *
     * @param array $headers The headers to load
     */
    private function normalizeAndLoadHeaders(array $headers): void
    {
        $this->headerSet = [];
        foreach ($headers as $header => $value) {
            list($header, $value) = $this->normalizeHeader($header, $value);
            $this->headerSet[$header] = $value;
        }
    }

    /**
     * Normalizes a single header and its value, ensuring that they are both stored in a consistent format.
     *
     * @param string $header The header name
     * @param mixed  $value  The header's value
     *
     * @return array Normalized header in format [$header, $value]
     */
    private function normalizeHeader(string $header, mixed $value = null): array
    {
        $value = array_map(fn($item) => (string)$item, (array)$value);

        return [strtolower($header), $value];
    }
}
