<?php

declare(strict_types=1);

namespace Shopify\Auth;

/**
 * Stores Cookie information to be used in OAuth
 */
class OAuthCookie
{
    public function __construct(
        private string $value,
        private string $name,
        private int $expire = 0,
        private bool $secure = true,
        private bool $httpOnly = true,
    ) {
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getExpire(): int
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
