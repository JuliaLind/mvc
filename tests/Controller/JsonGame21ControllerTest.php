<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class JsonGame21ControllerTest extends WebTestCase
{
    public function testDraw(): void
    {
        $client = static::createClient();
        $client->request('POST', '/game/init/0');
        $client->request('GET', '/api/game');
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('jsonGame');
    }
}
