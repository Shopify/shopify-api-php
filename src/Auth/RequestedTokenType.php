<?php

declare(strict_types=1);

namespace Shopify\Auth;

/**
 * The type of access token being requested via the token exchange grant.
 *
 * @see https://shopify.dev/docs/apps/build/authentication-authorization/access-tokens/token-exchange
 */
class RequestedTokenType
{
    public const ONLINE_ACCESS_TOKEN = 'urn:shopify:params:oauth:token-type:online-access-token';
    public const OFFLINE_ACCESS_TOKEN = 'urn:shopify:params:oauth:token-type:offline-access-token';
}
