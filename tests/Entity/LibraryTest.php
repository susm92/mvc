<?php

namespace App\Entity;

use App\Repository\LibraryRepository;
use PHPUnit\Framework\TestCase;

/**
 * Test class for class Library
 */
class LibraryTest extends TestCase
{
    /**
     * Method used to verify that the object is correctly created
     * also that constructor is the same as for parent class.
     */
    public function testCreateObject()
    {
        $library = new Library();
        $this->assertInstanceOf('\App\Entity\Library', $library);
    }

    /**
     * Method used to verify getter method for id
     */
    public function testGetId()
    {
        $library = new Library();

        $this->assertEquals($library->getId(), null);
    }

    /**
     * Method used to verify that setters and getters work
     * below is cleary demonstrated for Title
     */
    public function testSetTitle()
    {
        $library = new Library();
        $title = 'test';

        $library->setTitle($title);
        $this->assertEquals($library->getTitle(), $title);
    }

    /**
     * Method used to verify that setters and getters work
     * below is cleary demonstrated for Isbn
     */
    public function testSetIsbn()
    {
        $library = new Library();
        $isbn = 12345;

        $library->setIsbn($isbn);
        $this->assertEquals($library->getIsbn(), $isbn);
    }

    /**
     * Method used to verify that setters and getters work
     * below is cleary demonstrated for Author
     */
    public function testSetAuthor()
    {
        $library = new Library();
        $author = 'Test Testesson';

        $library->setAuthor($author);
        $this->assertEquals($library->getAuthor(), $author);
    }

    /**
     * Method used to verify that setters and getters work
     * below is cleary demonstrated for Image
     */
    public function testSetImage()
    {
        $library = new Library();
        $image = 'Test Testesson';

        $library->setImage($image);
        $this->assertEquals($library->getImage(), $image);
    }
}
