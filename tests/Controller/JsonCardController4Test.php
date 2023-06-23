<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class JsonCardController4Test extends WebTestCase
{
    public function testDraw(): void
    {
        $client = static::createClient();
        $client->request('POST', '/api/deck/draw');
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('jsonDraw');
    }
}
