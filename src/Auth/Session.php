<?php

declare(strict_types=1);

namespace Shopify\Auth;

use DateTime;

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
        // This is currently a bug until a new version of phpcs is released
        // phpcs:disable
        private string $id,
        private string $shop,
        private bool $isOnline,
        private string $state,
        // phpcs:enable
    ) {
    }

    public function getId()
    {
        return $this->id;
    }

    public function getShop()
    {
        return $this->shop;
    }

    public function getState()
    {
        return $this->state;
    }

    public function getScope()
    {
        return $this->scope;
    }

    public function getExpires()
    {
        return $this->expires;
    }

    public function isOnline()
    {
        return $this->isOnline;
    }

    public function getAccessToken()
    {
        return $this->accessToken;
    }

    public function getOnlineAccessInfo()
    {
        return $this->onlineAccessInfo;
    }

    public function setScope(string $scope)
    {
        return $this->scope = $scope;
    }

    public function setExpires(string | int | DateTime $expires)
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
        return $this->expires = $date;
    }

    public function setAccessToken(string $accessToken)
    {
        return $this->accessToken = $accessToken;
    }

    public function setOnlineAccessInfo(AccessTokenOnlineUserInfo $onlineAccessInfo)
    {
        return $this->onlineAccessInfo = $onlineAccessInfo;
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
}
