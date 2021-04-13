# Performing OAuth

Once the library is set up for your project, you'll be able to use it to start adding functionality to your app. The first thing your app will need to do is to obtain an access token to the Admin API by performing the OAuth process. You can read our [OAuth tutorial](https://shopify.dev/tutorials/authenticate-with-oauth) to learn more about the process.

## Begin OAuth

Create a route for starting the OAuth method such as `/login`. In this route, the `begin` method located in `src/Auth/OAuth.php` will be used. The method takes in a Shopify shop domain or hostname (_string_), the redirect path (_string_), and whether or not you are requesting [online access](https://shopify.dev/concepts/about-apis/authentication#api-access-modes) (_boolean_). The last parameter is optional and is an override function to set cookies. In order to be framework-agnostic, the built-in `setcookie` method is applied. If that method does not work, a function can be written to set cookies in your chosen framework.

<details>
<summary>Custom set cookie function with Yii</summary>
```php
function () use ($cookie) {
    $cookies = Yii::$app->response->cookies;
    $cookieSet = $cookies->add(new Cookie([
        $cookie->getName(),
        $cookie->getValue(),
        $cookie->getExpire(),
        secure: $cookie->isSecure(),
        httponly: $cookie->isHttpOnly(),
    ]))
    return $cookieSet;
}
```
</details>

The `begin` method returns a URL that will be used for redirecting the user to the Shopify Authentication screen.

## OAuth callback

To complete the OAuth process, your app can call the `OAuth.callback` method, which takes in the following arguments:

| Parameter | Type | Required? | Default Value | Notes |
| -------------- | ----------------------------------- | :-------: | :-----------: | ---------------------------------------------------------------------------------------- |
| `cookies` | `array` | Yes | - | HTTP request cookies, from which the OAuth session will be loaded. This must be a hash of `cookie name => value` pairs. The value will be cast to string so they may be objects that implement `toString` |
| `query` | `array` | Yes | - | The HTTP request URL query values. |

[Back to guide index](../README.md)
