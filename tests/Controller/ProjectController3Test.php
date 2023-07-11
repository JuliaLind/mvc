<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockFileSessionStorage;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

use App\Project\Game;
use App\ProjectGrid\Grid;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProjectController3Test extends WebTestCase
{
    use SessionTrait;

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
        $this->assertEquals([2, 1], $res);
    }

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

    public function testProjUnsetSuggest(): void
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
        $this->assertEquals([2, 1], $res);
    }

    public function testUnsetSuggest(): void
    {
        $client = static::createClient();
        $session = $this->createSession($client);
        $container = $client->getContainer();
        $container->set(Session::class, $session);

        $client->request('POST', "/proj/unset-suggestion");
        $this->assertRouteSame('proj-unset-suggest');
        $this->assertFalse($session->get('show-suggestion'));
        $this->assertResponseRedirects('/proj/play');

    }
}
