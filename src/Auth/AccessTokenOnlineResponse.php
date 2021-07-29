<?php

declare(strict_types=1);

namespace Shopify\Auth;

final class AccessTokenOnlineResponse extends AccessTokenResponse
{
    /** @var string */
    protected $accessToken;
    /** @var string */
    protected $scope;
    /** @var int */
    private $expiresIn;
    /** @var string */
    private $associatedUserScope;
    /** @var AccessTokenOnlineUserInfo|null */
    private $associatedUser = null;

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
