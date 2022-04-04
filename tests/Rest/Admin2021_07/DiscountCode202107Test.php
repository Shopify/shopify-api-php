<?php

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Admin2021_07\DiscountCode;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class DiscountCode202107Test extends BaseTestCase
{
    /** @var Session */
    private $test_session;

    public function setUp(): void
    {
        parent::setUp();

        Context::$API_VERSION = "2021-07";

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
                  ["discount_code" => ["id" => 1054381139, "price_rule_id" => 507328175, "code" => "SUMMERSALE10OFF", "usage_count" => 0, "created_at" => "2022-03-30T19:54:05-04:00", "updated_at" => "2022-03-30T19:54:05-04:00"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/price_rules/507328175/discount_codes.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["discount_code" => ["code" => "SUMMERSALE10OFF"]]),
            ),
        ]);

        $discount_code = new DiscountCode($this->test_session);
        $discount_code->price_rule_id = 507328175;
        $discount_code->code = "SUMMERSALE10OFF";
        $discount_code->save();
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
                  ["discount_codes" => [["id" => 507328175, "price_rule_id" => 507328175, "code" => "SUMMERSALE10OFF", "usage_count" => 0, "created_at" => "2022-03-30T19:40:01-04:00", "updated_at" => "2022-03-30T19:40:01-04:00"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/price_rules/507328175/discount_codes.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        DiscountCode::all(
            $this->test_session,
            ["price_rule_id" => "507328175"],
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
                  ["discount_code" => ["id" => 507328175, "price_rule_id" => 507328175, "code" => "WINTERSALE20OFF", "usage_count" => 0, "created_at" => "2022-03-30T19:40:01-04:00", "updated_at" => "2022-03-30T19:54:06-04:00"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/price_rules/507328175/discount_codes/507328175.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["discount_code" => ["id" => 507328175, "code" => "WINTERSALE20OFF"]]),
            ),
        ]);

        $discount_code = new DiscountCode($this->test_session);
        $discount_code->price_rule_id = 507328175;
        $discount_code->id = 507328175;
        $discount_code->code = "WINTERSALE20OFF";
        $discount_code->save();
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
                  ["discount_code" => ["id" => 507328175, "price_rule_id" => 507328175, "code" => "SUMMERSALE10OFF", "usage_count" => 0, "created_at" => "2022-03-30T19:40:01-04:00", "updated_at" => "2022-03-30T19:40:01-04:00"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/price_rules/507328175/discount_codes/507328175.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        DiscountCode::find(
            $this->test_session,
            507328175,
            ["price_rule_id" => "507328175"],
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
                  []
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/price_rules/507328175/discount_codes/507328175.json",
                "DELETE",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        DiscountCode::delete(
            $this->test_session,
            507328175,
            ["price_rule_id" => "507328175"],
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
                "https://test-shop.myshopify.io/admin/api/2021-07/discount_codes/count.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        DiscountCode::count(
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
                  ["discount_code_creation" => ["id" => 989355119, "price_rule_id" => 507328175, "started_at" => null, "completed_at" => null, "created_at" => "2022-03-30T19:54:15-04:00", "updated_at" => "2022-03-30T19:54:15-04:00", "status" => "queued", "codes_count" => 3, "imported_count" => 0, "failed_count" => 0, "logs" => []]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/price_rules/507328175/batch.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["discount_codes" => [["code" => "SUMMER1"], ["code" => "SUMMER2"], ["code" => "SUMMER3"]]]),
            ),
        ]);

        $discount_code = new DiscountCode($this->test_session);
        $discount_code->price_rule_id = 507328175;
        $discount_code->batch(
            [],
            ["discount_codes" => [["code" => "SUMMER1"], ["code" => "SUMMER2"], ["code" => "SUMMER3"]]],
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
                  ["discount_code_creation" => ["id" => 173232803, "price_rule_id" => 507328175, "started_at" => null, "completed_at" => null, "created_at" => "2022-03-30T19:40:01-04:00", "updated_at" => "2022-03-30T19:40:01-04:00", "status" => "queued", "codes_count" => 3, "imported_count" => 0, "failed_count" => 0, "logs" => []]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/price_rules/507328175/batch/173232803.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        DiscountCode::get_all(
            $this->test_session,
            ["price_rule_id" => "507328175", "batch_id" => "173232803"],
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
                  ["discount_codes" => [["id" => null, "code" => "foo", "errors" => []], ["id" => null, "code" => "", "errors" => []], ["id" => null, "code" => "bar", "errors" => []]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-07/price_rules/507328175/batch/173232803/discount_codes.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        DiscountCode::all(
            $this->test_session,
            ["price_rule_id" => "507328175", "batch_id" => "173232803"],
            [],
        );
    }

}
