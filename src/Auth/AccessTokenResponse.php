<?php

declare(strict_types=1);

namespace Shopify\Auth;

class AccessTokenResponse
{
    public function __construct(
        protected string $accessToken,
        protected string $scope,
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
