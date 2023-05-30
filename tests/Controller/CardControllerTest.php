<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


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
        $this->assertSelectorTextContains('h1', 'Draw 1 cards for 1 players');
    }

    public function testDrawMany(): void
    {
        $client = static::createClient();
        $client->request('POST', '/card/deck/draw/7');
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('drawMany');
        $this->assertSelectorTextContains('p', 'Cards left: 45');
        $this->assertSelectorTextContains('h1', 'Draw 7 cards for 1 players');
    }

    public function testDeal(): void
    {
        $client = static::createClient();
        $client->request('POST', '/card/deck/deal/3/7');
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('deal');
        $this->assertSelectorTextContains('p', 'Cards left: 31');
        $this->assertSelectorTextContains('h1', 'Draw 7 cards for 3 players');
    }
}
