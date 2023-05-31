<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CardLandingControllerTest extends WebTestCase
{
    public function testCard(): void
    {
        $client = static::createClient();
        $client->request('GET', '/card');
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('card');
        $this->assertSelectorTextContains('h1', 'Kortspel');
    }
}
