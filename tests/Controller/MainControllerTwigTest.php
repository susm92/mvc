<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Test class for controller class MainControllerTwig
 */
class MainControllerTwigTest extends WebTestCase
{
    public function testGetHomeRoute()
    {
        $client = static::createClient();
        $client->request('GET', "/");

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertSelectorTextContains('h1', 'Home');
    }

    public function testGetAbout()
    {
        $client = static::createClient();
        $client->request('GET', "/about");

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertSelectorTextContains('h1', 'About');
    }

    public function testGetReport()
    {
        $client = static::createClient();
        $client->request('GET', "/report");

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertSelectorTextContains('h1', 'Report');
    }
}
