<?php

namespace App\Entity;

use App\Repository\ProductRepository;;
use PHPUnit\Framework\TestCase;

/**
 * Test class for class Products
 */
class ProductTest extends TestCase
{
    /**
     * Methods used to verify that the object is correctly created
     * and that constructor is the same as for the real class.
     */
    public function testCreateObject(): void
    {
        $product = new Product();
        $this->assertInstanceOf('\App\Entity\Product', $product);
    }

    /**
     * Method used to verify that the products id can be allocated
     */
    public function testGetId(): void
    {
        $product = new Product();

        $this->assertEquals($product->getId(), null);
    }

    /**
     * Methods used to check that setter and getters work as intended
     * here it is clearly demonstrated for the name
     */
    public function testSetName(): void
    {
        $product = new Product();
        $name = 'susm20';

        $product->setName($name);
        $this->assertEquals($product->getName(), $name);
    }

    /**
     * Methods used to check that setter and getters work as intended
     * here it is cleary demonstrated for the value
     */
    public function testSetValue(): void
    {
        $product = new Product();
        $value = 12345;

        $product->setValue($value);
        $this->assertEquals($product->getValue(), $value);
    }
}
