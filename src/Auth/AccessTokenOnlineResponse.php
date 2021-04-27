<?php

declare(strict_types=1);

namespace Shopify\Auth;

final class AccessTokenOnlineResponse extends AccessTokenResponse
{
    public function __construct(
        protected string $accessToken,
        protected string $scope,
        private int $expiresIn,
        private string $associatedUserScope,
        private ?AccessTokenOnlineUserInfo $associatedUser = null,
    ) {
    }

    public function getExpiresIn(): int
    {
        return $this->expiresIn;
    }

    public function getAssociatedUserScope(): string
    {
        return $this->associatedUserScope;
    }

    public function getAssociatedUser(): ?AccessTokenOnlineUserInfo
    {
        return $this->associatedUser;
    }
}
