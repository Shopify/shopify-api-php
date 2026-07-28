<?php

declare(strict_types=1);

namespace Shopify\Auth;

use Exception;
use DateTime;
use Shopify\Context;
use Shopify\Utils;

/**
 * Stores App information from logged in merchants so they can make authenticated requests to the Admin API.
 */
class Session
{
    /** @var string|null */
    private $scope = null;
    /** @var DateTime|null */
    private $expires = null;
    /** @var string|null */
    private $accessToken = null;
    /** @var AccessTokenOnlineUserInfo|null */
    private $onlineAccessInfo = null;
    /** @var string|null */
    private $refreshToken = null;
    /** @var DateTime|null */
    private $refreshTokenExpiresAt = null;

    public function __construct(
        private string $id,
        private string $shop,
        private bool $isOnline,
        private string $state
    ) {
        $this->id = $id;
        $this->shop = Utils::sanitizeShopDomain($shop);
        $this->isOnline = $isOnline;
        $this->state = $state;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getShop(): string
    {
        return $this->shop;
    }

    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @return string|null
     */
    public function getScope()
    {
        return $this->scope;
    }

    /**
     * @return DateTime|null
     */
    public function getExpires()
    {
        return $this->expires;
    }

    public function isOnline(): bool
    {
        return $this->isOnline;
    }

    /**
     * @return string|null
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @return AccessTokenOnlineUserInfo|null
     */
    public function getOnlineAccessInfo()
    {
        return $this->onlineAccessInfo;
    }

    /**
     * The refresh token for this session, if it was obtained as an expiring offline access token. This is only
     * populated for offline sessions obtained via the token exchange or refresh token grants with `expiring=1`.
     *
     * @return string|null
     */
    public function getRefreshToken()
    {
        return $this->refreshToken;
    }

    /**
     * The date and time at which this session's refresh token expires, if it has one.
     *
     * @return DateTime|null
     */
    public function getRefreshTokenExpiresAt()
    {
        return $this->refreshTokenExpiresAt;
    }

    public function setScope(string $scope): void
    {
        $this->scope = $scope;
    }

    /**
     * @param string|int|DateTime $expires
     *
     * @throws Exception
     */
    public function setExpires($expires): void
    {
        $date = null;
        if ($expires) {
            if (is_string($expires)) {
                $date = new DateTime($expires);
            } elseif (is_numeric($expires)) {
                $date = new DateTime("@$expires");
            } else {
                $date = $expires;
            }
        }
        $this->expires = $date;
    }

    public function setAccessToken(string $accessToken): void
    {
        $this->accessToken = $accessToken;
    }

    public function setOnlineAccessInfo(AccessTokenOnlineUserInfo $onlineAccessInfo): void
    {
        $this->onlineAccessInfo = $onlineAccessInfo;
    }

    public function setRefreshToken(?string $refreshToken): void
    {
        $this->refreshToken = $refreshToken;
    }

    /**
     * @param string|int|DateTime|null $refreshTokenExpiresAt
     *
     * @throws Exception
     */
    public function setRefreshTokenExpiresAt($refreshTokenExpiresAt): void
    {
        $date = null;
        if ($refreshTokenExpiresAt) {
            if (is_string($refreshTokenExpiresAt)) {
                $date = new DateTime($refreshTokenExpiresAt);
            } elseif (is_numeric($refreshTokenExpiresAt)) {
                $date = new DateTime("@$refreshTokenExpiresAt");
            } else {
                $date = $refreshTokenExpiresAt;
            }
        }
        $this->refreshTokenExpiresAt = $date;
    }

    /**
     * Creates a clone of the current session with a new id.
     *
     * @param string $newSessionId The id of the new session
     *
     * @return Session
     */
    public function clone(string $newSessionId): Session
    {
        $newSession = new Session($newSessionId, $this->shop, $this->isOnline, $this->state);
        $newSession->scope = $this->scope;
        $newSession->expires = $this->expires;
        $newSession->accessToken = $this->accessToken;
        $newSession->onlineAccessInfo = $this->onlineAccessInfo;
        $newSession->refreshToken = $this->refreshToken;
        $newSession->refreshTokenExpiresAt = $this->refreshTokenExpiresAt;

        return $newSession;
    }

    /**
     * Checks whether this session has all of the necessary settings to make requests to Shopify.
     *
     * @return bool
     */
    public function isValid(): bool
    {
        return (Context::$SCOPES->equals($this->scope) &&
            $this->accessToken &&
            (!$this->expires || ($this->expires > new DateTime()))
        );
    }
}
