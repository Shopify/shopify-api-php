# Shopify API Library for PHP

<!-- ![Build Status]() -->
[![License: MIT](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

This library provides support for PHP [Shopify](https://www.shopify.com) apps to access the [Shopify Admin API](https://shopify.dev/docs/admin-api), by making it easier to perform the following actions:

- Creating [online](https://shopify.dev/concepts/about-apis/authentication#online-access) or [offline](https://shopify.dev/concepts/about-apis/authentication#offline-access) access tokens for the Admin API via OAuth
- Making requests to the [REST API](https://shopify.dev/docs/admin-api/rest/reference)
- Making requests to the [GraphQL API](https://shopify.dev/docs/admin-api/graphql/reference)
- Registering/processing webhooks

In addition to the Admin API, this library also allows querying the [Storefront API](https://shopify.dev/docs/storefront-api).

This library can be used in any application that has a PHP backend, since it doesn't rely on any specific framework—you can include it alongside your preferred stack and only use the features that you need to build your app.

# Requirements

To follow these usage guides, you will need to:
- have a basic understanding of [PHP](https://php.net)
- have a Shopify Partner account and development store
- _OR_ have a test store where you can create a private app
- have a private or custom app already set up in your test store or partner account
- use [ngrok](https://ngrok.com), in order to create a secure tunnel to your app running on your localhost
- add the `ngrok` URL and the appropriate redirect for your OAuth callback route to your app settings

<!-- Make sure this section is in sync with docs/README.md -->
# Getting started

You can follow our [getting started guide](docs/) to learn how to use this library's components.

- [Getting started](docs/getting_started.md)
  - [Install dependencies](docs/getting_started.md#install-dependencies)
  - [Set up the library](docs/getting_started.md#set-up-the-library)
- [Performing OAuth](docs/usage/oauth.md)
  - [Begin OAuth](docs/usage/oauth.md#begin-oauth)
  - [OAuth callback](docs/usage/oauth.md#oauth-callback)
- [REST Admin API](docs/usage/rest.md)
- [Make a GraphQL API call](docs/usage/graphql.md)
- [Make a Storefront API call](docs/usage/storefront.md)
- [Webhooks](docs/usage/webhooks.md)
- [Utilities](docs/usage/utils.md)
- [Known issues and caveats](docs/issues.md)
  - [Notes on session handling](docs/issues.md#notes-on-session-handling)

# Developing this library

After cloning the repository, composer can install the dependencies:
```
composer install
```

To run tests:
```
composer test
```

If you want to get a code coverage report from the tests, you'll need to install the `php-xdebug` extension by running `pecl install xdebug`, and then run:
```
composer test -- [--coverage-text|--coverage-html=<path>]
```

You may have to clear composer's autoload cache when namespaces change:
```
composer dump-autoload
```

To run linter:
```
composer lint
```
