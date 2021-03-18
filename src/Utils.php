<?php

declare(strict_types=1);

namespace Shopify;

/**
 * Class to store all util functions
 */
final class Utils
{
    /**
     * Returns a sanitized Shopify shop domain
     * 
     * If the provided shop domain is invalid or could not be sanitized, returns null.
     *
     * @param string $shopDomain a Shopify shop domain or hostname
     * @param string $myshopifyDomain (optional) a custom Shopify domain
     * @return string $name a sanitifized Shopify shop domain, null if the provided domain is invalid
     */
    public static function sanitizeShopDomain(string $shopDomain, string $myshopifyDomain='myshopify.com')
    {
        $name = trim(strtolower($shopDomain));
        if ((strpos($name, $myshopifyDomain) == false) && (strpos($name, ".") == false))
        {
            $name .= ".{$myshopifyDomain}";
        }
        $name = preg_replace("/\A(https?\:\/\/)/", '', $name);

        if (preg_match('/\A[a-zA-Z0-9][a-zA-Z0-9\-]*\.myshopify\.(com|io)\z/', $name))
        {
            return $name;

        } else {
            return null;
        }
    }

    /**
     * Determines if request is valid by processing secret key through an HMAC-SHA256 hash function
     *
     * @param array $params array of parameters parsed from a URL
     * @param string $secret the secret key associated with the app in the Partners Dashboard
     * @return bool true if the generated hexdigest is equal to the hmac parameter, false otherwise
     */
    public static function validateHmac(array $params, string $secret)
    {
        $hmac = $params['hmac'];
        unset($params['hmac']);

        $computedHmac = hash_hmac('sha256', http_build_query($params), $secret);

        return hash_equals($hmac, $computedHmac);
    }

    /**
     * Retrieves the query string arguments from a URL, if any
     *
     * @param string $url the url string with query parameters to be extracted
     * @return array $params Array of key/value pairs representing the query parameters
     */
    public static function getQueryParams(string $url)
    {
        $queryString = parse_url($url, PHP_URL_QUERY);
        if (empty($queryString)) {
            return array();
        }
        parse_str($queryString, $params);
        return $params;
    }
}
