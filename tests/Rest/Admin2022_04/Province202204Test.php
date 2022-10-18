<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Admin2022_04\Province;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class Province202204Test extends BaseTestCase
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
                  ["provinces" => [["id" => 205434194, "country_id" => 879921427, "name" => "Alberta", "code" => "AB", "tax_name" => null, "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.08, "tax_percentage" => 8.0], ["id" => 170405627, "country_id" => 879921427, "name" => "British Columbia", "code" => "BC", "tax_name" => null, "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.07, "tax_percentage" => 7.0], ["id" => 342345110, "country_id" => 879921427, "name" => "Manitoba", "code" => "MB", "tax_name" => null, "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.07, "tax_percentage" => 7.0], ["id" => 92264567, "country_id" => 879921427, "name" => "New Brunswick", "code" => "NB", "tax_name" => null, "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.15, "tax_percentage" => 15.0], ["id" => 243284171, "country_id" => 879921427, "name" => "Newfoundland", "code" => "NL", "tax_name" => null, "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.15, "tax_percentage" => 15.0], ["id" => 439598329, "country_id" => 879921427, "name" => "Northwest Territories", "code" => "NT", "tax_name" => null, "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.0, "tax_percentage" => 0.0], ["id" => 448070559, "country_id" => 879921427, "name" => "Nova Scotia", "code" => "NS", "tax_name" => null, "tax_type" => "harmonized", "shipping_zone_id" => null, "tax" => 0.15, "tax_percentage" => 15.0], ["id" => 670206421, "country_id" => 879921427, "name" => "Nunavut", "code" => "NU", "tax_name" => null, "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.0, "tax_percentage" => 0.0], ["id" => 702530425, "country_id" => 879921427, "name" => "Ontario", "code" => "ON", "tax_name" => null, "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.08, "tax_percentage" => 8.0], ["id" => 570891722, "country_id" => 879921427, "name" => "Prince Edward Island", "code" => "PE", "tax_name" => null, "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.1, "tax_percentage" => 10.0], ["id" => 224293623, "country_id" => 879921427, "name" => "Quebec", "code" => "QC", "tax_name" => "HST", "tax_type" => "compounded", "shipping_zone_id" => null, "tax" => 0.09, "tax_percentage" => 9.0], ["id" => 473391800, "country_id" => 879921427, "name" => "Saskatchewan", "code" => "SK", "tax_name" => null, "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.09, "tax_percentage" => 9.0], ["id" => 1005264686, "country_id" => 879921427, "name" => "Yukon", "code" => "YT", "tax_name" => null, "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.0, "tax_percentage" => 0.0]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/countries/879921427/provinces.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Province::all(
            $this->test_session,
            ["country_id" => "879921427"],
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
                  ["provinces" => [["id" => 570891722, "country_id" => 879921427, "name" => "Prince Edward Island", "code" => "PE", "tax_name" => null, "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.1, "tax_percentage" => 10.0], ["id" => 670206421, "country_id" => 879921427, "name" => "Nunavut", "code" => "NU", "tax_name" => null, "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.0, "tax_percentage" => 0.0], ["id" => 702530425, "country_id" => 879921427, "name" => "Ontario", "code" => "ON", "tax_name" => null, "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.08, "tax_percentage" => 8.0], ["id" => 1005264686, "country_id" => 879921427, "name" => "Yukon", "code" => "YT", "tax_name" => null, "tax_type" => null, "shipping_zone_id" => null, "tax" => 0.0, "tax_percentage" => 0.0]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/countries/879921427/provinces.json?since_id=536137098",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Province::all(
            $this->test_session,
            ["country_id" => "879921427"],
            ["since_id" => "536137098"],
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
                  ["count" => 13]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/countries/879921427/provinces/count.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Province::count(
            $this->test_session,
            ["country_id" => "879921427"],
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
                  ["province" => ["id" => 224293623, "country_id" => 879921427, "name" => "Quebec", "code" => "QC", "tax_name" => "HST", "tax_type" => "compounded", "shipping_zone_id" => null, "tax" => 0.09, "tax_percentage" => 9.0]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/countries/879921427/provinces/224293623.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Province::find(
            $this->test_session,
            224293623,
            ["country_id" => "879921427"],
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
                  ["province" => ["country_id" => 879921427, "id" => 224293623, "name" => "Quebec", "code" => "QC", "tax_name" => "HST", "tax_type" => "compounded", "shipping_zone_id" => null, "tax" => 0.09, "tax_percentage" => 9.0]]
                )),
                "https://test-shop.myshopify.io/admin/api/2022-04/countries/879921427/provinces/224293623.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["province" => ["tax" => 0.09]]),
            ),
        ]);

        $province = new Province($this->test_session);
        $province->country_id = 879921427;
        $province->id = 224293623;
        $province->tax = 0.09;
        $province->save();
    }

}
