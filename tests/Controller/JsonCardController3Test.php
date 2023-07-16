<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Cards\DeckOfCards;
use App\Cards\Player;

class JsonCardController3Test extends WebTestCase
{
    public function testJsonDrawMany(): void
    {
        $client = static::createClient();
        $client->request('POST', '/api/deck/draw/7');
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('jsonDrawMany');
    }

    public function testJsonDrawMany2(): void
    {
        $client = static::createClient();
        $container = $client->getContainer();
        $player = $this->createMock(Player::class);
        $player->expects($this->once())
        ->method('drawMany')->with($this->equalTo(new DeckOfCards()), $this->equalTo(7));
        $player->expects($this->once())
        ->method('showHandAsString');

        $container->set(Player::class, $player);

        $client->request('POST', '/api/deck/draw/7');
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('jsonDrawMany');
    }
}
