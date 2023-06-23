<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class JsonCardControllerTest extends WebTestCase
{
    public function testJsonDeal(): void
    {
        $client = static::createClient();
        $client->request('POST', '/api/deck/deal/3/7');
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('jsonDeal');
    }
}
