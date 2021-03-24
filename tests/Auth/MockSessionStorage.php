<?php

declare(strict_types=1);

namespace ShopifyTest\Auth;

use Shopify\Auth\Session;
use Shopify\Auth\SessionStorage;

final class MockSessionStorage implements SessionStorage
{
    private array $calls = [];
    private array $testSessions = [];

    public function storeSession(Session $session): bool
    {
        $this->calls[] = ['store', $session];
        $this->testSessions[$session->getId()] = $session;
        return true;
    }

    public function loadSession(string $sessionId): Session | null
    {
        $this->calls[] = ['load', $sessionId];
        return $this->testSessions[$sessionId] ?? null;
    }

    public function deleteSession(string $sessionId): bool
    {
        $this->calls[] = ['delete', $sessionId];
        unset($this->testSessions[$sessionId]);
        return true;
    }

    /**
     * Retrieves the calls made to this class for assertions.
     *
     * @return array
     */
    public function getCalls(): array
    {
        return $this->calls;
    }
}
