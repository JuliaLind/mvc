<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class JsonDealManyCardsControllerTest extends WebTestCase
{
    public function testJsonDrawMany(): void
    {
        $client = static::createClient();
        $client->request('POST', '/api/deck/draw/7');
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('jsonDrawMany');
    }
}
