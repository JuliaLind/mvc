<?php

namespace App\Controller;

use App\Cards\DeckOfCards;
use App\Cards\Player;
use App\Cards\CardGraphic;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CardController2Test extends WebTestCase
{
    public function testDraw(): void
    {
        $client = static::createClient();

        $container = $client->getContainer();
        $player = $this->createMock(Player::class);
        $player->expects($this->once())
        ->method('draw')->with($this->equalTo(new DeckOfCards()));
        $player->expects($this->once())
        ->method('showHandGraphic');

        $container->set(Player::class, $player);

        $client->request('POST', '/card/deck/draw');
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('draw');
        $this->assertSelectorTextContains('h1', 'Draw 1 card for 1 player');
    }

    public function testDraw2(): void
    {
        $client = static::createClient();

        $client->request('POST', '/card/deck/draw');
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('draw');
        $this->assertSelectorTextContains('p', 'Cards left: 51');
        $this->assertSelectorTextContains('h1', 'Draw 1 card for 1 player');
    }

    public function testDraw3(): void
    {
        $client = static::createClient();

        $client->request('POST', '/card/deck/draw');
        $client->request('POST', '/card/deck/draw');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('p', 'Cards left: 50');
    }


    public function testDrawMany(): void
    {
        $client = static::createClient();
        $container = $client->getContainer();
        $player = $this->createMock(Player::class);
        $player->expects($this->once())
        ->method('drawMany')->with($this->equalTo(new DeckOfCards()), $this->equalTo(7));
        $player->expects($this->once())
        ->method('showHandGraphic');

        $container->set(Player::class, $player);
        $client->request('POST', '/card/deck/draw/7');
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('drawMany');
        $this->assertSelectorTextContains('h1', 'Draw 7 cards for 1 player');
    }

    public function testDrawMany2(): void
    {
        $client = static::createClient();
        $client->request('POST', '/card/deck/draw/7');
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('drawMany');
        $this->assertSelectorTextContains('p', 'Cards left: 45');
        $this->assertSelectorTextContains('h1', 'Draw 7 cards for 1 player');

        $client->request('POST', '/card/deck/draw/5');
        $this->assertSelectorTextContains('p', 'Cards left: 40');
        $this->assertSelectorTextContains('h1', 'Draw 5 cards for 1 player');
    }

    public function testDeal(): void
    {
        $client = static::createClient();
        $client->request('POST', '/card/deck/deal/3/7');
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('deal');
        $this->assertSelectorTextContains('p', 'Cards left: 31');
        $this->assertSelectorTextContains('h1', 'Draw 7 cards for 3 players');

        $client->request('POST', '/card/deck/deal/1/1');
        $this->assertSelectorTextContains('p', 'Cards left: 30');
        $this->assertSelectorTextContains('h1', 'Draw 1 cards for 1 players');

        $client->request('POST', '/card/deck/deal/8/7');
        $this->assertSelectorTextContains('p', 'Cards left: 0');
        $this->assertSelectorTextContains('h1', 'Draw 7 cards for 8 players');
    }
}
