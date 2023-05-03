# Getting started

Before you start building your app, you'll need to perform the steps below.

## Install dependencies

To use this library, you'll need to have at least PHP 7.3 installed in your server.

The library is available on [Packagist](https://packagist.org/packages/shopify/shopify-api). You can add it to your project's Composer dependencies with `composer require shopify/shopify-api`.

## Set up the library

The first thing your app will need to do to use this library is to set up your configurations. You can do that by calling the `Shopify\Context::initialize` method, which accepts the following settings:

| Param             | Type              | Required? |   Default    | Notes                                                                                                                                                                                |
| ----------------- | ----------------- | :-------: | :----------: | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ |
| `apiKey`          | `string`          |    Yes    |      -       | App API key from the Partners dashboard                                                                                                                                              |
| `apiSecretKey`    | `string`          |    Yes    |      -       | App API secret from the Partners dashboard                                                                                                                                           |
| `scopes`          | `string \| array` |    Yes    |      -       | App scopes                                                                                                                                                                           |
| `hostName`        | `string`          |    Yes    |      -       | App host name e.g. `my-app.my-domain.ca`. You may optionally include `https://` or `http://` to determine which scheme to use                                                        |
| `sessionStorage`  | `SessionStorage`  |    Yes    |      -       | Session storage strategy. Read our [notes on session handling](issues.md#notes-on-session-handling) for more information                                                             |
| `apiVersion`      | `string`          |    No     | `'unstable'` | App API version, defaults to unstable                                                                                                                                                |
| `isEmbeddedApp`   | `bool`            |    No     |    `true`    | Whether the app is an embedded app                                                                                                                                                   |
| `isCustomStoreApp`    | `bool`            |    No     |   `false`    | Whether the app is a custom store app                                                                                                                                                     |
| `userAgentPrefix` | `string`          |    No     |      -       | Prefix for user agent header sent with a request                                                                                                                                     |
| `logger`          | `LoggerInterface` |    No     |      -       | App logger, so the library can add its own logs to it. Must implement the [PSR-3](https://www.php-fig.org/psr/psr-3/) `Psr\Log\LoggerInterface` interface from the `psr/log` package |

You should call this method as early as possible in your application, as none of the library's features are available until it is initialized. Below is an example call to `initialize`:

```php
Context::initialize(
    apiKey: $_ENV['SHOPIFY_API_KEY'],
    apiSecretKey: $_ENV['SHOPIFY_API_SECRET'],
    scopes: $_ENV['SHOPIFY_APP_SCOPES'],
    hostName: $_ENV['SHOPIFY_APP_HOST_NAME'],
    sessionStorage: new FileSessionStorage('/tmp/php_sessions'),
    apiVersion: '2023-04',
    isEmbeddedApp: true,
    isCustomStoreApp: false,
);
```

[Back to guide index](README.md)
