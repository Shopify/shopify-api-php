<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Admin2022_07\CustomerSavedSearch;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class CustomerSavedSearch202207Test extends BaseTestCase
{
    /** @var Session */
    private $test_session;

    public function setUp(): void
    {
        parent::setUp();

        Context::$API_VERSION = "2022-07";

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
                  ["customer_saved_searches" => [["id" => 789629109, "name" => "Accepts Marketing", "created_at" => "2023-03-28T17:13:27-04:00", "updated_at" => "2023-03-28T17:13:27-04:00", "query" => "accepts_marketing:1"], ["id" => 20610973, "name" => "Canadian Snowboarders", "created_at" => "2023-03-28T17:13:27-04:00", "updated_at" => "2023-03-28T17:13:27-04:00", "query" => "country:Canada"], ["id" => 669439218, "name" => "Premier Customers", "created_at" => "2023-03-28T17:13:27-04:00", "updated_at" => "2023-03-28T17:13:27-04:00", "query" => "John Smith orders_count:>10 total_spent:>100.00"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/customer_saved_searches.json",
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
                $this->buildMockHttpResponse(200, json_encode(
                  ["customer_saved_searches" => [["id" => 669439218, "name" => "Premier Customers", "created_at" => "2023-03-28T17:13:27-04:00", "updated_at" => "2023-03-28T17:13:27-04:00", "query" => "John Smith orders_count:>10 total_spent:>100.00"], ["id" => 789629109, "name" => "Accepts Marketing", "created_at" => "2023-03-28T17:13:27-04:00", "updated_at" => "2023-03-28T17:13:27-04:00", "query" => "accepts_marketing:1"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/customer_saved_searches.json?since_id=20610973",
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
                $this->buildMockHttpResponse(200, json_encode(
                  ["customer_saved_search" => ["id" => 1068136103, "name" => "Spent more than \$50", "created_at" => "2023-04-04T17:20:09-04:00", "updated_at" => "2023-04-04T17:20:09-04:00", "query" => "total_spent:>50"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/customer_saved_searches.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["customer_saved_search" => ["name" => "Spent more than \$50", "query" => "total_spent:>50"]]),
            ),
        ]);

        $customer_saved_search = new CustomerSavedSearch($this->test_session);
        $customer_saved_search->name = "Spent more than \$50";
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
                $this->buildMockHttpResponse(200, json_encode(
                  ["customer_saved_search" => ["id" => 1068136102, "name" => "Spent more than \$50 and after 2013", "created_at" => "2023-04-04T17:20:03-04:00", "updated_at" => "2023-04-04T17:20:03-04:00", "query" => "total_spent:>50 order_date:>=2013-01-01"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/customer_saved_searches.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["customer_saved_search" => ["name" => "Spent more than \$50 and after 2013", "query" => "total_spent:>50 order_date:>=2013-01-01"]]),
            ),
        ]);

        $customer_saved_search = new CustomerSavedSearch($this->test_session);
        $customer_saved_search->name = "Spent more than \$50 and after 2013";
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
                $this->buildMockHttpResponse(200, json_encode(
                  ["count" => 3]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/customer_saved_searches/count.json",
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
                $this->buildMockHttpResponse(200, json_encode(
                  ["count" => 2]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/customer_saved_searches/count.json?since_id=20610973",
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
                $this->buildMockHttpResponse(200, json_encode(
                  ["customer_saved_search" => ["id" => 789629109, "name" => "Accepts Marketing", "created_at" => "2023-03-28T17:13:27-04:00", "updated_at" => "2023-03-28T17:13:27-04:00", "query" => "accepts_marketing:1"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/customer_saved_searches/789629109.json",
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
                $this->buildMockHttpResponse(200, json_encode(
                  ["customer_saved_search" => ["name" => "This Name Has Been Changed", "id" => 789629109, "created_at" => "2023-03-28T17:13:27-04:00", "updated_at" => "2023-04-04T17:20:19-04:00", "query" => "accepts_marketing:1"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/customer_saved_searches/789629109.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["customer_saved_search" => ["name" => "This Name Has Been Changed"]]),
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
                $this->buildMockHttpResponse(200, json_encode(
                  []
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/customer_saved_searches/789629109.json",
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
                $this->buildMockHttpResponse(200, json_encode(
                  ["customers" => [["id" => 207119551, "email" => "bob.norman@mail.example.com", "accepts_marketing" => true, "created_at" => "2023-04-04T17:13:27-04:00", "updated_at" => "2023-04-04T17:20:12-04:00", "first_name" => "Bob", "last_name" => "Norman", "orders_count" => 1, "state" => "disabled", "total_spent" => "199.65", "last_order_id" => 450789469, "note" => null, "verified_email" => true, "multipass_identifier" => null, "tax_exempt" => false, "tags" => "L\u00E9on, No\u00EBl", "last_order_name" => "#1001", "currency" => "USD", "phone" => "+16136120707", "addresses" => [["id" => 207119551, "customer_id" => 207119551, "first_name" => null, "last_name" => null, "company" => null, "address1" => "Chestnut Street 92", "address2" => "", "city" => "Louisville", "province" => "Kentucky", "country" => "United States", "zip" => "40202", "phone" => "555-625-1199", "name" => "", "province_code" => "KY", "country_code" => "US", "country_name" => "United States", "default" => true]], "accepts_marketing_updated_at" => "2023-04-04T17:20:12-04:00", "marketing_opt_in_level" => "single_opt_in", "tax_exemptions" => [], "sms_marketing_consent" => ["state" => "not_subscribed", "opt_in_level" => "single_opt_in", "consent_updated_at" => "2023-04-04T17:13:27-04:00", "consent_collected_from" => "OTHER"], "admin_graphql_api_id" => "gid://shopify/Customer/207119551", "default_address" => ["id" => 207119551, "customer_id" => 207119551, "first_name" => null, "last_name" => null, "company" => null, "address1" => "Chestnut Street 92", "address2" => "", "city" => "Louisville", "province" => "Kentucky", "country" => "United States", "zip" => "40202", "phone" => "555-625-1199", "name" => "", "province_code" => "KY", "country_code" => "US", "country_name" => "United States", "default" => true]]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/customer_saved_searches/789629109/customers.json",
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
