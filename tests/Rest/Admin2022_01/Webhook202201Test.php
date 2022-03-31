<?php

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Admin2022_01\Webhook;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class Webhook202201Test extends BaseTestCase
{
    /** @var Session */
    private $test_session;

    public function setUp(): void
    {
        parent::setUp();

        Context::$API_VERSION = "2022-01";

        $this->test_session = new Session("session_id", "test-shop.myshopify.io", true, "1234");
        $this->test_session->setAccessToken("this_is_a_test_token");
    }

    /**

     *
     * @return void
     */
    public function test_1(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["webhooks" => [["id" => 4759306, "address" => "https://apple.com", "topic" => "orders/create", "created_at" => "2022-03-30T19:40:01-04:00", "updated_at" => "2022-03-30T19:40:01-04:00", "format" => "json", "fields" => [], "metafield_namespaces" => [], "api_version" => "unstable", "private_metafield_namespaces" => []], ["id" => 892403750, "address" => "https://example.org/fully_loaded_1", "topic" => "orders/cancelled", "created_at" => "2021-12-01T05:23:43-05:00", "updated_at" => "2021-12-01T05:23:43-05:00", "format" => "json", "fields" => [], "metafield_namespaces" => [], "api_version" => "unstable", "private_metafield_namespaces" => []], ["id" => 901431826, "address" => "https://apple.com/uninstall", "topic" => "app/uninstalled", "created_at" => "2022-03-30T19:40:01-04:00", "updated_at" => "2022-03-30T19:40:01-04:00", "format" => "json", "fields" => [], "metafield_namespaces" => [], "api_version" => "unstable", "private_metafield_namespaces" => []], ["id" => 1014196360, "address" => "https://example.org/app_uninstalled", "topic" => "app/uninstalled", "created_at" => "2022-03-30T19:40:01-04:00", "updated_at" => "2022-03-30T19:40:01-04:00", "format" => "json", "fields" => [], "metafield_namespaces" => [], "api_version" => "unstable", "private_metafield_namespaces" => []]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-01/webhooks.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Webhook::all(
            $this->test_session,
            [],
            [],
        );
    }

    /**

     *
     * @return void
     */
    public function test_2(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["webhooks" => [["id" => 1014196360, "address" => "https://example.org/app_uninstalled", "topic" => "app/uninstalled", "created_at" => "2022-03-30T19:40:01-04:00", "updated_at" => "2022-03-30T19:40:01-04:00", "format" => "json", "fields" => [], "metafield_namespaces" => [], "api_version" => "unstable", "private_metafield_namespaces" => []]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-01/webhooks.json?since_id=901431826",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Webhook::all(
            $this->test_session,
            [],
            ["since_id" => "901431826"],
        );
    }

    /**

     *
     * @return void
     */
    public function test_3(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["webhook" => ["id" => 7506554879, "address" => "https://example.hostname.com/", "topic" => "orders/create", "created_at" => "2022-03-30T19:49:47-04:00", "updated_at" => "2022-03-30T19:49:47-04:00", "format" => "json", "fields" => ["id", "note"], "metafield_namespaces" => [], "api_version" => "unstable", "private_metafield_namespaces" => []]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-01/webhooks.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["webhook" => ["topic" => "orders/create", "address" => "https://example.hostname.com/", "format" => "json", "fields" => ["id", "note"]]]),
            ),
        ]);

        $webhook = new Webhook($this->test_session);
        $webhook->topic = "orders/create";
        $webhook->address = "https://example.hostname.com/";
        $webhook->format = "json";
        $webhook->fields = [
            "id",
            "note"
        ];
        $webhook->save();
    }

    /**

     *
     * @return void
     */
    public function test_4(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["webhook" => ["id" => 7506554880, "address" => "arn:aws:events:us-east-1::event-source/aws.partner/shopify.com/755357713/example-event-source", "topic" => "customers/update", "created_at" => "2022-03-30T19:49:48-04:00", "updated_at" => "2022-03-30T19:49:48-04:00", "format" => "json", "fields" => [], "metafield_namespaces" => [], "api_version" => "unstable", "private_metafield_namespaces" => []]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-01/webhooks.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["webhook" => ["address" => "arn:aws:events:us-east-1::event-source/aws.partner/shopify.com/755357713/example-event-source", "topic" => "customers/update", "format" => "json"]]),
            ),
        ]);

        $webhook = new Webhook($this->test_session);
        $webhook->address = "arn:aws:events:us-east-1::event-source/aws.partner/shopify.com/755357713/example-event-source";
        $webhook->topic = "customers/update";
        $webhook->format = "json";
        $webhook->save();
    }

    /**

     *
     * @return void
     */
    public function test_5(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["webhook" => ["id" => 7506554881, "address" => "pubsub://projectName:topicName", "topic" => "customers/update", "created_at" => "2022-03-30T19:49:49-04:00", "updated_at" => "2022-03-30T19:49:49-04:00", "format" => "json", "fields" => [], "metafield_namespaces" => [], "api_version" => "unstable", "private_metafield_namespaces" => []]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-01/webhooks.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["webhook" => ["address" => "pubsub://projectName:topicName", "topic" => "customers/update", "format" => "json"]]),
            ),
        ]);

        $webhook = new Webhook($this->test_session);
        $webhook->address = "pubsub://projectName:topicName";
        $webhook->topic = "customers/update";
        $webhook->format = "json";
        $webhook->save();
    }

    /**

     *
     * @return void
     */
    public function test_6(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["count" => 4]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-01/webhooks/count.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Webhook::count(
            $this->test_session,
            [],
            [],
        );
    }

    /**

     *
     * @return void
     */
    public function test_7(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["count" => 1]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-01/webhooks/count.json?topic=orders%2Fcreate",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Webhook::count(
            $this->test_session,
            [],
            ["topic" => "orders/create"],
        );
    }

    /**

     *
     * @return void
     */
    public function test_8(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["webhook" => ["id" => 4759306, "address" => "https://apple.com", "topic" => "orders/create", "created_at" => "2022-03-30T19:40:01-04:00", "updated_at" => "2022-03-30T19:40:01-04:00", "format" => "json", "fields" => [], "metafield_namespaces" => [], "api_version" => "unstable", "private_metafield_namespaces" => []]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-01/webhooks/4759306.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Webhook::find(
            $this->test_session,
            4759306,
            [],
            [],
        );
    }

    /**

     *
     * @return void
     */
    public function test_9(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["webhook" => ["id" => 4759306, "address" => "https://somewhere-else.com/", "topic" => "orders/create", "created_at" => "2022-03-30T19:40:01-04:00", "updated_at" => "2022-03-30T19:49:52-04:00", "format" => "json", "fields" => [], "metafield_namespaces" => [], "api_version" => "unstable", "private_metafield_namespaces" => []]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-01/webhooks/4759306.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["webhook" => ["id" => 4759306, "address" => "https://somewhere-else.com/"]]),
            ),
        ]);

        $webhook = new Webhook($this->test_session);
        $webhook->id = 4759306;
        $webhook->address = "https://somewhere-else.com/";
        $webhook->save();
    }

    /**

     *
     * @return void
     */
    public function test_10(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  []
                )),
                "https://test-shop.myshopify.io/admin/api/2022-01/webhooks/4759306.json",
                "DELETE",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Webhook::delete(
            $this->test_session,
            4759306,
            [],
            [],
        );
    }

}
