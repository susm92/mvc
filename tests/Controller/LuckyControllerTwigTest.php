<?php

namespace App\Test\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

    /**
     * Test class for controller LuckyControllerTwig.
     */
    class LuckyControllerTwigTest extends WebTestCase
    {
        /**
         * Test lucky route
         */
        public function testLucky(): void
        {
            $client = static::createClient();

        // Request a specific page
        $client->request('GET', '/lucky');

        // Validate a successful response and some content
        $this->assertTrue($client->getResponse()->isSuccessful());
        $this->assertSelectorTextContains('h1', 'Magic number');
    }   
}
