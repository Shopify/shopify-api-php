# Shopify Admin API Library for PHP

<!-- ![Build Status]() -->
[![License: MIT](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

This library provides support for PHP [Shopify](https://www.shopify.com) apps to access the [Shopify Admin API](https://shopify.dev/docs/admin-api), by making it easier to perform the following actions:

- Creating [online](https://shopify.dev/concepts/about-apis/authentication#online-access) or [offline](https://shopify.dev/concepts/about-apis/authentication#offline-access) access tokens for the Admin API via OAuth
- Making requests to the [REST API](https://shopify.dev/docs/admin-api/rest/reference)
- Making requests to the [GraphQL API](https://shopify.dev/docs/admin-api/graphql/reference)
- Registering/processing webhooks

This library can be used in any application that has a PHP backend, since it doesn't rely on any specific framework—you can include it alongside your preferred stack and only use the features that you need to build your app.

## Developing this library

After cloning the repository, composer can install the dependencies:
```
composer install
```

To run tests:
```
composer test
```

To run linter:
```
composer lint
```
