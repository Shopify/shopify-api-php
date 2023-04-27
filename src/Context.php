<?php

declare(strict_types=1);

namespace Shopify;

use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;
use Shopify\Auth\Scopes;
use Shopify\Auth\SessionStorage;
use Shopify\Clients\HttpClientFactory;
use Shopify\Exception\FeatureDeprecatedException;
use Shopify\Exception\MissingArgumentException;
use Shopify\Exception\InvalidArgumentException;
use Shopify\Exception\PrivateAppException;
use Shopify\Exception\UninitializedContextException;

class Context
{
    /** @var string */
    public static $API_KEY = null;
    /** @var string */
    public static $API_SECRET_KEY = null;
    /** @var Scopes */
    public static $SCOPES;
    /** @var string */
    public static $HOST_NAME = null;
    /** @var string */
    public static $HOST_SCHEME = null;
    /** @var SessionStorage */
    public static $SESSION_STORAGE = null;
    /** @var string */
    public static $API_VERSION = null;
    /** @var bool */
    public static $IS_EMBEDDED_APP = true;
    /** @var bool */
    public static $IS_PRIVATE_APP = false;
    /** @var string|null */
    public static $PRIVATE_APP_STOREFRONT_ACCESS_TOKEN = null;
    /** @var string */
    public static $USER_AGENT_PREFIX = null;
    /** @var LoggerInterface|null */
    public static $LOGGER = null;
    /** @var string[] */
    public static $CUSTOM_SHOP_DOMAINS = null;

    /** @var int */
    public static $RETRY_TIME_IN_SECONDS = 1;
    /** @var HttpClientFactory */
    public static $HTTP_CLIENT_FACTORY;
    /** @var bool */
    private static $IS_INITIALIZED = false;

    /**
     * Initializes Context object
     *
     * @param string               $apiKey                          App API key
     * @param string               $apiSecretKey                    App API secret
     * @param string|array         $scopes                          App scopes
     * @param string               $hostName                        App host name e.g. www.google.ca. May include scheme
     * @param SessionStorage       $sessionStorage                  Session storage strategy
     * @param string               $apiVersion                      App API key, defaults to unstable
     * @param bool                 $isEmbeddedApp                   Whether the app is an embedded app, defaults to true
     * @param bool                 $isPrivateApp                    Whether the app is a private app, defaults to false
     * @param string|null          $privateAppStorefrontAccessToken The Storefront API Access Token for a private app
     * @param string               $userAgentPrefix                 Prefix for user agent header sent with a request
     * @param LoggerInterface|null $logger                          App logger, so the library can add its own logs to
     *                                                              it
     * @param string[]             $customShopDomains               One or more regexps to use when validating domains
     *
     * @throws \Shopify\Exception\MissingArgumentException
     */
    public static function initialize(
        string $apiKey,
        string $apiSecretKey,
        $scopes,
        string $hostName,
        SessionStorage $sessionStorage,
        string $apiVersion = ApiVersion::LATEST,
        bool $isEmbeddedApp = true,
        bool $isPrivateApp = false,
        string $privateAppStorefrontAccessToken = null,
        string $userAgentPrefix = '',
        LoggerInterface $logger = null,
        array $customShopDomains = []
    ): void {
        $authScopes = new Scopes($scopes);

        // ensure required values given
        $requiredValues = [
            'apiKey' => $apiKey,
            'apiSecretKey' => $apiSecretKey,
            'scopes' => implode((array)$scopes),
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

        if (!ApiVersion::isValid($apiVersion)) {
            throw new InvalidArgumentException("Invalid API version: $apiVersion");
        }

        if (!preg_match("/http(s)?:\/\//", $hostName)) {
            $hostName = "https://$hostName";
        }
        $parsedUrl = parse_url($hostName);
        if (!is_array($parsedUrl)) {
            throw new InvalidArgumentException("Invalid host: $hostName");
        }

        $host = $parsedUrl["host"] . (array_key_exists("port", $parsedUrl) ? ":{$parsedUrl["port"]}" : "");

        self::$API_KEY = $apiKey;
        self::$API_SECRET_KEY = $apiSecretKey;
        self::$SCOPES = $authScopes;
        self::$HOST_NAME = $host;
        self::$HOST_SCHEME = $parsedUrl["scheme"];
        self::$SESSION_STORAGE = $sessionStorage;
        self::$HTTP_CLIENT_FACTORY = new HttpClientFactory();
        self::$API_VERSION = $apiVersion;
        self::$IS_EMBEDDED_APP = $isEmbeddedApp;
        self::$IS_PRIVATE_APP = $isPrivateApp;
        self::$PRIVATE_APP_STOREFRONT_ACCESS_TOKEN = $privateAppStorefrontAccessToken;
        self::$USER_AGENT_PREFIX = $userAgentPrefix;
        self::$LOGGER = $logger;
        self::$CUSTOM_SHOP_DOMAINS = $customShopDomains;

        self::$IS_INITIALIZED = true;
    }

    /**
     * Throws exception if initialize() has not been called
     *
     * @throws \Shopify\Exception\UninitializedContextException
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
     * @param string $message Message to output with the exception
     *
     * @throws \Shopify\Exception\PrivateAppException
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
     * @param array $context  Key/value pairs of contextual information supporting the log statement
     *
     * @throws \Shopify\Exception\UninitializedContextException
     */
    public static function log(string $message, string $level = LogLevel::INFO, array $context = []): void
    {
        self::throwIfUninitialized();

        if (!self::$LOGGER) {
            return;
        }

        self::$LOGGER->log($level, $message, $context);
    }

    /**
     * Logs a message at DEBUG level
     *
     * @param string $message The message to log
     * @param array $context  Key/value pairs of contextual information supporting the log statement
     *
     * @throws UninitializedContextException
     */
    public static function logDebug(string $message, array $context = []): void
    {
        self::log($message, LogLevel::DEBUG, $context);
    }

    /**
     * Logs a message at INFO level
     *
     * @param string $message The message to log
     * @param array $context  Key/value pairs of contextual information supporting the log statement
     *
     * @throws UninitializedContextException
     */
    public static function logInfo(string $message, array $context = []): void
    {
        self::log($message, LogLevel::INFO, $context);
    }

    /**
     * Logs a message at NOTICE level
     *
     * @param string $message The message to log
     * @param array $context  Key/value pairs of contextual information supporting the log statement
     *
     * @throws UninitializedContextException
     */
    public static function logNotice(string $message, array $context = []): void
    {
        self::log($message, LogLevel::NOTICE, $context);
    }

    /**
     * Logs a message at WARNING level
     *
     * @param string $message The message to log
     * @param array $context  Key/value pairs of contextual information supporting the log statement
     *
     * @throws UninitializedContextException
     */
    public static function logWarning(string $message, array $context = []): void
    {
        self::log($message, LogLevel::WARNING, $context);
    }

    /**
     * Logs a message at ERROR level
     *
     * @param string $message The message to log
     * @param array $context  Key/value pairs of contextual information supporting the log statement
     *
     * @throws UninitializedContextException
     */
    public static function logError(string $message, array $context = []): void
    {
        self::log($message, LogLevel::ERROR, $context);
    }

    /**
     * Logs a message at ALERT level
     *
     * @param string $message The message to log
     * @param array $context  Key/value pairs of contextual information supporting the log statement
     *
     * @throws UninitializedContextException
     */
    public static function logAlert(string $message, array $context = []): void
    {
        self::log($message, LogLevel::ALERT, $context);
    }

    /**
     * Logs a message at EMERGENCY level
     *
     * @param string $message The message to log
     * @param array $context  Key/value pairs of contextual information supporting the log statement
     *
     * @throws UninitializedContextException
     */
    public static function logEmergency(string $message, array $context = []): void
    {
        self::log($message, LogLevel::EMERGENCY, $context);
    }

    /**
     * Logs a message at CRITICAL level
     *
     * @param string $message The message to log
     * @param array $context  Key/value pairs of contextual information supporting the log statement
     *
     * @throws UninitializedContextException
     */
    public static function logCritical(string $message, array $context = []): void
    {
        self::log($message, LogLevel::CRITICAL, $context);
    }

    /**
     * Log a deprecation message
     *
     * @param string $deprecatedFrom A version that will trigger the message once it has been reached
     * @param string $message        The message to log
     * @param array $context         Key/value pairs of contextual information supporting the log statement
     *
     * @throws UninitializedContextException
     * @throws FeatureDeprecatedException
     * @throws \Exception
     */
    public static function logDeprecation(string $deprecatedFrom, string $message, array $context = []): void
    {
        if (!preg_match('#^\d+.\d+.\d+$#', $deprecatedFrom)) {
            throw new \Exception(sprintf('Encountered an invalid version: "%s"', $deprecatedFrom));
        }

        $currentVersion = Utils::getVersion();
        if (version_compare($currentVersion, $deprecatedFrom, '>=')) {
            throw new FeatureDeprecatedException($deprecatedFrom);
        }

        $context = array_merge(
            [
                'current_version' => $currentVersion,
                'deprecated_from' => $deprecatedFrom,
            ],
            $context
        );

        self::logWarning($message, $context);
    }
}
