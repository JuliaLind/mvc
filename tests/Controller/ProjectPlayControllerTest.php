<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockFileSessionStorage;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

use App\Project\Game;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProjectPlayControllerTest extends WebTestCase
{
    use SessionTrait;

    public function testProjPlayNotOk(): void
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

        $client->request('POST', "/proj/play");
        $this->assertRouteSame('proj-play');

        $this->assertResponseRedirects('/proj');
    }

    public function testProjPlayFinished(): void
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
                'bet' => 100,
            ]
        );

        for ($i = 0; $i <= 4; $i++) {
            for ($j = 0; $j <= 4; $j++) {
                $client->request('POST', "/proj/one-round/{$i}/{$j}");
            }
        }

        $client->request('POST', "/proj/play");
        $this->assertRouteSame('proj-play');

        $this->assertResponseIsSuccessful();
        $response = strval($client->getResponse()->getContent());
        $this->assertStringContainsString('won', $response);
        $this->assertStringContainsString('final', $response);
    }

    public function testProjPlayOk(): void
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
                'bet' => 100,
            ]
        );

        $client->request('POST', "/proj/play");
        $this->assertRouteSame('proj-play');

        $this->assertResponseIsSuccessful();
        $response = strval($client->getResponse()->getContent());
        $this->assertStringContainsString('Your balance: 1340 coins', $response);
    }
}
