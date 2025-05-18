<?php

namespace App\Test\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProjectControllerTest extends WebTestCase
{
    public function testProjectHome(): void
    {
        $client = static::createClient();
        $client->request('GET', '/proj');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorExists('body');
    }

    public function testProjectAbout(): void
    {
        $client = static::createClient();
        $client->request('GET', '/proj/about');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorExists('body');
    }

    public function testProjectDoc(): void
    {
        $client = static::createClient();
        $client->request('GET', '/proj/doc');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorExists('body');
    }

    public function testProjectInitGet(): void
    {
        $client = static::createClient();
        $client->request('GET', '/proj/init');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorExists('body');
    }

    public function testProjectInitPost(): void
    {
        $client = static::createClient();
        $client->request('POST', '/proj/init', ['nrOfPlayers' => 2]);
        $this->assertResponseRedirects('/proj/game');
    }

    public function testProjectRestart(): void
    {
        $client = static::createClient();
        $client->request('POST', '/proj/restart');
        $this->assertResponseRedirects('/proj/init');
    }

    public function testProjectGameFlow(): void
    {
        $client = static::createClient();
        // Start game with 2 players
        $client->request('POST', '/proj/init', ['nrOfPlayers' => 2]);
        $client->followRedirect();
        $this->assertSelectorExists('body');

        // Draw card
        $client->request('POST', '/proj/draw');
        $this->assertTrue(
            $client->getResponse()->isRedirection() ||
            $client->getResponse()->isSuccessful()
        );

        // Hold
        $client->request('POST', '/proj/hold');
        $this->assertTrue(
            $client->getResponse()->isRedirection() ||
            $client->getResponse()->isSuccessful()
        );

        // Bank plays
        $client->request('GET', '/proj/bank_plays');
        $this->assertTrue(
            $client->getResponse()->isRedirection() ||
            $client->getResponse()->isSuccessful()
        );

        // Score
        $client->request('GET', '/proj/score');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorExists('body');
    }
}