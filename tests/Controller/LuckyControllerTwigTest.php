<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LuckyControllerTwigTest extends WebTestCase
{

    public function testLucky()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/lucky');
        $this->assertTrue($client->getResponse()->isSuccessful());
        $this->assertSelectorTextContains('h1', 'Magic number');
    }
}