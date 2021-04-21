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
     *                       If you don't provide this value, you can still use `addRawHeader` to add headers one by
     *                       one manually.
     */
    public function __construct(array $headers = [])
    {
        $this->normalizeAndLoadHeaders($headers);
    }


    /**
     * @param string $header Http header in `header-key: value` format. For example `Content-Type: application/json`.
     *                       If this method is called more than once for the same `header-key` the stored value will be
     *                       an array of values from each call.
     *                       Example:
     *                          If you call `addRawHeader` with `set-cookie: _y=bdc37ee4-ab06-49...`. The value
     *                       associated with this `set-cookie` header will be ` _y=bdc37ee4-ab06-49...`. If you call it
     *                       again with `set-cookie: _s=18d48dd0-a164-4b...`. The value will be
     *                       ['_y=bdc37ee4-ab06-49...', '_s=18d48dd0-a164-4b...']
     *
     *                       If the header string doesn't contain the `:` diameter. The entry will be ignored and the
     *                       length will be returned.
     *
     * @return int Header length
     */
    public function addRawHeader(string $header): int
    {
        $parsedHeader = explode(':', $header, 2);

        if (count($parsedHeader) < 2) {
            return strlen($header);
        }

        $key = strtolower(trim($parsedHeader[0]));
        $value = trim($parsedHeader[1]);

        if (array_key_exists($key, $this->headerSet)) {
            if (gettype($this->headerSet[$key]) !== 'array') {
                $this->headerSet[$key] = [$this->headerSet[$key]];
            }
            array_push($this->headerSet[$key], $value);
        } else {
            $this->headerSet[$key] = $value;
        }

        return strlen($header);
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
        return $this->headerSet[$header];
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
        return [strtolower($header), $value ? (string)$value : null];
    }
}
