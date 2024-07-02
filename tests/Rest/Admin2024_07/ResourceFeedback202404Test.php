<?php

/***********************************************************************************************************************
* This file is auto-generated. If you have an issue, please create a GitHub issue.                                     *
***********************************************************************************************************************/

declare(strict_types=1);

namespace ShopifyTest\Rest;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Rest\Admin2024_07\ResourceFeedback;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class ResourceFeedback202404Test extends BaseTestCase
{
    /** @var Session */
    private $test_session;

    public function setUp(): void
    {
        parent::setUp();

        Context::$API_VERSION = "2024-07";

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
                  ["resource_feedback" => ["created_at" => "2024-01-02T17:14:16-05:00", "updated_at" => "2024-01-02T17:14:16-05:00", "resource_id" => 548380009, "resource_type" => "Shop", "resource_updated_at" => null, "messages" => ["is not connected. Connect your account to use this sales channel."], "feedback_generated_at" => "2024-01-02T17:14:15-05:00", "state" => "requires_action"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2024-07/resource_feedback.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["resource_feedback" => ["state" => "requires_action", "messages" => ["is not connected. Connect your account to use this sales channel."], "feedback_generated_at" => "2024-01-02T22:14:15.870447Z"]]),
            ),
        ]);

        $resource_feedback = new ResourceFeedback($this->test_session);
        $resource_feedback->state = "requires_action";
        $resource_feedback->messages = [
            "is not connected. Connect your account to use this sales channel."
        ];
        $resource_feedback->feedback_generated_at = "2024-01-02T22:14:15.870447Z";
        $resource_feedback->save();
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
                  ["resource_feedback" => ["created_at" => "2024-01-02T17:14:15-05:00", "updated_at" => "2024-01-02T17:14:15-05:00", "resource_id" => 548380009, "resource_type" => "Shop", "resource_updated_at" => null, "messages" => [], "feedback_generated_at" => "2024-01-02T17:14:14-05:00", "state" => "success"]]
                )),
                "https://test-shop.myshopify.io/admin/api/2024-07/resource_feedback.json",
                "POST",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
                json_encode(["resource_feedback" => ["state" => "success", "feedback_generated_at" => "2024-01-02T22:14:14.748024Z"]]),
            ),
        ]);

        $resource_feedback = new ResourceFeedback($this->test_session);
        $resource_feedback->state = "success";
        $resource_feedback->feedback_generated_at = "2024-01-02T22:14:14.748024Z";
        $resource_feedback->save();
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
                  ["resource_feedback" => [["created_at" => "2024-01-02T17:14:15-05:00", "updated_at" => "2024-01-02T17:14:15-05:00", "resource_id" => 548380009, "resource_type" => "Shop", "resource_updated_at" => null, "messages" => ["is not connected. Connect your account to use this sales channel."], "feedback_generated_at" => "2024-01-02T16:14:15-05:00", "state" => "requires_action"]]]
                )),
                "https://test-shop.myshopify.io/admin/api/2024-07/resource_feedback.json",
                "GET",
                null,
                [
                    "X-Shopify-Access-Token: this_is_a_test_token",
                ],
            ),
        ]);

        ResourceFeedback::all(
            $this->test_session,
            [],
            [],
        );
    }

}
