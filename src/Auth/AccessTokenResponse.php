<?php

declare(strict_types=1);

namespace Shopify\Auth;

class AccessTokenResponse
{
    public function __construct(
        // This is currently a bug until a new version of phpcs is released
        // phpcs:disable
        protected string $accessToken,
        protected string $scope,
        // phpcs:enable
    ) {
    }

    public function getAccessToken()
    {
        return $this->accessToken;
    }

    public function getScope()
    {
        return $this->scope;
    }
}
