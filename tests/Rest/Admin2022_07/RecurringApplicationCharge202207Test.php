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
                  ["recurring_application_charge" => ["id" => 1029266949, "name" => "Super Duper Plan", "api_client_id" => 755357713, "price" => "10.00", "status" => "pending", "return_url" => "http://super-duper.shopifyapps.com/", "billing_on" => null, "created_at" => "2023-01-03T13:06:35-05:00", "updated_at" => "2023-01-03T13:06:35-05:00", "test" => null, "activated_on" => null, "cancelled_on" => null, "trial_days" => 5, "trial_ends_on" => null, "decorated_return_url" => "http://super-duper.shopifyapps.com/?charge_id=1029266949", "confirmation_url" => "https://jsmith.myshopify.com/admin/charges/755357713/1029266949/RecurringApplicationCharge/confirm_recurring_application_charge?signature=BAh7BzoHaWRpBAVeWT06EmF1dG9fYWN0aXZhdGVU--9b5c79476bf6e10095d51a27255892c04e5dd4fa"]]
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
    public function test_2(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["recurring_application_charge" => ["id" => 1029266951, "name" => "Super Duper Plan", "api_client_id" => 755357713, "price" => "10.00", "status" => "pending", "return_url" => "http://super-duper.shopifyapps.com/", "billing_on" => null, "created_at" => "2023-01-03T13:06:39-05:00", "updated_at" => "2023-01-03T13:06:39-05:00", "test" => null, "activated_on" => null, "cancelled_on" => null, "trial_days" => 0, "capped_amount" => "100.00", "trial_ends_on" => null, "balance_used" => 0.0, "balance_remaining" => 100.0, "risk_level" => 0, "decorated_return_url" => "http://super-duper.shopifyapps.com/?charge_id=1029266951", "confirmation_url" => "https://jsmith.myshopify.com/admin/charges/755357713/1029266951/RecurringApplicationCharge/confirm_recurring_application_charge?signature=BAh7BzoHaWRpBAdeWT06EmF1dG9fYWN0aXZhdGVU--4e07fb141094c2ffacfcff713a2dc85eab38a229"]]
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
    public function test_3(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["recurring_application_charge" => ["id" => 1029266952, "name" => "Super Duper Plan", "api_client_id" => 755357713, "price" => "10.00", "status" => "pending", "return_url" => "http://super-duper.shopifyapps.com/", "billing_on" => null, "created_at" => "2023-01-03T13:06:41-05:00", "updated_at" => "2023-01-03T13:06:41-05:00", "test" => null, "activated_on" => null, "cancelled_on" => null, "trial_days" => 0, "trial_ends_on" => null, "decorated_return_url" => "http://super-duper.shopifyapps.com/?charge_id=1029266952", "confirmation_url" => "https://jsmith.myshopify.com/admin/charges/755357713/1029266952/RecurringApplicationCharge/confirm_recurring_application_charge?signature=BAh7BzoHaWRpBAheWT06EmF1dG9fYWN0aXZhdGVU--c278a9ebe0e4885c8b9df2be46598c9b9abf0731"]]
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
    public function test_4(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["recurring_application_charge" => ["id" => 1029266954, "name" => "Super Duper Plan", "api_client_id" => 755357713, "price" => "10.00", "status" => "pending", "return_url" => "http://super-duper.shopifyapps.com/", "billing_on" => null, "created_at" => "2023-01-03T13:06:51-05:00", "updated_at" => "2023-01-03T13:06:51-05:00", "test" => true, "activated_on" => null, "cancelled_on" => null, "trial_days" => 0, "trial_ends_on" => null, "decorated_return_url" => "http://super-duper.shopifyapps.com/?charge_id=1029266954", "confirmation_url" => "https://jsmith.myshopify.com/admin/charges/755357713/1029266954/RecurringApplicationCharge/confirm_recurring_application_charge?signature=BAh7BzoHaWRpBApeWT06EmF1dG9fYWN0aXZhdGVU--f0a955813cb17f90e052cdbc976832ce6f213068"]]
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
    public function test_5(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(
                  ["recurring_application_charges" => [["id" => 455696195, "name" => "Super Mega Plan", "api_client_id" => 755357713, "price" => "15.00", "status" => "accepted", "return_url" => "http://yourapp.example.org", "billing_on" => "2023-01-03", "created_at" => "2023-01-03T12:56:35-05:00", "updated_at" => "2023-01-03T13:06:22-05:00", "test" => null, "activated_on" => null, "cancelled_on" => null, "trial_days" => 0, "trial_ends_on" => null, "decorated_return_url" => "http://yourapp.example.org?charge_id=455696195"]]]
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
                  ["recurring_application_charges" => [["id" => 1029266947, "name" => "Super Duper Plan", "api_client_id" => 755357713, "price" => "10.00", "status" => "pending", "return_url" => "http://super-duper.shopifyapps.com/", "billing_on" => null, "created_at" => "2023-01-03T13:06:21-05:00", "updated_at" => "2023-01-03T13:06:21-05:00", "test" => null, "activated_on" => null, "cancelled_on" => null, "trial_days" => 0, "trial_ends_on" => null, "decorated_return_url" => "http://super-duper.shopifyapps.com/?charge_id=1029266947", "confirmation_url" => "https://jsmith.myshopify.com/admin/charges/755357713/1029266947/RecurringApplicationCharge/confirm_recurring_application_charge?signature=BAh7BzoHaWRpBANeWT06EmF1dG9fYWN0aXZhdGVU--4e6554253be678506a3421452fb801fd291e6db7"]]]
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
                  ["recurring_application_charge" => ["id" => 455696195, "name" => "Super Mega Plan", "api_client_id" => 755357713, "price" => "15.00", "status" => "pending", "return_url" => "http://yourapp.example.org", "billing_on" => "2023-01-03", "created_at" => "2023-01-03T12:56:35-05:00", "updated_at" => "2023-01-03T12:56:35-05:00", "test" => null, "activated_on" => null, "cancelled_on" => null, "trial_days" => 0, "trial_ends_on" => null, "decorated_return_url" => "http://yourapp.example.org?charge_id=455696195", "confirmation_url" => "https://jsmith.myshopify.com/admin/charges/755357713/455696195/RecurringApplicationCharge/confirm_recurring_application_charge?signature=BAh7BzoHaWRpBENfKRs6EmF1dG9fYWN0aXZhdGVU--b5f90d04779cc5242b396e4054f2e650c5dace1c"]]
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
                  ["recurring_application_charge" => ["return_url" => "http://yourapp.example.org/", "id" => 455696195, "name" => "Super Mega Plan", "api_client_id" => 755357713, "price" => "15.00", "status" => "active", "billing_on" => null, "created_at" => "2023-01-03T12:56:35-05:00", "updated_at" => "2023-01-03T13:06:19-05:00", "test" => null, "activated_on" => "2023-01-03", "cancelled_on" => null, "trial_days" => 0, "capped_amount" => "100.00", "trial_ends_on" => "2023-01-03", "balance_used" => 0.0, "balance_remaining" => 100.0, "risk_level" => 0, "decorated_return_url" => "http://yourapp.example.org/?charge_id=455696195", "update_capped_amount_url" => "https://jsmith.myshopify.com/admin/charges/755357713/455696195/RecurringApplicationCharge/confirm_update_capped_amount?signature=BAh7BzoHaWRpBENfKRs6EmF1dG9fYWN0aXZhdGVG--c9d104c0a19c52b84fa17360f32abc13aae86935"]]
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
