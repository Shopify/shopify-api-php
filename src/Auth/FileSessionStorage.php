<?php

declare(strict_types=1);

namespace Shopify\Auth;

/**
 * Stores Sessions in a local file so that Session variables can be accessed throughout the app.
 */
class FileSessionStorage implements SessionStorage
{
    /** @var string */
    private $path;

    /**
     * Initializes FileSessionStorage object
     *
     * @param string $path Path to store the session files in
     */
    public function __construct(string $path = '/tmp/shopify_api_sessions')
    {
        if (!is_dir($path)) {
            mkdir($path);
        }

        $this->path = $path;
    }

    /**
     * Loads the Session object from the serialized file
     *
     * @param string $sessionId Id of the Session that is being loaded
     * @return Session Returns Session if found, null otherwise
     */
    public function loadSession(string $sessionId): ?Session
    {
        $path = $this->getPath($sessionId);
        if (!file_exists($path)) {
            return null;
        }
        return unserialize(file_get_contents($path));
    }

    /**
     * Stores session into a file
     *
     * @param Session $session An instance of the session class to be stored in a file
     * @return bool True if the number of bytes stored by file_put_contents() is > 0, false otherwise
     */
    public function storeSession(Session $session): bool
    {
        return file_put_contents($this->getPath($session->getId()), serialize($session)) > 0;
    }

    /**
     * Helper function that builds a path
     *
     * @param string $sessionId A Session ID
     * @return string The path to the file that the Session will be stored in
     */
    private function getPath(string $sessionId): string
    {
        return "{$this->path}/{$sessionId}";
    }

    /**
     * Deletes a Session file
     *
     * @param string $sessionId The ID of the Session to be deleted
     * @return bool Returns True if the file has been deleted or didn't exist
     */
    public function deleteSession(string $sessionId): bool
    {
        $path = $this->getPath($sessionId);
        if (file_exists($path)) {
            unlink($path);
        }
        return true;
    }
}
