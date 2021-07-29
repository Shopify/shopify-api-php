<?php

namespace ShopifyTest;

use PHPUnit\Framework\Constraint\Constraint;
use Psr\Http\Message\RequestInterface;

class HttpRequestMatcher extends Constraint
{
    /** @var string */
    private $url;
    /** @var string */
    private $method;
    /** @var string */
    private $userAgent;
    /** @var array */
    private $headers = [];
    /** @var string|null */
    private $body = null;
    /** @var bool */
    private $allowOtherHeaders = true;

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
        string $url,
        string $method,
        string $userAgent,
        array $headers = [],
        ?string $body = null,
        bool $allowOtherHeaders = true
    ) {
        $this->url = $url;
        $this->method = $method;
        $this->userAgent = $userAgent;
        $this->headers = $headers;
        $this->body = $body;
        $this->allowOtherHeaders = $allowOtherHeaders;
    }

    protected function matches($other): bool
    {
        if (!($other instanceof RequestInterface)) {
            return false;
        }
        return
            ($other->getUri() == $this->url)
            && ($other->getMethod() === $this->method)
            && $this->matchBody($other)
            && $this->matchHeadersWithoutUserAgent($other)
            && $this->matchUserAgent($other);
    }


    private function matchUserAgent(RequestInterface $request): bool
    {
        return preg_match($this->userAgent, $request->getHeaderLine('user-agent')) != false;
    }

    private function matchBody(RequestInterface $request): bool
    {
        $request->getBody()->rewind();
        return $this->body === $request->getBody()->getContents();
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
        if (!$this->matchBody($other)) {
            $other->getBody()->rewind();
            $diff[] = $this->diffLine("Body", $this->body, $other->getBody()->getContents());
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

    /**
     * @param string            $header
     * @param null|string|array $expected
     * @param null|string|array $actual
     */
    private function diffLine(string $header, $expected, $actual): string
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
