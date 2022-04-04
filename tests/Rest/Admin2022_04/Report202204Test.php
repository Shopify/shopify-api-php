<?php

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Admin2022_04\Report;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class Report202204Test extends BaseTestCase
{
    /** @var Session */
    private $test_session;

    public function setUp(): void
    {
        parent::setUp();

        Context::$API_VERSION = "2022-04";

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
                  ["reports" => [["id" => 752357116, "name" => "Custom App Report 2", "shopify_ql" => "SHOW total_sales BY order_id FROM sales ORDER BY total_sales", "updated_at" => "2022-03-30T19:40:01-04:00", "category" => "custom_app_reports"], ["id" => 517154478, "name" => "Wholesale Sales Report", "shopify_ql" => "SHOW total_sales BY order_id FROM sales WHERE api_client_id == 123 SINCE -1m UNTIL today", "updated_at" => "2017-04-10T16:33:22-04:00", "category" => "custom_app_reports"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/reports.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Report::all(
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
                  ["reports" => [["id" => 517154478, "name" => "Wholesale Sales Report", "shopify_ql" => "SHOW total_sales BY order_id FROM sales WHERE api_client_id == 123 SINCE -1m UNTIL today", "updated_at" => "2017-04-10T16:33:22-04:00", "category" => "custom_app_reports"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/reports.json?ids=517154478",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Report::all(
            $this->test_session,
            [],
            ["ids" => "517154478"],
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
                  ["reports" => [["id" => 752357116, "name" => "Custom App Report 2", "shopify_ql" => "SHOW total_sales BY order_id FROM sales ORDER BY total_sales", "updated_at" => "2022-03-30T19:40:01-04:00", "category" => "custom_app_reports"], ["id" => 517154478, "name" => "Wholesale Sales Report", "shopify_ql" => "SHOW total_sales BY order_id FROM sales WHERE api_client_id == 123 SINCE -1m UNTIL today", "updated_at" => "2017-04-10T16:33:22-04:00", "category" => "custom_app_reports"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/reports.json?updated_at_min=2005-07-31+15%3A57%3A11+EDT+-04%3A00",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Report::all(
            $this->test_session,
            [],
            ["updated_at_min" => "2005-07-31 15:57:11 EDT -04:00"],
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
                $this->buildMockHttpResponse(200, json_encode(
                  ["reports" => [["id" => 752357116, "shopify_ql" => "SHOW total_sales BY order_id FROM sales ORDER BY total_sales"], ["id" => 517154478, "shopify_ql" => "SHOW total_sales BY order_id FROM sales WHERE api_client_id == 123 SINCE -1m UNTIL today"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/reports.json?fields=id%2Cshopify_ql",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Report::all(
            $this->test_session,
            [],
            ["fields" => "id,shopify_ql"],
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
                  ["reports" => [["id" => 517154478, "name" => "Wholesale Sales Report", "shopify_ql" => "SHOW total_sales BY order_id FROM sales WHERE api_client_id == 123 SINCE -1m UNTIL today", "updated_at" => "2017-04-10T16:33:22-04:00", "category" => "custom_app_reports"], ["id" => 752357116, "name" => "Custom App Report 2", "shopify_ql" => "SHOW total_sales BY order_id FROM sales ORDER BY total_sales", "updated_at" => "2022-03-30T19:40:01-04:00", "category" => "custom_app_reports"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/reports.json?since_id=123",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Report::all(
            $this->test_session,
            [],
            ["since_id" => "123"],
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
                  ["report" => ["id" => 1016888664, "name" => "A new app report", "shopify_ql" => "SHOW total_sales BY order_id FROM sales SINCE -1m UNTIL today ORDER BY total_sales", "updated_at" => "2022-03-30T19:52:41-04:00", "category" => "custom_app_reports"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/reports.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["report" => ["name" => "A new app report", "shopify_ql" => "SHOW total_sales BY order_id FROM sales SINCE -1m UNTIL today ORDER BY total_sales"]]),
            ),
        ]);

        $report = new Report($this->test_session);
        $report->name = "A new app report";
        $report->shopify_ql = "SHOW total_sales BY order_id FROM sales SINCE -1m UNTIL today ORDER BY total_sales";
        $report->save();
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
                  ["report" => ["id" => 517154478, "name" => "Wholesale Sales Report", "shopify_ql" => "SHOW total_sales BY order_id FROM sales WHERE api_client_id == 123 SINCE -1m UNTIL today", "updated_at" => "2017-04-10T16:33:22-04:00", "category" => "custom_app_reports"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/reports/517154478.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Report::find(
            $this->test_session,
            517154478,
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
                  ["report" => ["id" => 517154478, "shopify_ql" => "SHOW total_sales BY order_id FROM sales WHERE api_client_id == 123 SINCE -1m UNTIL today"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/reports/517154478.json?fields=id%2Cshopify_ql",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Report::find(
            $this->test_session,
            517154478,
            [],
            ["fields" => "id,shopify_ql"],
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
                  ["report" => ["name" => "Changed Report Name", "shopify_ql" => "SHOW total_sales BY order_id FROM sales SINCE -12m UNTIL today ORDER BY total_sales", "id" => 517154478, "updated_at" => "2022-03-30T19:52:42-04:00", "category" => "custom_app_reports"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/reports/517154478.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["report" => ["id" => 517154478, "name" => "Changed Report Name", "shopify_ql" => "SHOW total_sales BY order_id FROM sales SINCE -12m UNTIL today ORDER BY total_sales"]]),
            ),
        ]);

        $report = new Report($this->test_session);
        $report->id = 517154478;
        $report->name = "Changed Report Name";
        $report->shopify_ql = "SHOW total_sales BY order_id FROM sales SINCE -12m UNTIL today ORDER BY total_sales";
        $report->save();
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
                "https://test-shop.myshopify.io/admin/api/2022-04/reports/517154478.json",
                "DELETE",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Report::delete(
            $this->test_session,
            517154478,
            [],
            [],
        );
    }

}
