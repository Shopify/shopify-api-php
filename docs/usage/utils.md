# Utility methods

The library provides a set of functions that make it easier to perform certain tasks. These functions allow apps to:

1. Execute smaller parts of the logic required for Shopify apps individually
1. Leverage the above functions to avoid repetition, by providing shortcuts to features that are often used together

These methods are provided as a collection of static methods under `Shopify\Utils`. The following methods are currently supported:

- [`sanitizeShopDomain`](#sanitizeShopDomain)
- [`getQueryParams`](#getQueryParams)
- [`validateHmac`](#validateHmac)
- [`decodeSessionToken`](#decodeSessionToken)
- [`isApiVersionCompatible`](#isApiVersionCompatible)
- [`loadOfflineSession`](#loadOfflineSession)
- [`loadCurrentSession`](#loadCurrentSession)
- [`graphqlProxy`](#graphqlProxy)

## `sanitizeShopDomain`

Returns a sanitized Shopify shop domain, ensuring that the domain is always in the format `my-domain.myshopify.com`.

Accepted arguments:
| Parameter | Type | Required | Default Value | Notes |
| --- | --- | :---: | :---: | --- |
| `shop` | `string` | Yes | - | A Shopify shop domain or hostname |
| `myshopifyDomain` | `string \| null` | No | `'myshopify.com'` | A custom Shopify domain, mostly used for testing |

This method will return a `string`, or `null` if the domain is invalid.

## `getQueryParams`

Retrieves the query string arguments from a URL string, if any.

Accepted arguments:
| Parameter | Type | Required | Default Value | Notes |
| --- | --- | :---: | :---: | --- |
| `url` | `string` | Yes | - | The url string with query parameters to be extracted |

This method will return an associative array containing the query parameters.

## `validateHmac`

Determines if a request is valid by checking the HMAC hash received in a request.

Accepted arguments:
| Parameter | Type | Required | Default Value | Notes |
| --- | --- | :---: | :---: | --- |
| `params` | `array` | Yes | - | Query parameters from a URL |
| `secret` | `string` | Yes | - | The secret key associated with the app in the Partners Dashboard |

This method will return whether the `hmac` key in `params` is valid.

## `decodeSessionToken`

Decodes the given session token (JWT) and extracts its payload, using `Context::$API_SECRET_KEY` as the secret.

Accepted arguments:
| Parameter | Type | Required | Default Value | Notes |
| --- | --- | :---: | :---: | --- |
| `jwt` | `string` | Yes | - | The JWT to decode |

This method will return the payload of the JWT.

## `isApiVersionCompatible`

Checks if the current version of the app (from `Context::$API_VERSION`) is compatible, i.e. more recent, than the given reference version.

Accepted arguments:
| Parameter | Type | Required | Default Value | Notes |
| --- | --- | :---: | :---: | --- |
| `referenceVersion` | `string` | Yes | - | The version to check against |

This method will return `true` if the current version in `Context` is more recent than (or equal to) the reference version.

## `loadOfflineSession`

Loads an offline session. This method **does not** perform any validation on the shop domain, so it **must not** rely on user input for the domain.

Accepted arguments:
| Parameter | Type | Required | Default Value | Notes |
| --- | --- | :---: | :---: | --- |
| `shop` | `string` | Yes | - | The shop url to find the offline session for |
| `includeExpired` | `bool` | No | `false` | Include expired sessions |

This method will return a `Session` object if a session exists, or `null` otherwise. Please refer to the [OAuth documentation](./oauth.md#the-session-object) for more information.

## `loadCurrentSession`

Loads the current user's session based on the given headers and cookies.

Accepted arguments:
| Parameter | Type | Required | Default Value | Notes |
| --- | --- | :---: | :---: | --- |
| `rawHeaders` | `array` | Yes | - | The headers from the HTTP request |
| `cookies` | `array` | Yes | - | The cookies from the HTTP request |
| `isOnline` | `bool` | Yes | - | Whether to load online or offline sessions |

This method will return a `Session` object if a session exists, or `null` otherwise. Please refer to the [OAuth documentation](./oauth.md#the-session-object) for more information.

## `graphqlProxy`

Forwards the GraphQL query in the HTTP request to Shopify, returning the response.

Accepted arguments:
| Parameter | Type | Required | Default Value | Notes |
| --- | --- | :---: | :---: | --- |
| `rawHeaders` | `array` | Yes | - | The headers from the HTTP request |
| `cookies` | `array` | Yes | - | The cookies from the HTTP request |
| `rawBody` | `string` | Yes | - | The raw HTTP request payload |

This method will return a `HttpResponse` object. Please refer to the [GraphQL client documentation](./graphql.md) for more information.
