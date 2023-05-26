<?php

namespace App\Test\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Test class for controller QuoteControllerTwig.
 */
class QuoteControllerTwigTest extends WebTestCase
{
    /**
     * Test api_quite route
     */
    public function testQuote(): void
    {
        $client = static::createClient();

        $client->request('GET', '/api/quote');

        $response = $client->getResponse();
        $this->assertTrue($response->isSuccessful());

        $content = $response->getContent();
        $data = json_decode($content, true);

        // Verifing that the following is being sent
        $this->assertArrayHasKey('qoute-of-the-day', $data);
        $this->assertArrayHasKey('generated', $data);
        $this->assertArrayHasKey('date', $data);
    }
}
