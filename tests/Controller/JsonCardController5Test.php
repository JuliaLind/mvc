<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Cards\DeckOfCards;

class JsonCardController5Test extends WebTestCase
{
    public function testJsonShuffle(): void
    {
        $client = static::createClient();
        $deck = $this->createMock(DeckOfCards::class);
        $deck->expects($this->once())->method('shuffle');
        $deck->expects($this->once())
        ->method('getAsString')->willReturn(['card1', 'card2']);
        $container = $client->getContainer();
        $container->set(DeckOfCards::class, $deck);
        $client->request('POST', '/api/deck/shuffle');
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('jsonShuffle');
    }
}
