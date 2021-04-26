# Performing OAuth

Once the library is set up for your project, you'll be able to use it to start adding functionality to your app. The first thing your app will need to do is to obtain an access token to the Admin API by performing the OAuth process. You can read our [OAuth tutorial](https://shopify.dev/tutorials/authenticate-with-oauth) to learn more about the process.

## Begin OAuth

Create a route for starting the OAuth method such as `/login`. In this route, the `begin` method located in `src/Auth/OAuth.php` will be used. The method takes in a Shopify shop domain or hostname (_string_), the redirect path (_string_), and whether or not you are requesting [online access](https://shopify.dev/concepts/about-apis/authentication#api-access-modes) (_boolean_). The last parameter is optional and is an override function to set cookies. The `begin` method returns a URL that will be used for redirecting the user to the Shopify Authentication screen.

| Parameter | Type | Required? | Default Value | Notes |
| -------------- | ----------------------------------- | :-------: | :-----------: | ---------------------------------------------------------------------------------------- |
| `shop` | `string` | Yes | - | A Shopify domain name or hostname that will be converted to the form `exampleshop.myshopify.com`. |
| `redirectPath` | `string` | Yes | - | The redirect path used for callback with an optional leading `/` (e.g. both `auth/callback` and `/auth/callback` are acceptable). The route should be whitelisted under the app settings. |
| `isOnline` | `bool` | Yes | - | `true` if the session is online and `false` otherwise. |
| `setCookieFunction` | `callable` | No | - | An override function to set cookies in the HTTP request. In order to be framework-agnostic, the built-in `setcookie` method is applied. If that method does not work for your chosen framework, a function that sets cookies can be passed in. |

 An example of the custom set cookie function with Yii. Similar functions can be created for any frameworks that do not rely on the PHP `setcookie` function
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

To complete the OAuth process, your app can call the `OAuth.callback` method, which takes in the following arguments:

| Parameter | Type | Required? | Default Value | Notes |
| -------------- | ----------------------------------- | :-------: | :-----------: | ---------------------------------------------------------------------------------------- |
| `cookies` | `array` | Yes | - | HTTP request cookies, from which the OAuth session will be loaded. This must be a hash of `cookie name => value` pairs. The value will be cast to string so they may be objects that implement `toString` |
| `query` | `array` | Yes | - | The HTTP request URL query values. |

[Back to guide index](../README.md)
