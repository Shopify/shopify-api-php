<?php

declare(strict_types=1);

namespace Shopify\Auth;

use Shopify\Context;
use Shopify\Auth\Session;
use Shopify\Auth\SessionStorage;

class FileSessionStorage implements SessionStorage
{
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
        if (isset(Context::$PATH)) {  // FIXME: it's not getting the Context
            $path = Context::$PATH;
        } else {
            $path = 'tmp/php_sessions';
        }
        return "{$path}/{$id}";
    }

    public function deleteSession(string $sessionId): bool
    {
        if (file_exists($this->getPath($sessionId))) {
            unlink(realpath($this->getPath($sessionId)));
            return true;
        } else {
            return true;
        }
    }
}
