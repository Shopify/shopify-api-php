# Webhooks

If your application's functionality depends on knowing when events occur on a given store, you need to register a Webhook. You need an access token to register webhooks, so you should complete the OAuth process beforehand.

The Shopify library enables you to handle all Webhooks in a single endpoint (see [Process a Webhook](#process-a-webhook) below), but you are not restricted to a single endpoint. Each topic you register can only be mapped to a single endpoint.

In order to subscribe to webhooks using this library, there are 3 main steps to take:
1. [Load your handlers](#load-your-handlers)
1. [Register webhooks with Shopify](#webhook-registration)
1. [Process incoming webhooks](#webhook-processing)

## Load your handlers

The first step to process webhooks in your app is telling the library how you expect to handle them. To do that, you can call the `Shopify\Webhooks\Registry::addHandler` method to set the callback you want the library to trigger when a certain topic is received.

The parameters this method accepts are:

| Parameter | Type | Required? | Default Value | Notes |
| --- | --- | :---: | :---: | --- |
| `topic` | `string` | Yes | - | The topic to subscribe to. May be a string or a value from the Shopify\Webhooks\Topics class. |
| `handler` | `Handler` | Yes | - | The handler for this topic, an instance of a class that implements `Handler`. |

Your handler needs to implement the `Shopify\Webhooks\Handler` interface, so it needs to implement the `handle` method. This method should accept the following parameters:

| Parameter | Type | Notes |
| --- | --- | --- |
| `topic` | `string` | The webhook topic. |
| `shop` | `string` | The shop for which the webhook was triggered. |
| `body` | `array` | The parsed payload of the POST request made by Shopify. |

For example, you can load one or more handlers in your `index.php` file (or any other location, as long as it happens before the call to `process`) by running:

```php
use Shopify\Webhooks\Registry;
use Shopify\Webhooks\Topics;
use App\Webhook\Handlers\AppUninstalled;

Registry::addHandler(Topics::APP_UNINSTALLED, new AppUninstalled());
```

Which will cause the `handle` method to be called when processing webhooks, like so:

```php
namespace App\Webhook\Handlers;

use Shopify\Webhooks\Handler;

class AppUninstalled implements Handler
{
    public function handle(string $topic, string $shop, array $requestBody): void
    {
        // Handle your webhook here!
    }
}
```

**Note**: We also provide a `Shopify\Webhooks\Topics` class which contains many known events, but may not be completely up to date at all times. If the list hasn't been updated with an event you want to use yet, you can simply pass in a string with the topic.

## Webhook Registration

After your handlers are loaded, you need to register which topics you want your app to listen to with Shopify. This can only happen after the merchant has installed your app, so the best place to register webhooks is after OAuth completes.

In your OAuth callback action, you can use the `Shopify\Webhooks\Registry::register` method to subscribe to any topic allowed by your app's scopes. This method can safely be called multiple times for a shop, as it will update existing webhooks if necessary.

### EventBridge and PubSub Webhooks

You can also register webhooks for delivery to Amazon EventBridge or Google Cloud Pub/Sub. In this case the `path` argument to `Registry::register` needs to be of a specific form.

For EventBridge, the `path` must be the [ARN of the partner event source](https://docs.aws.amazon.com/eventbridge/latest/APIReference/API_EventSource.html).

For Pub/Sub, the `path` must be of the form `pubsub://[PROJECT-ID]:[PUB-SUB-TOPIC-ID]`.  For example, if you created a topic with id `red` in the project `blue`, then the value of `path` would be `pubsub://blue:red`.

The parameters this method accepts are:

| Parameter        | Type     | Required? |          Default Value           | Notes                                                                        |
|:-----------------|:---------|:---------:|:--------------------------------:|:-----------------------------------------------------------------------------|
| `path`           | `string` |    Yes    |                -                 | The URL path for the callback for HTTP delivery, EventBridge or Pub/Sub URLs |
| `topic`          | `string` |    Yes    |                -                 | The topic to subscribe to. May be a string or a value from the Topics class. |
| `shop`           | `string` |    Yes    |                -                 | The shop to use for requests.                                                |
| `accessToken`    | `string` |    Yes    |                -                 | The access token to use for requests.                                        |
| `deliveryMethod` | `string` |    No     | `Registry::DELIVERY_METHOD_HTTP` | The delivery method for this webhook.                                        |

This method will return a `RegisterResponse` object, which holds the following data:

| Method | Return type | Notes |
| --- | --- | --- |
| `isSuccess` | `bool` | Whether the registration was successful. |
| `getBody` | `array` | The body from the Shopify request to register the webhook. May be null even when successful if no request was needed. |

For example, to subscribe to the `APP_UNINSTALLED` event, you can run this code in your OAuth callback action:

```php
function oauthCallbackAction()
{
    $session = OAuth::callback( ... );

    $response = Shopify\Webhooks\Registry::register(
        '/shopify/webhooks',
        Shopify\Webhooks\Topics::APP_UNINSTALLED,
        $session->getShop(),
        $session->getAccessToken(),
    );

    if ($response->isSuccess()) {
        // Webhook registered!
    } else {
        \My\App::log("Webhook registration failed with response: \n" . var_export($response, true));
    }
}
```

**Note**: You can either handle all webhooks in a single action or have multiple actions, but you can only register one handler per topic. If you're using multiple actions, they should all call the `Shopify\Webhooks\Registry::process` method.

## Webhook Processing

Once your webhooks are registered, Shopify will trigger them when the corresponding events happen in the shop. All webhooks will be a POST request made to the path defined in your `Shopify\Webhooks\Registry::register` call.

To handle webhooks, your app should call `Shopify\Webhooks\Registry::process`, which will validate that the request is a legitimate Shopify request and call your registered handler, or throw an exception.

The parameters this method accepts are:

| Parameter | Type | Required? | Default Value | Notes |
| --- | --- | :---: | :---: | --- |
| `rawHeaders` | `array` | Yes | - | The HTTP headers from the request, in pairs of type `[header => value]`. The header's `value` will be cast to a string so that objects that implement `toString` are also acceptable. |
| `rawBody` | `string` | Yes | - | The raw HTTP body from the request. The body is part of the request validation process, so it is important that it is not altered before being passed into this method. |

This method will return a `ProcessResponse` object, which holds the following data:

| Method | Return type | Notes |
| --- | --- | --- |
| `isSuccess` | `bool` | Whether the handler ran to completion. |
| `getErrorMessage` | `string` | The error message from the handler exception, if any were thrown. |

Following the example in the `register` section, your app may handle webhooks like so:

```php
class ShopifyController
{
    public function webhooksAction($request)
    {
        try {
            $response = Shopify\Webhooks\Registry::process($request->headers->toArray(), $request->getRawBody());

            if ($response->isSuccess()) {
                \My\App::log("Responded to webhook!");
                // Respond with HTTP 200 OK
            } else {
                // The webhook request was valid, but the handler threw an exception
                \My\App::log("Webhook handler failed with message: " . $response->getErrorMessage());
            }
        } catch (\Exception $error) {
            // The webhook request was not a valid one, likely a code error or it wasn't fired by Shopify
            \My\App::log($error);
        }
    }
}
```

As mentioned before, the handler you defined in your `addHandler` call will be triggered when `process` is called successfully.

```php
namespace App\Webhook\Handlers;

use Shopify\Webhooks\Handler;

class AppUninstalled implements Handler
{
    public function handle(string $topic, string $shop, array $requestBody): void
    {
        // Handle your webhook here!
    }
}
```

[Back to guide index](../README.md)
