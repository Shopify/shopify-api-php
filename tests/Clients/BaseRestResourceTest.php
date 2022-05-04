<?php

declare(strict_types=1);

namespace ShopifyTest\Clients;

use Shopify\Auth\Session;
use Shopify\Context;
use Shopify\Exception\RestResourceException;
use Shopify\Exception\RestResourceRequestException;
use ShopifyTest\BaseTestCase;

final class BaseRestResourceTest extends BaseTestCase
{
    use PaginationTestHelper;

    private ?Session $session = null;
    private string $prefix = "https://test-shop.myshopify.io/admin/api/unstable";

    public function setUp(): void
    {
        parent::setUp();

        Context::$API_VERSION = "unstable";

        $this->session = new Session("1234", "test-shop.myshopify.io", true, "1234");
        $this->session->setAccessToken("access-token");
    }

    public function testFindsResourceById()
    {
        $body = ["fake_resource" => ["id" => 1, "attribute" => "attribute"]];

        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, $body),
                "{$this->prefix}/fake_resources/1.json",
                "GET",
                null,
                ["X-Shopify-Access-Token: access-token"],
            ),
        ]);

        $resource = FakeResource::find($this->session, 1);
        $this->assertEquals([1, "attribute"], [$resource->id, $resource->attribute]);
    }

    public function testFindsWithParam()
    {
        $body = ["fake_resource" => ["id" => 1, "attribute" => "attribute"]];

        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, $body),
                "{$this->prefix}/fake_resources/1.json?param=value",
                "GET",
                null,
                ["X-Shopify-Access-Token: access-token"],
            ),
        ]);

        $resource = FakeResource::find($this->session, 1, ["param" => "value"]);
        $this->assertEquals([1, "attribute"], [$resource->id, $resource->attribute]);
    }

    public function testFindsResourceAndChildrenById()
    {
        $body = ["fake_resource" => [
            "id" => 1,
            "attribute" => "attribute1",
            "has_one_attribute" => ["id" => 2, "attribute" => "attribute2"],
            "has_many_attribute" => [
                ["id" => 3, "attribute" => "attribute3"],
            ],
        ]];

        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, $body),
                "{$this->prefix}/fake_resources/1.json",
                "GET",
                null,
                ["X-Shopify-Access-Token: access-token"],
            ),
        ]);

        $resource = FakeResource::find($this->session, 1);
        $this->assertEquals([1, "attribute1"], [$resource->id, $resource->attribute]);
        $this->assertEquals(
            [2, "attribute2"],
            [$resource->has_one_attribute->id, $resource->has_one_attribute->attribute]
        );
        $this->assertEquals(
            [3, "attribute3"],
            [$resource->has_many_attribute[0]->id, $resource->has_many_attribute[0]->attribute]
        );
    }

    public function testFindsResourceWithEmptyChildren()
    {
        $body = ["fake_resource" => [
            "id" => 1,
            "attribute" => "attribute1",
            "has_one_attribute" => null,
            "has_many_attribute" => null,
        ]];

        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, $body),
                "{$this->prefix}/fake_resources/1.json",
                "GET",
                null,
                ["X-Shopify-Access-Token: access-token"],
            ),
        ]);

        $resource = FakeResource::find($this->session, 1);
        $this->assertEquals([1, "attribute1"], [$resource->id, $resource->attribute]);
        $this->assertNull($resource->has_one_attribute);
        $this->assertEmpty($resource->has_many_attribute);
    }

    public function testFailsOnFindingNonexistentResourceById()
    {
        $body = ["errors" => "Not found"];

        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(404, $body),
                "{$this->prefix}/fake_resources/1.json",
                "GET",
                null,
                ["X-Shopify-Access-Token: access-token"],
            ),
        ]);

        $this->expectException(RestResourceRequestException::class);
        FakeResource::find($this->session, 1);
    }

    public function testFindsAllResources()
    {
        $body = ["fake_resources" => [
            ["id" => 1, "attribute" => "attribute1"],
            ["id" => 2, "attribute" => "attribute2"],
        ]];

        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, $body),
                "{$this->prefix}/fake_resources.json",
                "GET",
                null,
                ["X-Shopify-Access-Token: access-token"],
            ),
        ]);

        $resources = FakeResource::all($this->session);
        $this->assertEquals([1, "attribute1"], [$resources[0]->id, $resources[0]->attribute]);
        $this->assertEquals([2, "attribute2"], [$resources[1]->id, $resources[1]->attribute]);
    }

    public function testSaves()
    {
        $requestBody = ["fake_resource" => ["attribute" => "attribute"]];
        $responseBody = ["fake_resource" => ["id" => 1, "attribute" => "attribute"]];

        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, $responseBody),
                "{$this->prefix}/fake_resources.json",
                "POST",
                null,
                ["X-Shopify-Access-Token: access-token"],
                json_encode($requestBody)
            ),
        ]);

        $resource = new FakeResource($this->session);
        $resource->attribute = "attribute";

        $resource->save();
        $this->assertNull($resource->id);
    }

    public function testSavesAndUpdates()
    {
        $requestBody = ["fake_resource" => ["attribute" => "attribute"]];
        $responseBody = ["fake_resource" => ["id" => 1, "attribute" => "attribute"]];

        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, $responseBody),
                "{$this->prefix}/fake_resources.json",
                "POST",
                null,
                ["X-Shopify-Access-Token: access-token"],
                json_encode($requestBody)
            ),
        ]);

        $resource = new FakeResource($this->session);
        $resource->attribute = "attribute";

        $resource->saveAndUpdate();
        $this->assertEquals(1, $resource->id);
    }

    public function testSavesExistingResource()
    {
        $requestBody = ["fake_resource" => ["id" => 1, "attribute" => "attribute"]];
        $responseBody = ["fake_resource" => ["id" => 1, "attribute" => "attribute"]];

        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, $responseBody),
                "{$this->prefix}/fake_resources/1.json",
                "PUT",
                null,
                ["X-Shopify-Access-Token: access-token"],
                json_encode($requestBody)
            ),
        ]);

        $resource = new FakeResource($this->session);
        $resource->id = 1;
        $resource->attribute = "attribute";

        $resource->save();
    }

    public function testSavesWithChildren()
    {
        $requestBody = ["fake_resource" => [
            "id" => 1,
            "has_one_attribute" => ["attribute" => "attribute1"],
            "has_many_attribute" => [["attribute" => "attribute2"],["attribute" => "attribute3"]],
        ]];
        $responseBody = ["fake_resource" => ["id" => 1, "attribute" => "attribute"]];

        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, $responseBody),
                "{$this->prefix}/fake_resources/1.json",
                "PUT",
                null,
                ["X-Shopify-Access-Token: access-token"],
                json_encode($requestBody)
            ),
        ]);

        $child1 = new FakeResource($this->session);
        $child1->attribute = "attribute1";

        $child2 = new FakeResource($this->session);
        $child2->attribute = "attribute2";

        $child3 = new FakeResource($this->session);
        $child3->attribute = "attribute3";

        $resource = new FakeResource($this->session);
        $resource->id = 1;
        $resource->has_one_attribute = $child1;
        $resource->has_many_attribute = [$child2, $child3];

        $resource->save();
    }

    public function testLoadsUnknownAttribute()
    {
        $body = ["fake_resource" => ["attribute" => "value", "unknown?" => "some-value"]];

        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode($body)),
                "{$this->prefix}/fake_resources/1.json",
                "GET",
                null,
                ["X-Shopify-Access-Token: access-token"],
            ),
        ]);

        $resource = FakeResource::find($this->session, 1);

        $this->assertEquals("value", $resource->attribute);
        $this->assertEquals("some-value", $resource->{"unknown?"});
        $this->assertEquals("some-value", $resource->toArray()["unknown?"]);
    }

    public function testSavesWithUnknownAttribute()
    {
        $body = ["fake_resource" => ["unknown" => "some-value"]];

        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, ""),
                "{$this->prefix}/fake_resources.json",
                "POST",
                null,
                ["X-Shopify-Access-Token: access-token"],
                json_encode($body)
            ),
        ]);

        $resource = new FakeResource($this->session);
        $resource->unknown = "some-value";

        $resource->save();
    }

    public function testSavesWithForcedNullValue()
    {
        $body = ["fake_resource" => ["id" => 1, "has_one_attribute" => null]];

        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, ""),
                "{$this->prefix}/fake_resources/1.json",
                "PUT",
                null,
                ["X-Shopify-Access-Token: access-token"],
                json_encode($body)
            ),
        ]);

        $resource = new FakeResource($this->session);
        $resource->id = 1;
        $resource->has_one_attribute = null;

        $resource->save();
    }

    public function testIgnoresUnsaveableAttribute()
    {
        $requestBody = ["fake_resource" => ["attribute" => "attribute"]];
        $responseBody = ["fake_resource" => ["id" => 1, "attribute" => "attribute"]];

        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, $responseBody),
                "{$this->prefix}/fake_resources.json",
                "POST",
                null,
                ["X-Shopify-Access-Token: access-token"],
                json_encode($requestBody),
                null,
                true,
                false,
                true
            ),
        ]);

        $resource = new FakeResource($this->session);
        $resource->attribute = "attribute";
        $resource->unsaveable_attribute = "unsaveable_attribute";

        $resource->save();
        $this->assertNull($resource->id);
    }

    public function toArrayIncludesReadOnlyAttributes()
    {
        $resource = new FakeResource($this->session);
        $resource->attribute = "attribute";
        $resource->unsaveable_attribute = "unsaveable_attribute";

        $array = $resource->toArray();
        $this->assertEquals("attribute", $array["attribute"]);
        $this->assertEquals("unsaveable_attribute", $array["unsaveable_attribute"]);
    }

    public function toArrayExcludesReadOnlyAttributesWithSavingArgEqualTrue()
    {
        $resource = new FakeResource($this->session);
        $resource->attribute = "attribute";
        $resource->unsaveable_attribute = "unsaveable_attribute";

        $array = $resource->toArray(true);
        $this->assertEquals("attribute", $array["attribute"]);
        $this->assertArrayNotHasKey("unsaveable_attribute", $array);
    }

    public function testDeletesExistingResource()
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, ""),
                "{$this->prefix}/fake_resources/1.json",
                "DELETE",
                null,
                ["X-Shopify-Access-Token: access-token"],
            ),
        ]);

        FakeResource::delete($this->session, 1);
    }

    public function testDeletesOtherResource()
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, ""),
                "{$this->prefix}/other_resources/2/fake_resources/1.json",
                "DELETE",
                null,
                ["X-Shopify-Access-Token: access-token"],
            ),
        ]);

        FakeResource::delete($this->session, 1, array("other_resource_id" => 2));
    }

    public function testFailsDeletingNonexistentResource()
    {
        $body = ["errors" => "Not found"];

        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(404, $body),
                "{$this->prefix}/fake_resources/2.json",
                "DELETE",
                null,
                ["X-Shopify-Access-Token: access-token"],
            ),
        ]);

        $this->expectException(RestResourceRequestException::class);
        FakeResource::delete($this->session, 2);
    }

    public function testMakesCustomRequests()
    {
        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode(["test body"])),
                "{$this->prefix}/other_resources/2/fake_resources/1/custom.json",
                "GET",
                null,
                ["X-Shopify-Access-Token: access-token"],
            ),
        ]);

        $response = FakeResource::custom($this->session, 1, array("other_resource_id" => 2));
        $this->assertEquals(["test body"], $response);
    }

    public function testPagination()
    {
        $body = ["fake_resources" => []];

        $firstPaginationHeader = $this->getProductsLinkHeader(null, "page-info");
        $secondPaginationHeader = $this->getProductsLinkHeader("page-info2", null);

        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(
                    200,
                    json_encode($body),
                    ["Link" => $firstPaginationHeader]
                ),
                "{$this->prefix}/fake_resources.json",
                "GET",
                null,
                ["X-Shopify-Access-Token: access-token"],
            ),
            new MockRequest(
                $this->buildMockHttpResponse(
                    200,
                    json_encode($body),
                    ["Link" => $secondPaginationHeader]
                ),
                "{$this->prefix}/fake_resources.json?limit=10&fields=test1%2Ctest2&page_info=page-info",
                "GET",
                null,
                ["X-Shopify-Access-Token: access-token"],
            ),
            new MockRequest(
                $this->buildMockHttpResponse(200, json_encode($body)),
                "{$this->prefix}/fake_resources.json?limit=10&fields=test1%2Ctest2&page_info=page-info2",
                "GET",
                null,
                ["X-Shopify-Access-Token: access-token"],
            ),
        ]);

        FakeResource::all($this->session);
        $this->assertEquals(
            ["page_info" => "page-info", "limit" => "10", "fields" => "test1,test2"],
            FakeResource::$NEXT_PAGE_QUERY
        );
        $this->assertNull(FakeResource::$PREV_PAGE_QUERY);

        FakeResource::all($this->session, FakeResource::$NEXT_PAGE_QUERY);
        $this->assertNull(FakeResource::$NEXT_PAGE_QUERY);
        $this->assertEquals(
            ["page_info" => "page-info2", "limit" => "10", "fields" => "test1,test2"],
            FakeResource::$PREV_PAGE_QUERY
        );

        FakeResource::all($this->session, FakeResource::$PREV_PAGE_QUERY);
        $this->assertNull(FakeResource::$NEXT_PAGE_QUERY);
        $this->assertNull(FakeResource::$PREV_PAGE_QUERY);
    }

    public function testAllowsCustomPrefixes()
    {
        $body = ["fake_resource_with_custom_prefix" => ["id" => 1, "attribute" => "attribute"]];

        $this->mockTransportRequests([
            new MockRequest(
                $this->buildMockHttpResponse(200, $body),
                "https://test-shop.myshopify.io/admin/custom_prefix/fake_resource_with_custom_prefix/1.json",
                "GET",
                null,
                ["X-Shopify-Access-Token: access-token"],
            ),
        ]);

        $resource = FakeResourceWithCustomPrefix::find($this->session, 1);
        $this->assertEquals([1, "attribute"], [$resource->id, $resource->attribute]);
    }

    public function testThrowsOnMismatchedApiVersion()
    {
        Context::$API_VERSION = "2022-04";

        $this->expectException(RestResourceException::class);
        new FakeResource($this->session);
    }
}
