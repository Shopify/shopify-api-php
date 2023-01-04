<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Admin2022_10\Country;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class Country202210Test extends BaseTestCase
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
                  ["countries" => [["id" => 879921427, "name" => "Canada", "code" => "CA", "tax_name" => "GST", "tax" => 0.05, "provinces" => [["id" => 205434194, "country_id" => 879921427, "name" => "Alberta", "code" => "AB", "tax_name" => null, "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.08, "tax_percentage" => 8.0], ["id" => 170405627, "country_id" => 879921427, "name" => "British Columbia", "code" => "BC", "tax_name" => null, "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.07, "tax_percentage" => 7.0], ["id" => 342345110, "country_id" => 879921427, "name" => "Manitoba", "code" => "MB", "tax_name" => null, "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.07, "tax_percentage" => 7.0], ["id" => 92264567, "country_id" => 879921427, "name" => "New Brunswick", "code" => "NB", "tax_name" => null, "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.15, "tax_percentage" => 15.0], ["id" => 243284171, "country_id" => 879921427, "name" => "Newfoundland", "code" => "NL", "tax_name" => null, "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.15, "tax_percentage" => 15.0], ["id" => 439598329, "country_id" => 879921427, "name" => "Northwest Territories", "code" => "NT", "tax_name" => null, "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.0, "tax_percentage" => 0.0], ["id" => 448070559, "country_id" => 879921427, "name" => "Nova Scotia", "code" => "NS", "tax_name" => null, "tax_type" => "harmonized", "shipping_zone_id" => null, "tax" => 0.15, "tax_percentage" => 15.0], ["id" => 670206421, "country_id" => 879921427, "name" => "Nunavut", "code" => "NU", "tax_name" => null, "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.0, "tax_percentage" => 0.0], ["id" => 702530425, "country_id" => 879921427, "name" => "Ontario", "code" => "ON", "tax_name" => null, "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.08, "tax_percentage" => 8.0], ["id" => 570891722, "country_id" => 879921427, "name" => "Prince Edward Island", "code" => "PE", "tax_name" => null, "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.1, "tax_percentage" => 10.0], ["id" => 224293623, "country_id" => 879921427, "name" => "Quebec", "code" => "QC", "tax_name" => "HST", "tax_type" => "compounded", "shipping_zone_id" => null, "tax" => 0.09, "tax_percentage" => 9.0], ["id" => 473391800, "country_id" => 879921427, "name" => "Saskatchewan", "code" => "SK", "tax_name" => null, "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.09, "tax_percentage" => 9.0], ["id" => 1005264686, "country_id" => 879921427, "name" => "Yukon", "code" => "YT", "tax_name" => null, "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.0, "tax_percentage" => 0.0]]], ["id" => 359115488, "name" => "Colombia", "code" => "CO", "tax_name" => "VAT", "tax" => 0.15, "provinces" => []], ["id" => 817138619, "name" => "United States", "code" => "US", "tax_name" => "Federal Tax", "tax" => 0.0, "provinces" => [["id" => 952629862, "country_id" => 817138619, "name" => "California", "code" => "CA", "tax_name" => null, "tax_type" => null, "shipping_zone_id" => 1039932365, "tax" => 0.05, "tax_percentage" => 5.0], ["id" => 222234158, "country_id" => 817138619, "name" => "Kentucky", "code" => "KY", "tax_name" => null, "tax_type" => null, "shipping_zone_id" => 1039932365, "tax" => 0.06, "tax_percentage" => 6.0], ["id" => 9350860, "country_id" => 817138619, "name" => "Massachusetts", "code" => "MA", "tax_name" => null, "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.065, "tax_percentage" => 6.5], ["id" => 696485510, "country_id" => 817138619, "name" => "Minnesota", "code" => "MN", "tax_name" => null, "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.065, "tax_percentage" => 6.5], ["id" => 753050225, "country_id" => 817138619, "name" => "New Jersey", "code" => "NJ", "tax_name" => null, "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.06, "tax_percentage" => 6.0], ["id" => 1013111685, "country_id" => 817138619, "name" => "New York", "code" => "NY", "tax_name" => null, "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.04, "tax_percentage" => 4.0], ["id" => 915134533, "country_id" => 817138619, "name" => "Pennsylvania", "code" => "PA", "tax_name" => null, "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.05, "tax_percentage" => 5.0], ["id" => 591478044, "country_id" => 817138619, "name" => "Rhode Island", "code" => "RI", "tax_name" => null, "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.07, "tax_percentage" => 7.0]]]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-10/countries.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Country::all(
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
                  ["countries" => [["id" => 817138619, "name" => "United States", "code" => "US", "tax_name" => "Federal Tax", "tax" => 0.0, "provinces" => [["id" => 952629862, "country_id" => 817138619, "name" => "California", "code" => "CA", "tax_name" => null, "tax_type" => null, "shipping_zone_id" => 1039932365, "tax" => 0.05, "tax_percentage" => 5.0], ["id" => 222234158, "country_id" => 817138619, "name" => "Kentucky", "code" => "KY", "tax_name" => null, "tax_type" => null, "shipping_zone_id" => 1039932365, "tax" => 0.06, "tax_percentage" => 6.0], ["id" => 9350860, "country_id" => 817138619, "name" => "Massachusetts", "code" => "MA", "tax_name" => null, "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.065, "tax_percentage" => 6.5], ["id" => 696485510, "country_id" => 817138619, "name" => "Minnesota", "code" => "MN", "tax_name" => null, "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.065, "tax_percentage" => 6.5], ["id" => 753050225, "country_id" => 817138619, "name" => "New Jersey", "code" => "NJ", "tax_name" => null, "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.06, "tax_percentage" => 6.0], ["id" => 1013111685, "country_id" => 817138619, "name" => "New York", "code" => "NY", "tax_name" => null, "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.04, "tax_percentage" => 4.0], ["id" => 915134533, "country_id" => 817138619, "name" => "Pennsylvania", "code" => "PA", "tax_name" => null, "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.05, "tax_percentage" => 5.0], ["id" => 591478044, "country_id" => 817138619, "name" => "Rhode Island", "code" => "RI", "tax_name" => null, "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.07, "tax_percentage" => 7.0]]], ["id" => 879921427, "name" => "Canada", "code" => "CA", "tax_name" => "GST", "tax" => 0.05, "provinces" => [["id" => 205434194, "country_id" => 879921427, "name" => "Alberta", "code" => "AB", "tax_name" => null, "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.08, "tax_percentage" => 8.0], ["id" => 170405627, "country_id" => 879921427, "name" => "British Columbia", "code" => "BC", "tax_name" => null, "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.07, "tax_percentage" => 7.0], ["id" => 342345110, "country_id" => 879921427, "name" => "Manitoba", "code" => "MB", "tax_name" => null, "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.07, "tax_percentage" => 7.0], ["id" => 92264567, "country_id" => 879921427, "name" => "New Brunswick", "code" => "NB", "tax_name" => null, "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.15, "tax_percentage" => 15.0], ["id" => 243284171, "country_id" => 879921427, "name" => "Newfoundland", "code" => "NL", "tax_name" => null, "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.15, "tax_percentage" => 15.0], ["id" => 439598329, "country_id" => 879921427, "name" => "Northwest Territories", "code" => "NT", "tax_name" => null, "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.0, "tax_percentage" => 0.0], ["id" => 448070559, "country_id" => 879921427, "name" => "Nova Scotia", "code" => "NS", "tax_name" => null, "tax_type" => "harmonized", "shipping_zone_id" => null, "tax" => 0.15, "tax_percentage" => 15.0], ["id" => 670206421, "country_id" => 879921427, "name" => "Nunavut", "code" => "NU", "tax_name" => null, "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.0, "tax_percentage" => 0.0], ["id" => 702530425, "country_id" => 879921427, "name" => "Ontario", "code" => "ON", "tax_name" => null, "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.08, "tax_percentage" => 8.0], ["id" => 570891722, "country_id" => 879921427, "name" => "Prince Edward Island", "code" => "PE", "tax_name" => null, "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.1, "tax_percentage" => 10.0], ["id" => 224293623, "country_id" => 879921427, "name" => "Quebec", "code" => "QC", "tax_name" => "HST", "tax_type" => "compounded", "shipping_zone_id" => null, "tax" => 0.09, "tax_percentage" => 9.0], ["id" => 473391800, "country_id" => 879921427, "name" => "Saskatchewan", "code" => "SK", "tax_name" => null, "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.09, "tax_percentage" => 9.0], ["id" => 1005264686, "country_id" => 879921427, "name" => "Yukon", "code" => "YT", "tax_name" => null, "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.0, "tax_percentage" => 0.0]]]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-10/countries.json?since_id=359115488",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Country::all(
            $this->test_session,
            [],
            ["since_id" => "359115488"],
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
                  ["country" => ["id" => 1070231511, "name" => "France", "code" => "FR", "tax_name" => "TVA", "tax" => 0.2, "provinces" => []]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-10/countries.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["country" => ["code" => "FR"]]),
            ),
        ]);

        $country = new Country($this->test_session);
        $country->code = "FR";
        $country->save();
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
                  ["country" => ["id" => 1070231510, "name" => "France", "code" => "FR", "tax_name" => "TVA", "tax" => 0.2, "provinces" => []]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-10/countries.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["country" => ["code" => "FR", "tax" => 0.2]]),
            ),
        ]);

        $country = new Country($this->test_session);
        $country->code = "FR";
        $country->tax = 0.2;
        $country->save();
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
                "https://test-shop.myshopify.io/admin/api/2022-10/countries/count.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Country::count(
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
                  ["country" => ["id" => 879921427, "name" => "Canada", "code" => "CA", "tax_name" => "GST", "tax" => 0.05, "provinces" => [["id" => 205434194, "country_id" => 879921427, "name" => "Alberta", "code" => "AB", "tax_name" => null, "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.08, "tax_percentage" => 8.0], ["id" => 170405627, "country_id" => 879921427, "name" => "British Columbia", "code" => "BC", "tax_name" => null, "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.07, "tax_percentage" => 7.0], ["id" => 342345110, "country_id" => 879921427, "name" => "Manitoba", "code" => "MB", "tax_name" => null, "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.07, "tax_percentage" => 7.0], ["id" => 92264567, "country_id" => 879921427, "name" => "New Brunswick", "code" => "NB", "tax_name" => null, "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.15, "tax_percentage" => 15.0], ["id" => 243284171, "country_id" => 879921427, "name" => "Newfoundland", "code" => "NL", "tax_name" => null, "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.15, "tax_percentage" => 15.0], ["id" => 439598329, "country_id" => 879921427, "name" => "Northwest Territories", "code" => "NT", "tax_name" => null, "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.0, "tax_percentage" => 0.0], ["id" => 448070559, "country_id" => 879921427, "name" => "Nova Scotia", "code" => "NS", "tax_name" => null, "tax_type" => "harmonized", "shipping_zone_id" => null, "tax" => 0.15, "tax_percentage" => 15.0], ["id" => 670206421, "country_id" => 879921427, "name" => "Nunavut", "code" => "NU", "tax_name" => null, "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.0, "tax_percentage" => 0.0], ["id" => 702530425, "country_id" => 879921427, "name" => "Ontario", "code" => "ON", "tax_name" => null, "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.08, "tax_percentage" => 8.0], ["id" => 570891722, "country_id" => 879921427, "name" => "Prince Edward Island", "code" => "PE", "tax_name" => null, "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.1, "tax_percentage" => 10.0], ["id" => 224293623, "country_id" => 879921427, "name" => "Quebec", "code" => "QC", "tax_name" => "HST", "tax_type" => "compounded", "shipping_zone_id" => null, "tax" => 0.09, "tax_percentage" => 9.0], ["id" => 473391800, "country_id" => 879921427, "name" => "Saskatchewan", "code" => "SK", "tax_name" => null, "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.09, "tax_percentage" => 9.0], ["id" => 1005264686, "country_id" => 879921427, "name" => "Yukon", "code" => "YT", "tax_name" => null, "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.0, "tax_percentage" => 0.0]]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-10/countries/879921427.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Country::find(
            $this->test_session,
            879921427,
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
                  ["country" => ["id" => 879921427, "name" => "Canada", "code" => "CA", "tax_name" => "GST", "tax" => 0.05, "provinces" => [["country_id" => 879921427, "tax_name" => "Tax", "id" => 205434194, "name" => "Alberta", "code" => "AB", "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.08, "tax_percentage" => 8.0], ["country_id" => 879921427, "tax_name" => "Tax", "id" => 170405627, "name" => "British Columbia", "code" => "BC", "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.07, "tax_percentage" => 7.0], ["country_id" => 879921427, "tax_name" => "Tax", "id" => 342345110, "name" => "Manitoba", "code" => "MB", "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.07, "tax_percentage" => 7.0], ["country_id" => 879921427, "tax_name" => "Tax", "id" => 92264567, "name" => "New Brunswick", "code" => "NB", "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.15, "tax_percentage" => 15.0], ["country_id" => 879921427, "tax_name" => "Tax", "id" => 243284171, "name" => "Newfoundland", "code" => "NL", "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.15, "tax_percentage" => 15.0], ["country_id" => 879921427, "tax_name" => "Tax", "id" => 439598329, "name" => "Northwest Territories", "code" => "NT", "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.0, "tax_percentage" => 0.0], ["country_id" => 879921427, "tax_name" => "Tax", "id" => 448070559, "name" => "Nova Scotia", "code" => "NS", "tax_type" => "harmonized", "shipping_zone_id" => null, "tax" => 0.15, "tax_percentage" => 15.0], ["country_id" => 879921427, "tax_name" => "Tax", "id" => 670206421, "name" => "Nunavut", "code" => "NU", "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.0, "tax_percentage" => 0.0], ["country_id" => 879921427, "tax_name" => "Tax", "id" => 702530425, "name" => "Ontario", "code" => "ON", "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.08, "tax_percentage" => 8.0], ["country_id" => 879921427, "tax_name" => "Tax", "id" => 570891722, "name" => "Prince Edward Island", "code" => "PE", "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.1, "tax_percentage" => 10.0], ["id" => 224293623, "country_id" => 879921427, "name" => "Quebec", "code" => "QC", "tax_name" => "HST", "tax_type" => "compounded", "shipping_zone_id" => null, "tax" => 0.09, "tax_percentage" => 9.0], ["country_id" => 879921427, "tax_name" => "Tax", "id" => 473391800, "name" => "Saskatchewan", "code" => "SK", "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.09, "tax_percentage" => 9.0], ["country_id" => 879921427, "tax_name" => "Tax", "id" => 1005264686, "name" => "Yukon", "code" => "YT", "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.0, "tax_percentage" => 0.0]]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-10/countries/879921427.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["country" => ["tax" => 0.05]]),
            ),
        ]);

        $country = new Country($this->test_session);
        $country->id = 879921427;
        $country->tax = 0.05;
        $country->save();
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
                "https://test-shop.myshopify.io/admin/api/2022-10/countries/879921427.json",
                "DELETE",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Country::delete(
            $this->test_session,
            879921427,
            [],
            [],
        );
    }

}
