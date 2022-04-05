<?php

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Admin2021_10\AndroidPayKey;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class AndroidPayKey202110Test extends BaseTestCase
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
                  ["android_pay_key" => ["id" => 964811896, "public_key" => "BPI5no5liIrAC3knvJnxSoMW09D0KwbJOnv TaAmd3Fur3wYlD85yFaJABZC\n1qb/14GtM 616y8SrKwaVOSu4U8=\n"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-10/android_pay_keys.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["android_pay_key" => []]),
            ),
        ]);

        $android_pay_key = new AndroidPayKey($this->test_session);

        $android_pay_key->save();
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
                  ["android_pay_key" => ["id" => 964811894, "public_key" => "BPI5no5liIrAC3knvJnxSoMW09D0KwbJOnv TaAmd3Fur3wYlD85yFaJABZC\n1qb/14GtM 616y8SrKwaVOSu4U8=\n"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2021-10/android_pay_keys/964811894.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        AndroidPayKey::find(
            $this->test_session,
            964811894,
            [],
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
                  []
                )),
                "https://test-shop.myshopify.io/admin/api/2021-10/android_pay_keys/964811895.json",
                "DELETE",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        AndroidPayKey::delete(
            $this->test_session,
            964811895,
            [],
            [],
        );
    }

}
