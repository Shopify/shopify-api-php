<?php

declare(strict_types=1);

namespace Shopify;

/**
 * Class to store all util functions
 */
final class Utils
{
    /**
     * Validates .myshopify.com shop domain
     *
     * @param string $shop {domainName}.myshopify.com
     * @return bool true if the domain is valid, false otherwise
     */
    public static function validateShopDomain(string $shop)
    {
        $substring = explode('.', $shop);

        if (count($substring) != 3) {
            return false;
        }

        return (ctype_alnum($substring[0]) && $substring[1] . '.' . $substring[2] == 'myshopify.com');
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
}
