<?php

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\MobilePlatformApplication;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class MobilePlatformApplication202104Test extends BaseTestCase
{
    /** @var Session */
    private $test_session;

    public function setUp(): void
    {
        parent::setUp();

        Context::$API_VERSION = "2021-04";

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
                "https://test-shop.myshopify.io/admin/api/2021-04/mobile_platform_applications.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        MobilePlatformApplication::all(
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
                "https://test-shop.myshopify.io/admin/api/2021-04/mobile_platform_applications.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["mobile_platform_application" => ["platform" => "ios", "application_id" => "X1Y2.ca.domain.app", "enabled_universal_or_app_links" => true, "enabled_shared_webcredentials" => true]]),
            ),
        ]);

        $mobile_platform_application = new MobilePlatformApplication($this->test_session);
        $mobile_platform_application->platform = "ios";
        $mobile_platform_application->application_id = "X1Y2.ca.domain.app";
        $mobile_platform_application->enabled_universal_or_app_links = true;
        $mobile_platform_application->enabled_shared_webcredentials = true;
        $mobile_platform_application->save();
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
                "https://test-shop.myshopify.io/admin/api/2021-04/mobile_platform_applications.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["mobile_platform_application" => ["platform" => "android", "application_id" => "com.example", "sha256_cert_fingerprints" => ["14:6D:E9:83:C5:73:06:50:D8:EE:B9:95:2F:34:FC:64:16:A0:83:42:E6:1D:BE:A8:8A:04:96:B2:3F:CF:44:E5"], "enabled_universal_or_app_links" => true]]),
            ),
        ]);

        $mobile_platform_application = new MobilePlatformApplication($this->test_session);
        $mobile_platform_application->platform = "android";
        $mobile_platform_application->application_id = "com.example";
        $mobile_platform_application->sha256_cert_fingerprints = [
            "14:6D:E9:83:C5:73:06:50:D8:EE:B9:95:2F:34:FC:64:16:A0:83:42:E6:1D:BE:A8:8A:04:96:B2:3F:CF:44:E5"
        ];
        $mobile_platform_application->enabled_universal_or_app_links = true;
        $mobile_platform_application->save();
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
                "https://test-shop.myshopify.io/admin/api/2021-04/mobile_platform_applications/1066176008.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        MobilePlatformApplication::find(
            $this->test_session,
            1066176008,
            [],
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
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-04/mobile_platform_applications/1066176009.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["mobile_platform_application" => ["id" => 1066176009, "application_id" => "A1B2.ca.domain.app", "platform" => "ios", "created_at" => "2022-02-03T16:41:55-05:00", "updated_at" => "2022-02-03T16:41:55-05:00", "sha256_cert_fingerprints" => [], "enabled_universal_or_app_links" => true, "enabled_shared_webcredentials" => true]]),
            ),
        ]);

        $mobile_platform_application = new MobilePlatformApplication($this->test_session);
        $mobile_platform_application->id = 1066176009;
        $mobile_platform_application->application_id = "A1B2.ca.domain.app";
        $mobile_platform_application->platform = "ios";
        $mobile_platform_application->created_at = "2022-02-03T16:41:55-05:00";
        $mobile_platform_application->updated_at = "2022-02-03T16:41:55-05:00";
        $mobile_platform_application->sha256_cert_fingerprints = [];
        $mobile_platform_application->enabled_universal_or_app_links = true;
        $mobile_platform_application->enabled_shared_webcredentials = true;
        $mobile_platform_application->save();
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
                "https://test-shop.myshopify.io/admin/api/2021-04/mobile_platform_applications/1066176010.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["mobile_platform_application" => ["id" => 1066176010, "application_id" => "com.example.news.app", "platform" => "android", "created_at" => "2022-02-03T16:41:57-05:00", "updated_at" => "2022-02-03T16:41:57-05:00", "sha256_cert_fingerprints" => ["14:6D:E9:83:C5:73:06:50:D8:EE:B9:95:2F:34:FC:64:16:A0:83:42:E6:1D:BE:A8:8A:04:96:B2:3F:CF:44:E5"], "enabled_universal_or_app_links" => true, "enabled_shared_webcredentials" => false]]),
            ),
        ]);

        $mobile_platform_application = new MobilePlatformApplication($this->test_session);
        $mobile_platform_application->id = 1066176010;
        $mobile_platform_application->application_id = "com.example.news.app";
        $mobile_platform_application->platform = "android";
        $mobile_platform_application->created_at = "2022-02-03T16:41:57-05:00";
        $mobile_platform_application->updated_at = "2022-02-03T16:41:57-05:00";
        $mobile_platform_application->sha256_cert_fingerprints = [
            "14:6D:E9:83:C5:73:06:50:D8:EE:B9:95:2F:34:FC:64:16:A0:83:42:E6:1D:BE:A8:8A:04:96:B2:3F:CF:44:E5"
        ];
        $mobile_platform_application->enabled_universal_or_app_links = true;
        $mobile_platform_application->enabled_shared_webcredentials = false;
        $mobile_platform_application->save();
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
                "https://test-shop.myshopify.io/admin/api/2021-04/mobile_platform_applications/1066176011.json",
                "DELETE",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        MobilePlatformApplication::delete(
            $this->test_session,
            1066176011,
            [],
            [],
        );
    }

}
