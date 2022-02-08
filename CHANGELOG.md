# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Added

- [#134](https://github.com/Shopify/shopify-php-api/pull/134) ⚠️ [Breaking] Add support for PHP 8.1 and remove 7.3 from the supported list, since it's no longer supported

### Fixed

- [#117](https://github.com/Shopify/shopify-php-api/pull/117) Handle float `Retry-After` headers
- [#114](https://github.com/Shopify/shopify-php-api/pull/114) Update session cookie expiration after OAuth
- [#116](https://github.com/Shopify/shopify-php-api/pull/116) Save signature OAuth cookies when using the fallback function for frameworkless apps
