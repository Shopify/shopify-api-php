<?php

declare(strict_types=1);

namespace Shopify\Auth;

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

    public function __construct(
        string $id,
        string $shop,
        bool $isOnline,
        string $state
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

    public function setScope(string $scope): void
    {
        $this->scope = $scope;
    }

    /**
     * @param string|int|DateTime $expires
     *
     * @throws \Exception
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

        return $newSession;
    }

    /**
     * Checks whether this session has all of the necessary settings to make requests to Shopify.
     *
     * @return bool
     */
    public function isValid(): bool
    {
        return (
            Context::$SCOPES->equals($this->scope) &&
            $this->accessToken &&
            (!$this->expires || ($this->expires > new DateTime()))
        );
    }
}
