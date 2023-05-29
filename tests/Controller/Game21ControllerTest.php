<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

use App\Game\Game21Easy;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use Symfony\Component\HttpFoundation\Session\Storage\MockArraySessionStorage;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Test class for MainController
 */
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
}
