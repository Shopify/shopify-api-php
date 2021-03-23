<?php

declare(strict_types=1);

namespace Shopify;

/**
 * Class to store a user/shop session
 */
class Session
{
    public function __construct(public string $shop, public ?string $accessToken = null)
    {
    }

    public function getAccessToken()
    {
        return $this->accessToken;
    }

    public function getShop()
    {
        return $this->shop;
    }
}
