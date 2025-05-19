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
        $client->request('POST', '/proj/init', ['nrOfPlayers' => 2, 'name' => 'TestPlayer']);
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
        $client->request('POST', '/proj/init', ['nrOfPlayers' => 2, 'name' => 'TestPlayer']);
        $client->followRedirect();
        $this->assertSelectorExists('body');

        $client->request('POST', '/proj/draw');
        $this->assertTrue(
            $client->getResponse()->isRedirection() ||
            $client->getResponse()->isSuccessful()
        );

        $client->request('POST', '/proj/bet');
        $this->assertTrue(
            $client->getResponse()->isRedirection() ||
            $client->getResponse()->isSuccessful()
        );

        $client->request('POST', '/proj/hold');
        $this->assertTrue(
            $client->getResponse()->isRedirection() ||
            $client->getResponse()->isSuccessful()
        );

        $client->request('GET', '/proj/bank_plays');
        $this->assertTrue(
            $client->getResponse()->isRedirection() ||
            $client->getResponse()->isSuccessful()
        );

        $client->request('GET', '/proj/score');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorExists('body');
    }
}