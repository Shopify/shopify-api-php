# Performing OAuth

Once the library is set up for your project, you'll be able to use it to start adding functionality to your app. The first thing your app will need to do is to obtain an access token to the Admin API by performing the OAuth process. You can read our [OAuth tutorial](https://shopify.dev/tutorials/authenticate-with-oauth) to learn more about the process.

## OAuth.callback

To complete the OAuth process, your app can call the `OAuth.callback` method, which takes in the following arguments:

| Parameter | Type | Required? | Default Value | Notes |
| -------------- | ----------------------------------- | :-------: | :-----------: | ---------------------------------------------------------------------------------------- |
| `cookies` | `array` | Yes | - | HTTP request cookies, from which the OAuth session will be loaded. This must be a hash of `cookie name => value` pairs. The value will be cast to string so they may be objects that implement `toString` |
| `query` | `array` | Yes | - | The HTTP request URL query values. |

[Back to guide index](../README.md)
