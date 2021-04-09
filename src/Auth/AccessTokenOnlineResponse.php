<?php

declare(strict_types=1);

namespace Shopify\Auth;

final class AccessTokenOnlineResponse extends AccessTokenResponse
{
    public function __construct(
        // This is currently a bug until a new version of phpcs is released
        // phpcs:disable
        protected string $accessToken,
        protected string $scope,
        private int $expiresIn,
        private string $associatedUserScope,
        private ?AccessTokenOnlineUserInfo $associatedUser = null,
        // phpcs:enable
    ) {
    }

    public function getExpiresIn()
    {
        return $this->expiresIn;
    }

    public function getAssociatedUserScope()
    {
        return $this->associatedUserScope;
    }

    public function getAssociatedUser()
    {
        return $this->associatedUser;
    }
}
