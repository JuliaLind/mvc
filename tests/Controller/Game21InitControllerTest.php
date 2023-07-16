<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockFileSessionStorage;

use App\Game\Game21Easy;
use App\Game\Game21Hard;

class Game21InitControllerTest extends WebTestCase
{
    use SessionTrait;

    public function testInitEasy(): void
    {
        $client = static::createClient();
        $session = $this->createSession($client);
        $container = $client->getContainer();
        $container->set(Session::class, $session);

        $client->request('POST', '/game/init/0');
        $this->assertRouteSame('init');
        $this->assertResponseRedirects('/game/select-amount');
        /**
         * @var Game21Easy $gameEasy
         */
        $gameEasy = $session->get("game21");
        $this->assertInstanceOf('App\Game\Game21Easy', $gameEasy);
    }

    public function testInitHard(): void
    {
        $client = static::createClient();
        $session = $this->createSession($client);
        $container = $client->getContainer();
        $container->set(Session::class, $session);

        $client->request('POST', '/game/init/2');
        $this->assertResponseRedirects('/game/select-amount');
        /**
         * @var Game21Hard $gameHard
         */
        $gameHard = $session->get("game21");
        $this->assertInstanceOf("App\Game\Game21Hard", $gameHard);
    }
}
