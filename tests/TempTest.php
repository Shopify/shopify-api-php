<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class TempTest extends TestCase
{
    public function testSaysHello()
    {
        $this->assertEquals('Hello, world!', Shopify\Temp::helloWorld());
    }
}
