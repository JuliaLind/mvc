<?php

namespace App\Controller;

use App\Cards\DeckOfCards;
use App\Cards\Player;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class JsonCardController4Test extends WebTestCase
{
    public function testDraw(): void
    {
        $client = static::createClient();
        $container = $client->getContainer();
        $player = $this->createMock(Player::class);
        $player->expects($this->once())
        ->method('draw')->with($this->equalTo(new DeckOfCards()));
        $player->expects($this->once())
        ->method('showHandAsString');

        $container->set(Player::class, $player);
        $client->request('POST', '/api/deck/draw');
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('jsonDraw');
    }
}
