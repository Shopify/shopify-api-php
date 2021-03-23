<?php

declare(strict_types=1);

namespace Shopify;

/**
 * Stores App information from logged in merchants so they can make authenticated requests to the Admin API.
 */
class Session
{
    public function __construct(
        protected string $shop,
        protected string $state,
        protected string $scope,
        protected ?string $expires,
        protected ?bool $isOnline,
        protected ?string $accessToken = null,
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
