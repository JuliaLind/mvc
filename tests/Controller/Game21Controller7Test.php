<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class Game21Controller7Test extends WebTestCase
{
    public function testPlayerDraw(): void
    {
        $client = static::createClient();
        $client->request('POST', '/game/init/0');
        $client->request('POST', '/game/draw');
        $this->assertRouteSame('playerDraw');
        $this->assertResponseRedirects('/game/play');
    }
}
