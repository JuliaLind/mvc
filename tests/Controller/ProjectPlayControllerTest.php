<?php

namespace App\Controller;

use App\Project\Game;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockFileSessionStorage;

class ProjectPlayControllerTest extends WebTestCase
{
    use SessionTrait;

    /**
     * Tests that user is redirected to profile-page if route is
     * accessed directly via url before a game is initiated
     */
    public function testProjPlayNotOk(): void
    {
        $client = static::createClient();

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

    /**
     * Tests that correct template is rendered for a finished game
     */
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
        $this->assertStringContainsString('Final score', $response);
        /**
         * @var Game $game
         */
        $game = $session->get('game');
        /**
         * @var array<string,mixed> $state
         */
        $state = $game ->currentState();
        $this->assertTrue($state['finished']);
        $this->assertEquals(25, $state['placedCards']);
        $this->assertEquals([], $state['playerPossibleCards']);
    }


    /**
     * Tests that play route works and correct template is rendered
     */
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
        $this->assertStringContainsString('Balance: 1340 coins', $response);

        /**
         * @var Game $game
         */
        $game = $session->get('game');
        $state = $game->currentState();
        $this->assertEquals(100, $state['bet']);
    }
}
