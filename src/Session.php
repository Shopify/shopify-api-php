<?php

declare(strict_types=1);

namespace Shopify;

/**
 * Class to store a user/shop session
 */
class Session
{
    private $shop;
    private $accessToken;

    public function __construct(string $shop, ?string $accessToken = null)
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
