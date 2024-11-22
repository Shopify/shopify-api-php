<?php

declare(strict_types=1);

namespace Shopify\Auth;

final class AccessTokenOnlineResponse extends AccessTokenResponse
{
    protected string $accessToken;
    protected string $scope;
    private readonly int $expiresIn;
    private readonly string $associatedUserScope;
    private readonly ?AccessTokenOnlineUserInfo $associatedUser;

    public function __construct(
        string $accessToken,
        string $scope,
        int $expiresIn,
        string $associatedUserScope,
        ?AccessTokenOnlineUserInfo $associatedUser = null
    ) {
        $this->accessToken = $accessToken;
        $this->scope = $scope;
        $this->expiresIn = $expiresIn;
        $this->associatedUserScope = $associatedUserScope;
        $this->associatedUser = $associatedUser;
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
