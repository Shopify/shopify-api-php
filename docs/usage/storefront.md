# Make a Storefront API call

This library also allows you to send GraphQL requests to the [Shopify Storefront API](https://shopify.dev/docs/storefront-api). To do that, you can use the `Shopify\Clients\Storefront` class using the current shop and an access token.

⚠️ This API limits request rates based on the IP address that calls it, which will be your server's address for all requests made by the library. The API uses a leaky bucket algorithm, with a default bucket size of 60 seconds of request processing time (minimum 0.5s per request), with a leak rate of 1/s. Learn more about [rate limits](https://shopify.dev/api/usage/rate-limits).

You can obtain Storefront API access tokens for both private apps and sales channels. Please read [our documentation](https://shopify.dev/docs/storefront-api/getting-started) to learn more about Storefront Access Tokens. For example, sales channels can create new Storefront Access Tokens by running the following code **with an offline Admin API session**:

```php
// Create a REST client from your offline session
$client = new \Shopify\Clients\Rest($session->getShop(), $session->getAccessToken());

// Create a new access token
$storefrontTokenResponse = $client->post(
    'storefront_access_tokens',
    [
        "storefront_access_token" => [
            "title" => "This is my test access token",
        ]
    ],
);
$storefrontAccessToken = $storefrontTokenResponse->getBody()['storefront_access_token']['access_token'];
```

If you are building a private app, you can set a default Storefront Access Token for all `Shopify\Clients\Storefront` instances by setting the `privateAppStorefrontAccessToken` property when you call `Shopify\Context::initialize`, instead of creating a new one using the Admin API.

`Shopify\Clients\Storefront` extends the `Shopify\Clients\Graphql`, so it supports the same parameters. Please refer to the [GraphQL client documentation](graphql.md) for details.

Below is an example of how you may query the Storefront API:

```php
// Load the access token as per instructions above
$storefrontAccessToken = '<my token>';
// Shop from which we're fetching data
$shop = 'my-shop.myshopify.com';

// The Storefront client takes in the shop url and the Storefront Access Token for that shop.
$storefrontClient = new \Shopify\Clients\Storefront($shop, $storefrontAccessToken);

// Call query and pass your query as `data`
$products = $storefrontClient->query(
    <<<QUERY
    {
        products (first: 10) {
            edges {
                node {
                    id
                    title
                    descriptionHtml
                }
            }
        }
    }
    QUERY,
);

// do something with the returned data
```

[Back to guide index](../README.md)
