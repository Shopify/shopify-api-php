<?php

declare(strict_types=1);

namespace ShopifyTest;

use PHPUnit\Framework\Constraint\Constraint;
use Shopify\Clients\HttpResponse;

class HttpResponseMatcher extends Constraint
{
    /** @var int */
    private $statusCode = 200;
    /** @var array */
    private $headers = [];
    /** @var array|null */
    private $decodedBody = null;

    /**
     * HttpResponseMatcher constructor.
     *
     * @param int        $statusCode  HTTP Status Code
     * @param array      $headers     Headers formatted as `[headerName] => [value1, value2, ...]
     * @param array|null $decodedBody Body as an array
     */
    public function __construct(
        int $statusCode = 200,
        array $headers = [],
        ?array $decodedBody = null
    ) {
        $this->statusCode = $statusCode;
        $this->headers = $headers;
        $this->decodedBody = $decodedBody;
    }

    protected function matches($other): bool
    {
        if (!($other instanceof HttpResponse)) {
            return false;
        }

        return $this->statusCode === $other->getStatusCode()
            && $this->headers == $other->getHeaders()
            && $this->decodedBody === $other->getDecodedBody();
    }


    public function toString(): string
    {
        return "HttpResponseMatcher";
    }

    protected function additionalFailureDescription($other): string
    {
        $diff = [];
        if ($this->statusCode !== $other->getStatusCode()) {
            $diff[] = $this->diffLine("Status Code", $this->statusCode, $other->getStatusCode());
        }
        if ($this->headers != $other->getHeaders()) {
            $diff[] = $this->diffLine("Headers", $this->headers, $other->getHeaders());
        }
        if ($this->decodedBody != $other->getDecodedBody()) {
            $diff[] = $this->diffLine("Decoded Body", $this->decodedBody, $other->getDecodedBody());
        }

        return implode("\n", $diff);
    }

    private function diffLine(string $header, mixed $expected, mixed $actual): string
    {
        $expected = print_r($expected, true);
        $actual = print_r($actual, true);

        return "## $header:\n `$actual` Doesn't match expected `$expected`";
    }
}
