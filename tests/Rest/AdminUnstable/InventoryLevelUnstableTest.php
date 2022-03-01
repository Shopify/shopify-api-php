<?php

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\InventoryLevel;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class InventoryLevelUnstableTest extends BaseTestCase
{
    /** @var Session */
    private $test_session;

    public function setUp(): void
    {
        parent::setUp();

        Context::$API_VERSION = "unstable";

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
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/unstable/inventory_levels.json?inventory_item_ids=808950810%2C39072856&location_ids=655441491%2C487838322",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        InventoryLevel::all(
            $this->test_session,
            [],
            ["inventory_item_ids" => "808950810,39072856", "location_ids" => "655441491,487838322"],
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
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/unstable/inventory_levels.json?inventory_item_ids=808950810",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        InventoryLevel::all(
            $this->test_session,
            [],
            ["inventory_item_ids" => 808950810],
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
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/unstable/inventory_levels.json?location_ids=655441491",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        InventoryLevel::all(
            $this->test_session,
            [],
            ["location_ids" => 655441491],
        );
    }

    /**

     *
     * @return void
     */
    public function test_4(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/unstable/inventory_levels/adjust.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["location_id" => 655441491, "inventory_item_id" => 808950810, "available_adjustment" => 5]),
            ),
        ]);

        $inventory_level = new InventoryLevel($this->test_session);

        $inventory_level->adjust(
            [],
            ["location_id" => 655441491, "inventory_item_id" => 808950810, "available_adjustment" => 5],
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
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/unstable/inventory_levels.json?inventory_item_id=808950810&location_id=655441491",
                "DELETE",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        InventoryLevel::delete(
            $this->test_session,
            [],
            ["inventory_item_id" => 808950810, "location_id" => 655441491],
        );
    }

    /**

     *
     * @return void
     */
    public function test_6(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/unstable/inventory_levels/connect.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["location_id" => 844681632, "inventory_item_id" => 457924702]),
            ),
        ]);

        $inventory_level = new InventoryLevel($this->test_session);

        $inventory_level->connect(
            [],
            ["location_id" => 844681632, "inventory_item_id" => 457924702],
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
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/unstable/inventory_levels/set.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["location_id" => 655441491, "inventory_item_id" => 808950810, "available" => 42]),
            ),
        ]);

        $inventory_level = new InventoryLevel($this->test_session);

        $inventory_level->set(
            [],
            ["location_id" => 655441491, "inventory_item_id" => 808950810, "available" => 42],
        );
    }

}
