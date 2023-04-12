<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Admin2023_01\FulfillmentService;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class FulfillmentService202301Test extends BaseTestCase
{
    /** @var Session */
    private $test_session;

    public function setUp(): void
    {
        parent::setUp();

        Context::$API_VERSION = "2023-01";

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
                  ["fulfillment_services" => [["id" => 611870435, "name" => "Venus Fulfillment", "email" => null, "service_name" => "Venus Fulfillment", "handle" => "venus-fulfillment", "fulfillment_orders_opt_in" => false, "include_pending_stock" => false, "provider_id" => null, "location_id" => 611870435, "callback_url" => null, "tracking_support" => true, "inventory_management" => true, "admin_graphql_api_id" => "gid://shopify/ApiFulfillmentService/611870435"], ["id" => 755357713, "name" => "Mars Fulfillment", "email" => null, "service_name" => "Mars Fulfillment", "handle" => "mars-fulfillment", "fulfillment_orders_opt_in" => true, "include_pending_stock" => false, "provider_id" => null, "location_id" => 24826418, "callback_url" => "http://google.com/", "tracking_support" => true, "inventory_management" => true, "admin_graphql_api_id" => "gid://shopify/ApiFulfillmentService/755357713"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2023-01/fulfillment_services.json?scope=all",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        FulfillmentService::all(
            $this->test_session,
            [],
            ["scope" => "all"],
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
                  ["fulfillment_services" => [["id" => 755357713, "name" => "Mars Fulfillment", "email" => null, "service_name" => "Mars Fulfillment", "handle" => "mars-fulfillment", "fulfillment_orders_opt_in" => true, "include_pending_stock" => false, "provider_id" => null, "location_id" => 24826418, "callback_url" => "http://google.com/", "tracking_support" => true, "inventory_management" => true, "admin_graphql_api_id" => "gid://shopify/ApiFulfillmentService/755357713"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2023-01/fulfillment_services.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        FulfillmentService::all(
            $this->test_session,
            [],
            [],
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
                  ["fulfillment_service" => ["id" => 1061774487, "name" => "Jupiter Fulfillment", "email" => null, "service_name" => "Jupiter Fulfillment", "handle" => "jupiter-fulfillment", "fulfillment_orders_opt_in" => true, "include_pending_stock" => false, "provider_id" => null, "location_id" => 1072404542, "callback_url" => "http://google.com/", "tracking_support" => true, "inventory_management" => true, "admin_graphql_api_id" => "gid://shopify/ApiFulfillmentService/1061774487", "permits_sku_sharing" => true]]
                )),
                "https://test-shop.myshopify.io/admin/api/2023-01/fulfillment_services.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["fulfillment_service" => ["name" => "Jupiter Fulfillment", "callback_url" => "http://google.com", "inventory_management" => true, "tracking_support" => true, "requires_shipping_method" => true, "format" => "json", "permits_sku_sharing" => true, "fulfillment_orders_opt_in" => true]]),
            ),
        ]);

        $fulfillment_service = new FulfillmentService($this->test_session);
        $fulfillment_service->name = "Jupiter Fulfillment";
        $fulfillment_service->callback_url = "http://google.com";
        $fulfillment_service->inventory_management = true;
        $fulfillment_service->tracking_support = true;
        $fulfillment_service->requires_shipping_method = true;
        $fulfillment_service->format = "json";
        $fulfillment_service->permits_sku_sharing = true;
        $fulfillment_service->fulfillment_orders_opt_in = true;
        $fulfillment_service->save();
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
                  ["fulfillment_service" => ["id" => 755357713, "name" => "Mars Fulfillment", "email" => null, "service_name" => "Mars Fulfillment", "handle" => "mars-fulfillment", "fulfillment_orders_opt_in" => true, "include_pending_stock" => false, "provider_id" => null, "location_id" => 24826418, "callback_url" => "http://google.com/", "tracking_support" => true, "inventory_management" => true, "admin_graphql_api_id" => "gid://shopify/ApiFulfillmentService/755357713"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2023-01/fulfillment_services/755357713.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        FulfillmentService::find(
            $this->test_session,
            755357713,
            [],
            [],
        );
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
                  ["fulfillment_service" => ["id" => 755357713, "name" => "New Fulfillment Service Name", "email" => null, "service_name" => "New Fulfillment Service Name", "handle" => "new-fulfillment-service-name", "fulfillment_orders_opt_in" => true, "include_pending_stock" => false, "provider_id" => null, "location_id" => 24826418, "callback_url" => "http://google.com/", "tracking_support" => true, "inventory_management" => true, "admin_graphql_api_id" => "gid://shopify/ApiFulfillmentService/755357713"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2023-01/fulfillment_services/755357713.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["fulfillment_service" => ["name" => "New Fulfillment Service Name"]]),
            ),
        ]);

        $fulfillment_service = new FulfillmentService($this->test_session);
        $fulfillment_service->id = 755357713;
        $fulfillment_service->name = "New Fulfillment Service Name";
        $fulfillment_service->save();
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
                  []
                )),
                "https://test-shop.myshopify.io/admin/api/2023-01/fulfillment_services/755357713.json",
                "DELETE",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        FulfillmentService::delete(
            $this->test_session,
            755357713,
            [],
            [],
        );
    }

}
