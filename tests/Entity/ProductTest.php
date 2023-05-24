<?php

namespace App\Entity;

use App\Repository\ProductRepository;;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function testCreateObject()
    {
        $product = new Product();
        $this->assertInstanceOf('\App\Entity\Product', $product);
    }

    public function testGetId()
    {
        $product = new Product();

        $this->assertEquals($product->getId(1), null);
    }

    public function testSetName()
    {
        $product = new Product();
        $name = 'susm20';

        $product->setName($name);
        $this->assertEquals($product->getName(), $name);
    }

    public function testSetValue()
    {
        $product = new Product();
        $value = 12345;

        $product->setValue($value);
        $this->assertEquals($product->getValue(), $value);
    }
}
