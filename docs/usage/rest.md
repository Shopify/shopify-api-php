# REST Admin API

REST Admin API lets you build apps and other integrations for the Shopify admin using REST. With the API, you can create apps that offer functionality at every stage of a store's operation, including shipping, fulfillment, and product management.

You can read our [REST Admin API](https://shopify.dev/docs/admin-api/getting-started#rest-admin-api) documentation and [REST Admin API reference](https://shopify.dev/docs/admin-api/rest/reference) for more information.

## Making your first REST request

REST Admin API endpoints are organized by [resource](https://shopify.dev/docs/admin-api/rest/reference#selecting-apis-for-your-app) . You'll need to use different API endpoints depending on the service that your app provides.

REST uses `get`, `post`, `put`, and `delete` requests to retrieve, create, update, and delete resources respectively.

| Parameter | Type            | Required? | Default Value | Notes                                            |
|:----------|:----------------|:---------:|:-------------:|:-------------------------------------------------|
| path      | string          |    Yes    |               | The URL path to request                          |
| headers   | array           |    No     |      []       | Any extra headers to send along with the request |
| tries     | int             |    No     |     null      | How many times to attempt the request            |
| query     | array           |    No     |      []       | Query parameters as an associative array         |
| body      | string or array |    Yes    |               | Only `Post`, and `put` methods can have body     |
| dataType  | No              |    Yes    |               | Only `Post`, and `put` methods can have body     |

In the following example we will retrieve a list of products from a shop using `Shopify\Clients\Rest` class.

```php
use Shopify\Clients\Rest;

$client = new Rest($session->getShop(), $session->getAccessToken());
$response = $client->get('products');
```

This request returns an instance of `Shopify\Clients\RestResponse`. The response object includes response `statusCode`, `body`, `headers`, and pagination information. To access the response attributes you can use `getStatusCode`, `getBody` and `getHeaders` respectively. There is also a convenience method `getDecodedBody` that will give you the JSON decoded associative array of the response body.

## Pagination

REST endpoints support cursor-based pagination. When you send a request to a REST endpoint that supports cursor-based pagination, the response body returns the first page of results, and a response header returns links to the next page, and the previous page of results (if applicable). For more information check [Make paginated requests to the REST Admin API](https://shopify.dev/tutorials/make-paginated-requests-to-rest-admin-api) tutorial.

`Shopify\Clients\Rest` helps you manage pagination by giving you the information you need. The response object of a `get` operation includes pagination information. To retrieve the pagination information call `$result->getPageInfo()`.

You can serialize the `pageInfo` and save it between requests to be able to access the next or previous page if present.

```php
$serializedPageInfo = serialize($result->getPageInfo());
```

To get the next page.

```php
$pageInfo = unserialize($serializedPageInfo);
$result = $client->get(path: 'products', query: $pageInfo->getNextPageQuery());
```

PageInfo gives you some convenience methods to determine whether there is there are more pages.

|         method         | Return type | Notes                          |
|:----------------------:|:-----------:|:-------------------------------|
|     hasNextPage()      |    bool     | false if there is no more page |
|   hasPreviousPage()    |    bool     | false if there is no more page |
|   getNextPageQuery()   |    array    | Query to get the next page     |
| getPreviousPageQuery() |    array    | Query to get the previous page |
