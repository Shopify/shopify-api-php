<?php

declare(strict_types=1);

namespace ShopifyTest;

use PHPUnit\Framework\TestCase;
use Shopify\Clients\HttpResponse;

class HttpResponseMatcherTest extends TestCase
{
    /** @var array */
    private $successResponse = [
        'products' => [
            'title' => 'Test Product',
            'amount' => 1,
        ],
    ];

    public function testMatchFailsForIncorrectDataType()
    {
        $matcher = new HttpResponseMatcher();
        $this->assertThat("incorrect data type", $this->logicalNot($matcher));
    }


    public function testMatchPassesIfAllParametersAreEqual()
    {
        $response = new HttpResponse(
            200,
            ['Header-1' => ['ABCD'], 'Header-2' => ['DCBA']],
            json_encode($this->successResponse)
        );
        $matcher = new HttpResponseMatcher(
            200,
            ['Header-1' => ['ABCD'], 'Header-2' => ['DCBA']],
            $this->successResponse
        );
        $this->assertThat($response, $matcher);
    }

    public function testMatchFailsIfAnyOfTheParametersIsNotEqual()
    {
        $response = new HttpResponse(
            204,
            ['Header-1' => ['ABCD'], 'Header-2' => ['DCBA']],
            json_encode($this->successResponse)
        );
        $matcher = new HttpResponseMatcher(
            200,
            ['Header-1' => ['ABCD'], 'Header-2' => ['DCBA']],
            $this->successResponse
        );

        $this->assertThat($response, $this->logicalNot($matcher));

        $response = new HttpResponse(
            200,
            ['Header-1' => ['ABCD'], 'Header-2' => ['totally differnt value']],
            json_encode($this->successResponse)
        );
        $matcher = new HttpResponseMatcher(
            200,
            ['Header-1' => ['ABCD'], 'Header-2' => ['DCBA']],
            $this->successResponse
        );
        $this->assertThat($response, $this->logicalNot($matcher));

        $response = new HttpResponse(
            200,
            ['Header-1' => ['ABCD'], 'Header-2' => ['DCBA']],
            json_encode($this->successResponse)
        );
        $matcher = new HttpResponseMatcher(
            200,
            ['Header-1' => ['ABCD'], 'Header-2' => ['DCBA']],
            null
        );
        $this->assertThat($response, $this->logicalNot($matcher));
    }
}
