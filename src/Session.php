<?php

declare(strict_types=1);

namespace Shopify;

/**
 * Stores App information from logged in merchants so they can make authenticated requests to the Admin API.
 */
class Session
{
    public function __construct(
        public string $shop,
        public string $state,
        public string $scope,
        public ?string $expires,
        public ?bool $isOnline,
        public ?string $accessToken = null,
    )
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
