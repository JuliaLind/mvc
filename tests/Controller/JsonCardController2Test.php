<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Cards\DeckOfCards;

class JsonCardController2Test extends WebTestCase
{
    public function testJsonDeck(): void
    {
        $client = static::createClient();
        $deck = $this->createMock(DeckOfCards::class);
        $deck->expects($this->once())
        ->method('getAsString')->willReturn(['card1', 'card2']);
        $container = $client->getContainer();
        $container->set(DeckOfCards::class, $deck);
        $client->request('GET', '/api/deck');
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('jsonDeck');
        $response = strval($client->getResponse()->getContent());
        $this->assertJson($response);
        $this->assertStringContainsString('card1', $response);
        $this->assertStringContainsString('card2', $response);
    }

    public function testJsonShuffle(): void
    {
        $client = static::createClient();
        $client->request('POST', '/api/deck/shuffle');
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('jsonShuffle');
    }
}
