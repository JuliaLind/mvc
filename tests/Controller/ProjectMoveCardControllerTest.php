<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockFileSessionStorage;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

use App\Project\Game;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProjectMoveCardControllerTest extends WebTestCase
{
    use SessionTrait;

    public function testProjPickCardNotOk(): void
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
                'bet' => 1391,
            ]
        );

        $client->request('POST', "/proj/pick-card/49");
        $this->assertRouteSame('pick-card');

        $this->assertResponseRedirects('/proj/play');
        $expectedFlashbag = ['warning' => ["You do not have enough coins to use this cheat. Purchase more coins in the shop"]];

        /**
         * @var FlashBagInterface $bag
         */
        $bag = $session->getBag('flashes');

        $this->assertEquals($expectedFlashbag, $bag->peekAll());
    }

    public function testProjPickCardNotOk2(): void
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

        $client->request('POST', "/proj/pick-card/100");
        $this->assertRouteSame('pick-card');
        $this->assertResponseRedirects('/proj');
    }

    public function testProjPlaceCardNotOk(): void
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

        $client->request('POST', "/proj/place-card");
        $this->assertRouteSame('place-card');
        $this->assertResponseRedirects('/proj');
    }

    public function testProjPickCardOk(): void
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
        $client->request('GET', "/proj/pick-card/100");
        $this->assertRouteSame('pick-card');

        $this->assertResponseIsSuccessful();
        $content = strval($client->getResponse()->getContent());
        $this->assertStringContainsString('Click on the card you want to move', $content);
    }

    public function testSetFromSlotOk(): void
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
        $client->request('POST', '/proj/one-round/3/1');
        $client->request('POST', '/proj/one-round/4/2');
        $client->request('POST', "/proj/set-fromslot/3/1");

        $this->assertRouteSame('set-fromslot');
        $this->assertResponseRedirects('/proj/place-card');
        /**
         * @var Game $game
         */
        $game = $session->get('game');
        $state = $game->currentState();


        /**
         * @var array<string,array<int>> $lastRound
         */
        $lastRound = $state['lastRound'];
        $this->assertEquals([[3, 1], [4, 2]], $lastRound['player']);
        $this->assertEquals([3, 1], $state['fromSlot']);
        /**
         * @var array<array<array<string,string>>>
         */
        $playerCards = $state['player'];
        $this->assertNotEquals("", $playerCards[4][2]['alt']);
        $this->assertNotEquals("", $playerCards[3][1]['alt']);
        $this->assertEquals("", $playerCards[0][2]['alt']);
    }

    public function testMoveCardOk(): void
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
        $client->request('POST', '/proj/one-round/3/1');
        $client->request('POST', '/proj/one-round/4/2');
        $client->request('POST', "/proj/set-fromslot/3/1");
        $client->request('POST', "/proj/move-card/0/2");
        $this->assertRouteSame('move-card');
        $this->assertResponseRedirects('/proj/place-card');
        /**
         * @var Game $game
         */
        $game = $session->get('game');
        $state = $game->currentState();
        /**
         * @var array<string,array<int>> $lastRound
         */
        $lastRound = $state['lastRound'];
        $this->assertEquals([], $lastRound['player']);
        $this->assertEquals([], $state['fromSlot']);
        /**
         * @var array<array<array<string,string>>>
         */
        $playerCards = $state['player'];
        $this->assertNotEquals("", $playerCards[4][2]['alt']);
        $this->assertEquals("", $playerCards[3][1]['alt']);
        $this->assertNotEquals("", $playerCards[0][2]['alt']);
    }

    public function testMoveCardNotOk(): void
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
                'bet' => 1391,
            ]
        );
        $client->request('POST', '/proj/one-round/3/1');
        $client->request('POST', '/proj/one-round/4/2');
        $client->request('POST', "/proj/set-fromslot/3/1");
        $client->request('POST', "/proj/move-card/0/2");
        $this->assertRouteSame('move-card');
        $this->assertResponseRedirects('/proj/play');
        $expectedFlashbag = ['warning' => ["You do not have enough coins to use this cheat. Purchase more coins in the shop"]];

        /**
         * @var FlashBagInterface $bag
         */
        $bag = $session->getBag('flashes');

        $this->assertEquals($expectedFlashbag, $bag->peekAll());
    }
}
