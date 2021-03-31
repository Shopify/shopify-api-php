<?php

declare(strict_types=1);

namespace Shopify\Auth;

use Shopify\Auth\Session;
use Shopify\Auth\SessionStorage;

class FileSessionStorage implements SessionStorage
{
    public function __construct(private string $path='/tmp/shopify_api_sessions')
    {
        if (!is_dir($path)) {
            mkdir($path);
        }
    }

    public function loadSession(string $id): ?Session
    {
        $path = $this->getPath($id);
        if (!file_exists($path)) {
            return null;
        }
        return unserialize(file_get_contents($path));
    }

    public function storeSession(Session $session): bool
    {
        return file_put_contents($this->getPath($session->getId()), serialize($session)) > 0;
    }

    private function getPath(string $id)
    {
        return "{$this->path}/{$id}";
    }

    public function deleteSession(string $sessionId): bool
    {
        $path = $this->getPath($sessionId);
        if (file_exists($path)) {
            unlink(realpath($path));
        }
        return true;
    }
}
