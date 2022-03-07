<?php

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\CustomerSavedSearch;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class CustomerSavedSearch202201Test extends BaseTestCase
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
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2022-01/customer_saved_searches.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        CustomerSavedSearch::all(
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
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2022-01/customer_saved_searches.json?since_id=20610973",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        CustomerSavedSearch::all(
            $this->test_session,
            [],
            ["since_id" => "20610973"],
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
                "https://test-shop.myshopify.io/admin/api/2022-01/customer_saved_searches.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["customer_saved_search" => ["name" => "Spent more than $50", "query" => "total_spent:>50"]]),
            ),
        ]);

        $customer_saved_search = new CustomerSavedSearch($this->test_session);
        $customer_saved_search->name = "Spent more than $50";
        $customer_saved_search->query = "total_spent:>50";
        $customer_saved_search->save();
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
                "https://test-shop.myshopify.io/admin/api/2022-01/customer_saved_searches.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["customer_saved_search" => ["name" => "Spent more than $50 and after 2013", "query" => "total_spent:>50 order_date:>=2013-01-01"]]),
            ),
        ]);

        $customer_saved_search = new CustomerSavedSearch($this->test_session);
        $customer_saved_search->name = "Spent more than $50 and after 2013";
        $customer_saved_search->query = "total_spent:>50 order_date:>=2013-01-01";
        $customer_saved_search->save();
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
                "https://test-shop.myshopify.io/admin/api/2022-01/customer_saved_searches/count.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        CustomerSavedSearch::count(
            $this->test_session,
            [],
            [],
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
                "https://test-shop.myshopify.io/admin/api/2022-01/customer_saved_searches/count.json?since_id=20610973",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        CustomerSavedSearch::count(
            $this->test_session,
            [],
            ["since_id" => "20610973"],
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
                "https://test-shop.myshopify.io/admin/api/2022-01/customer_saved_searches/789629109.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        CustomerSavedSearch::find(
            $this->test_session,
            789629109,
            [],
            [],
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
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2022-01/customer_saved_searches/789629109.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["customer_saved_search" => ["id" => 789629109, "name" => "This Name Has Been Changed"]]),
            ),
        ]);

        $customer_saved_search = new CustomerSavedSearch($this->test_session);
        $customer_saved_search->id = 789629109;
        $customer_saved_search->name = "This Name Has Been Changed";
        $customer_saved_search->save();
    }

    /**

     *
     * @return void
     */
    public function test_9(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2022-01/customer_saved_searches/789629109.json",
                "DELETE",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        CustomerSavedSearch::delete(
            $this->test_session,
            789629109,
            [],
            [],
        );
    }

    /**

     *
     * @return void
     */
    public function test_10(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2022-01/customer_saved_searches/789629109/customers.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        CustomerSavedSearch::customers(
            $this->test_session,
            789629109,
            [],
            [],
        );
    }

}
