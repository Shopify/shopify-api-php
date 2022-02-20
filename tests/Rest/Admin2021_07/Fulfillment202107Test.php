<?php

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Fulfillment;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class Fulfillment202107Test extends BaseTestCase
{
    /** @var Session */
    private $test_session;

    public function setUp(): void
    {
        parent::setUp();

        Context::$API_VERSION = "2021-07";

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
                "https://test-shop.myshopify.io/admin/api/2021-07/orders/450789469/fulfillments.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Fulfillment::all(
            $this->test_session,
            ["order_id" => 450789469],
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
                "https://test-shop.myshopify.io/admin/api/2021-07/orders/450789469/fulfillments.json?since_id=255858046",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Fulfillment::all(
            $this->test_session,
            ["order_id" => 450789469],
            ["since_id" => 255858046],
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
                "https://test-shop.myshopify.io/admin/api/2021-07/orders/450789469/fulfillments.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["fulfillment" => ["location_id" => 487838322, "tracking_number" => 123456789, "tracking_urls" => ["https://shipping.xyz/track.php?num=123456789", "https://anothershipper.corp/track.php?code=abc"], "notify_customer" => true]]),
            ),
        ]);

        $fulfillment = new Fulfillment($this->test_session);
        $fulfillment->order_id = 450789469;
        $fulfillment->location_id = 487838322;
        $fulfillment->tracking_number = 123456789;
        $fulfillment->tracking_urls = [
            "https://shipping.xyz/track.php?num=123456789",
            "https://anothershipper.corp/track.php?code=abc"
        ];
        $fulfillment->notify_customer = true;
        $fulfillment->save();
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
                "https://test-shop.myshopify.io/admin/api/2021-07/orders/450789469/fulfillments.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["fulfillment" => ["location_id" => 655441491, "tracking_number" => null, "line_items" => [["id" => 518995019]]]]),
            ),
        ]);

        $fulfillment = new Fulfillment($this->test_session);
        $fulfillment->order_id = 450789469;
        $fulfillment->location_id = 655441491;
        $fulfillment->tracking_number = null;
        $fulfillment->line_items = [
            [
                "id" => 518995019
            ]
        ];
        $fulfillment->save();
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
                "https://test-shop.myshopify.io/admin/api/2021-07/orders/450789469/fulfillments.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["fulfillment" => ["location_id" => 655441491, "tracking_numbers" => ["88b451840563b72cc15d3fcb6179f302", "aee587edbd98ad725d27974c808ec7d6", "94e71192ecf091ea5c25b69c385c2b1b"], "line_items" => [["id" => 518995019]]]]),
            ),
        ]);

        $fulfillment = new Fulfillment($this->test_session);
        $fulfillment->order_id = 450789469;
        $fulfillment->location_id = 655441491;
        $fulfillment->tracking_numbers = [
            "88b451840563b72cc15d3fcb6179f302",
            "aee587edbd98ad725d27974c808ec7d6",
            "94e71192ecf091ea5c25b69c385c2b1b"
        ];
        $fulfillment->line_items = [
            [
                "id" => 518995019
            ]
        ];
        $fulfillment->save();
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
                "https://test-shop.myshopify.io/admin/api/2021-07/orders/450789469/fulfillments.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["fulfillment" => ["location_id" => 655441491, "tracking_url" => "http://www.packagetrackr.com/track/somecarrier/1234567", "tracking_company" => "Jack Black's Pack, Stack and Track", "line_items" => [["id" => 518995019]]]]),
            ),
        ]);

        $fulfillment = new Fulfillment($this->test_session);
        $fulfillment->order_id = 450789469;
        $fulfillment->location_id = 655441491;
        $fulfillment->tracking_url = "http://www.packagetrackr.com/track/somecarrier/1234567";
        $fulfillment->tracking_company = "Jack Black's Pack, Stack and Track";
        $fulfillment->line_items = [
            [
                "id" => 518995019
            ]
        ];
        $fulfillment->save();
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
                "https://test-shop.myshopify.io/admin/api/2021-07/orders/450789469/fulfillments.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["fulfillment" => ["location_id" => 655441491, "tracking_number" => 123456789, "tracking_company" => "4PX", "line_items" => [["id" => 518995019]]]]),
            ),
        ]);

        $fulfillment = new Fulfillment($this->test_session);
        $fulfillment->order_id = 450789469;
        $fulfillment->location_id = 655441491;
        $fulfillment->tracking_number = 123456789;
        $fulfillment->tracking_company = "4PX";
        $fulfillment->line_items = [
            [
                "id" => 518995019
            ]
        ];
        $fulfillment->save();
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
                "https://test-shop.myshopify.io/admin/api/2021-07/orders/450789469/fulfillments.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["fulfillment" => ["location_id" => 655441491, "tracking_number" => 123456789010, "tracking_company" => "fed ex", "line_items" => [["id" => 518995019]]]]),
            ),
        ]);

        $fulfillment = new Fulfillment($this->test_session);
        $fulfillment->order_id = 450789469;
        $fulfillment->location_id = 655441491;
        $fulfillment->tracking_number = 123456789010;
        $fulfillment->tracking_company = "fed ex";
        $fulfillment->line_items = [
            [
                "id" => 518995019
            ]
        ];
        $fulfillment->save();
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
                "https://test-shop.myshopify.io/admin/api/2021-07/orders/450789469/fulfillments.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["fulfillment" => ["location_id" => 655441491, "tracking_number" => 123456789010, "tracking_company" => "fed ex", "tracking_url" => "https://www.new-fedex-tracking.com/?number=123456789010", "line_items" => [["id" => 518995019]]]]),
            ),
        ]);

        $fulfillment = new Fulfillment($this->test_session);
        $fulfillment->order_id = 450789469;
        $fulfillment->location_id = 655441491;
        $fulfillment->tracking_number = 123456789010;
        $fulfillment->tracking_company = "fed ex";
        $fulfillment->tracking_url = "https://www.new-fedex-tracking.com/?number=123456789010";
        $fulfillment->line_items = [
            [
                "id" => 518995019
            ]
        ];
        $fulfillment->save();
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
                "https://test-shop.myshopify.io/admin/api/2021-07/orders/450789469/fulfillments.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["fulfillment" => ["location_id" => 655441491, "tracking_number" => "RR123456789CN", "tracking_company" => "Chinese Post", "line_items" => [["id" => 518995019]]]]),
            ),
        ]);

        $fulfillment = new Fulfillment($this->test_session);
        $fulfillment->order_id = 450789469;
        $fulfillment->location_id = 655441491;
        $fulfillment->tracking_number = "RR123456789CN";
        $fulfillment->tracking_company = "Chinese Post";
        $fulfillment->line_items = [
            [
                "id" => 518995019
            ]
        ];
        $fulfillment->save();
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
                "https://test-shop.myshopify.io/admin/api/2021-07/orders/450789469/fulfillments.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["fulfillment" => ["location_id" => 655441491, "tracking_number" => 1234567, "tracking_company" => "Custom Tracking Company", "line_items" => [["id" => 518995019]]]]),
            ),
        ]);

        $fulfillment = new Fulfillment($this->test_session);
        $fulfillment->order_id = 450789469;
        $fulfillment->location_id = 655441491;
        $fulfillment->tracking_number = 1234567;
        $fulfillment->tracking_company = "Custom Tracking Company";
        $fulfillment->line_items = [
            [
                "id" => 518995019
            ]
        ];
        $fulfillment->save();
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
                "https://test-shop.myshopify.io/admin/api/2021-07/orders/450789469/fulfillments.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["fulfillment" => ["location_id" => 655441491, "tracking_number" => "CJ274101086US", "tracking_url" => "http://www.custom-tracking.com/?tracking_number=CJ274101086US", "line_items" => [["id" => 518995019]]]]),
            ),
        ]);

        $fulfillment = new Fulfillment($this->test_session);
        $fulfillment->order_id = 450789469;
        $fulfillment->location_id = 655441491;
        $fulfillment->tracking_number = "CJ274101086US";
        $fulfillment->tracking_url = "http://www.custom-tracking.com/?tracking_number=CJ274101086US";
        $fulfillment->line_items = [
            [
                "id" => 518995019
            ]
        ];
        $fulfillment->save();
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
                "https://test-shop.myshopify.io/admin/api/2021-07/orders/450789469/fulfillments.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["fulfillment" => ["location_id" => 655441491, "tracking_number" => null, "line_items" => [["id" => 518995019]]]]),
            ),
        ]);

        $fulfillment = new Fulfillment($this->test_session);
        $fulfillment->order_id = 450789469;
        $fulfillment->location_id = 655441491;
        $fulfillment->tracking_number = null;
        $fulfillment->line_items = [
            [
                "id" => 518995019
            ]
        ];
        $fulfillment->save();
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
                "https://test-shop.myshopify.io/admin/api/2021-07/orders/450789469/fulfillments.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["fulfillment" => ["location_id" => 655441491, "tracking_number" => null, "line_items" => [["id" => 518995019, "quantity" => 1]]]]),
            ),
        ]);

        $fulfillment = new Fulfillment($this->test_session);
        $fulfillment->order_id = 450789469;
        $fulfillment->location_id = 655441491;
        $fulfillment->tracking_number = null;
        $fulfillment->line_items = [
            [
                "id" => 518995019,
                "quantity" => 1
            ]
        ];
        $fulfillment->save();
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
                "https://test-shop.myshopify.io/admin/api/2021-07/fulfillment_orders/1046000859/fulfillments.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Fulfillment::all(
            $this->test_session,
            ["fulfillment_order_id" => 1046000859],
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
                "https://test-shop.myshopify.io/admin/api/2021-07/orders/450789469/fulfillments/count.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Fulfillment::count(
            $this->test_session,
            ["order_id" => 450789469],
            [],
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
                "https://test-shop.myshopify.io/admin/api/2021-07/orders/450789469/fulfillments/255858046.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        Fulfillment::find(
            $this->test_session,
            255858046,
            ["order_id" => 450789469],
            [],
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
                "https://test-shop.myshopify.io/admin/api/2021-07/orders/450789469/fulfillments/255858046.json",
                "PUT",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["fulfillment" => ["tracking_number" => 987654321, "id" => 255858046]]),
            ),
        ]);

        $fulfillment = new Fulfillment($this->test_session);
        $fulfillment->order_id = 450789469;
        $fulfillment->id = 255858046;
        $fulfillment->tracking_number = 987654321;
        $fulfillment->save();
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
                "https://test-shop.myshopify.io/admin/api/2021-07/fulfillments.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["fulfillment" => ["message" => "The package was shipped this morning.", "notify_customer" => false, "tracking_info" => ["number" => 1562678, "url" => "https://www.my-shipping-company.com", "company" => "my-shipping-company"], "line_items_by_fulfillment_order" => [["fulfillment_order_id" => 1046000873, "fulfillment_order_line_items" => [["id" => 1058737644, "quantity" => 1]]]]]]),
            ),
        ]);

        $fulfillment = new Fulfillment($this->test_session);
        $fulfillment->message = "The package was shipped this morning.";
        $fulfillment->notify_customer = false;
        $fulfillment->tracking_info = [
            "number" => 1562678,
            "url" => "https://www.my-shipping-company.com",
            "company" => "my-shipping-company"
        ];
        $fulfillment->line_items_by_fulfillment_order = [
            [
                "fulfillment_order_id" => 1046000873,
                "fulfillment_order_line_items" => [
                        [
                                    "id" => 1058737644,
                                    "quantity" => 1
                                ]
                    ]
            ]
        ];
        $fulfillment->save();
    }

    /**

     *
     * @return void
     */
    public function test_20(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-07/fulfillments.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["fulfillment" => ["message" => "The package was shipped this morning.", "notify_customer" => false, "tracking_info" => ["number" => 1562678, "url" => "https://www.my-shipping-company.com", "company" => "my-shipping-company"], "line_items_by_fulfillment_order" => [["fulfillment_order_id" => 1046000874]]]]),
            ),
        ]);

        $fulfillment = new Fulfillment($this->test_session);
        $fulfillment->message = "The package was shipped this morning.";
        $fulfillment->notify_customer = false;
        $fulfillment->tracking_info = [
            "number" => 1562678,
            "url" => "https://www.my-shipping-company.com",
            "company" => "my-shipping-company"
        ];
        $fulfillment->line_items_by_fulfillment_order = [
            [
                "fulfillment_order_id" => 1046000874
            ]
        ];
        $fulfillment->save();
    }

    /**

     *
     * @return void
     */
    public function test_21(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-07/fulfillments/1069019908/update_tracking.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["fulfillment" => ["notify_customer" => true, "tracking_info" => ["number" => 1111, "url" => "http://www.my-url.com", "company" => "my-company"]]]),
            ),
        ]);

        $fulfillment = new Fulfillment($this->test_session);
        $fulfillment->id = 1069019908;
        $fulfillment->update_tracking(
            [],
            ["fulfillment" => ["notify_customer" => true, "tracking_info" => ["number" => 1111, "url" => "http://www.my-url.com", "company" => "my-company"]]],
        );
    }

    /**

     *
     * @return void
     */
    public function test_22(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-07/orders/450789469/fulfillments/255858046/complete.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        $fulfillment = new Fulfillment($this->test_session);
        $fulfillment->order_id = 450789469;
        $fulfillment->id = 255858046;
        $fulfillment->complete(
            [],
        );
    }

    /**

     *
     * @return void
     */
    public function test_23(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-07/orders/450789469/fulfillments/255858046/open.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        $fulfillment = new Fulfillment($this->test_session);
        $fulfillment->order_id = 450789469;
        $fulfillment->id = 255858046;
        $fulfillment->open(
            [],
        );
    }

    /**

     *
     * @return void
     */
    public function test_24(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-07/orders/450789469/fulfillments/255858046/cancel.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        $fulfillment = new Fulfillment($this->test_session);
        $fulfillment->order_id = 450789469;
        $fulfillment->id = 255858046;
        $fulfillment->cancel(
            [],
        );
    }

    /**

     *
     * @return void
     */
    public function test_25(): void
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, ""),
                "https://test-shop.myshopify.io/admin/api/2021-07/fulfillments/1069019909/cancel.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        $fulfillment = new Fulfillment($this->test_session);
        $fulfillment->id = 1069019909;
        $fulfillment->cancel(
            [],
        );
    }

}
