<?php

declare(strict_types=1);

namespace ShopifyTest\Auth;

use Shopify\Auth\Scopes;
use ShopifyTest\BaseTestCase;

final class ScopesTest extends BaseTestCase
{
    public function testStringScopeParsing()
    {
        $scopeString = ' read_products, read_orders,read_orders , , write_customers ';
        $scopes = new Scopes($scopeString);

        $this->assertEquals('read_products,read_orders,write_customers', $scopes->toString());
    }

    public function testArrayScopeParsing()
    {
        $scopeArray = [' read_products', 'read_orders', 'read_orders', '', 'unauthenticated_write_customers '];
        $scopes = new Scopes($scopeArray);

        $this->assertEquals('read_products,read_orders,unauthenticated_write_customers', $scopes->toString());
    }

    public function testTrimsImpliedScopes()
    {
        $scopeString = 'read_customers,write_customers,read_products';
        $scopes = new Scopes($scopeString);

        $this->assertEquals('write_customers,read_products', $scopes->toString());
    }

    public function testTrimsImpliedUnauthenticatedScopes()
    {
        $scopeString = 'unauthenticated_read_customers,unauthenticated_write_customers,read_products';
        $scopes = new Scopes($scopeString);

        $this->assertEquals('unauthenticated_write_customers,read_products', $scopes->toString());
    }

    public function testHasReturnsTrueForStringSubset()
    {
        $scopes = new Scopes('read_products,write_customers');
        $this->assertTrue($scopes->has('write_customers'));
    }

    public function testHasReturnsTrueForArraySubset()
    {
        $scopes = new Scopes('read_products,write_customers');
        $this->assertTrue($scopes->has(['write_customers']));
    }

    public function testHasReturnsTrueForObjectSubset()
    {
        $scopes = new Scopes('read_products,write_customers');
        $this->assertTrue($scopes->has(new Scopes('write_customers')));
    }

    public function testHasReturnsTrueForEqualStrings()
    {
        $scopes = new Scopes('read_products,write_customers');
        $this->assertTrue($scopes->has('read_products,write_customers'));
    }

    public function testHasReturnsTrueForEqualArrays()
    {
        $scopes = new Scopes('read_products,write_customers');
        $this->assertTrue($scopes->has(['read_products', 'write_customers']));
    }

    public function testHasReturnsTrueForEqualObjects()
    {
        $scopes = new Scopes('read_products,write_customers');
        $this->assertTrue($scopes->has(new Scopes('read_products,write_customers')));
    }

    public function testHasReturnsFalseForStringSuperset()
    {
        $scopes = new Scopes('read_products,write_customers');
        $this->assertFalse($scopes->has('read_products,write_customers,read_orders'));
    }

    public function testHasReturnsFalseForArraySuperset()
    {
        $scopes = new Scopes('read_products,write_customers');
        $this->assertFalse($scopes->has(['read_products', 'write_customers', 'read_orders']));
    }

    public function testHasReturnsFalseForObjectSuperset()
    {
        $scopes = new Scopes('read_products,write_customers');
        $this->assertFalse($scopes->has(new Scopes('read_products,write_customers,read_orders')));
    }

    public function testHasReturnsTrueForImpliedObjectScope()
    {
        $scopes = new Scopes('read_products,write_customers');
        $this->assertTrue($scopes->has(new Scopes('read_products,read_customers')));
        $this->assertFalse($scopes->has(new Scopes('write_products,write_customers')));
    }

    public function testHasReturnsTrueForImpliedArrayScope()
    {
        $scopes = new Scopes('read_products,write_customers');
        $this->assertTrue($scopes->has(['read_products', 'read_customers']));
        $this->assertFalse($scopes->has(['write_products', 'write_customers']));
    }

    public function testHasReturnsTrueForImpliedStringScope()
    {
        $scopes = new Scopes('read_products,write_customers');
        $this->assertTrue($scopes->has('read_products,read_customers'));
        $this->assertFalse($scopes->has('write_products,write_customers'));
    }

    public function testEqualsReturnsTrueForEqualScopes()
    {
        $scopes1 = new Scopes('write_customers,read_products');
        $scopes2 = new Scopes(['write_customers', 'read_products']);
        $this->assertTrue($scopes1->equals($scopes2));
        $this->assertTrue($scopes2->equals($scopes1));
    }

    public function testEqualsReturnsFalseForDifferentScopes()
    {
        $scopes1 = new Scopes('write_customers,read_products');
        $scopes2 = new Scopes(['write_customers', 'write_orders']);
        $this->assertFalse($scopes1->equals($scopes2));
        $this->assertFalse($scopes2->equals($scopes1));
    }

    public function testEqualsReturnsTrueForImpliedScopes()
    {
        $scopes1 = new Scopes('write_customers,read_products,write_products');
        $scopes2 = new Scopes(['write_customers', 'write_products']);
        $this->assertTrue($scopes1->equals($scopes2));
        $this->assertTrue($scopes2->equals($scopes1));
    }

    public function testEqualsReturnsFalseForScopeSubsets()
    {
        $scopes1 = new Scopes('write_customers,read_products');
        $scopes2 = new Scopes(['write_customers', 'read_products', 'write_orders']);
        $this->assertFalse($scopes1->equals($scopes2));
        $this->assertFalse($scopes2->equals($scopes1));
    }

    public function testEqualsAllowsStrings()
    {
        $scopes1 = new Scopes('write_customers,read_products');
        $this->assertTrue($scopes1->equals('write_customers,read_products'));
        $this->assertFalse($scopes1->equals('write_customers,read_products,write_products'));
    }

    public function testEqualsAllowsArrays()
    {
        $scopes1 = new Scopes('write_customers,read_products');
        $this->assertTrue($scopes1->equals(['write_customers', 'read_products']));
        $this->assertFalse($scopes1->equals(['write_customers', 'read_products', 'write_products']));
    }

    public function testEqualsReturnsTrueForImpliedObjectScopes()
    {
        $scopes = new Scopes('read_products,write_customers');

        $scopes2 = new Scopes('read_products,read_customers,write_customers');
        $this->assertTrue($scopes->equals($scopes2));
        $this->assertTrue($scopes2->equals($scopes));

        $scopes2 = new Scopes('read_products,write_customers');
        $this->assertTrue($scopes->equals($scopes2));
        $this->assertTrue($scopes2->equals($scopes));

        $scopes2 = new Scopes('write_products,read_customers,write_customers');
        $this->assertFalse($scopes->equals($scopes2));
        $this->assertFalse($scopes2->equals($scopes));
    }

    public function testEqualsReturnsTrueForImpliedArrayScopes()
    {
        $scopes = new Scopes('read_products,write_customers');
        $this->assertTrue($scopes->equals(['read_products', 'read_customers', 'write_customers']));
        $this->assertTrue($scopes->equals(['read_products', 'write_customers']));
        $this->assertFalse($scopes->equals(['write_products', 'read_customers', 'write_customers']));
    }

    public function testEqualsReturnsTrueForImpliedStringScopes()
    {
        $scopes = new Scopes('read_products,write_customers');
        $this->assertTrue($scopes->equals('read_products,read_customers,write_customers'));
        $this->assertTrue($scopes->equals('read_products,write_customers'));
        $this->assertFalse($scopes->equals('write_products,read_customers,write_customers'));
    }
}
