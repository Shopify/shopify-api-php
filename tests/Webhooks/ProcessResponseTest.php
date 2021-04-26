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

        $response = new ProcessResponse(false, 'Something went wrong');
        $this->assertFalse($response->isSuccess());
        $this->assertEquals('Something went wrong', $response->getErrorMessage());
    }
}
