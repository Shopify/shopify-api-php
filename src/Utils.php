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
}
