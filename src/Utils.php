<?php

declare(strict_types=1);

namespace Shopify;

use Shopify\Context;
use Shopify\Auth\OAuth;
use Shopify\Auth\Session;
use Shopify\Clients\Graphql;
use Shopify\Clients\HttpResponse;
use Shopify\Exception\InvalidArgumentException;
use Shopify\Exception\SessionNotFoundException;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

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
     * @param string      $shop            A Shopify shop domain or hostname
     * @param string|null $myshopifyDomain A custom Shopify domain
     *
     * @return string|null $name a sanitized Shopify shop domain, null if the provided domain is invalid
     */
    public static function sanitizeShopDomain(string $shop, ?string $myshopifyDomain = null): ?string
    {
        $name = trim(strtolower($shop));

        if ($myshopifyDomain) {
            $allowedDomains = [preg_replace("/^\*?\.?(.*)/", "$1", $myshopifyDomain)];
        } else {
            $allowedDomains = ["myshopify.com", "myshopify.io"];
        }

        if (Context::$CUSTOM_SHOP_DOMAINS) {
            $allowedDomains = array_merge(
                $allowedDomains,
                preg_replace("/^\*?\.?(.*)/", "$1", Context::$CUSTOM_SHOP_DOMAINS)
            );
        }

        $allowedDomainsRegexp = "(" . implode("|", $allowedDomains) . ")";

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
     * @throws \Shopify\Exception\UninitializedContextException
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

    /**
     * Loads the current user's session based on the given headers and cookies.
     *
     * @param array $rawHeaders The headers from the HTTP request
     * @param array $cookies    The cookies from the HTTP request
     * @param bool  $isOnline   Whether to load online or offline sessions
     *
     * @return Session|null The session or null if the session can't be found
     * @throws \Shopify\Exception\CookieNotFoundException
     * @throws \Shopify\Exception\MissingArgumentException
     */
    public static function loadCurrentSession(array $rawHeaders, array $cookies, bool $isOnline): ?Session
    {
        $sessionId = OAuth::getCurrentSessionId($rawHeaders, $cookies, $isOnline);

        return Context::$SESSION_STORAGE->loadSession($sessionId);
    }

    /**
     * Decodes the given session token and extracts the session information from it
     *
     * @param string $jwt A compact JSON web token in the form of xxxx.yyyy.zzzz
     *
     * @return array The decoded payload which contains claims about the entity
     */
    public static function decodeSessionToken(string $jwt): array
    {
        JWT::$leeway = 10;
        $payload = JWT::decode($jwt, new Key(Context::$API_SECRET_KEY, 'HS256'));
        return (array) $payload;
    }

    /**
     * Forwards the GraphQL query in the HTTP request to Shopify, returning the response.
     *
     * @param array  $rawHeaders The headers from the HTTP request
     * @param array  $cookies    The cookies from the HTTP request
     * @param string $rawBody    The raw HTTP request payload
     *
     * @return HttpResponse
     * @throws \Psr\Http\Client\ClientExceptionInterface
     * @throws \Shopify\Exception\CookieNotFoundException
     * @throws \Shopify\Exception\MissingArgumentException
     * @throws \Shopify\Exception\SessionNotFoundException
     * @throws \Shopify\Exception\UninitializedContextException
     */
    public static function graphqlProxy(array $rawHeaders, array $cookies, string $rawBody): HttpResponse
    {
        $session = self::loadCurrentSession($rawHeaders, $cookies, true);
        if (!$session) {
            throw new SessionNotFoundException("Could not find session for GraphQL proxy");
        }

        $client = new Graphql($session->getShop(), $session->getAccessToken());

        return $client->proxy($rawBody);
    }

    /**
     * Returns the appropriate URL for the host that should load the embedded app.
     *
     * @param string $host The host value received from Shopify
     *
     * @return string
     */
    public static function getEmbeddedAppUrl(string $host): string
    {
        if (empty($host)) {
            throw new InvalidArgumentException("Host value cannot be empty");
        }

        $decodedHost = base64_decode($host, true);
        if (!$decodedHost) {
            throw new InvalidArgumentException("Host was not a valid base64 string");
        }

        $apiKey = Context::$API_KEY;
        return "https://$decodedHost/apps/$apiKey";
    }
}
