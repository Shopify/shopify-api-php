<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Admin2022_04\RecurringApplicationCharge;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class RecurringApplicationCharge202204Test extends BaseTestCase
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
                  ["recurring_application_charge" => ["id" => 1029266966, "name" => "Super Duper Plan", "price" => "10.00", "billing_on" => null, "status" => "pending", "created_at" => "2023-06-14T14:50:20-04:00", "updated_at" => "2023-06-14T14:50:20-04:00", "activated_on" => null, "return_url" => "http://super-duper.shopifyapps.com/", "test" => null, "cancelled_on" => null, "trial_days" => 5, "trial_ends_on" => null, "api_client_id" => 755357713, "decorated_return_url" => "http://super-duper.shopifyapps.com/?charge_id=1029266966", "confirmation_url" => "https://jsmith.myshopify.com/admin/charges/755357713/1029266966/RecurringApplicationCharge/confirm_recurring_application_charge?signature=BAh7BzoHaWRpBBZeWT06EmF1dG9fYWN0aXZhdGVU--a2c5ad38aeda769a5cb80dccb27399d4c24d2e2e", "currency" => "USD"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/recurring_application_charges.json",
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
                  ["recurring_application_charge" => ["id" => 1029266964, "name" => "Super Duper Plan", "price" => "10.00", "billing_on" => null, "status" => "pending", "created_at" => "2023-06-14T14:50:16-04:00", "updated_at" => "2023-06-14T14:50:16-04:00", "activated_on" => null, "return_url" => "http://super-duper.shopifyapps.com/", "test" => null, "cancelled_on" => null, "trial_days" => 0, "trial_ends_on" => null, "api_client_id" => 755357713, "decorated_return_url" => "http://super-duper.shopifyapps.com/?charge_id=1029266964", "capped_amount" => "100.00", "balance_used" => 0.0, "balance_remaining" => 100.0, "risk_level" => 0, "confirmation_url" => "https://jsmith.myshopify.com/admin/charges/755357713/1029266964/RecurringApplicationCharge/confirm_recurring_application_charge?signature=BAh7BzoHaWRpBBReWT06EmF1dG9fYWN0aXZhdGVU--7239a27757dbe011a007c3d2c36787b51c24af6c", "currency" => "USD"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/recurring_application_charges.json",
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
                  ["recurring_application_charge" => ["id" => 1029266967, "name" => "Super Duper Plan", "price" => "10.00", "billing_on" => null, "status" => "pending", "created_at" => "2023-06-14T14:50:28-04:00", "updated_at" => "2023-06-14T14:50:28-04:00", "activated_on" => null, "return_url" => "http://super-duper.shopifyapps.com/", "test" => null, "cancelled_on" => null, "trial_days" => 0, "trial_ends_on" => null, "api_client_id" => 755357713, "decorated_return_url" => "http://super-duper.shopifyapps.com/?charge_id=1029266967", "confirmation_url" => "https://jsmith.myshopify.com/admin/charges/755357713/1029266967/RecurringApplicationCharge/confirm_recurring_application_charge?signature=BAh7BzoHaWRpBBdeWT06EmF1dG9fYWN0aXZhdGVU--295989c40261e70fe85c382e864fb43b0829dc4b", "currency" => "USD"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/recurring_application_charges.json",
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
                  ["recurring_application_charge" => ["id" => 1029266962, "name" => "Super Duper Plan", "price" => "10.00", "billing_on" => null, "status" => "pending", "created_at" => "2023-06-14T14:50:04-04:00", "updated_at" => "2023-06-14T14:50:04-04:00", "activated_on" => null, "return_url" => "http://super-duper.shopifyapps.com/", "test" => true, "cancelled_on" => null, "trial_days" => 0, "trial_ends_on" => null, "api_client_id" => 755357713, "decorated_return_url" => "http://super-duper.shopifyapps.com/?charge_id=1029266962", "confirmation_url" => "https://jsmith.myshopify.com/admin/charges/755357713/1029266962/RecurringApplicationCharge/confirm_recurring_application_charge?signature=BAh7BzoHaWRpBBJeWT06EmF1dG9fYWN0aXZhdGVU--29a492d97c529d36a1df77526836d8a253060c34", "currency" => "USD"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/recurring_application_charges.json",
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
                  ["recurring_application_charges" => [["id" => 455696195, "name" => "Super Mega Plan", "price" => "15.00", "billing_on" => "2023-06-14", "status" => "accepted", "created_at" => "2023-06-14T14:27:29-04:00", "updated_at" => "2023-06-14T14:50:05-04:00", "activated_on" => null, "return_url" => "http://yourapp.example.org", "test" => null, "cancelled_on" => null, "trial_days" => 0, "trial_ends_on" => null, "api_client_id" => 755357713, "decorated_return_url" => "http://yourapp.example.org?charge_id=455696195", "currency" => "USD"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/recurring_application_charges.json",
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
                  ["recurring_application_charges" => [["id" => 1029266965, "name" => "Super Duper Plan", "price" => "10.00", "billing_on" => null, "status" => "pending", "created_at" => "2023-06-14T14:50:18-04:00", "updated_at" => "2023-06-14T14:50:18-04:00", "activated_on" => null, "return_url" => "http://super-duper.shopifyapps.com/", "test" => null, "cancelled_on" => null, "trial_days" => 0, "trial_ends_on" => null, "api_client_id" => 755357713, "decorated_return_url" => "http://super-duper.shopifyapps.com/?charge_id=1029266965", "confirmation_url" => "https://jsmith.myshopify.com/admin/charges/755357713/1029266965/RecurringApplicationCharge/confirm_recurring_application_charge?signature=BAh7BzoHaWRpBBVeWT06EmF1dG9fYWN0aXZhdGVU--41d682c525b812740be789eb48651fbe5e931d85", "currency" => "USD"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/recurring_application_charges.json?since_id=455696195",
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
                  ["recurring_application_charge" => ["id" => 455696195, "name" => "Super Mega Plan", "price" => "15.00", "billing_on" => "2023-06-14", "status" => "pending", "created_at" => "2023-06-14T14:27:29-04:00", "updated_at" => "2023-06-14T14:27:29-04:00", "activated_on" => null, "return_url" => "http://yourapp.example.org", "test" => null, "cancelled_on" => null, "trial_days" => 0, "trial_ends_on" => null, "api_client_id" => 755357713, "decorated_return_url" => "http://yourapp.example.org?charge_id=455696195", "confirmation_url" => "https://jsmith.myshopify.com/admin/charges/755357713/455696195/RecurringApplicationCharge/confirm_recurring_application_charge?signature=BAh7BzoHaWRpBENfKRs6EmF1dG9fYWN0aXZhdGVU--b5f90d04779cc5242b396e4054f2e650c5dace1c", "currency" => "USD"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/recurring_application_charges/455696195.json",
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
                "https://test-shop.myshopify.io/admin/api/2022-04/recurring_application_charges/455696195.json",
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
                  ["recurring_application_charge" => ["id" => 455696195, "name" => "Super Mega Plan", "price" => "15.00", "billing_on" => null, "status" => "active", "created_at" => "2023-06-14T14:27:29-04:00", "updated_at" => "2023-06-14T14:50:26-04:00", "activated_on" => "2023-06-14", "return_url" => "http://yourapp.example.org", "test" => null, "cancelled_on" => null, "trial_days" => 0, "trial_ends_on" => "2023-06-14", "api_client_id" => 755357713, "decorated_return_url" => "http://yourapp.example.org?charge_id=455696195", "capped_amount" => "100.00", "balance_used" => 0.0, "balance_remaining" => 100.0, "risk_level" => 0, "update_capped_amount_url" => "https://jsmith.myshopify.com/admin/charges/755357713/455696195/RecurringApplicationCharge/confirm_update_capped_amount?signature=BAh7BzoHaWRpBENfKRs6EmF1dG9fYWN0aXZhdGVG--105a128dbc51cc968cf86e1fec02ca319cd6b3cb", "currency" => "USD"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/recurring_application_charges/455696195/customize.json?recurring_application_charge%5Bcapped_amount%5D=200",
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
