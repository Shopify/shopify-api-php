<?php

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Customer;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class Customer202110Test extends BaseTestCase
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
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-10/customers.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Customer::all(
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
                "https://test-shop.myshopify.io/admin/api/2021-10/customers.json?since_id=207119551",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Customer::all(
            $this->test_session,
            [],
            ["since_id" => "207119551"],
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
                "https://test-shop.myshopify.io/admin/api/2021-10/customers.json?updated_at_min=2022-02-02+21%3A51%3A21",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Customer::all(
            $this->test_session,
            [],
            ["updated_at_min" => "2022-02-02 21:51:21"],
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
                "https://test-shop.myshopify.io/admin/api/2021-10/customers.json?ids=207119551%2C1073339489",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Customer::all(
            $this->test_session,
            [],
            ["ids" => "207119551,1073339489"],
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
                "https://test-shop.myshopify.io/admin/api/2021-10/customers.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["customer" => ["first_name" => "Steve", "last_name" => "Lastnameson", "email" => "steve.lastnameson@example.com", "phone" => " 15142546011", "verified_email" => true, "addresses" => [["address1" => "123 Oak St", "city" => "Ottawa", "province" => "ON", "phone" => "555-1212", "zip" => "123 ABC", "last_name" => "Lastnameson", "first_name" => "Mother", "country" => "CA"]], "password" => "newpass", "password_confirmation" => "newpass", "send_email_welcome" => false]]),
            ),
        ]);

        $customer = new Customer($this->test_session);
        $customer->first_name = "Steve";
        $customer->last_name = "Lastnameson";
        $customer->email = "steve.lastnameson@example.com";
        $customer->phone = " 15142546011";
        $customer->verified_email = true;
        $customer->addresses = [
            [
                "address1" => "123 Oak St",
                "city" => "Ottawa",
                "province" => "ON",
                "phone" => "555-1212",
                "zip" => "123 ABC",
                "last_name" => "Lastnameson",
                "first_name" => "Mother",
                "country" => "CA"
            ]
        ];
        $customer->password = "newpass";
        $customer->password_confirmation = "newpass";
        $customer->send_email_welcome = false;
        $customer->save();
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
                "https://test-shop.myshopify.io/admin/api/2021-10/customers.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["customer" => ["first_name" => "Steve", "last_name" => "Lastnameson", "email" => "steve.lastnameson@example.com", "phone" => " 15142546011", "verified_email" => true, "addresses" => [["address1" => "123 Oak St", "city" => "Ottawa", "province" => "ON", "phone" => "555-1212", "zip" => "123 ABC", "last_name" => "Lastnameson", "first_name" => "Mother", "country" => "CA"]]]]),
            ),
        ]);

        $customer = new Customer($this->test_session);
        $customer->first_name = "Steve";
        $customer->last_name = "Lastnameson";
        $customer->email = "steve.lastnameson@example.com";
        $customer->phone = " 15142546011";
        $customer->verified_email = true;
        $customer->addresses = [
            [
                "address1" => "123 Oak St",
                "city" => "Ottawa",
                "province" => "ON",
                "phone" => "555-1212",
                "zip" => "123 ABC",
                "last_name" => "Lastnameson",
                "first_name" => "Mother",
                "country" => "CA"
            ]
        ];
        $customer->save();
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
                "https://test-shop.myshopify.io/admin/api/2021-10/customers.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["customer" => ["first_name" => "Steve", "last_name" => "Lastnameson", "email" => "steve.lastnameson@example.com", "phone" => " 15142546011", "verified_email" => true, "addresses" => [["address1" => "123 Oak St", "city" => "Ottawa", "province" => "ON", "phone" => "555-1212", "zip" => "123 ABC", "last_name" => "Lastnameson", "first_name" => "Mother", "country" => "CA"]], "metafields" => [["key" => "new", "value" => "newvalue", "value_type" => "string", "namespace" => "global"]]]]),
            ),
        ]);

        $customer = new Customer($this->test_session);
        $customer->first_name = "Steve";
        $customer->last_name = "Lastnameson";
        $customer->email = "steve.lastnameson@example.com";
        $customer->phone = " 15142546011";
        $customer->verified_email = true;
        $customer->addresses = [
            [
                "address1" => "123 Oak St",
                "city" => "Ottawa",
                "province" => "ON",
                "phone" => "555-1212",
                "zip" => "123 ABC",
                "last_name" => "Lastnameson",
                "first_name" => "Mother",
                "country" => "CA"
            ]
        ];
        $customer->metafields = [
            [
                "key" => "new",
                "value" => "newvalue",
                "value_type" => "string",
                "namespace" => "global"
            ]
        ];
        $customer->save();
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
                "https://test-shop.myshopify.io/admin/api/2021-10/customers.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["customer" => ["first_name" => "Steve", "last_name" => "Lastnameson", "email" => "steve.lastnameson@example.com", "phone" => " 15142546011", "verified_email" => true, "addresses" => [["address1" => "123 Oak St", "city" => "Ottawa", "province" => "ON", "phone" => "555-1212", "zip" => "123 ABC", "last_name" => "Lastnameson", "first_name" => "Mother", "country" => "CA"]], "send_email_invite" => true]]),
            ),
        ]);

        $customer = new Customer($this->test_session);
        $customer->first_name = "Steve";
        $customer->last_name = "Lastnameson";
        $customer->email = "steve.lastnameson@example.com";
        $customer->phone = " 15142546011";
        $customer->verified_email = true;
        $customer->addresses = [
            [
                "address1" => "123 Oak St",
                "city" => "Ottawa",
                "province" => "ON",
                "phone" => "555-1212",
                "zip" => "123 ABC",
                "last_name" => "Lastnameson",
                "first_name" => "Mother",
                "country" => "CA"
            ]
        ];
        $customer->send_email_invite = true;
        $customer->save();
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
                "https://test-shop.myshopify.io/admin/api/2021-10/customers/search.json?query=Bob+country%3AUnited+States",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Customer::search(
            $this->test_session,
            [],
            ["query" => "Bob country:United States"],
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
                "https://test-shop.myshopify.io/admin/api/2021-10/customers/207119551.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Customer::find(
            $this->test_session,
            207119551,
            [],
            [],
        );
    }

    /**

     *
     * @return void
     */
    public function test_11(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-10/customers/207119551.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["customer" => ["id" => 207119551, "email" => "changed@email.address.com", "note" => "Customer is a great guy"]]),
            ),
        ]);

        $customer = new Customer($this->test_session);
        $customer->id = 207119551;
        $customer->email = "changed@email.address.com";
        $customer->note = "Customer is a great guy";
        $customer->save();
    }

    /**

     *
     * @return void
     */
    public function test_12(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-10/customers/207119551.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["customer" => ["id" => 207119551, "metafields" => [["key" => "new", "value" => "newvalue", "value_type" => "string", "namespace" => "global"]]]]),
            ),
        ]);

        $customer = new Customer($this->test_session);
        $customer->id = 207119551;
        $customer->metafields = [
            [
                "key" => "new",
                "value" => "newvalue",
                "value_type" => "string",
                "namespace" => "global"
            ]
        ];
        $customer->save();
    }

    /**

     *
     * @return void
     */
    public function test_13(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-10/customers/207119551.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["customer" => ["id" => 207119551, "tags" => "New Customer, Repeat Customer"]]),
            ),
        ]);

        $customer = new Customer($this->test_session);
        $customer->id = 207119551;
        $customer->tags = "New Customer, Repeat Customer";
        $customer->save();
    }

    /**

     *
     * @return void
     */
    public function test_14(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-10/customers/207119551.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["customer" => ["id" => 207119551, "accepts_marketing" => true, "accepts_marketing_updated_at" => "2022-01-31T16:45:55-05:00", "marketing_opt_in_level" => "confirmed_opt_in"]]),
            ),
        ]);

        $customer = new Customer($this->test_session);
        $customer->id = 207119551;
        $customer->accepts_marketing = true;
        $customer->accepts_marketing_updated_at = "2022-01-31T16:45:55-05:00";
        $customer->marketing_opt_in_level = "confirmed_opt_in";
        $customer->save();
    }

    /**

     *
     * @return void
     */
    public function test_15(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-10/customers/207119551/account_activation_url.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        $customer = new Customer($this->test_session);
        $customer->id = 207119551;
        $customer->account_activation_url(
            [],
        );
    }

    /**

     *
     * @return void
     */
    public function test_16(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-10/customers/207119551/send_invite.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["customer_invite" => []]),
            ),
        ]);

        $customer = new Customer($this->test_session);
        $customer->id = 207119551;
        $customer->send_invite(
            [],
            ["customer_invite" => []],
        );
    }

    /**

     *
     * @return void
     */
    public function test_17(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-10/customers/207119551/send_invite.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["customer_invite" => ["to" => "new_test_email@shopify.com", "from" => "j.limited@example.com", "bcc" => ["j.limited@example.com"], "subject" => "Welcome to my new shop", "custom_message" => "My awesome new store"]]),
            ),
        ]);

        $customer = new Customer($this->test_session);
        $customer->id = 207119551;
        $customer->send_invite(
            [],
            ["customer_invite" => ["to" => "new_test_email@shopify.com", "from" => "j.limited@example.com", "bcc" => ["j.limited@example.com"], "subject" => "Welcome to my new shop", "custom_message" => "My awesome new store"]],
        );
    }

    /**

     *
     * @return void
     */
    public function test_18(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-10/customers/count.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Customer::count(
            $this->test_session,
            [],
            [],
        );
    }

    /**

     *
     * @return void
     */
    public function test_19(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-10/customers/207119551/orders.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Customer::orders(
            $this->test_session,
            207119551,
            [],
            [],
        );
    }

}
