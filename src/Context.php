<?php

declare(strict_types=1);

namespace Shopify;

use Shopify\Auth\SessionStorage;
use Shopify\Exception\MissingArgumentException;
use Shopify\Exception\PrivateAppException;
use Shopify\Exception\UninitializedContextException;

class Context
{
    public static ?string $API_KEY = null;
    public static ?string $API_SECRET_KEY = null;
    public static ?array $SCOPES = null;
    public static ?string $HOST_NAME = null;
    public static ?SessionStorage $SESSION_STORAGE = null;
    public static ?string $API_VERSION = null;
    public static bool $IS_EMBEDDED_APP = true;
    public static bool $IS_PRIVATE_APP = false;
    public static ?string $USER_AGENT_PREFIX = null;

    private static bool $IS_INITIALIZED = false;

    /**
     * Initializes Context object
     *
     * @param string         $apiKey          App API key
     * @param string         $apiSecretKey    App API secret
     * @param array          $scopes          App scopes
     * @param string         $hostName        App host name e.g. www.google.ca
     * @param SessionStorage $sessionStorage  Session storage strategy
     * @param string         $apiVersion      App API key, defaults to unstable
     * @param bool           $isEmbeddedApp   Whether the app is an embedded app, defaults to true
     * @param bool           $isPrivateApp    Whether the app is a private app, defaults to false
     * @param string         $userAgentPrefix Prefix for user agent header sent with a request, defaults to empty string
     */
    public static function initialize(
        string $apiKey,
        string $apiSecretKey,
        array $scopes,
        string $hostName,
        SessionStorage $sessionStorage,
        string $apiVersion = 'unstable',
        bool $isEmbeddedApp = true,
        bool $isPrivateApp = false,
        string $userAgentPrefix = '',
    ): void {
        // ensure required values given
        $requiredValues = [
            'apiKey' => $apiKey,
            'apiSecretKey' => $apiSecretKey,
            'scopes' => implode($scopes),
            'hostName' => $hostName,
        ];
        $missing = array();
        foreach ($requiredValues as $key => $value) {
            if (!strlen($value)) {
                $missing[] = $key;
            }
        }

        if (!empty($missing)) {
            $missing = implode(', ', $missing);
            throw new MissingArgumentException(
                "Cannot initialize Shopify API Library. Missing values for: $missing"
            );
        }

        self::$API_KEY = $apiKey;
        self::$API_SECRET_KEY = $apiSecretKey;
        self::$SCOPES = $scopes;
        self::$HOST_NAME = $hostName;
        self::$SESSION_STORAGE = $sessionStorage;
        self::$API_VERSION = $apiVersion;
        self::$IS_EMBEDDED_APP = $isEmbeddedApp;
        self::$IS_PRIVATE_APP = $isPrivateApp;
        self::$USER_AGENT_PREFIX = $userAgentPrefix;

        self::$IS_INITIALIZED = true;
    }

    /**
     * Throws exception if initialize() has not been called
     */
    public static function throwIfUninitialized(): void
    {
        if (!self::$IS_INITIALIZED) {
            throw new UninitializedContextException(
                'Context has not been properly initialized. ' .
                'Please call the .initialize() method to set up your app context object.'
            );
        }
    }

    /**
     * Throws exception if the app is private has not been called
     *
     * @param string $message   Message to output with the exception
     */
    public static function throwIfPrivateApp(string $message): void
    {
        if (self::$IS_PRIVATE_APP) {
            throw new PrivateAppException($message);
        }
    }
}
