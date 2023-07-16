<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockFileSessionStorage;

use App\Game\Game21Easy;
use App\Game\Game21Hard;

class Game21Controller5Test extends WebTestCase
{
    use SessionTrait;

    public function testBet(): void
    {
        $client = static::createClient();
        $client->request('POST', '/game/init/0');
        $client->request('POST', '/game/bet/30');
        $this->assertRouteSame('bet');
        $this->assertResponseRedirects('/game/play');
    }
}
