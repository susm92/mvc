<?php

namespace App\Entity;

use App\Repository\LibraryRepository;
use PHPUnit\Framework\TestCase;

class LibraryTest extends TestCase
{
    public function testCreateObject()
    {
        $library = new Library();
        $this->assertInstanceOf('\App\Entity\Library', $library);
    }

    public function testGetId()
    {
        $library = new Library();

        $this->assertEquals($library->getId(1), null);
    }

    public function testSetTitle()
    {
        $library = new Library();
        $title = 'test';

        $library->setTitle($title);
        $this->assertEquals($library->getTitle(), $title);
    }

    public function testSetIsbn()
    {
        $library = new Library();
        $isbn = 12345;

        $library->setIsbn($isbn);
        $this->assertEquals($library->getIsbn(), $isbn);
    }

    public function testSetAuthor()
    {
        $library = new Library();
        $author = 'Test Testesson';

        $library->setAuthor($author);
        $this->assertEquals($library->getAuthor(), $author);
    }

    public function testSetImage()
    {
        $library = new Library();
        $image = 'Test Testesson';

        $library->setImage($image);
        $this->assertEquals($library->getImage(), $image);
    }
}
