<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class Game21Controller2Test extends WebTestCase
{
    public function testBankPlaying(): void
    {
        $client = static::createClient();
        $client->request('POST', '/game/init/0');
        $client->request('POST', '/game/bank-playing');
        $this->assertRouteSame('bankPlaying');
        $this->assertResponseRedirects('/game/play');
    }
}
