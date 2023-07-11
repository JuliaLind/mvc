<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockFileSessionStorage;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

use App\Project\Game;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProjectController7Test extends WebTestCase
{
    use SessionTrait;

    public function testUndoCheatNotOk(): void
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
    }

    public function testUndoCheatOk(): void
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

        // /**
        //  * @var Game $game
        //  */
        // $game = $session->get('game');
        // $state = $game->currentState();

        // /**
        //  * @var array<array<int>> $lastRound
        //  */
        // $lastRound = $state['lastRound'];
        // $res = $lastRound['player'];
        // $this->assertEquals([], $res);
    }

}
