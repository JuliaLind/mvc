<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Game\Game21Easy;
use Symfony\Component\HttpFoundation\Session\Session;

class Game21Controller5Test extends WebTestCase
{
    use SessionTrait;

    public function testBet(): void
    {
        $client = static::createClient();

        $session = $this->createSession($client);
        $container = $client->getContainer();
        $container->set(Session::class, $session);

        $client->request('POST', '/game/init/0');
        $client->request('POST', '/game/bet/30');
        $this->assertRouteSame('bet');
        $this->assertResponseRedirects('/game/play');

        /**
         * @var Game21Easy $game
         */
        $game = $session->get('game21');
        /**
         * @var array<string,mixed> $data
         */
        $data = $game->getGameStatus();
        $this->assertEquals(60, $data['moneyPot']);
    }
}
