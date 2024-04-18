<?php

declare(strict_types=1);

namespace Shopify\Auth;

/**
 * Stores Cookie information to be used in OAuth
 */
class OAuthCookie
{
    private readonly string $value;
    private readonly string $name;
    private readonly ?int $expire;
    private readonly bool $secure;
    private readonly bool $httpOnly;

    public function __construct(
        string $value,
        string $name,
        ?int $expire = 0,
        bool $secure = true,
        bool $httpOnly = true
    ) {
        $this->value = $value;
        $this->name = $name;
        $this->expire = $expire;
        $this->secure = $secure;
        $this->httpOnly = $httpOnly;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getExpire(): ?int
    {
        return $this->expire;
    }

    public function isSecure(): bool
    {
        return $this->secure;
    }

    public function isHttpOnly(): bool
    {
        return $this->httpOnly;
    }
}
