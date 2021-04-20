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
    private ?string $scope = null;
    private ?DateTime $expires = null;
    private ?string $accessToken = null;
    private ?AccessTokenOnlineUserInfo $onlineAccessInfo = null;

    public function __construct(
        private string $id,
        private string $shop,
        private bool $isOnline,
        private string $state,
    ) {
        $this->shop = Utils::sanitizeShopDomain($shop);
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

    public function getScope(): string | null
    {
        return $this->scope;
    }

    public function getExpires(): DateTime | null
    {
        return $this->expires;
    }

    public function isOnline(): bool
    {
        return $this->isOnline;
    }

    public function getAccessToken(): string | null
    {
        return $this->accessToken;
    }

    public function getOnlineAccessInfo(): AccessTokenOnlineUserInfo | null
    {
        return $this->onlineAccessInfo;
    }

    public function setScope(string $scope): void
    {
        $this->scope = $scope;
    }

    public function setExpires(string | int | DateTime $expires): void
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
        $newSession = new Session(
            id: $newSessionId,
            shop: $this->shop,
            state: $this->state,
            isOnline: $this->isOnline,
        );
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
