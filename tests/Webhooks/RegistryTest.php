<?php

declare(strict_types=1);

namespace ShopifyTest\Webhooks;

use Exception;
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
        $property = $reflection->getProperty('REGISTRY');
        $property->setAccessible(true);
        $property = $property->setValue([]);
    }

    public function testAddHandler()
    {
        $handler = $this->getMockHandler();
        Registry::addHandler(Topics::APP_UNINSTALLED, $handler);

        $this->assertSame($handler, Registry::getHandler(Topics::APP_UNINSTALLED));
    }

    public function testAddHandlerToExistingRegistry()
    {
        $handler = $this->getMockHandler();
        Registry::addHandler(Topics::APP_UNINSTALLED, $handler);

        $this->assertSame($handler, Registry::getHandler(Topics::APP_UNINSTALLED));

        // Now add a second webhook for a different topic
        $handler = $this->getMockHandler();
        Registry::addHandler(Topics::PRODUCTS_CREATE, $handler);

        $this->assertSame($handler, Registry::getHandler(Topics::PRODUCTS_CREATE));
    }

    public function testAddHandlerOverridesRegistry()
    {
        $handler = $this->getMockHandler();
        Registry::addHandler(Topics::APP_UNINSTALLED, $handler);

        $this->assertSame($handler, Registry::getHandler(Topics::APP_UNINSTALLED));

        // Now add a second handler for the same topic
        $handler = $this->getMockHandler();
        Registry::addHandler(Topics::APP_UNINSTALLED, $handler);

        $this->assertSame($handler, Registry::getHandler(Topics::APP_UNINSTALLED));
    }

    public function testCanRegisterAndUpdateWebhook()
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, $this->checkResponseEmpty),
                "https://$this->domain/admin/api/" . Context::$API_VERSION . "/graphql.json",
                "POST",
                "Shopify Admin API Library for PHP v",
                ['X-Shopify-Access-Token: real_token'],
                $this->httpCheckQuery,
            ),
            new MockRequest(
                $this->buildMockHttpResponse(200, $this->registerAddResponse),
                "https://$this->domain/admin/api/" . Context::$API_VERSION . "/graphql.json",
                "POST",
                "Shopify Admin API Library for PHP v",
                ['X-Shopify-Access-Token: real_token'],
                $this->registerAddQuery,
            ),
            new MockRequest(
                $this->buildMockHttpResponse(200, $this->checkResponseExisting),
                "https://$this->domain/admin/api/" . Context::$API_VERSION . "/graphql.json",
                "POST",
                "Shopify Admin API Library for PHP v",
                ['X-Shopify-Access-Token: real_token'],
                $this->httpCheckQuery,
            ),
            new MockRequest(
                $this->buildMockHttpResponse(200, $this->registerUpdateResponse),
                "https://$this->domain/admin/api/" . Context::$API_VERSION . "/graphql.json",
                "POST",
                "Shopify Admin API Library for PHP v",
                ['X-Shopify-Access-Token: real_token'],
                $this->registerUpdateQuery,
            ),
        ]);

        $response = Registry::register('/test-webhooks', Topics::APP_UNINSTALLED, $this->domain, 'real_token');
        $this->assertTrue($response->isSuccess());
        $this->assertEquals($this->registerAddResponse, $response->getBody());

        $response = Registry::register('/test-webhooks-updated', Topics::APP_UNINSTALLED, $this->domain, 'real_token');
        $this->assertTrue($response->isSuccess());
        $this->assertEquals($this->registerUpdateResponse, $response->getBody());
    }

    public function testCanRegisterAndUpdateEventBridgeWebhook()
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, $this->checkResponseEmpty),
                "https://$this->domain/admin/api/" . Context::$API_VERSION . "/graphql.json",
                "POST",
                "Shopify Admin API Library for PHP v",
                ['X-Shopify-Access-Token: real_token'],
                $this->eventBridgeCheckQuery,
            ),
            new MockRequest(
                $this->buildMockHttpResponse(200, $this->registerAddEventBridgeResponse),
                "https://$this->domain/admin/api/" . Context::$API_VERSION . "/graphql.json",
                "POST",
                "Shopify Admin API Library for PHP v",
                ['X-Shopify-Access-Token: real_token'],
                $this->registerAddEventBridgeQuery,
            ),
            new MockRequest(
                $this->buildMockHttpResponse(200, $this->checkEventBridgeResponseExisting),
                "https://$this->domain/admin/api/" . Context::$API_VERSION . "/graphql.json",
                "POST",
                "Shopify Admin API Library for PHP v",
                ['X-Shopify-Access-Token: real_token'],
                $this->eventBridgeCheckQuery,
            ),
            new MockRequest(
                $this->buildMockHttpResponse(200, $this->registerUpdateEventBridgeResponse),
                "https://$this->domain/admin/api/" . Context::$API_VERSION . "/graphql.json",
                "POST",
                "Shopify Admin API Library for PHP v",
                ['X-Shopify-Access-Token: real_token'],
                $this->registerUpdateEventBridgeQuery,
            ),
        ]);

        $response = Registry::register(
            '/test-webhooks',
            Topics::APP_UNINSTALLED,
            $this->domain,
            'real_token',
            Registry::DELIVERY_METHOD_EVENT_BRIDGE,
        );
        $this->assertTrue($response->isSuccess());
        $this->assertEquals($this->registerAddEventBridgeResponse, $response->getBody());

        $response = Registry::register(
            '/test-webhooks-updated',
            Topics::APP_UNINSTALLED,
            $this->domain,
            'real_token',
            Registry::DELIVERY_METHOD_EVENT_BRIDGE,
        );
        $this->assertTrue($response->isSuccess());
        $this->assertEquals($this->registerUpdateEventBridgeResponse, $response->getBody());
    }

    public function testCanRegisterAndUpdatePubSubWebhook()
    {
        $this->mockTransportRequests(
            [
                new MockRequest(
                    $this->buildMockHttpResponse(200, $this->checkResponseEmpty),
                    "https://$this->domain/admin/api/" . Context::$API_VERSION . "/graphql.json",
                    "POST",
                    "Shopify Admin API Library for PHP v",
                    ['X-Shopify-Access-Token: real_token'],
                    $this->pubSubCheckQuery,
                ),
                new MockRequest(
                    $this->buildMockHttpResponse(200, $this->registerPubSubResponse),
                    "https://$this->domain/admin/api/" . Context::$API_VERSION . "/graphql.json",
                    "POST",
                    "Shopify Admin API Library for PHP v",
                    ['X-Shopify-Access-Token: real_token'],
                    $this->registerPubSubQuery,
                ),
                new MockRequest(
                    $this->buildMockHttpResponse(200, $this->pubSubWebhookCheckResponse),
                    "https://$this->domain/admin/api/" . Context::$API_VERSION . "/graphql.json",
                    "POST",
                    "Shopify Admin API Library for PHP v",
                    ['X-Shopify-Access-Token: real_token'],
                    $this->pubSubCheckQuery,
                ),
                new MockRequest(
                    $this->buildMockHttpResponse(200, $this->registerUpdatePubSubResponse),
                    "https://$this->domain/admin/api/" . Context::$API_VERSION . "/graphql.json",
                    "POST",
                    "Shopify Admin API Library for PHP v",
                    ['X-Shopify-Access-Token: real_token'],
                    $this->registerUpdatePubSubQuery,
                ),
            ]
        );

        $response = Registry::register(
            'pubsub://my-project-id:my-topic-id',
            Topics::APP_UNINSTALLED,
            $this->domain,
            'real_token',
            Registry::DELIVERY_METHOD_PUB_SUB,
        );
        $this->assertTrue($response->isSuccess());
        $this->assertEquals($this->registerPubSubResponse, $response->getBody());

        $response = Registry::register(
            'pubsub://my-project-id:my-topic-id-updated',
            Topics::APP_UNINSTALLED,
            $this->domain,
            'real_token',
            Registry::DELIVERY_METHOD_PUB_SUB,
        );
        $this->assertTrue($response->isSuccess());
        $this->assertEquals($this->registerUpdatePubSubResponse, $response->getBody());
    }

    public function testCanRegisterAndUpdateLegacyWebhook()
    {
        Context::$API_VERSION = '2020-01';

        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, $this->legacyCheckResponseEmpty),
                "https://$this->domain/admin/api/2020-01/graphql.json",
                "POST",
                "Shopify Admin API Library for PHP v",
                ['X-Shopify-Access-Token: real_token'],
                $this->legacyCheckQuery,
            ),
            new MockRequest(
                $this->buildMockHttpResponse(200, $this->registerAddResponse),
                "https://$this->domain/admin/api/2020-01/graphql.json",
                "POST",
                "Shopify Admin API Library for PHP v",
                ['X-Shopify-Access-Token: real_token'],
                $this->registerAddQuery,
            ),
            new MockRequest(
                $this->buildMockHttpResponse(200, $this->legacyCheckResponseExisting),
                "https://$this->domain/admin/api/2020-01/graphql.json",
                "POST",
                "Shopify Admin API Library for PHP v",
                ['X-Shopify-Access-Token: real_token'],
                $this->legacyCheckQuery,
            ),
            new MockRequest(
                $this->buildMockHttpResponse(200, $this->registerUpdateResponse),
                "https://$this->domain/admin/api/2020-01/graphql.json",
                "POST",
                "Shopify Admin API Library for PHP v",
                ['X-Shopify-Access-Token: real_token'],
                $this->registerUpdateQuery,
            ),
        ]);

        $response = Registry::register('/test-webhooks', Topics::APP_UNINSTALLED, $this->domain, 'real_token');
        $this->assertTrue($response->isSuccess());
        $this->assertEquals($this->registerAddResponse, $response->getBody());

        $response = Registry::register('/test-webhooks-updated', Topics::APP_UNINSTALLED, $this->domain, 'real_token');
        $this->assertTrue($response->isSuccess());
        $this->assertEquals($this->registerUpdateResponse, $response->getBody());
    }

    public function testSkipsUpdateIfCallbackIsTheSame()
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, $this->checkResponseEmpty),
                "https://$this->domain/admin/api/" . Context::$API_VERSION . "/graphql.json",
                "POST",
                "Shopify Admin API Library for PHP v",
                ['X-Shopify-Access-Token: real_token'],
                $this->httpCheckQuery,
            ),
            new MockRequest(
                $this->buildMockHttpResponse(200, $this->registerAddResponse),
                "https://$this->domain/admin/api/" . Context::$API_VERSION . "/graphql.json",
                "POST",
                "Shopify Admin API Library for PHP v",
                ['X-Shopify-Access-Token: real_token'],
                $this->registerAddQuery,
            ),
            new MockRequest(
                $this->buildMockHttpResponse(200, $this->checkResponseExisting),
                "https://$this->domain/admin/api/" . Context::$API_VERSION . "/graphql.json",
                "POST",
                "Shopify Admin API Library for PHP v",
                ['X-Shopify-Access-Token: real_token'],
                $this->httpCheckQuery,
            ),
        ]);

        $response = Registry::register('/test-webhooks', Topics::APP_UNINSTALLED, $this->domain, 'real_token');
        $this->assertTrue($response->isSuccess());
        $this->assertEquals($this->registerAddResponse, $response->getBody());

        $response = Registry::register('/test-webhooks', Topics::APP_UNINSTALLED, $this->domain, 'real_token');
        $this->assertTrue($response->isSuccess());
        $this->assertNull($response->getBody());
    }

    public function testCannotRegisterLegacyEventBridgeWebhook()
    {
        Context::$API_VERSION = '2020-01';

        $this->expectException(InvalidArgumentException::class);

        Registry::register(
            '/test-webhooks',
            Topics::APP_UNINSTALLED,
            $this->domain,
            'real_token',
            Registry::DELIVERY_METHOD_EVENT_BRIDGE,
        );
    }

    public function testCannotRegisterUnknownDeliveryMethod()
    {
        $this->expectException(InvalidArgumentException::class);

        Registry::register(
            '/test-webhooks',
            Topics::APP_UNINSTALLED,
            $this->domain,
            'real_token',
            'NOT_A_REAL_METHOD',
        );
    }

    public function testThrowsOnRegistrationCheckError()
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(403),
                "https://$this->domain/admin/api/" . Context::$API_VERSION . "/graphql.json",
                "POST",
                "Shopify Admin API Library for PHP v",
                ['X-Shopify-Access-Token: real_token'],
                $this->httpCheckQuery,
            ),
        ]);

        $this->expectException(WebhookRegistrationException::class);

        Registry::register('/test-webhooks', Topics::APP_UNINSTALLED, $this->domain, 'real_token');
    }

    public function testThrowsOnRegistrationError()
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, $this->checkResponseEmpty),
                "https://$this->domain/admin/api/" . Context::$API_VERSION . "/graphql.json",
                "POST",
                "Shopify Admin API Library for PHP v",
                ['X-Shopify-Access-Token: real_token'],
                $this->httpCheckQuery,
            ),
            new MockRequest(
                $this->buildMockHttpResponse(403),
                "https://$this->domain/admin/api/" . Context::$API_VERSION . "/graphql.json",
                "POST",
                "Shopify Admin API Library for PHP v",
                ['X-Shopify-Access-Token: real_token'],
                $this->registerAddQuery,
            ),
        ]);

        $this->expectException(WebhookRegistrationException::class);

        Registry::register('/test-webhooks', Topics::APP_UNINSTALLED, $this->domain, 'real_token');
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
            ->willThrowException(new Exception('Something went wrong in the handler'));

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
    private function getMockHandler()
    {
        return $this->createMock(Handler::class);
    }

    /** @var string */
    private $httpCheckQuery = <<<QUERY
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
                    }
                }
            }
        }
    }
    QUERY;

    /** @var string */
    private $eventBridgeCheckQuery = <<<QUERY
    {
        webhookSubscriptions(first: 1, topics: APP_UNINSTALLED) {
            edges {
                node {
                    id
                    endpoint {
                        __typename
                        ... on WebhookEventBridgeEndpoint {
                            arn
                        }
                    }
                }
            }
        }
    }
    QUERY;

    /** @var string */
    private $pubSubCheckQuery = <<<QUERY
    {
        webhookSubscriptions(first: 1, topics: APP_UNINSTALLED) {
            edges {
                node {
                    id
                    endpoint {
                        __typename
                        ... on WebhookPubSubEndpoint {
                            pubSubProject
                            pubSubTopic
                        }
                    }
                }
            }
        }
    }
    QUERY;

    /** @var array */
    private $checkResponseEmpty = [
        'data' => [
            'webhookSubscriptions' => [
                'edges' => [],
            ],
        ],
    ];

    /** @var array */
    private $checkResponseExisting = [
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

    /** @var array */
    private $checkEventBridgeResponseExisting = [
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

    /** @var string */
    private $legacyCheckQuery = <<<QUERY
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

    /** @var array */
    private $legacyCheckResponseEmpty = [
        'data' => [
            'webhookSubscriptions' => [
                'edges' => [],
            ],
        ],
    ];

    /** @var array */
    private $legacyCheckResponseExisting = [
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
    /** @var string */
    private $registerAddQuery = <<<QUERY
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

    /** @var array */
    private $registerAddResponse = [
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
    /** @var string */
    private $registerUpdateQuery = <<<QUERY
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

    /** @var array */
    private $registerUpdateResponse = [
        'data' => [
            'webhookSubscriptionUpdate' => [
                "userErrors" => [],
                "webhookSubscription" => [
                    "id" => "webhook_1",
                ],
            ],
        ],
    ];

    /** @var string */
    private $registerAddEventBridgeQuery = <<<QUERY
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

    /** @var array */
    private $registerAddEventBridgeResponse = [
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
    /** @var string */
    private $registerUpdateEventBridgeQuery = <<<QUERY
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

    /** @var array */
    private $registerUpdateEventBridgeResponse = [
        'data' => [
            'eventBridgeWebhookSubscriptionUpdate' => [
                "userErrors" => [],
                "webhookSubscription" => [
                    "id" => "webhook_1",
                ],
            ],
        ],
    ];

    // phpcs:disable
    /** @var string */
    private $registerPubSubQuery = <<<QUERY
    mutation webhookSubscription {
        pubSubWebhookSubscriptionCreate(topic: APP_UNINSTALLED, webhookSubscription: {pubSubProject: "my-project-id", pubSubTopic: "my-topic-id"}) {
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

    /** @var array */
    private $registerPubSubResponse = [
        'data' => [
            'pubSubWebhookSubscriptionCreate' => [
                "userErrors" => [],
                "webhookSubscription" => [
                    "id" => "webhook_1",
                ],
            ],
        ],
    ];

    /** @var array */
    private $pubSubWebhookCheckResponse = [
        'data' => [
            'webhookSubscriptions' => [
                'edges' => [
                    [
                        'node' => [
                            'id' => 'test_webhook_1',
                            'endpoint' => [
                                '__typename' => 'WebhookPubSubEndpoint',
                                'pubSubProject' => 'my-project-id',
                                'pubSubTopic' => 'my-topic-id',
                            ],
                        ],
                    ]
                ],
            ],
        ],
    ];

    /** @var array */
    private $registerUpdatePubSubResponse = [
        'data' => [
            'pubSubWebhookSubscriptionUpdate' => [
                "userErrors" => [],
                "webhookSubscription" => [
                    "id" => "webhook_1",
                ],
            ],
        ],
    ];

    // phpcs:disable
    /** @var string */
    private $registerUpdatePubSubQuery = <<<QUERY
    mutation webhookSubscription {
        pubSubWebhookSubscriptionUpdate(id: "test_webhook_1", webhookSubscription: {pubSubProject: "my-project-id", pubSubTopic: "my-topic-id-updated"}) {
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

    /** @var array */
    private $processHeaders = [
        HttpHeaders::X_SHOPIFY_HMAC => '/Redz4YXHLnSmmSN8grr5/Jl/Ua3d7yX3iWbjb8R8wo=',
        HttpHeaders::X_SHOPIFY_TOPIC => Topics::PRODUCTS_UPDATE,
        HttpHeaders::X_SHOPIFY_DOMAIN => 'test-shop.myshopify.io',
    ];

    /** @var array */
    private $processBody = [
        'foo' => 'bar',
    ];
}
