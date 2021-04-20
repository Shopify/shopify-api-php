<?php

declare(strict_types=1);

namespace Shopify;

use Shopify\Auth\OAuth;
use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Exception\InvalidArgumentException;
use Firebase\JWT\JWT;

/**
 * Class to store all util functions
 */
final class Utils
{
    /**
     * Returns a sanitized Shopify shop domain
     *
     * If the provided shop domain or hostname is invalid or could not be sanitized, returns null.
     *
     * @param string        $shop               A Shopify shop domain or hostname
     * @param string|null   $myshopifyDomain    A custom Shopify domain
     *
     * @return string $name a sanitized Shopify shop domain, null if the provided domain is invalid
     */
    public static function sanitizeShopDomain(string $shop, ?string $myshopifyDomain = null): ?string
    {
        $name = trim(strtolower($shop));

        $allowedDomainsRegexp = $myshopifyDomain ? "($myshopifyDomain)" : "(myshopify.com|myshopify.io)";

        if (!preg_match($allowedDomainsRegexp, $name) && (strpos($name, ".") === false)) {
            $name .= '.' . ($myshopifyDomain ?? 'myshopify.com');
        }
        $name = preg_replace("/\A(https?\:\/\/)/", '', $name);

        if (preg_match("/\A[a-zA-Z0-9][a-zA-Z0-9\-]*\.{$allowedDomainsRegexp}\z/", $name)) {
            return $name;
        } else {
            return null;
        }
    }

    /**
     * Determines if request is valid by processing secret key through an HMAC-SHA256 hash function
     *
     * @param array  $params array of parameters parsed from a URL
     * @param string $secret the secret key associated with the app in the Partners Dashboard
     *
     * @return bool true if the generated hexdigest is equal to the hmac parameter, false otherwise
     * @throws \Shopify\Exception\UninitializedContextException
     */
    public static function validateHmac(array $params, string $secret): bool
    {
        $hmac = $params['hmac'] ?? '';
        unset($params['hmac']);

        $computedHmac = hash_hmac('sha256', http_build_query($params), $secret);

        return hash_equals($hmac, $computedHmac);
    }

    /**
     * Retrieves the query string arguments from a URL, if any
     *
     * @param string $url the url string with query parameters to be extracted
     *
     * @return array $params Array of key/value pairs representing the query parameters or empty array
     */
    public static function getQueryParams(string $url): array
    {
        $queryString = parse_url($url, PHP_URL_QUERY);
        if (empty($queryString)) {
            return [];
        }
        parse_str($queryString, $params);
        return $params;
    }

    /**
     * Checks if the current version of the app (from Context::$API_VERSION) is compatible, i.e. more recent, than the
     * given reference version.
     *
     * @param string $referenceVersion The version to check
     *
     * @return bool
     * @throws \Shopify\Exception\InvalidArgumentException
     */
    public static function isApiVersionCompatible(string $referenceVersion): bool
    {
        if (Context::$API_VERSION === 'unstable' || Context::$API_VERSION === 'unversioned') {
            return true;
        }

        if (!ctype_digit(str_replace('-', '', $referenceVersion))) {
            throw new InvalidArgumentException("Reference version '$referenceVersion' is invalid");
        }

        $currentNumeric = (int)str_replace('-', '', Context::$API_VERSION);
        $referenceNumeric = (int)str_replace('-', '', $referenceVersion);

        return $currentNumeric >= $referenceNumeric;
    }

    /**
     * Loads an offline session
     * No validation is done on the shop param; ensure it comes from a safe source
     *
     * @param string $shop           The shop url to find the offline session for
     * @param bool   $includeExpired Optionally include expired sessions, defaults to false
     *
     * @return Session|null If exists, the most recent session
     * @throws \Shopify\Exception\ContextUninitializedException
     */
    public static function loadOfflineSession(string $shop, bool $includeExpired = false): ?Session
    {
        Context::throwIfUninitialized();

        $sessionId = OAuth::getOfflineSessionId($shop);
        $session = Context::$SESSION_STORAGE->loadSession($sessionId);

        if ($session && !$includeExpired && !$session->isValid()) {
            return null;
        }

        return $session;
    }

     * Loads the current user's session based on the given headers and cookies.
     *
     * @param array $headers    the headers from the HTTP request
     * @param array $cookies    the cookies from the HTTP response
     * @param bool  $isOnline   whether to load online or offline sessions
     *
     * @return Session|null returns the session or null if the session can't be found
     * @throws \Shopify\Exception\UninitializedContextException
     */
    public static function loadCurrentSession(array $headers, array $cookies, bool $isOnline): ?Session
    {
        $oauth = new OAuth();
        $sessionId = $oauth->getCurrentSessionId($headers, $cookies, $isOnline);

        return !$sessionId ? null : Context::$SESSION_STORAGE->loadSession($sessionId);
    }

    /**
     * Decodes the given session token and extracts the session information from it
     *
     * @param string $jwt a compact JSON web token in the form of xxxx.yyyy.zzzz
     *
     * @return array the decoded payload which contains claims about the entity
     */
    public static function decodeSessionToken(string $jwt): array
    {
        $payload = JWT::decode($jwt, Context::$API_SECRET_KEY, array('HS256'));
        return (array) $payload;
    }
}
