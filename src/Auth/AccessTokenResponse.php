<?php

declare(strict_types=1);

namespace Shopify\Auth;

class AccessTokenResponse
{
    protected string $accessToken;
    protected string $scope;

    // Note: this is intentionally not named `expiresIn` to avoid clashing with the property of the same name
    // declared on AccessTokenOnlineResponse, which has a different (non-nullable) type.
    private readonly ?int $tokenExpiresIn;
    private readonly ?string $refreshToken;
    private readonly ?int $refreshTokenExpiresIn;

    public function __construct(
        string $accessToken,
        string $scope,
        ?int $expiresIn = null,
        ?string $refreshToken = null,
        ?int $refreshTokenExpiresIn = null
    ) {
        $this->accessToken = $accessToken;
        $this->scope = $scope;
        $this->tokenExpiresIn = $expiresIn;
        $this->refreshToken = $refreshToken;
        $this->refreshTokenExpiresIn = $refreshTokenExpiresIn;
    }

    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    public function getScope(): string
    {
        return $this->scope;
    }

    /**
     * The number of seconds until the access token expires. Only present for expiring offline access tokens.
     *
     * @return int|null
     */
    public function getExpiresIn(): ?int
    {
        return $this->tokenExpiresIn;
    }

    /**
     * The refresh token that can be used to obtain a new access token. Only present for expiring offline access
     * tokens.
     *
     * @return string|null
     */
    public function getRefreshToken(): ?string
    {
        return $this->refreshToken;
    }

    /**
     * The number of seconds until the refresh token expires. Only present for expiring offline access tokens.
     *
     * @return int|null
     */
    public function getRefreshTokenExpiresIn(): ?int
    {
        return $this->refreshTokenExpiresIn;
    }
}
