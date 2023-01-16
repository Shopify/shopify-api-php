<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Admin2022_10\CustomerAddress;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class CustomerAddress202210Test extends BaseTestCase
{
    /** @var Session */
    private $test_session;

    public function setUp(): void
    {
        parent::setUp();

        Context::$API_VERSION = "2022-10";

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
                  ["addresses" => [["id" => 207119551, "customer_id" => 207119551, "first_name" => null, "last_name" => null, "company" => null, "address1" => "Chestnut Street 92", "address2" => "", "city" => "Louisville", "province" => "Kentucky", "country" => "United States", "zip" => "40202", "phone" => "555-625-1199", "name" => "", "province_code" => "KY", "country_code" => "US", "country_name" => "United States", "default" => true]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-10/customers/207119551/addresses.json?limit=1",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        CustomerAddress::all(
            $this->test_session,
            ["customer_id" => "207119551"],
            ["limit" => "1"],
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
                  ["addresses" => [["id" => 207119551, "customer_id" => 207119551, "first_name" => null, "last_name" => null, "company" => null, "address1" => "Chestnut Street 92", "address2" => "", "city" => "Louisville", "province" => "Kentucky", "country" => "United States", "zip" => "40202", "phone" => "555-625-1199", "name" => "", "province_code" => "KY", "country_code" => "US", "country_name" => "United States", "default" => true]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-10/customers/207119551/addresses.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        CustomerAddress::all(
            $this->test_session,
            ["customer_id" => "207119551"],
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
                  ["customer_address" => ["id" => 207119551, "customer_id" => 207119551, "first_name" => null, "last_name" => null, "company" => null, "address1" => "Chestnut Street 92", "address2" => "", "city" => "Louisville", "province" => "Kentucky", "country" => "United States", "zip" => "40202", "phone" => "555-625-1199", "name" => "", "province_code" => "KY", "country_code" => "US", "country_name" => "United States", "default" => true]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-10/customers/207119551/addresses/207119551.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        CustomerAddress::find(
            $this->test_session,
            207119551,
            ["customer_id" => "207119551"],
            [],
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
                  ["customer_address" => ["customer_id" => 207119551, "zip" => "90210", "country" => "United States", "province" => "Kentucky", "city" => "Louisville", "address1" => "Chestnut Street 92", "address2" => "", "first_name" => null, "last_name" => null, "company" => null, "phone" => "555-625-1199", "id" => 207119551, "name" => "", "province_code" => "KY", "country_code" => "US", "country_name" => "United States", "default" => true]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-10/customers/207119551/addresses/207119551.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["address" => ["zip" => "90210"]]),
            ),
        ]);

        $customer_address = new CustomerAddress($this->test_session);
        $customer_address->customer_id = 207119551;
        $customer_address->id = 207119551;
        $customer_address->zip = "90210";
        $customer_address->save();
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
                  ["customer_address" => ["customer_id" => 207119551, "address1" => "Apartment 23", "address2" => "Chestnut Street 92", "country" => "United States", "province" => "Kentucky", "zip" => "40202", "city" => "Louisville", "first_name" => null, "last_name" => null, "company" => null, "phone" => "555-625-1199", "id" => 207119551, "name" => "", "province_code" => "KY", "country_code" => "US", "country_name" => "United States", "default" => true]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-10/customers/207119551/addresses/207119551.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["address" => ["address1" => "Apartment 23", "address2" => "Chestnut Street 92"]]),
            ),
        ]);

        $customer_address = new CustomerAddress($this->test_session);
        $customer_address->customer_id = 207119551;
        $customer_address->id = 207119551;
        $customer_address->address1 = "Apartment 23";
        $customer_address->address2 = "Chestnut Street 92";
        $customer_address->save();
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
                  []
                )),
                "https://test-shop.myshopify.io/admin/api/2022-10/customers/207119551/addresses/1053317306.json",
                "DELETE",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        CustomerAddress::delete(
            $this->test_session,
            1053317306,
            ["customer_id" => "207119551"],
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
                  ["customer_address" => ["id" => 1053317303, "customer_id" => 207119551, "first_name" => "Samuel", "last_name" => "de Champlain", "company" => "Fancy Co.", "address1" => "1 Rue des Carrieres", "address2" => "Suite 1234", "city" => "Montreal", "province" => "Quebec", "country" => "Canada", "zip" => "G1R 4P5", "phone" => "819-555-5555", "name" => "Samuel de Champlain", "province_code" => "QC", "country_code" => "CA", "country_name" => "Canada", "default" => false]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-10/customers/207119551/addresses.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["address" => ["address1" => "1 Rue des Carrieres", "address2" => "Suite 1234", "city" => "Montreal", "company" => "Fancy Co.", "first_name" => "Samuel", "last_name" => "de Champlain", "phone" => "819-555-5555", "province" => "Quebec", "country" => "Canada", "zip" => "G1R 4P5", "name" => "Samuel de Champlain", "province_code" => "QC", "country_code" => "CA", "country_name" => "Canada"]]),
            ),
        ]);

        $customer_address = new CustomerAddress($this->test_session);
        $customer_address->customer_id = 207119551;
        $customer_address->address1 = "1 Rue des Carrieres";
        $customer_address->address2 = "Suite 1234";
        $customer_address->city = "Montreal";
        $customer_address->company = "Fancy Co.";
        $customer_address->first_name = "Samuel";
        $customer_address->last_name = "de Champlain";
        $customer_address->phone = "819-555-5555";
        $customer_address->province = "Quebec";
        $customer_address->country = "Canada";
        $customer_address->zip = "G1R 4P5";
        $customer_address->name = "Samuel de Champlain";
        $customer_address->province_code = "QC";
        $customer_address->country_code = "CA";
        $customer_address->country_name = "Canada";
        $customer_address->save();
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
                "https://test-shop.myshopify.io/admin/api/2022-10/customers/207119551/addresses/set.json?address_ids%5B%5D=1053317305&operation=destroy",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        $customer_address = new CustomerAddress($this->test_session);
        $customer_address->customer_id = 207119551;
        $customer_address->set(
            ["address_ids" => ["1053317305"], "operation" => "destroy"],
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
                  ["customer_address" => ["id" => 1053317304, "customer_id" => 207119551, "first_name" => "Bob", "last_name" => "Norman", "company" => null, "address1" => "Chestnut Street 92", "address2" => "", "city" => "Louisville", "province" => "Kentucky", "country" => "United States", "zip" => "40202", "phone" => "555-625-1199", "name" => "Bob Norman", "province_code" => "KY", "country_code" => "US", "country_name" => "United States", "default" => true]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-10/customers/207119551/addresses/1053317304/default.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        $customer_address = new CustomerAddress($this->test_session);
        $customer_address->customer_id = 207119551;
        $customer_address->id = 1053317304;
        $customer_address->default(
            [],
        );
    }

}
