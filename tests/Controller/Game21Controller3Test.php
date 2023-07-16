<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class Game21Controller3Test extends WebTestCase
{
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
}
