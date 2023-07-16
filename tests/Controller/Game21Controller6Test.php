<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class Game21Controller6Test extends WebTestCase
{
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
