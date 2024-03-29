<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Session\Session;

use App\Project\ApiGame1;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProjectApiController1Test extends WebTestCase
{
    use SessionTrait;

    public function testApiOneRound(): void
    {

        $client = static::createClient();
        $session = $this->createSession($client);

        $client->request('POST', '/proj/api/bot-plays');

        $container = $client->getContainer();
        $container->set(Session::class, $session);
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('api-bot-plays');

        $response = strval($client->getResponse()->getContent());
        $this->assertJson($response);
        $this->assertStringContainsString('"placed cards":1', $response);
        $client->request('POST', '/proj/api/bot-plays');
        $client->request('POST', '/proj/api/bot-plays');
        $response = strval($client->getResponse()->getContent());
        $this->assertStringContainsString('"placed cards":3', $response);
        $game = $session->get('api-game');
        $this->assertInstanceOf('App\Project\ApiGame1', $game);
    }
}
