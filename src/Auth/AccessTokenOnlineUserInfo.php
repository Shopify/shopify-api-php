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

    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function isEmailVerified(): bool
    {
        return $this->emailVerified;
    }

    public function isAccountOwner(): bool
    {
        return $this->accountOwner;
    }

    public function getLocale(): string
    {
        return $this->locale;
    }

    public function isCollaborator(): bool
    {
        return $this->collaborator;
    }
}
