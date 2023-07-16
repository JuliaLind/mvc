<?php

namespace App\Controller;

use App\Cards\DeckOfCards;
use App\Cards\Player;
use App\Cards\CardGraphic;
use Symfony\Component\HttpFoundation\Session\Session;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CardControllerTest extends WebTestCase
{
    use SessionTrait;

    public function testDeck(): void
    {
        $client = static::createClient();
        $session = $this->createSession($client);
        $deck = $this->createMock(DeckOfCards::class);

        $deck->expects($this->once())
        ->method('getImgLinks')->willReturn(['alink.png', 'anotherlink.png']);
        $container = $client->getContainer();
        $container->set(DeckOfCards::class, $deck);
        $container->set(Session::class, $session);
        $client->request('GET', '/card/deck');
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('deck');
        $this->assertSelectorTextContains('h1', 'New deck');
        $this->assertEquals($deck, $session->get('deck'));
        $response = strval($client->getResponse()->getContent());
        $this->assertStringContainsString('alink.png', $response);
    }

    public function testShuffle(): void
    {
        $client = static::createClient();
        $session = $this->createSession($client);
        $deck = $this->createMock(DeckOfCards::class);
        $deck->expects($this->once())
        ->method('shuffle');
        $deck->expects($this->once())
        ->method('getImgLinks')->willReturn(['alink.png', 'anotherlink.png']);
        $container = $client->getContainer();
        $container->set(DeckOfCards::class, $deck);
        $container->set(Session::class, $session);
        $client->request('POST', '/card/deck/shuffle');
        $this->assertEquals($deck, $session->get('deck'));
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('shuffle');
        $this->assertSelectorTextContains('h1', 'Shuffled deck');
        $response = strval($client->getResponse()->getContent());
        $this->assertStringContainsString('anotherlink.png', $response);
    }

    public function testCard(): void
    {
        $client = static::createClient();
        $client->request('GET', '/card');
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('card');
        $this->assertSelectorTextContains('h1', 'Kortspel');
        $content = strval($client->getResponse()->getContent());
        $this->assertStringContainsString('type="submit" value=/card/deck/deal/3/5', $content);
    }
}
