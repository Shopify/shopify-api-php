<?php

declare(strict_types=1);

namespace Shopify\Auth;

/**
 * Stores Cookie information to be used in OAuth
 */
class OAuthCookie
{
    public function __construct(
        // phpcs:disable
        private string $value,
        private string $name,
        private int $expire = 0,
        private bool $secure = true,
        private bool $httpOnly = true
        // phpcs:enable
    ) {
    }

    public function getValue()
    {
        return $this->value;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getExpire()
    {
        return $this->expire;
    }

    public function isSecure()
    {
        return $this->secure;
    }

    public function isHttpOnly()
    {
        return $this->httpOnly;
    }
}
