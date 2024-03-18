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
                  ["recurring_application_charge" => ["id" => 1029266954, "name" => "Super Duper Plan", "price" => "10.00", "billing_on" => null, "status" => "pending", "created_at" => "2023-07-11T18:01:01-04:00", "updated_at" => "2023-07-11T18:01:01-04:00", "activated_on" => null, "return_url" => "http://super-duper.shopifyapps.com/", "test" => null, "cancelled_on" => null, "trial_days" => 5, "trial_ends_on" => null, "api_client_id" => 755357713, "decorated_return_url" => "http://super-duper.shopifyapps.com/?charge_id=1029266954", "confirmation_url" => "https://jsmith.myshopify.com/admin/charges/755357713/1029266954/RecurringApplicationCharge/confirm_recurring_application_charge?signature=BAh7BzoHaWRpBApeWT06EmF1dG9fYWN0aXZhdGVU--59cfa71df340801b40dd0ff290cfc00ea9f411e4", "currency" => "USD"]]
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
                  ["recurring_application_charge" => ["id" => 1029266951, "name" => "Super Duper Plan", "price" => "10.00", "billing_on" => null, "status" => "pending", "created_at" => "2023-07-11T18:00:48-04:00", "updated_at" => "2023-07-11T18:00:48-04:00", "activated_on" => null, "return_url" => "http://super-duper.shopifyapps.com/", "test" => null, "cancelled_on" => null, "trial_days" => 0, "trial_ends_on" => null, "api_client_id" => 755357713, "decorated_return_url" => "http://super-duper.shopifyapps.com/?charge_id=1029266951", "capped_amount" => "100.00", "balance_used" => 0.0, "balance_remaining" => 100.0, "risk_level" => 0, "confirmation_url" => "https://jsmith.myshopify.com/admin/charges/755357713/1029266951/RecurringApplicationCharge/confirm_recurring_application_charge?signature=BAh7BzoHaWRpBAdeWT06EmF1dG9fYWN0aXZhdGVU--9914ef8ed4fd08ad7566537380b04eb2a5a51b19", "currency" => "USD"]]
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
                  ["recurring_application_charge" => ["id" => 1029266950, "name" => "Super Duper Plan", "price" => "10.00", "billing_on" => null, "status" => "pending", "created_at" => "2023-07-11T18:00:37-04:00", "updated_at" => "2023-07-11T18:00:37-04:00", "activated_on" => null, "return_url" => "http://super-duper.shopifyapps.com/", "test" => null, "cancelled_on" => null, "trial_days" => 0, "trial_ends_on" => null, "api_client_id" => 755357713, "decorated_return_url" => "http://super-duper.shopifyapps.com/?charge_id=1029266950", "confirmation_url" => "https://jsmith.myshopify.com/admin/charges/755357713/1029266950/RecurringApplicationCharge/confirm_recurring_application_charge?signature=BAh7BzoHaWRpBAZeWT06EmF1dG9fYWN0aXZhdGVU--1efa5fdbf4ba6a4100453cb131088b78217041ce", "currency" => "USD"]]
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
                  ["recurring_application_charge" => ["id" => 1029266952, "name" => "Super Duper Plan", "price" => "10.00", "billing_on" => null, "status" => "pending", "created_at" => "2023-07-11T18:00:50-04:00", "updated_at" => "2023-07-11T18:00:50-04:00", "activated_on" => null, "return_url" => "http://super-duper.shopifyapps.com/", "test" => true, "cancelled_on" => null, "trial_days" => 0, "trial_ends_on" => null, "api_client_id" => 755357713, "decorated_return_url" => "http://super-duper.shopifyapps.com/?charge_id=1029266952", "confirmation_url" => "https://jsmith.myshopify.com/admin/charges/755357713/1029266952/RecurringApplicationCharge/confirm_recurring_application_charge?signature=BAh7BzoHaWRpBAheWT06EmF1dG9fYWN0aXZhdGVU--e714dccd65e72276ef8a4277ddf715ef320d9a6e", "currency" => "USD"]]
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
                  ["recurring_application_charges" => [["id" => 455696195, "name" => "Super Mega Plan", "price" => "15.00", "billing_on" => "2023-07-11", "status" => "accepted", "created_at" => "2023-07-11T17:47:36-04:00", "updated_at" => "2023-07-11T18:00:52-04:00", "activated_on" => null, "return_url" => "http://yourapp.example.org", "test" => null, "cancelled_on" => null, "trial_days" => 0, "trial_ends_on" => null, "api_client_id" => 755357713, "decorated_return_url" => "http://yourapp.example.org?charge_id=455696195", "currency" => "USD"]]]
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
                  ["recurring_application_charges" => [["id" => 1029266953, "name" => "Super Duper Plan", "price" => "10.00", "billing_on" => null, "status" => "pending", "created_at" => "2023-07-11T18:00:51-04:00", "updated_at" => "2023-07-11T18:00:51-04:00", "activated_on" => null, "return_url" => "http://super-duper.shopifyapps.com/", "test" => null, "cancelled_on" => null, "trial_days" => 0, "trial_ends_on" => null, "api_client_id" => 755357713, "decorated_return_url" => "http://super-duper.shopifyapps.com/?charge_id=1029266953", "confirmation_url" => "https://jsmith.myshopify.com/admin/charges/755357713/1029266953/RecurringApplicationCharge/confirm_recurring_application_charge?signature=BAh7BzoHaWRpBAleWT06EmF1dG9fYWN0aXZhdGVU--a179b77d136bbff5ad67bc98351443684cb993e3", "currency" => "USD"]]]
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
                  ["recurring_application_charge" => ["id" => 455696195, "name" => "Super Mega Plan", "price" => "15.00", "billing_on" => "2023-07-11", "status" => "pending", "created_at" => "2023-07-11T17:47:36-04:00", "updated_at" => "2023-07-11T17:47:36-04:00", "activated_on" => null, "return_url" => "http://yourapp.example.org", "test" => null, "cancelled_on" => null, "trial_days" => 0, "trial_ends_on" => null, "api_client_id" => 755357713, "decorated_return_url" => "http://yourapp.example.org?charge_id=455696195", "confirmation_url" => "https://jsmith.myshopify.com/admin/charges/755357713/455696195/RecurringApplicationCharge/confirm_recurring_application_charge?signature=BAh7BzoHaWRpBENfKRs6EmF1dG9fYWN0aXZhdGVU--b5f90d04779cc5242b396e4054f2e650c5dace1c", "currency" => "USD"]]
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
                  ["recurring_application_charge" => ["id" => 455696195, "name" => "Super Mega Plan", "price" => "15.00", "billing_on" => null, "status" => "active", "created_at" => "2023-07-11T17:47:36-04:00", "updated_at" => "2023-07-11T18:00:41-04:00", "activated_on" => "2023-07-11", "return_url" => "http://yourapp.example.org", "test" => null, "cancelled_on" => null, "trial_days" => 0, "trial_ends_on" => "2023-07-11", "api_client_id" => 755357713, "decorated_return_url" => "http://yourapp.example.org?charge_id=455696195", "capped_amount" => "100.00", "balance_used" => 0.0, "balance_remaining" => 100.0, "risk_level" => 0, "update_capped_amount_url" => "https://jsmith.myshopify.com/admin/charges/755357713/455696195/RecurringApplicationCharge/confirm_update_capped_amount?signature=BAh7BzoHaWRpBENfKRs6EmF1dG9fYWN0aXZhdGVG--89f824797067689501d07d8fdcb351dc71cc4ed0", "currency" => "USD"]]
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
