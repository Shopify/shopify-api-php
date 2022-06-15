# Make a GraphQL API call
Once OAuth is complete, we can use the library's GraphQL client to make requests to the GraphQL Admin API. To do that, create an instance of `Graphql` using the current shop URL and, for non-private apps, the session `accessToken` in your app's endpoint.

The GraphQL client's main method is `query`, which takes the following arguments and returns an `HttpResponse` object:
| Parameter | Type | Required? | Default Value | Notes |
| --------- | ---- | :--: | :--: | ----- |
| `data` | `string \| array` | Yes | - | Query to be posted to endpoint |
| `query` | `array` | No | - | URL query parameters |
| `extraHeaders` | `array` | No | - | Any extra headers to send along with the request |
| `tries` | `int \| null` | No | `1` | How many times to attempt the request |

Example use of `query`
```php
// Load current session to get `accessToken`
$session = Shopify\Utils::loadCurrentSession($headers, $cookies, $isOnline);
// Create GraphQL client
$client = new Shopify\Clients\Graphql($session->getShop(), $session->getAccessToken());
// Use `query` method and pass your query as `data`
$queryString = <<<QUERY
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
QUERY;
$response = $client->query($queryString);

// do something with the returned data
```

Example with variables
```php
// load current session and create GraphQL client like above example

// Use `query` method, passing the query and variables in an array as `data`
$queryUsingVariables = <<<QUERY
    mutation productCreate(\$input: ProductInput!) {
        productCreate(input: \$input) {
            product {
                id
            }
        }
    }
QUERY;
$variables = [
    "input" => [
        ["title" => "TARDIS"],
        ["descriptionHtml" => "Time and Relative Dimensions in Space"],
        ["productType" => "Time Lord technology"]
    ]    
];
$response = $client->query(['query' => $queryUsingVariables, 'variables' => $variables]);

// do something with the returned data
```

[Back to guide index](../README.md)
