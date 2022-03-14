<?php

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\RecurringApplicationCharge;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class RecurringApplicationCharge202110Test extends BaseTestCase
{
    /** @var Session */
    private $test_session;

    public function setUp(): void
    {
        parent::setUp();

        Context::$API_VERSION = "2021-10";

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
                  ["recurring_application_charge" => ["id" => 1029266962, "name" => "Super Duper Plan", "api_client_id" => 755357713, "price" => "10.00", "status" => "pending", "return_url" => "http://super-duper.shopifyapps.com/", "billing_on" => null, "created_at" => "2022-02-03T16:43:01-05:00", "updated_at" => "2022-02-03T16:43:01-05:00", "test" => null, "activated_on" => null, "cancelled_on" => null, "trial_days" => 0, "trial_ends_on" => null, "decorated_return_url" => "http://super-duper.shopifyapps.com/?charge_id=1029266962", "confirmation_url" => "https://jsmith.myshopify.com/admin/charges/1029266962/confirm_recurring_application_charge?signature=BAh7BzoHaWRpBBJeWT06EmF1dG9fYWN0aXZhdGVU--74d9d807e18dfbca41735317f5e768363d1624e2"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-10/recurring_application_charges.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["recurring_application_charge" => ["name" => "Super Duper Plan", "price" => 10.0, "return_url" => "http://super-duper.shopifyapps.com"]]),
            ),
        ]);

        $recurring_application_charge = new RecurringApplicationCharge($this->test_session);
        $recurring_application_charge->name = "Super Duper Plan";
        $recurring_application_charge->price = 10.0;
        $recurring_application_charge->return_url = "http://super-duper.shopifyapps.com";
        $recurring_application_charge->save();
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
                  ["recurring_application_charge" => ["id" => 1029266963, "name" => "Super Duper Plan", "api_client_id" => 755357713, "price" => "10.00", "status" => "pending", "return_url" => "http://super-duper.shopifyapps.com/", "billing_on" => null, "created_at" => "2022-02-03T16:43:02-05:00", "updated_at" => "2022-02-03T16:43:02-05:00", "test" => null, "activated_on" => null, "cancelled_on" => null, "trial_days" => 0, "capped_amount" => "100.00", "trial_ends_on" => null, "balance_used" => 0.0, "balance_remaining" => 100.0, "risk_level" => 0, "decorated_return_url" => "http://super-duper.shopifyapps.com/?charge_id=1029266963", "confirmation_url" => "https://jsmith.myshopify.com/admin/charges/1029266963/confirm_recurring_application_charge?signature=BAh7BzoHaWRpBBNeWT06EmF1dG9fYWN0aXZhdGVU--3264282fb3cc146d9671e6d7be87703f42881f15"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-10/recurring_application_charges.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["recurring_application_charge" => ["name" => "Super Duper Plan", "price" => 10.0, "return_url" => "http://super-duper.shopifyapps.com", "capped_amount" => 100, "terms" => "\$1 for 1000 emails"]]),
            ),
        ]);

        $recurring_application_charge = new RecurringApplicationCharge($this->test_session);
        $recurring_application_charge->name = "Super Duper Plan";
        $recurring_application_charge->price = 10.0;
        $recurring_application_charge->return_url = "http://super-duper.shopifyapps.com";
        $recurring_application_charge->capped_amount = 100;
        $recurring_application_charge->terms = "\$1 for 1000 emails";
        $recurring_application_charge->save();
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
                  ["recurring_application_charge" => ["id" => 1029266964, "name" => "Super Duper Plan", "api_client_id" => 755357713, "price" => "10.00", "status" => "pending", "return_url" => "http://super-duper.shopifyapps.com/", "billing_on" => null, "created_at" => "2022-02-03T16:43:03-05:00", "updated_at" => "2022-02-03T16:43:03-05:00", "test" => null, "activated_on" => null, "cancelled_on" => null, "trial_days" => 5, "trial_ends_on" => null, "decorated_return_url" => "http://super-duper.shopifyapps.com/?charge_id=1029266964", "confirmation_url" => "https://jsmith.myshopify.com/admin/charges/1029266964/confirm_recurring_application_charge?signature=BAh7BzoHaWRpBBReWT06EmF1dG9fYWN0aXZhdGVU--15efe288887adbb6e91837f398ea009752112bdb"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-10/recurring_application_charges.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["recurring_application_charge" => ["name" => "Super Duper Plan", "price" => 10.0, "return_url" => "http://super-duper.shopifyapps.com", "trial_days" => 5]]),
            ),
        ]);

        $recurring_application_charge = new RecurringApplicationCharge($this->test_session);
        $recurring_application_charge->name = "Super Duper Plan";
        $recurring_application_charge->price = 10.0;
        $recurring_application_charge->return_url = "http://super-duper.shopifyapps.com";
        $recurring_application_charge->trial_days = 5;
        $recurring_application_charge->save();
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
                  ["recurring_application_charge" => ["id" => 1029266965, "name" => "Super Duper Plan", "api_client_id" => 755357713, "price" => "10.00", "status" => "pending", "return_url" => "http://super-duper.shopifyapps.com/", "billing_on" => null, "created_at" => "2022-02-03T16:43:05-05:00", "updated_at" => "2022-02-03T16:43:05-05:00", "test" => true, "activated_on" => null, "cancelled_on" => null, "trial_days" => 0, "trial_ends_on" => null, "decorated_return_url" => "http://super-duper.shopifyapps.com/?charge_id=1029266965", "confirmation_url" => "https://jsmith.myshopify.com/admin/charges/1029266965/confirm_recurring_application_charge?signature=BAh7BzoHaWRpBBVeWT06EmF1dG9fYWN0aXZhdGVU--3f7857a16054f426f93abc51169aa4dfdd2a4c0e"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-10/recurring_application_charges.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["recurring_application_charge" => ["name" => "Super Duper Plan", "price" => 10.0, "return_url" => "http://super-duper.shopifyapps.com", "test" => true]]),
            ),
        ]);

        $recurring_application_charge = new RecurringApplicationCharge($this->test_session);
        $recurring_application_charge->name = "Super Duper Plan";
        $recurring_application_charge->price = 10.0;
        $recurring_application_charge->return_url = "http://super-duper.shopifyapps.com";
        $recurring_application_charge->test = true;
        $recurring_application_charge->save();
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
                  ["recurring_application_charges" => [["id" => 455696195, "name" => "Super Mega Plan", "api_client_id" => 755357713, "price" => "15.00", "status" => "accepted", "return_url" => "http://yourapp.com", "billing_on" => "2022-02-03", "created_at" => "2022-02-03T16:32:42-05:00", "updated_at" => "2022-02-03T16:42:34-05:00", "test" => null, "activated_on" => null, "cancelled_on" => null, "trial_days" => 0, "trial_ends_on" => null, "decorated_return_url" => "http://yourapp.com?charge_id=455696195"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-10/recurring_application_charges.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        RecurringApplicationCharge::all(
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
                  ["recurring_application_charges" => [["id" => 1029266958, "name" => "Super Duper Plan", "api_client_id" => 755357713, "price" => "10.00", "status" => "pending", "return_url" => "http://super-duper.shopifyapps.com/", "billing_on" => null, "created_at" => "2022-02-03T16:42:36-05:00", "updated_at" => "2022-02-03T16:42:36-05:00", "test" => null, "activated_on" => null, "cancelled_on" => null, "trial_days" => 0, "trial_ends_on" => null, "decorated_return_url" => "http://super-duper.shopifyapps.com/?charge_id=1029266958", "confirmation_url" => "https://jsmith.myshopify.com/admin/charges/1029266958/confirm_recurring_application_charge?signature=BAh7BzoHaWRpBA5eWT06EmF1dG9fYWN0aXZhdGVU--f478748edf1ed8406a2bbe1f9a670dd6611cf7da"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-10/recurring_application_charges.json?since_id=455696195",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        RecurringApplicationCharge::all(
            $this->test_session,
            [],
            ["since_id" => "455696195"],
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
                  ["recurring_application_charge" => ["id" => 455696195, "name" => "Super Mega Plan", "api_client_id" => 755357713, "price" => "15.00", "status" => "pending", "return_url" => "http://yourapp.com", "billing_on" => "2022-02-03", "created_at" => "2022-02-03T16:32:42-05:00", "updated_at" => "2022-02-03T16:32:42-05:00", "test" => null, "activated_on" => null, "cancelled_on" => null, "trial_days" => 0, "trial_ends_on" => null, "decorated_return_url" => "http://yourapp.com?charge_id=455696195", "confirmation_url" => "https://jsmith.myshopify.com/admin/charges/455696195/confirm_recurring_application_charge?signature=BAh7BzoHaWRpBENfKRs6EmF1dG9fYWN0aXZhdGVU--b5f90d04779cc5242b396e4054f2e650c5dace1c"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-10/recurring_application_charges/455696195.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        RecurringApplicationCharge::find(
            $this->test_session,
            455696195,
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
                  []
                )),
                "https://test-shop.myshopify.io/admin/api/2021-10/recurring_application_charges/455696195.json",
                "DELETE",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        RecurringApplicationCharge::delete(
            $this->test_session,
            455696195,
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
                  ["recurring_application_charge" => ["id" => 455696195, "name" => "Super Mega Plan", "api_client_id" => 755357713, "price" => "15.00", "status" => "active", "return_url" => "http://yourapp.com", "billing_on" => null, "created_at" => "2022-02-03T16:32:42-05:00", "updated_at" => "2022-02-03T16:42:49-05:00", "test" => null, "activated_on" => "2022-02-03", "cancelled_on" => null, "trial_days" => 0, "capped_amount" => "100.00", "trial_ends_on" => "2022-02-03", "balance_used" => 0.0, "balance_remaining" => 100.0, "risk_level" => 0, "decorated_return_url" => "http://yourapp.com?charge_id=455696195", "update_capped_amount_url" => "https://jsmith.myshopify.com/admin/charges/455696195/confirm_update_capped_amount?signature=BAh7BzoHaWRpBENfKRs6EmF1dG9fYWN0aXZhdGVG--c394192ebae94dcf5ba4b265d67b5f847fb99776"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-10/recurring_application_charges/455696195/customize.json?recurring_application_charge%5Bcapped_amount%5D=200",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        $recurring_application_charge = new RecurringApplicationCharge($this->test_session);
        $recurring_application_charge->id = 455696195;
        $recurring_application_charge->customize(
            ["recurring_application_charge" => ["capped_amount" => "200"]],
        );
    }

}
