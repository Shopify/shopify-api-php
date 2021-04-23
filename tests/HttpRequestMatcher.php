<?php

namespace ShopifyTest;

use PHPUnit\Framework\Constraint\Constraint;
use Psr\Http\Message\RequestInterface;

class HttpRequestMatcher extends Constraint
{

    private string $actualBody;

    /**
     * HttpRequestMatcher constructor.
     *
     * @param string      $url               Expected HTTP URL including query parameters
     * @param string      $method            Expected Http Method
     * @param string      $userAgent         Expected Http User-Agent Header Value
     * @param array       $headers           Expected Http Headers other than User-Agent
     * @param string|null $body              Expected Http Headers
     * @param bool        $allowOtherHeaders When true will assert for contains rather than equals
     */
    public function __construct(
        private string $url,
        private string $method,
        private string $userAgent,
        private array $headers = [],
        private ?string $body = null,
        private bool $allowOtherHeaders = true,
    ) {
    }

    protected function matches($other): bool
    {
        if (!($other instanceof RequestInterface)) {
            return false;
        }
        $this->actualBody = $this->actualBody ?? $other->getBody()->getContents();
        return
            ($other->getUri() == $this->url)
            && ($other->getMethod() === $this->method)
            && $this->matchBody()
            && $this->matchHeadersWithoutUserAgent($other)
            && $this->matchUserAgent($other);
    }


    private function matchUserAgent(RequestInterface $request): bool
    {
        return preg_match($this->userAgent, $request->getHeaderLine('user-agent')) !== false;
    }

    private function matchBody(): bool
    {
        return $this->body === $this->actualBody;
    }

    private function matchHeadersWithoutUserAgent(RequestInterface $request): bool
    {
        $request = $request->withoutHeader('user-agent');
        if (!$this->allowOtherHeaders && count($request->getHeaders()) != count($this->headers)) {
            return false;
        }

        foreach ($this->headers as $expectedHeader) {
            $header = explode(':', $expectedHeader, 2);

            $matchedHeaderValue = $request->getHeaderLine(trim($header[0])) === trim($header[1]);
            if (
                !($request->hasHeader(trim($header[0]))
                && $matchedHeaderValue)
            ) {
                return false;
            }
        }

        return true;
    }

    protected function additionalFailureDescription($other): string
    {
        $diff = [];
        if ($other->getUri() != $this->url) {
            $diff[] = $this->diffLine("URL", $this->url, $other->getUri());
        }
        if ($other->getMethod() !== $this->method) {
            $diff[] = $this->diffLine("Method", $this->method, $other->getMethod());
        }
        if (!$this->matchBody()) {
            $diff[] = $this->diffLine("Body", $this->body, $this->actualBody);
        }

        if (!$this->matchUserAgent($other)) {
            $diff[] = $this->diffLine("User-Agent", $this->userAgent, $other->getHeaderLine('user-agent'));
        }

        if (!$this->matchHeadersWithoutUserAgent($other)) {
            $diff[] = $this->diffLine(
                "Headers",
                $this->headers,
                $other->withoutHeader('user-agent')->getHeaders()
            );
        }

        return implode("\n", $diff);
    }

    private function diffLine(string $header, null|string|array $expected, null|string|array $actual): string
    {
        if (is_array($expected)) {
            $expected = print_r($expected, true);
        }
        if (is_array($actual)) {
            $actual = print_r($actual, true);
        }

        return "## $header:\n `$actual` Doesn't match expected `$expected`";
    }


    public function toString(): string
    {
        return "HttpRequestMatcher";
    }
}
