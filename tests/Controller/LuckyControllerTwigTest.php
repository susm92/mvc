<?php

namespace App\Test\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Test class for class CardGraphic.
 */
class LuckyControllerTwigTest extends WebTestCase
{
    /**
     * Construct object and verify that is is a card object
     */
    public function testLucky(): void
    {
        $client = static::createClient();

        // Request a specific page
        $crawler = $client->request('GET', '/lucky');

        // Validate a successful response and some content
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Magic number');
    }
}
