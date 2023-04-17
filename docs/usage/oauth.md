# Performing OAuth

Once the library is set up for your project, you'll be able to use it to start adding functionality to your app. The first thing your app will need to do is to obtain an access token to the Admin API by performing the OAuth process. You can read our [OAuth overview](https://shopify.dev/docs/apps/auth/oauth) to learn more about the process.

Once you've implemented these actions in your app, please make sure to read our [notes on session handling](../issues.md#notes-on-session-handling).

## Begin OAuth

Create a route for starting the OAuth method such as `/login`. In this route, the `Shopify\Auth\OAuth::begin` method will be used. The `begin` method returns a URL that will be used for redirecting the user to the Shopify Authentication screen. It takes in the following arguments:

| Parameter | Type | Required? | Default Value | Notes |
| --- | --- | :---: | :---: | --- |
| `shop` | `string` | Yes | - | A Shopify domain name or hostname that will be converted to the form `exampleshop.myshopify.com`. |
| `redirectPath` | `string` | Yes | - | The redirect path used for callback with an optional leading `/` (e.g. both `auth/callback` and `/auth/callback` are acceptable). The route should be allowed under the app settings. |
| `isOnline` | `bool` | Yes | - | `true` if the session is online and `false` otherwise. |
| `setCookieFunction` | `callable` | No | - | An override function to set cookies in the HTTP request. In order to be framework-agnostic, the built-in `setcookie` method is applied. If that method does not work for your chosen framework, a function that sets cookies can be passed in. |

 An example of the custom set cookie function with Yii. Similar functions can be created for any frameworks that do not rely on the PHP `setcookie` function, but we **strongly recommend storing secure and signed cookies** in your app to help prevent session hijacking.
```php
function () use (Shopify\Auth\OAuthCookie $cookie) {
    $cookies = Yii::$app->response->cookies;
    $cookies->add(new \yii\web\Cookie([
        'name' => $cookie->getName(),
        'value' => $cookie->getValue(),
        'expire' => $cookie->getExpire(),
        'secure' => $cookie->isSecure(),
        'httpOnly' => $cookie->isSecure(),
    ]));

    return true;
}
```

## OAuth callback

To complete the OAuth process, your app needs to validate the callback request made by Shopify after the merchant authorizes your app to access their store data.

To do that, you can call the `Shopify\Auth\OAuth::callback` method in the endpoint defined in the `redirectPath` argument of the [begin method](#begin-oauth), which takes in the following arguments:

| Parameter | Type | Required? | Default Value | Notes |
| --- | --- | :---: | :---: | --- |
| `cookies` | `array` | Yes | - | HTTP request cookies, from which the OAuth session will be loaded. This must be a hash of `cookie name => value` pairs. The value will be cast to string so they may be objects that implement `toString`. |
| `query` | `array` | Yes | - | The HTTP request URL query values. |
| `setCookieFunction` | `callable` | No | - | An override function to set cookies in the HTTP request. In order to be framework-agnostic, the built-in `setcookie` method is applied. If that method does not work for your chosen framework, a function that sets cookies can be passed in. |

If successful, this method will return a `Session` object, which is described [below](#the-session-object). Once the session is created, you can use [utility methods](./utils.md) to fetch it.

## The `Session` object

The OAuth process will create a new `Session` object and store it in your `Context::$SESSION_STORAGE`. This object is a collection of data that is needed to authenticate requests to Shopify, so you can access shop data using the Admin API.

The `Session` object provides the following methods to expose its data:
| Method | Return Type | Returned data |
| --- | --- | --- |
| `getId` | `string` | The id of the session. |
| `getShop` | `string` | The shop to which the session belongs. |
| `getState` | `string` | The `state` of the session. This is mainly used for OAuth. |
| `getScope` | `string \| null` | The effective API scopes enabled for this session. |
| `getExpires` | `DateTime \| null` | The expiration date of the session, or null if it is offline. |
| `isOnline` | `bool` | Whether the session is [online or offline](https://shopify.dev/docs/apps/auth#api-access-modes). |
| `getAccessToken` | `string \| null` | The Admin API access token for the session. |
| `getOnlineAccessInfo` | `AccessTokenOnlineUserInfo \| null` | The data for the user associated with this session. Only applies to online sessions. |

[Back to guide index](../README.md)
