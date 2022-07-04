<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Admin2022_07\RecurringApplicationCharge;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class RecurringApplicationCharge202207Test extends BaseTestCase
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
                  ["recurring_application_charge" => ["id" => 1029266947, "name" => "Super Duper Plan", "api_client_id" => 755357713, "price" => "10.00", "status" => "pending", "return_url" => "http://super-duper.shopifyapps.com/", "billing_on" => null, "created_at" => "2022-07-02T01:31:23-04:00", "updated_at" => "2022-07-02T01:31:23-04:00", "test" => null, "activated_on" => null, "cancelled_on" => null, "trial_days" => 0, "capped_amount" => "100.00", "trial_ends_on" => null, "balance_used" => 0.0, "balance_remaining" => 100.0, "risk_level" => 0, "decorated_return_url" => "http://super-duper.shopifyapps.com/?charge_id=1029266947", "confirmation_url" => "https://jsmith.myshopify.com/admin/charges/755357713/1029266947/RecurringApplicationCharge/confirm_recurring_application_charge?signature=BAh7BzoHaWRpBANeWT06EmF1dG9fYWN0aXZhdGVU--a403288a917e193c432d469d5c44ae42c5c460a3"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/recurring_application_charges.json",
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
    public function test_2(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["recurring_application_charge" => ["id" => 1029266948, "name" => "Super Duper Plan", "api_client_id" => 755357713, "price" => "10.00", "status" => "pending", "return_url" => "http://super-duper.shopifyapps.com/", "billing_on" => null, "created_at" => "2022-07-02T01:31:24-04:00", "updated_at" => "2022-07-02T01:31:24-04:00", "test" => true, "activated_on" => null, "cancelled_on" => null, "trial_days" => 0, "trial_ends_on" => null, "decorated_return_url" => "http://super-duper.shopifyapps.com/?charge_id=1029266948", "confirmation_url" => "https://jsmith.myshopify.com/admin/charges/755357713/1029266948/RecurringApplicationCharge/confirm_recurring_application_charge?signature=BAh7BzoHaWRpBAReWT06EmF1dG9fYWN0aXZhdGVU--05881c0e8068c7dfd4dfd30cbb6daa6c2355c06e"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/recurring_application_charges.json",
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
    public function test_3(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["recurring_application_charge" => ["id" => 1029266949, "name" => "Super Duper Plan", "api_client_id" => 755357713, "price" => "10.00", "status" => "pending", "return_url" => "http://super-duper.shopifyapps.com/", "billing_on" => null, "created_at" => "2022-07-02T01:31:25-04:00", "updated_at" => "2022-07-02T01:31:25-04:00", "test" => null, "activated_on" => null, "cancelled_on" => null, "trial_days" => 5, "trial_ends_on" => null, "decorated_return_url" => "http://super-duper.shopifyapps.com/?charge_id=1029266949", "confirmation_url" => "https://jsmith.myshopify.com/admin/charges/755357713/1029266949/RecurringApplicationCharge/confirm_recurring_application_charge?signature=BAh7BzoHaWRpBAVeWT06EmF1dG9fYWN0aXZhdGVU--66d03ff1fe445a2ac7bf0e079e0f5a63e3ba468e"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/recurring_application_charges.json",
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
                  ["recurring_application_charge" => ["id" => 1029266954, "name" => "Super Duper Plan", "api_client_id" => 755357713, "price" => "10.00", "status" => "pending", "return_url" => "http://super-duper.shopifyapps.com/", "billing_on" => null, "created_at" => "2022-07-02T01:31:52-04:00", "updated_at" => "2022-07-02T01:31:52-04:00", "test" => null, "activated_on" => null, "cancelled_on" => null, "trial_days" => 0, "trial_ends_on" => null, "decorated_return_url" => "http://super-duper.shopifyapps.com/?charge_id=1029266954", "confirmation_url" => "https://jsmith.myshopify.com/admin/charges/755357713/1029266954/RecurringApplicationCharge/confirm_recurring_application_charge?signature=BAh7BzoHaWRpBApeWT06EmF1dG9fYWN0aXZhdGVU--130a2db669d94e032ba93208c925e1b28f0e6845"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/recurring_application_charges.json",
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
    public function test_5(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["recurring_application_charges" => [["id" => 455696195, "name" => "Super Mega Plan", "api_client_id" => 755357713, "price" => "15.00", "status" => "accepted", "return_url" => "http://yourapp.example.org", "billing_on" => "2022-07-01", "created_at" => "2022-07-02T01:30:21-04:00", "updated_at" => "2022-07-02T01:31:28-04:00", "test" => null, "activated_on" => null, "cancelled_on" => null, "trial_days" => 0, "trial_ends_on" => null, "decorated_return_url" => "http://yourapp.example.org?charge_id=455696195"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/recurring_application_charges.json",
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
                  ["recurring_application_charges" => [["id" => 1029266950, "name" => "Super Duper Plan", "api_client_id" => 755357713, "price" => "10.00", "status" => "pending", "return_url" => "http://super-duper.shopifyapps.com/", "billing_on" => null, "created_at" => "2022-07-02T01:31:29-04:00", "updated_at" => "2022-07-02T01:31:29-04:00", "test" => null, "activated_on" => null, "cancelled_on" => null, "trial_days" => 0, "trial_ends_on" => null, "decorated_return_url" => "http://super-duper.shopifyapps.com/?charge_id=1029266950", "confirmation_url" => "https://jsmith.myshopify.com/admin/charges/755357713/1029266950/RecurringApplicationCharge/confirm_recurring_application_charge?signature=BAh7BzoHaWRpBAZeWT06EmF1dG9fYWN0aXZhdGVU--43a628754e3767b03baaf131cfd3c1c6624e8245"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/recurring_application_charges.json?since_id=455696195",
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
                  ["recurring_application_charge" => ["id" => 455696195, "name" => "Super Mega Plan", "api_client_id" => 755357713, "price" => "15.00", "status" => "pending", "return_url" => "http://yourapp.example.org", "billing_on" => "2022-07-01", "created_at" => "2022-07-02T01:30:21-04:00", "updated_at" => "2022-07-02T01:30:21-04:00", "test" => null, "activated_on" => null, "cancelled_on" => null, "trial_days" => 0, "trial_ends_on" => null, "decorated_return_url" => "http://yourapp.example.org?charge_id=455696195", "confirmation_url" => "https://jsmith.myshopify.com/admin/charges/755357713/455696195/RecurringApplicationCharge/confirm_recurring_application_charge?signature=BAh7BzoHaWRpBENfKRs6EmF1dG9fYWN0aXZhdGVU--b5f90d04779cc5242b396e4054f2e650c5dace1c"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/recurring_application_charges/455696195.json",
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
                "https://test-shop.myshopify.io/admin/api/2022-07/recurring_application_charges/455696195.json",
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
                  ["recurring_application_charge" => ["return_url" => "http://yourapp.example.org/", "id" => 455696195, "name" => "Super Mega Plan", "api_client_id" => 755357713, "price" => "15.00", "status" => "active", "billing_on" => null, "created_at" => "2022-07-02T01:30:21-04:00", "updated_at" => "2022-07-02T01:31:36-04:00", "test" => null, "activated_on" => "2022-07-02", "cancelled_on" => null, "trial_days" => 0, "capped_amount" => "100.00", "trial_ends_on" => "2022-07-02", "balance_used" => 0.0, "balance_remaining" => 100.0, "risk_level" => 0, "decorated_return_url" => "http://yourapp.example.org/?charge_id=455696195", "update_capped_amount_url" => "https://jsmith.myshopify.com/admin/charges/755357713/455696195/RecurringApplicationCharge/confirm_update_capped_amount?signature=BAh7BzoHaWRpBENfKRs6EmF1dG9fYWN0aXZhdGVG--4b6fd05be3f627f6f268925abd0dfba8a0ca7aad"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-07/recurring_application_charges/455696195/customize.json?recurring_application_charge%5Bcapped_amount%5D=200",
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
