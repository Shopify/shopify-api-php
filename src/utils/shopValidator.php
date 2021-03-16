<?php

/**
 * Validates .myshopify.com shop domain
 * 
 * @param string $shop {domainName}.myshopify.com
 * @return bool true if the domain is valid, false otherwise
 */
function validateShopDomain(string $shop) {
    $substring = explode('.', $shop);

    if (count($substring) != 3) {
        return FALSE;
    }

    return (ctype_alnum($substring[0]) && $substring[1] . '.' . $substring[2] == 'myshopify.com');
}