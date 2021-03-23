<?php

declare(strict_types=1);

namespace Shopify;

use DateTime;

/**
 * Stores App information from logged in merchants so they can make authenticated requests to the Admin API.
 */
class Session
{
    private string $shop;
    private string $state;
    private string $scope;
    private ?DateTime $expires = null;
    private ?bool $isOnline = false;
    private ?string $accessToken = null;

    public function __construct(private string $id)
    {
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

    public function getIsOnline()
    {
        return $this->isOnline;
    }

    public function getAccessToken()
    {
        return $this->accessToken;
    }

    public function setShop(string $shop)
    {
        return $this->shop = $shop;
    }

    public function setState(string $state)
    {
        return $this->state = $state;
    }

    public function setScope(string $scope)
    {
        return $this->scope = $scope;
    }

    public function setExpires(string $expires)
    {
        $date = new DateTime($expires);
        return $this->expires = $date;
    }

    public function setIsOnline(bool $isOnline)
    {
        return $this->isOnline = $isOnline;
    }

    public function setAccessToken(string $accessToken)
    {
        return $this->accessToken = $accessToken;
    }
}
