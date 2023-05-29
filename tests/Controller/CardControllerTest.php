<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Test class for MainController
 */
class CardControllerTest extends WebTestCase
{
    public function testDeck(): void
    {
        $client = static::createClient();
        $client->request('GET', '/card/deck');
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('deck');
        $this->assertSelectorTextContains('h1', 'New deck');
    }

    public function testShuffle(): void
    {
        $client = static::createClient();
        $client->request('POST', '/card/deck/shuffle');
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('shuffle');
        $this->assertSelectorTextContains('h1', 'New deck');
    }

    public function testDraw(): void
    {
        $client = static::createClient();
        $client->request('POST', '/card/deck/draw');
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('draw');
        $this->assertSelectorTextContains('p', 'Cards left: 51');
    }
}
