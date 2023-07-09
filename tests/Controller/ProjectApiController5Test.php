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

    public function testApiGameState(): void
    {

        $client = static::createClient();
        $session = $this->createSession($client);

        $client->request('POST', '/proj/api/game-state');

        $container = $client->getContainer();
        $container->set(Session::class, $session);
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('api-game-state');

        $response = strval($client->getResponse()->getContent());
        $this->assertJson($response);
        $this->assertStringContainsString('no game initiated', $response);

    }
}
