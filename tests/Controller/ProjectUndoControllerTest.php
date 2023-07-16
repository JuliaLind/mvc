<?php

namespace App\Controller;

use App\Project\Game;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockFileSessionStorage;

class ProjectUndoControllerTest extends WebTestCase
{
    use SessionTrait;

    /**
     * Tests that route redirects back to play if the
     * player does not have enough money to purchase the cheat
     */
    public function testUndoNotOk(): void
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
                'bet' => 1431,
            ]
        );
        $client->request('POST', '/proj/one-round/2/1');
        $client->request('POST', '/proj/undo');
        $this->assertRouteSame('undo');
        $this->assertResponseRedirects('/proj/play');

        $expectedFlashbag = ['warning' => ["You do not have enough coins to use this cheat. Purchase more coins in the shop"]];

        /**
         * @var FlashBagInterface $bag
         */
        $bag = $session->getBag('flashes');

        $this->assertEquals($expectedFlashbag, $bag->peekAll());

        /**
         * @var Game $game
         */
        $game = $session->get('game');
        $state = $game->currentState();
        /**
         * @var array<array<array<string,string>>>
         */
        $playerCards = $state['player'];
        $this->assertNotEquals("", $playerCards[2][1]['alt']);
    }

    /**
     * Tests that the only last move is reversed and that coordinates
     */
    public function testUndoOk(): void
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
        $client->request('POST', '/proj/one-round/2/3');
        $client->request('POST', '/proj/one-round/0/4');
        $client->request('POST', '/proj/one-round/1/3');



        $client->request('POST', '/proj/undo');
        /**
         * @var Game $game
         */
        $game = $session->get('game');
        /**
         * @var array<string,mixed> $state
         */
        $state = $game ->currentState();
        /**
         * @var array<array<int>> $roundCoords
         */
        $roundCoords = $state['lastRound'];

        $res = $roundCoords['player'];

        $exp = [[2, 1], [2, 3], [0, 4]];
        $this->assertEquals($exp, $res);
        /**
         * @var array<array<int,array<string,string>>> $playerGrid
         */
        $playerGrid = $state['player'];
        $this->assertEquals($playerGrid[1][3]['alt'], "");
        $this->assertNotEquals($playerGrid[0][4]['alt'], "");
    }

    /**
     * Tests that the last move is reversed
     */
    public function testUndoOk2(): void
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

        $client->request('POST', '/proj/undo');
        $this->assertRouteSame('undo');
        $this->assertResponseRedirects('/proj/play');

        /**
         * @var Game $game
         */
        $game = $session->get('game');
        $state = $game->currentState();
        /**
         * @var array<array<array<string,string>>>
         */
        $playerCards = $state['player'];
        $this->assertEquals("", $playerCards[2][1]['alt']);
    }
}
