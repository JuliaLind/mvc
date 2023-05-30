<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

use App\Game\Game21Easy;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;
use Symfony\Component\HttpFoundation\Session\Session;


class Game21ControllerTest extends WebTestCase
{
    public function testGame(): void
    {
        $client = static::createClient();
        $client->request('GET', '/game');
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('gameMain');
        $this->assertSelectorTextContains('h1', 'Game 21');
        $this->assertSelectorTextContains('h2', 'Dokumentation');
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
    }

    public function testSelectAmount(): void
    {
        // $game21 = $this->createMock(Game21Easy::class);

        // $session = new Session(new MockArraySessionStorage());

        // $session->set("game21", $game21);

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
