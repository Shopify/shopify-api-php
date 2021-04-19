# Webhooks

If your application's functionality depends on knowing when events occur on a given store, you need to register a Webhook. You need an access token to register webhooks, so you should complete the OAuth process beforehand.

The Shopify library enables you to handle all Webhooks in a single endpoint (see [Process a Webhook](#process-a-webhook) below), but you are not restricted to a single endpoint. Each topic you register can only be mapped to a single endpoint.

In order to subscribe to webhooks using this library, there are 3 main steps to take:
1. [Load your handlers](#load-your-handlers)
1. [Register webhooks with Shopify](#webhook-registration)
1. [Process incoming webhooks](#webhook-processing)

## Load your handlers

The first step your app needs to perform to process webhooks is telling the library how you expect to handle them. To do that, you can call the `Shopify\Webhooks\Registry::addHandler` method to set the callback you want the library to trigger when a certain topic is received.

The parameters this method accepts are:

| Parameter | Type | Required? | Default Value | Notes |
| --- | --- | :---: | :---: | --- |
| `topic` | `string` | Yes | - | The topic to subscribe to. May be a string or a value from the Shopify\Webhooks\Topics class. |
| `handler` | `string \| array` | Yes | - | The method that will handle this topic. Must map to a callable static function, e.g. `['Class', 'method']`, where `Class` has a static method named `method`. |

For example, you can load one or more handlers in your `index.php` file (or any other location, as long as it happens before the call to `process`) by running:

```php
Shopify\Webhooks\Registry::addHandler(
    Shopify\Webhooks\Topics::APP_UNINSTALLED,
    ['\App\WebhookHandlers', 'appUninstalled']
);
```

Which will cause the static `appUninstalled` method to be called when processing webhooks, like so:

```php
namespace App;

class WebhookHandlers
{
    public static function appUninstalled(string $shop, string $topic, string $requestBody): void
    {
        // Handle your webhook here!
    }
}
```

**Note**: We also provide a `Shopify\Webhooks\Topics` class which contains many known events, but may not be completely up to date at all times. If the list hasn't been updated with an event you want to use yet, you can simply pass in a string with the topic.

## Webhook Registration

After your handlers are loaded, you can register which topics you want your app to listen to. This can only happen after the merchant has installed your app, so the best place to register webhooks is after OAuth completes.

In your OAuth callback function, you can use the `Shopify\Webhooks\Registry::register` method to subscribe to any topic. This method can safely be called multiple times for a shop, as it will update existing webhooks if necessary.

The parameters this method accepts are:

| Parameter | Type | Required? | Default Value | Notes |
| --- | --- | :---: | :---: | --- |
| `path` | `string` | Yes | - | The URL path for the callback. If using EventBridge, this is the full resource address. |
| `topic` | `string` | Yes | - | The topic to subscribe to. May be a string or a value from the Topics class. |
| `shop` | `string` | Yes | - | The shop to use for requests. |
| `accessToken` | `string` | Yes | - | The access token to use for requests. |
| `deliveryMethod` | `string` | No | `Registry::DELIVERY_METHOD_HTTP` | The delivery method for this webhook. |

For example, to subscribe to the `APP_UNINSTALLED` event, you can run this code in your OAuth callback action:

```php
function oauthCallbackAction()
{
    $session = OAuth::callback( ... );

    $response = Shopify\Webhooks\Registry::register(
        path: '/shopify/webhooks',
        topic: Shopify\Webhooks\Topics::APP_UNINSTALLED,
        shop: $session->getShop(),
        accessToken: $session->getAccessToken(),
    );

    if ($response->isSuccess()) {
        // Webhook registered!
    } else {
        \My\App::log("Webhook registration failed with response: \n" . var_export($response, true));
    }
}
```

## Webhook Processing

Coming soon!

[Back to guide index](../README.md)
