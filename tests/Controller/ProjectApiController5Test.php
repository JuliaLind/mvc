<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockFileSessionStorage;
use App\Project\Game;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProjectApiController5Test extends WebTestCase
{
    use SessionTrait;

    public function testApiGameStateNotOk(): void
    {

        $client = static::createClient();
        $session = $this->createSession($client);
        $container = $client->getContainer();
        $container->set(Session::class, $session);
        $client->request('POST', '/proj/api/game-state');
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('api-game-state');

        $response = strval($client->getResponse()->getContent());
        $this->assertJson($response);
        $this->assertStringContainsString('no game initiated', $response);
    }

    public function testApiGameStateOk(): void
    {
        $client = static::createClient();
        $session = $this->createSession($client);
        $container = $client->getContainer();
        $container->set(Session::class, $session);
        $client->request(
            'POST',
            '/proj/login',
            [
                'email' => 'user0@test.se',
                'password' => 'julia'
            ]
        );

        $client->request(
            'POST',
            '/proj/init',
            [
                'bet' => 350,
            ]
        );
        $client->request('POST', '/proj/api/game-state');
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('api-game-state');

        $response = strval($client->getResponse()->getContent());
        $this->assertJson($response);
        $this->assertStringContainsString('"bet":350', $response);
        $this->assertStringContainsString('"player":{"cardCount":0,"rows":[]},"placedCardsPlayer":0,"placedCardsHouse":0,"deckCardCount":51', $response);
        $this->assertStringContainsString('"fromSlot":[],"lastRound":{"house":[],"player":[]', $response);
    }
}
