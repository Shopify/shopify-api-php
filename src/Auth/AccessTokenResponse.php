<?php

declare(strict_types=1);

namespace Shopify\Auth;

class AccessTokenResponse
{
    /** @var string */
    protected $accessToken;
    /** @var string */
    protected $scope;

    public function __construct(
        string $accessToken,
        string $scope
    ) {
        $this->accessToken = $accessToken;
        $this->scope = $scope;
    }

    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    public function getScope(): string
    {
        return $this->scope;
    }
}
