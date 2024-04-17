<?php

declare(strict_types=1);

namespace ShopifyTest\Webhooks;

use Shopify\Webhooks\ProcessResponse;
use ShopifyTest\BaseTestCase;

final class ProcessResponseTest extends BaseTestCase
{
    public function testGetters()
    {
        $response = new ProcessResponse(true);
        $this->assertTrue($response->isSuccess());
        $this->assertNull($response->getErrorMessage());
        $this->assertNull($response->getBody());

        $response = new ProcessResponse(false);
        $response->setErrorMessage('Something went wrong');
        $this->assertFalse($response->isSuccess());
        $this->assertEquals('Something went wrong', $response->getErrorMessage());
        $this->assertNull($response->getBody());

        $response = new ProcessResponse(false);
        $response->setErrorMessage('Something went wrong');
        $response->setBody('A String Response');
        $this->assertFalse($response->isSuccess());
        $this->assertEquals('Something went wrong', $response->getErrorMessage());
        $this->assertEquals('A String Response', $response->getBody());

        $response = new ProcessResponse(true);
        $response->setBody('A String Response');
        $this->assertTrue($response->isSuccess());
        $this->assertEquals(null, $response->getErrorMessage());
        $this->assertEquals('A String Response', $response->getBody());

        $response = new ProcessResponse(false);
        $response->setBody('A String Response');
        $this->assertFalse($response->isSuccess());
        $this->assertEquals(null, $response->getErrorMessage());
        $this->assertEquals('A String Response', $response->getBody());

        $response = new ProcessResponse(true);
        $response->setBody(['Some Data in an Array']);
        $this->assertTrue($response->isSuccess());
        $this->assertEquals(null, $response->getErrorMessage());
        $this->assertEquals(['Some Data in an Array'], $response->getBody());

        $response = new ProcessResponse(true);
        $response->setBody(123456789);
        $this->assertTrue($response->isSuccess());
        $this->assertEquals(null, $response->getErrorMessage());
        $this->assertEquals(123456789, $response->getBody());
    }
}
