<?php

declare(strict_types=1);

namespace ShopifyTest\Webhooks;

use PHPUnit\Framework\MockObject\MockObject;
use ReflectionClass;
use Shopify\Clients\HttpHeaders;
use Shopify\Context;
use Shopify\Exception\InvalidArgumentException;
use Shopify\Exception\InvalidWebhookException;
use Shopify\Exception\MissingWebhookHandlerException;
use Shopify\Exception\WebhookRegistrationException;
use Shopify\Webhooks\Handler;
use Shopify\Webhooks\Registry;
use Shopify\Webhooks\Topics;
use ShopifyTest\BaseTestCase;
use ShopifyTest\Clients\MockRequest;

final class RegistryTest extends BaseTestCase
{
    public function setUp(): void
    {
        parent::setUp();

        // Clean up the registry for every test
        $reflection = new ReflectionClass(Registry::class);
        $reflection->setStaticPropertyValue('REGISTRY', []);
    }

    public function testAddHandler()
    {
        $handler = $this->getMockHandler();
        Registry::addHandler(topic: Topics::APP_UNINSTALLED, handler: $handler);

        $this->assertSame($handler, Registry::getHandler(Topics::APP_UNINSTALLED));
    }

    public function testAddHandlerToExistingRegistry()
    {
        $handler = $this->getMockHandler();
        Registry::addHandler(topic: Topics::APP_UNINSTALLED, handler: $handler);

        $this->assertSame($handler, Registry::getHandler(Topics::APP_UNINSTALLED));

        // Now add a second webhook for a different topic
        $handler = $this->getMockHandler();
        Registry::addHandler(topic: Topics::PRODUCTS_CREATE, handler: $handler);

        $this->assertSame($handler, Registry::getHandler(Topics::PRODUCTS_CREATE));
    }

    public function testAddHandlerOverridesRegistry()
    {
        $handler = $this->getMockHandler();
        Registry::addHandler(topic: Topics::APP_UNINSTALLED, handler: $handler);

        $this->assertSame($handler, Registry::getHandler(Topics::APP_UNINSTALLED));

        // Now add a second handler for the same topic
        $handler = $this->getMockHandler();
        Registry::addHandler(topic: Topics::APP_UNINSTALLED, handler: $handler);

        $this->assertSame($handler, Registry::getHandler(Topics::APP_UNINSTALLED));
    }

    public function testCanRegisterAndUpdateWebhook()
    {
        $this->mockTransportRequests([
            new MockRequest(
                url: "https://$this->domain/admin/api/unstable/graphql.json",
                method: "POST",
                body: $this->checkQuery,
                userAgent: "Shopify Admin API Library for PHP v",
                headers: ['X-Shopify-Access-Token: real_token'],
                response: $this->buildMockHttpResponse(200, $this->checkResponseEmpty),
            ),
            new MockRequest(
                url: "https://$this->domain/admin/api/unstable/graphql.json",
                method: "POST",
                body: $this->registerAddQuery,
                userAgent: "Shopify Admin API Library for PHP v",
                headers: ['X-Shopify-Access-Token: real_token'],
                response: $this->buildMockHttpResponse(200, $this->registerAddResponse),
            ),
            new MockRequest(
                url: "https://$this->domain/admin/api/unstable/graphql.json",
                method: "POST",
                body: $this->checkQuery,
                userAgent: "Shopify Admin API Library for PHP v",
                headers: ['X-Shopify-Access-Token: real_token'],
                response: $this->buildMockHttpResponse(200, $this->checkResponseExisting),
            ),
            new MockRequest(
                url: "https://$this->domain/admin/api/unstable/graphql.json",
                method: "POST",
                body: $this->registerUpdateQuery,
                userAgent: "Shopify Admin API Library for PHP v",
                headers: ['X-Shopify-Access-Token: real_token'],
                response: $this->buildMockHttpResponse(200, $this->registerUpdateResponse),
            ),
        ]);

        $response = Registry::register(
            shop: $this->domain,
            topic: Topics::APP_UNINSTALLED,
            path: '/test-webhooks',
            accessToken: 'real_token',
        );
        $this->assertTrue($response->isSuccess());
        $this->assertEquals($this->registerAddResponse, $response->getBody());

        $response = Registry::register(
            shop: $this->domain,
            topic: Topics::APP_UNINSTALLED,
            path: '/test-webhooks-updated',
            accessToken: 'real_token',
        );
        $this->assertTrue($response->isSuccess());
        $this->assertEquals($this->registerUpdateResponse, $response->getBody());
    }

    public function testCanRegisterAndUpdateEventBridgeWebhook()
    {
        $this->mockTransportRequests([
            new MockRequest(
                url: "https://$this->domain/admin/api/unstable/graphql.json",
                method: "POST",
                body: $this->checkQuery,
                userAgent: "Shopify Admin API Library for PHP v",
                headers: ['X-Shopify-Access-Token: real_token'],
                response: $this->buildMockHttpResponse(200, $this->checkResponseEmpty),
            ),
            new MockRequest(
                url: "https://$this->domain/admin/api/unstable/graphql.json",
                method: "POST",
                body: $this->registerAddEventBridgeQuery,
                userAgent: "Shopify Admin API Library for PHP v",
                headers: ['X-Shopify-Access-Token: real_token'],
                response: $this->buildMockHttpResponse(200, $this->registerAddEventBridgeResponse),
            ),
            new MockRequest(
                url: "https://$this->domain/admin/api/unstable/graphql.json",
                method: "POST",
                body: $this->checkQuery,
                userAgent: "Shopify Admin API Library for PHP v",
                headers: ['X-Shopify-Access-Token: real_token'],
                response: $this->buildMockHttpResponse(200, $this->checkEventBridgeResponseExisting),
            ),
            new MockRequest(
                url: "https://$this->domain/admin/api/unstable/graphql.json",
                method: "POST",
                body: $this->registerUpdateEventBridgeQuery,
                userAgent: "Shopify Admin API Library for PHP v",
                headers: ['X-Shopify-Access-Token: real_token'],
                response: $this->buildMockHttpResponse(200, $this->registerUpdateEventBridgeResponse),
            ),
        ]);

        $response = Registry::register(
            shop: $this->domain,
            topic: Topics::APP_UNINSTALLED,
            path: '/test-webhooks',
            accessToken: 'real_token',
            deliveryMethod: Registry::DELIVERY_METHOD_EVENT_BRIDGE,
        );
        $this->assertTrue($response->isSuccess());
        $this->assertEquals($this->registerAddEventBridgeResponse, $response->getBody());

        $response = Registry::register(
            shop: $this->domain,
            topic: Topics::APP_UNINSTALLED,
            path: '/test-webhooks-updated',
            accessToken: 'real_token',
            deliveryMethod: Registry::DELIVERY_METHOD_EVENT_BRIDGE,
        );
        $this->assertTrue($response->isSuccess());
        $this->assertEquals($this->registerUpdateEventBridgeResponse, $response->getBody());
    }

    public function testCanRegisterAndUpdateLegacyWebhook()
    {
        Context::$API_VERSION = '2020-01';

        $this->mockTransportRequests([
            new MockRequest(
                url: "https://$this->domain/admin/api/2020-01/graphql.json",
                method: "POST",
                body: $this->legacyCheckQuery,
                userAgent: "Shopify Admin API Library for PHP v",
                headers: ['X-Shopify-Access-Token: real_token'],
                response: $this->buildMockHttpResponse(200, $this->legacyCheckResponseEmpty),
            ),
            new MockRequest(
                url: "https://$this->domain/admin/api/2020-01/graphql.json",
                method: "POST",
                body: $this->registerAddQuery,
                userAgent: "Shopify Admin API Library for PHP v",
                headers: ['X-Shopify-Access-Token: real_token'],
                response: $this->buildMockHttpResponse(200, $this->registerAddResponse),
            ),
            new MockRequest(
                url: "https://$this->domain/admin/api/2020-01/graphql.json",
                method: "POST",
                body: $this->legacyCheckQuery,
                userAgent: "Shopify Admin API Library for PHP v",
                headers: ['X-Shopify-Access-Token: real_token'],
                response: $this->buildMockHttpResponse(200, $this->legacyCheckResponseExisting),
            ),
            new MockRequest(
                url: "https://$this->domain/admin/api/2020-01/graphql.json",
                method: "POST",
                body: $this->registerUpdateQuery,
                userAgent: "Shopify Admin API Library for PHP v",
                headers: ['X-Shopify-Access-Token: real_token'],
                response: $this->buildMockHttpResponse(200, $this->registerUpdateResponse),
            ),
        ]);

        $response = Registry::register(
            shop: $this->domain,
            topic: Topics::APP_UNINSTALLED,
            path: '/test-webhooks',
            accessToken: 'real_token',
        );
        $this->assertTrue($response->isSuccess());
        $this->assertEquals($this->registerAddResponse, $response->getBody());

        $response = Registry::register(
            shop: $this->domain,
            topic: Topics::APP_UNINSTALLED,
            path: '/test-webhooks-updated',
            accessToken: 'real_token',
        );
        $this->assertTrue($response->isSuccess());
        $this->assertEquals($this->registerUpdateResponse, $response->getBody());
    }

    public function testSkipsUpdateIfCallbackIsTheSame()
    {
        $this->mockTransportRequests([
            new MockRequest(
                url: "https://$this->domain/admin/api/unstable/graphql.json",
                method: "POST",
                body: $this->checkQuery,
                userAgent: "Shopify Admin API Library for PHP v",
                headers: ['X-Shopify-Access-Token: real_token'],
                response: $this->buildMockHttpResponse(200, $this->checkResponseEmpty),
            ),
            new MockRequest(
                url: "https://$this->domain/admin/api/unstable/graphql.json",
                method: "POST",
                body: $this->registerAddQuery,
                userAgent: "Shopify Admin API Library for PHP v",
                headers: ['X-Shopify-Access-Token: real_token'],
                response: $this->buildMockHttpResponse(200, $this->registerAddResponse),
            ),
            new MockRequest(
                url: "https://$this->domain/admin/api/unstable/graphql.json",
                method: "POST",
                body: $this->checkQuery,
                userAgent: "Shopify Admin API Library for PHP v",
                headers: ['X-Shopify-Access-Token: real_token'],
                response: $this->buildMockHttpResponse(200, $this->checkResponseExisting),
            ),
        ]);

        $response = Registry::register(
            shop: $this->domain,
            topic: Topics::APP_UNINSTALLED,
            path: '/test-webhooks',
            accessToken: 'real_token',
        );
        $this->assertTrue($response->isSuccess());
        $this->assertEquals($this->registerAddResponse, $response->getBody());

        $response = Registry::register(
            shop: $this->domain,
            topic: Topics::APP_UNINSTALLED,
            path: '/test-webhooks',
            accessToken: 'real_token',
        );
        $this->assertTrue($response->isSuccess());
        $this->assertNull($response->getBody());
    }

    public function testCannotRegisterLegacyEventBridgeWebhook()
    {
        Context::$API_VERSION = '2020-01';

        $this->expectException(InvalidArgumentException::class);

        Registry::register(
            shop: $this->domain,
            topic: Topics::APP_UNINSTALLED,
            path: '/test-webhooks',
            accessToken: 'real_token',
            deliveryMethod: Registry::DELIVERY_METHOD_EVENT_BRIDGE,
        );
    }

    public function testCannotRegisterUnknownDeliveryMethod()
    {
        $this->expectException(InvalidArgumentException::class);

        Registry::register(
            shop: $this->domain,
            topic: Topics::APP_UNINSTALLED,
            path: '/test-webhooks',
            accessToken: 'real_token',
            deliveryMethod: 'NOT_A_REAL_METHOD',
        );
    }

    public function testThrowsOnRegistrationCheckError()
    {
        $this->mockTransportRequests([
            new MockRequest(
                url: "https://$this->domain/admin/api/unstable/graphql.json",
                method: "POST",
                body: $this->checkQuery,
                userAgent: "Shopify Admin API Library for PHP v",
                headers: ['X-Shopify-Access-Token: real_token'],
                response: $this->buildMockHttpResponse(403),
            ),
        ]);

        $this->expectException(WebhookRegistrationException::class);

        Registry::register(
            shop: $this->domain,
            topic: Topics::APP_UNINSTALLED,
            path: '/test-webhooks',
            accessToken: 'real_token',
        );
    }

    public function testThrowsOnRegistrationError()
    {
        $this->mockTransportRequests([
            new MockRequest(
                url: "https://$this->domain/admin/api/unstable/graphql.json",
                method: "POST",
                body: $this->checkQuery,
                userAgent: "Shopify Admin API Library for PHP v",
                headers: ['X-Shopify-Access-Token: real_token'],
                response: $this->buildMockHttpResponse(200, $this->checkResponseEmpty),
            ),
            new MockRequest(
                url: "https://$this->domain/admin/api/unstable/graphql.json",
                method: "POST",
                body: $this->registerAddQuery,
                userAgent: "Shopify Admin API Library for PHP v",
                headers: ['X-Shopify-Access-Token: real_token'],
                response: $this->buildMockHttpResponse(403),
            ),
        ]);

        $this->expectException(WebhookRegistrationException::class);

        Registry::register(
            shop: $this->domain,
            topic: Topics::APP_UNINSTALLED,
            path: '/test-webhooks',
            accessToken: 'real_token',
        );
    }

    public function testProcessWebhook()
    {
        $handler = $this->getMockHandler();
        $handler->expects($this->once())
            ->method('handle')
            ->with(
                Topics::PRODUCTS_UPDATE,
                'test-shop.myshopify.io',
                $this->processBody,
            );

        Registry::addHandler(Topics::PRODUCTS_UPDATE, $handler);

        $response = Registry::process($this->processHeaders, json_encode($this->processBody));
        $this->assertTrue($response->isSuccess());
        $this->assertNull($response->getErrorMessage());
    }

    public function testProcessWebhookWithHandlerErrors()
    {
        $handler = $this->getMockHandler();
        $handler->expects($this->once())
            ->method('handle')
            ->willThrowException(new \Exception('Something went wrong in the handler'));

        Registry::addHandler(Topics::PRODUCTS_UPDATE, $handler);

        $response = Registry::process($this->processHeaders, json_encode($this->processBody));
        $this->assertFalse($response->isSuccess());
        $this->assertEquals('Something went wrong in the handler', $response->getErrorMessage());
    }

    public function testProcessThrowsErrorOnMissingBody()
    {
        Registry::addHandler(Topics::PRODUCTS_UPDATE, $this->getMockHandler());

        $this->expectException(InvalidWebhookException::class);
        Registry::process($this->processHeaders, '');
    }

    public function testProcessThrowsErrorOnMissingHmac()
    {
        Registry::addHandler(Topics::PRODUCTS_UPDATE, $this->getMockHandler());

        $headers = $this->processHeaders;
        unset($headers[HttpHeaders::X_SHOPIFY_HMAC]);

        $this->expectException(InvalidWebhookException::class);
        Registry::process($headers, json_encode($this->processBody));
    }

    public function testProcessThrowsErrorOnMissingTopic()
    {
        Registry::addHandler(Topics::PRODUCTS_UPDATE, $this->getMockHandler());

        $headers = $this->processHeaders;
        unset($headers[HttpHeaders::X_SHOPIFY_TOPIC]);

        $this->expectException(InvalidWebhookException::class);
        Registry::process($headers, json_encode($this->processBody));
    }

    public function testProcessThrowsErrorOnMissingShop()
    {
        Registry::addHandler(Topics::PRODUCTS_UPDATE, $this->getMockHandler());

        $headers = $this->processHeaders;
        unset($headers[HttpHeaders::X_SHOPIFY_DOMAIN]);

        $this->expectException(InvalidWebhookException::class);
        Registry::process($headers, json_encode($this->processBody));
    }

    public function testProcessThrowsErrorOnInvalidHmac()
    {
        Registry::addHandler(Topics::PRODUCTS_UPDATE, $this->getMockHandler());

        $headers = $this->processHeaders;
        $headers[HttpHeaders::X_SHOPIFY_HMAC] = 'whoops_this_is_wrong';

        $this->expectException(InvalidWebhookException::class);
        Registry::process($headers, json_encode($this->processBody));
    }

    public function testProcessThrowsErrorOnMissingHandler()
    {
        $this->expectException(MissingWebhookHandlerException::class);
        Registry::process($this->processHeaders, json_encode($this->processBody));
    }

    /**
     * Creates a new mock handler to be used for testing.
     *
     * @return MockObject|Handler
     */
    private function getMockHandler(): MockObject | Handler
    {
        return $this->createMock(Handler::class);
    }

    private string $checkQuery = <<<QUERY
    {
        webhookSubscriptions(first: 1, topics: APP_UNINSTALLED) {
            edges {
                node {
                    id
                    endpoint {
                        __typename
                        ... on WebhookHttpEndpoint {
                            callbackUrl
                        }
                        ... on WebhookEventBridgeEndpoint {
                            arn
                        }
                    }
                }
            }
        }
    }
    QUERY;

    private array $checkResponseEmpty = [
        'data' => [
            'webhookSubscriptions' => [
                'edges' => [],
            ],
        ],
    ];

    private array $checkResponseExisting = [
        'data' => [
            'webhookSubscriptions' => [
                'edges' => [
                    [
                        'node' => [
                            'id' => 'test_webhook_1',
                            'endpoint' => [
                                '__typename' => 'WebhookHttpEndpoint',
                                'callbackUrl' => 'https://www.my-friends-cats.com/test-webhooks',
                            ],
                        ],
                    ]
                ],
            ],
        ],
    ];

    private array $checkEventBridgeResponseExisting = [
        'data' => [
            'webhookSubscriptions' => [
                'edges' => [
                    [
                        'node' => [
                            'id' => 'test_webhook_1',
                            'endpoint' => [
                                '__typename' => 'WebhookEventBridgeEndpoint',
                                'arn' => '/test-webhooks',
                            ],
                        ],
                    ]
                ],
            ],
        ],
    ];

    private string $legacyCheckQuery = <<<QUERY
    {
        webhookSubscriptions(first: 1, topics: APP_UNINSTALLED) {
            edges {
                node {
                    id
                    callbackUrl
                }
            }
        }
    }
    QUERY;

    private array $legacyCheckResponseEmpty = [
        'data' => [
            'webhookSubscriptions' => [
                'edges' => [],
            ],
        ],
    ];

    private array $legacyCheckResponseExisting = [
        'data' => [
            'webhookSubscriptions' => [
                'edges' => [
                    [
                        'node' => [
                            'id' => 'test_webhook_1',
                            'callbackUrl' => '',
                        ],
                    ]
                ],
            ],
        ],
    ];

    // phpcs:disable
    private string $registerAddQuery = <<<QUERY
    mutation webhookSubscription {
        webhookSubscriptionCreate(topic: APP_UNINSTALLED, webhookSubscription: {callbackUrl: "https://www.my-friends-cats.com/test-webhooks"}) {
            userErrors {
                field
                message
            }
            webhookSubscription {
                id
            }
        }
    }
    QUERY;
    // phpcs:enable

    private array $registerAddResponse = [
        'data' => [
            'webhookSubscriptionCreate' => [
                "userErrors" => [],
                "webhookSubscription" => [
                    "id" => "webhook_1",
                ],
            ],
        ],
    ];

    // phpcs:disable
    private string $registerUpdateQuery = <<<QUERY
    mutation webhookSubscription {
        webhookSubscriptionUpdate(id: "test_webhook_1", webhookSubscription: {callbackUrl: "https://www.my-friends-cats.com/test-webhooks-updated"}) {
            userErrors {
                field
                message
            }
            webhookSubscription {
                id
            }
        }
    }
    QUERY;
    // phpcs:enable

    private array $registerUpdateResponse = [
        'data' => [
            'webhookSubscriptionUpdate' => [
                "userErrors" => [],
                "webhookSubscription" => [
                    "id" => "webhook_1",
                ],
            ],
        ],
    ];

    private string $registerAddEventBridgeQuery = <<<QUERY
    mutation webhookSubscription {
        eventBridgeWebhookSubscriptionCreate(topic: APP_UNINSTALLED, webhookSubscription: {arn: "/test-webhooks"}) {
            userErrors {
                field
                message
            }
            webhookSubscription {
                id
            }
        }
    }
    QUERY;

    private array $registerAddEventBridgeResponse = [
        'data' => [
            'eventBridgeWebhookSubscriptionCreate' => [
                "userErrors" => [],
                "webhookSubscription" => [
                    "id" => "webhook_1",
                ],
            ],
        ],
    ];

    // phpcs:disable
    private string $registerUpdateEventBridgeQuery = <<<QUERY
    mutation webhookSubscription {
        eventBridgeWebhookSubscriptionUpdate(id: "test_webhook_1", webhookSubscription: {arn: "/test-webhooks-updated"}) {
            userErrors {
                field
                message
            }
            webhookSubscription {
                id
            }
        }
    }
    QUERY;
    // phpcs:enable

    private array $registerUpdateEventBridgeResponse = [
        'data' => [
            'eventBridgeWebhookSubscriptionUpdate' => [
                "userErrors" => [],
                "webhookSubscription" => [
                    "id" => "webhook_1",
                ],
            ],
        ],
    ];

    private array $processHeaders = [
        HttpHeaders::X_SHOPIFY_HMAC => '/Redz4YXHLnSmmSN8grr5/Jl/Ua3d7yX3iWbjb8R8wo=',
        HttpHeaders::X_SHOPIFY_TOPIC => Topics::PRODUCTS_UPDATE,
        HttpHeaders::X_SHOPIFY_DOMAIN => 'test-shop.myshopify.io',
    ];

    private array $processBody = [
        'foo' => 'bar',
    ];
}
