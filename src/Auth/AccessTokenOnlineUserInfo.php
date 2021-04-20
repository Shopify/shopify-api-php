<?php

declare(strict_types=1);

namespace Shopify\Auth;

final class AccessTokenOnlineUserInfo
{
    public function __construct(
        private int $id,
        private string $firstName,
        private string $lastName,
        private string $email,
        private bool $emailVerified,
        private bool $accountOwner,
        private string $locale,
        private bool $collaborator,
    ) {
    }

    public function getId()
    {
        return $this->id;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function isEmailVerified()
    {
        return $this->emailVerified;
    }

    public function isAccountOwner()
    {
        return $this->accountOwner;
    }

    public function getLocale()
    {
        return $this->locale;
    }

    public function isCollaborator()
    {
        return $this->collaborator;
    }
}
