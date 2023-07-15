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

    /**
     * Tests that the user is redirected do the profile page if the route for
     * placing card (part of the move-a-card cheat) is accessed directly and before a game has been initiated
     */
    public function testPlaceCardNotOk(): void
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

    /**
     * Test that the user is redirected if the place card page is accessed
     * directly and before the from-slot has been set (before the pick card route)
     */
    public function testPlaceCardNotOk2(): void
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
        $client->request('POST', "/proj/place-card");
        $this->assertRouteSame('place-card');
        $this->assertResponseRedirects('/proj/play');
    }

    /**
     * Tests that if the one round move is accessed after the from slot has been sen,
     * the from slot will get unset
     */
    public function testPlaceCardNotOk3(): void
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
        $client->request('POST', '/proj/one-round/3/1');
        $client->request('POST', '/proj/one-round/4/2');
        $client->request('POST', "/proj/set-fromslot/3/1");
        $client->request('POST', '/proj/one-round/2/2');
        $client->request('POST', "/proj/place-card");
        $this->assertRouteSame('place-card');
        $this->assertResponseRedirects('/proj/play');
    }

    /**
     * Tests that route for placing card is working correctly if everyhing
     * is in order and that correct template is rendered
     */
    public function testPlaceCardOk(): void
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
        $client->request('POST', '/proj/one-round/3/1');
        $client->request('POST', '/proj/one-round/4/2');
        $client->request('POST', "/proj/set-fromslot/3/1");
        $client->request('POST', "/proj/place-card");
        $this->assertRouteSame('place-card');
        $this->assertResponseIsSuccessful();
        $content = strval($client->getResponse()->getContent());
        $this->assertStringContainsString('Click on an empty slot to which you want to move the selected card', $content);
    }


    /**
     * Tests that the move is working as expected
     * and a card is moved when everything is in order
     */
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
        $this->assertResponseRedirects('/proj/play');
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
