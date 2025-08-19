# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

## Unreleased

## v5.11.0 - 2025-07-10
- [#418](https://github.com/Shopify/shopify-api-php/pull/416) [Minor] Add support for 2025-07 API version

## v5.10.0 - 2025-04-03
- [#292](https://github.com/Shopify/shopify-api-php/pull/292) [Patch] Fix bug where null can be passed to param 3 of setcookie()
- [#405](https://github.com/Shopify/shopify-api-php/pull/405) [Minor] Add support for 2025-04 API version

## v5.9.0 - 2025-01-08
- [#393](https://github.com/Shopify/shopify-api-php/pull/393) [Minor] Add support for 2025-01 API version REST resources
- [#367](https://github.com/Shopify/shopify-api-php/pull/367) [Patch] Allow uppercase characters in redirect URI
- [#394](https://github.com/Shopify/shopify-api-php/pull/394) [Patch] Remove implicit nullability to support PHP 8.4

## v5.8.1 - 2024-11-13
- [#387](https://github.com/Shopify/shopify-api-php/pull/387) [Patch] Fix GraphQL request to properly encode query string

## v5.8.0 - 2024-11-12
- [#381](https://github.com/Shopify/shopify-api-php/pull/381) [Minor] Adding support for 2024-10 API version
- [#379](https://github.com/Shopify/shopify-api-php/pull/379) [Patch] Fix GraphQL `Content-Type` header to be `application/json`

## v5.7.0 - 2024-10-22
- [#371](https://github.com/Shopify/shopify-api-php/pull/371) [Minor] Remove API version validation to allow more flexibility of API version. And add support for 2024-10 API version
- [#370](https://github.com/Shopify/shopify-api-php/pull/370) [Patch] Fix params set to zero being removed from request payload
- [#366](https://github.com/Shopify/shopify-api-php/pull/366) [Minor] Updated webhook subscription topic constants

## v5.6.0 - 2024-07-02

- [#354](https://github.com/Shopify/shopify-api-php/pull/354) [Minor] Adding support for 2024-07 API version

## v5.5.1 - 2024-05-24

- [#345](https://github.com/Shopify/shopify-api-php/pull/345) [Patch] Stop storing a session in the database when beginning OAuth, only when completing it

## v5.5.0 - 2024-04-18

- [#332](https://github.com/Shopify/shopify-api-php/pull/332) [Patch] Avoid writing to system temporary directory when an API deprecation is encountered

## v5.4.0 - 2024-04-08

- [#333](https://github.com/Shopify/shopify-api-php/pull/333) [Minor] Adding support for 2024-04 API version

## v5.3.0 - 2024-01-10

- [#318](https://github.com/Shopify/shopify-api-php/pull/318) [Minor] Adding support for 2024-01 API version

## v5.2.0 - 2023-10-24

- [#306](https://github.com/Shopify/shopify-api-php/pull/306) [Minor] Adding support for 2023-10 API version
- [#297](https://github.com/Shopify/shopify-api-php/pull/297) [Patch] Fix CustomerAddress methods, FulfillmentRequest save method

## v5.1.0 - 2023-07-11

- [#285](https://github.com/Shopify/shopify-api-php/pull/285) [Minor] Adding support for 2023-07 API version

## v5.0.0 - 2023-05-10

- [#269](https://github.com/Shopify/shopify-api-php/pull/269) [bugfix] Refactored query string building to account for Shopify-specific array format
- [#236](https://github.com/Shopify/shopify-api-php/pull/236) [bugfix] Correct requirements in `composer.json`
- [#262](https://github.com/Shopify/shopify-api-php/pull/262) ⚠️ [Breaking] Added support for PHP 8.2, and removed support for PHP 7.4
- [#264](https://github.com/Shopify/shopify-api-php/pull/264) [Patch] Remove support for currently-non-existent versions of PHP (8.3+)
- [#272](https://github.com/Shopify/shopify-api-php/pull/272) ⚠️ [Breaking] Removed REST resources for 2022-01, update resources for remaining versions
- [#270](https://github.com/Shopify/shopify-api-php/pull/270) [Patch] Add support for Event topic names

## v4.3.0 - 2023-04-12

- [#259](https://github.com/Shopify/shopify-api-php/pull/259) Added support for 2023-04 API version, updated auto-generated REST resources

## v4.2.0 - 2023-01-05

- [#235](https://github.com/Shopify/shopify-api-php/pull/235) Fixed an error when parsing the JSON response body for the `AssignedFulfillmentOrder` resource
- [#238](https://github.com/Shopify/shopify-api-php/pull/238) Add support for 2023-01 API version

## v4.1.1 - 2022-11-07

- [#186](https://github.com/Shopify/shopify-api-php/pull/186) Update the `php-jwt` package

## v4.1.0 - 2022-10-11

- [#222](https://github.com/Shopify/shopify-api-php/pull/222) Add support for `Context::$CUSTOM_SHOP_DOMAINS` setting

## v4.0.0 - 2022-10-04

- [#221](https://github.com/Shopify/shopify-api-php/pull/221) ⚠️ [Breaking] Add REST resources for October 2022 API version, remove support and REST resources for October 2021 (`2021-10`) API version

## v3.2.1 - 2022-09-21

- [#218](https://github.com/Shopify/shopify-api-php/pull/218) Fix issue that failed when setting `Context::$HOST_NAME` with a port

## v3.2.0 - 2022-09-21

- [#213](https://github.com/Shopify/shopify-api-php/pull/213) Add 10s leeway when decoding session token JWTs
- [#211](https://github.com/Shopify/shopify-api-php/pull/211) Change requirement of `psr/log` from `^1.1` to `^1.1 || ^2.0 || ^3.0`
- [#210](https://github.com/Shopify/shopify-api-php/pull/210) Add `ext-json` as a dependency in `composer.json`
- [#212](https://github.com/Shopify/shopify-api-php/pull/212) Allow a scheme in the `Context::$HOST_NAME` URL to enable support for HTTP apps

## v3.1.0 - 2022-08-04

- [#209](https://github.com/Shopify/shopify-api-php/pull/209) Add `getEmbeddedAppUrl` utils method to load the embedded app in the right Shopify host

## v3.0.0 - 2022-07-04

- [#197](https://github.com/Shopify/shopify-api-php/pull/197) ⚠️ [Breaking] Add REST resources for July 2022 API version, remove support and REST resources for July 2021 (`2021-07`) API version
- [#180](https://github.com/Shopify/shopify-api-php/pull/180) Add optional `saving` parameter to `toArray` of `Base` class - default is `false` and will include read-only attributes in returned array; `true` used for `save` when committing via API to Shopify, which excludes read-only attributes.

## v2.0.1 - 2022-04-11

### Added

- [#168](https://github.com/Shopify/shopify-api-php/pull/168) Allow REST resources to configure a deny list of attributes to be excluded when saving
- [#169](https://github.com/Shopify/shopify-api-php/pull/169) Allow loading dynamic fields returned by the API, and fix an issue when loading object arrays from API response data

## v2.0.0 - 2022-04-04

### Added

- [#139](https://github.com/Shopify/shopify-api-php/pull/139) Add support for REST resources
- [#134](https://github.com/Shopify/shopify-api-php/pull/134) ⚠️ [Breaking] Add support for PHP 8.1 and remove 7.3 from the supported list, since it's no longer supported
- [#136](https://github.com/Shopify/shopify-api-php/pull/136) Allow full paths in REST requests

### Fixed

- [#117](https://github.com/Shopify/shopify-api-php/pull/117) Handle float `Retry-After` headers
- [#114](https://github.com/Shopify/shopify-api-php/pull/114) Update session cookie expiration after OAuth
- [#116](https://github.com/Shopify/shopify-api-php/pull/116) Save signature OAuth cookies when using the fallback function for frameworkless apps
