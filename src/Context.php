<?php

declare(strict_types=1);

namespace Shopify;

use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;
use Shopify\Auth\SessionStorage;
use Shopify\Clients\Curl;
use Shopify\Auth\Scopes;
use Shopify\Clients\TransportFactory;
use Shopify\Exception\MissingArgumentException;
use Shopify\Exception\PrivateAppException;
use Shopify\Exception\UninitializedContextException;

class Context
{
    public static ?string $API_KEY = null;
    public static ?string $API_SECRET_KEY = null;
    public static Scopes $SCOPES;
    public static ?string $HOST_NAME = null;
    public static ?SessionStorage $SESSION_STORAGE = null;
    public static TransportFactory $TRANSPORT_FACTORY;
    public static ?string $API_VERSION = null;
    public static bool $IS_EMBEDDED_APP = true;
    public static bool $IS_PRIVATE_APP = false;
    public static ?string $USER_AGENT_PREFIX = null;
    public static int $RETRY_TIME_IN_SECONDS = 1;
    public static ?LoggerInterface $LOGGER = null;
    private static bool $IS_INITIALIZED = false;

    /**
     * Initializes Context object
     *
     * @param string          $apiKey          App API key
     * @param string          $apiSecretKey    App API secret
     * @param string|array    $scopes          App scopes
     * @param string          $hostName        App host name e.g. www.google.ca
     * @param SessionStorage  $sessionStorage  Session storage strategy
     * @param string          $apiVersion      App API version, defaults to unstable
     * @param bool            $isEmbeddedApp   Whether the app is an embedded app, defaults to true
     * @param bool            $isPrivateApp    Whether the app is a private app, defaults to false
     * @param string          $userAgentPrefix Prefix for user agent header sent with a request, defaults to empty
     *                                         string
     * @param LoggerInterface $logger          App logger, so the library can add its own logs to it
     */
    public static function initialize(
        string $apiKey,
        string $apiSecretKey,
        string | array $scopes,
        string $hostName,
        SessionStorage $sessionStorage,
        string $apiVersion = 'unstable',
        bool $isEmbeddedApp = true,
        bool $isPrivateApp = false,
        string $userAgentPrefix = '',
        LoggerInterface $logger = null,
    ): void {
        $authScopes = new Scopes($scopes);

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
        self::$SCOPES = $authScopes;
        self::$HOST_NAME = $hostName;
        self::$SESSION_STORAGE = $sessionStorage;
        self::$TRANSPORT_FACTORY = new TransportFactory();
        self::$API_VERSION = $apiVersion;
        self::$IS_EMBEDDED_APP = $isEmbeddedApp;
        self::$IS_PRIVATE_APP = $isPrivateApp;
        self::$USER_AGENT_PREFIX = $userAgentPrefix;
        self::$LOGGER = $logger;

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

    /**
     * Logs a message using the defined callback. If none is set, the message is ignored.
     *
     * @param string $message The message to log
     * @param string $level   One of the \Psr\Log\LogLevel::* consts, defaults to INFO
     *
     * @throws \Shopify\Exception\UninitializedContextException
     */
    public static function log(string $message, string $level = LogLevel::INFO): void
    {
        self::throwIfUninitialized();

        if (!self::$LOGGER) {
            return;
        }

        self::$LOGGER->log($level, $message);
    }
}
