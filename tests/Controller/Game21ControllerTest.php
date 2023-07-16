<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class Game21ControllerTest extends WebTestCase
{
    public function testGame(): void
    {
        $client = static::createClient();

        $parser = $this->createMock(MdParser::class);
        $parser->expects($this->once())
        ->method('getParsedText')->with($this->equalTo("markdown/game21.md"));
        $container = $client->getContainer();
        $container->set(MdParser::class, $parser);
        $client->request('GET', '/game');
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('gameMain');
        $this->assertSelectorTextContains('h1', 'Game 21');
        $this->assertSelectorTextContains('h2', 'Dokumentation');
        $response = strval($client->getResponse()->getContent());
        $this->assertStringNotContainsString('Klicka på denna knapp för att återgå till pågående spel', $response);
    }

    public function testGame2(): void
    {

        $client = static::createClient();

        $client->request('POST', '/game/init/0');
        $client->request('GET', '/game');

        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('gameMain');
        $this->assertSelectorTextContains('h1', 'Game 21');
        $this->assertSelectorTextContains('h2', 'Dokumentation');
        $response = strval($client->getResponse()->getContent());
        $this->assertStringContainsString('Klicka på denna knapp för att återgå till pågående spel', $response);
    }

    public function testDoc(): void
    {
        $client = static::createClient();
        $client->request('GET', '/game/doc');
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('gameDoc');
        $this->assertSelectorTextContains('h2', 'Flödesschema');
    }
}
