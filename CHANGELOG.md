# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

## Unreleased

### Added

- [#168](https://github.com/Shopify/shopify-php-api/pull/168) Allow REST resources to configure a deny list of attributes to be excluded when saving
- [#169](https://github.com/Shopify/shopify-php-api/pull/169) Allow loading dynamic fields returned by the API, and fix an issue when loading object arrays from API response data

## v2.0.0 - 2022-04-04

### Added

- [#139](https://github.com/Shopify/shopify-php-api/pull/139) Add support for REST resources
- [#134](https://github.com/Shopify/shopify-php-api/pull/134) ⚠️ [Breaking] Add support for PHP 8.1 and remove 7.3 from the supported list, since it's no longer supported
- [#136](https://github.com/Shopify/shopify-php-api/pull/136) Allow full paths in REST requests

### Fixed

- [#117](https://github.com/Shopify/shopify-php-api/pull/117) Handle float `Retry-After` headers
- [#114](https://github.com/Shopify/shopify-php-api/pull/114) Update session cookie expiration after OAuth
- [#116](https://github.com/Shopify/shopify-php-api/pull/116) Save signature OAuth cookies when using the fallback function for frameworkless apps
