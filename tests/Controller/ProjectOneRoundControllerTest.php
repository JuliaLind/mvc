<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockFileSessionStorage;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

use App\Project\Game;
use App\ProjectGrid\Grid;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProjectOneROundControllerTest extends WebTestCase
{
    use SessionTrait;

    /**
     * Tests that the one round route is working correctly for a game hat is not finished
     */
    public function testProjRoundNotFinished(): void
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


        $client->request('POST', '/proj/one-round/2/1');
        $this->assertResponseRedirects('/proj/play');
        $this->assertRouteSame('proj-round');
        /**
         * @var Game $game
         */
        $game = $session->get('game');
        $state = $game->currentState();

        /**
         * @var array<array<int>> $lastRound
         */
        $lastRound = $state['lastRound'];
        $res = $lastRound['player'];
        $this->assertEquals([2, 1], $res[0]);
    }

    /**
     * Tests that the one round route is working correctly
     * if the game is finished
     */
    public function testProjRoundFinished(): void
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

        /**
         * @var Game $game
         */
        $game = $session->get('game');
        $state = $game->currentState();

        $this->assertTrue($state['finished']);
    }
}
