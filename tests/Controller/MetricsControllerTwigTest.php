<?php

namespace App\Test\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Test class for controller MetricsControllerTwig.
 */
class MetricsControllerTwigTest extends WebTestCase
{
    /**
     * Test Metrics route
     */
    public function testMetrics(): void
    {
        $client = static::createClient();

        // Request a specific page
        $client->request('GET', '/metrics');

        // Validate a successful response and some content
        $this->assertTrue($client->getResponse()->isSuccessful());
        $this->assertSelectorTextContains('h1', 'Introduktion');
    }
}
