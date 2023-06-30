<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

// use Symfony\Component\HttpFoundation\Session\Session;
// use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;
// use Symfony\Component\BrowserKit\Cookie;

// use App\Markdown\MdParser;

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

    public function testInit(): void
    {
        $client = static::createClient();
        $client->request('POST', '/game/init/0');
        $this->assertRouteSame('init');
        $this->assertResponseRedirects('/game/select-amount');

        $client->request('POST', '/game/init/2');
        $this->assertResponseRedirects('/game/select-amount');
    }

    public function testSelectAmount(): void
    {
        $client = static::createClient();
        $client->request('POST', '/game/init/0');
        $client->request('GET', '/game/select-amount');
        $this->assertRouteSame('selectAmount');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Spelomgång nr 1');
        $this->assertSelectorTextContains('p', 'Du kan investera max 100');
    }

    public function testBet(): void
    {
        $client = static::createClient();
        $client->request('POST', '/game/init/0');
        $client->request('POST', '/game/bet/30');
        $this->assertRouteSame('bet');
        $this->assertResponseRedirects('/game/play');
    }

    public function testPlayerDraw(): void
    {
        $client = static::createClient();
        $client->request('POST', '/game/init/0');
        $client->request('POST', '/game/draw');
        $this->assertRouteSame('playerDraw');
        $this->assertResponseRedirects('/game/play');
    }

    public function testBankPlaying(): void
    {
        $client = static::createClient();
        $client->request('POST', '/game/init/0');
        $client->request('POST', '/game/bank-playing');
        $this->assertRouteSame('bankPlaying');
        $this->assertResponseRedirects('/game/play');
    }

    public function testPlay(): void
    {
        $client = static::createClient();
        $client->request('POST', '/game/init/0');
        $client->request('POST', '/game/bet/30');
        $client->request('GET', '/game/play');
        $this->assertRouteSame('play');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', "Level: easy | Round 0 | Money in pot: 60");
    }
}
