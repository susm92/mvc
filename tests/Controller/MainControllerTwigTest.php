<?php

namespace App\Test\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Test class for controller MainControllerTwig.
 */
class MainControllerTwigTest extends WebTestCase
{
    /**
     * Test Home route
     */
    public function testHome(): void
    {
        $client = static::createClient();

        // Request a specific page
        $client->request('GET', '/');

        // Validate a successful response and some content
        $this->assertTrue($client->getResponse()->isSuccessful());
        $this->assertSelectorTextContains('h1', 'Home');
    }

        /**
     * Test About route
     */
    public function testAbout(): void
    {
        $client = static::createClient();

        // Request a specific page
        $client->request('GET', '/about');

        // Validate a successful response and some content
        $this->assertTrue($client->getResponse()->isSuccessful());
        $this->assertSelectorTextContains('h1', 'About');
    }

        /**
     * Test Report route
     */
    public function testReport(): void
    {
        $client = static::createClient();

        // Request a specific page
        $client->request('GET', '/report');

        // Validate a successful response and some content
        $this->assertTrue($client->getResponse()->isSuccessful());
        $this->assertSelectorTextContains('h1', 'Report');
    }
}
