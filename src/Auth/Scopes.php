<?php

declare(strict_types=1);

namespace Shopify\Auth;

final class Scopes
{
    public const SCOPE_DELIMITER = ',';

    /** @var array */
    private $compressedScopes;
    /** @var array */
    private $expandedScopes;

    /**
     * @param string|array $scopes
     */
    public function __construct($scopes)
    {
        if (is_string($scopes)) {
            $scopesArray = explode(self::SCOPE_DELIMITER, $scopes);
        } else {
            $scopesArray = $scopes;
        }

        $scopesArray = array_unique(array_filter(array_map('trim', $scopesArray)));

        $impliedScopes = $this->getImpliedScopes($scopesArray);

        $this->compressedScopes = array_diff($scopesArray, $impliedScopes);
        $this->expandedScopes = array_merge($scopesArray, $impliedScopes);
    }

    /**
     * Converts the scopes in this object to a valid string.
     *
     * @return string
     */
    public function toString(): string
    {
        return implode(self::SCOPE_DELIMITER, $this->toArray());
    }

    /**
     * Converts the scopes in this object to a valid array.
     *
     * @return array
     */
    public function toArray(): array
    {
        return $this->compressedScopes;
    }

    /**
     * Checks whether the scopes in this object encapsulate the given scopes.
     *
     * @param string|array|Scopes $scopes The scopes to check
     *
     * @return bool
     */
    public function has($scopes): bool
    {
        if (!($scopes instanceof self)) {
            $scopes = new self($scopes);
        }

        return count(array_diff($scopes->toArray(), $this->expandedScopes)) === 0;
    }

    /**
     * Checks whether the given scopes are equal to the scopes in this object.
     *
     * @param string|array|Scopes $scopes The scopes to check
     *
     * @return bool
     */
    public function equals($scopes): bool
    {
        if (!($scopes instanceof self)) {
            $scopes = new self($scopes);
        }

        return (
            count($this->compressedScopes) === count($scopes->compressedScopes) &&
            count(array_diff($this->compressedScopes, $scopes->compressedScopes)) === 0
        );
    }

    /**
     * Returns any scopes that are implied by any of the given ones.
     *
     * @param array $scopes The scopes to check
     *
     * @return array
     */
    private function getImpliedScopes(array $scopes): array
    {
        $impliedScopes = [];
        foreach ($scopes as $scope) {
            if (preg_match('/^(unauthenticated_)?write_(.*)$/', $scope, $matches)) {
                $impliedScopes[] = ($matches[1] ?? '') . "read_{$matches[2]}";
            }
        }

        return $impliedScopes;
    }
}
