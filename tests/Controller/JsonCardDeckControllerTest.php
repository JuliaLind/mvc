<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class JsonCardDeckControllerTest extends WebTestCase
{
    public function testJsonDeck(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/deck');
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('jsonDeck');
    }

    public function testJsonShuffle(): void
    {
        $client = static::createClient();
        $client->request('POST', '/api/deck/shuffle');
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('jsonShuffle');
    }
}
