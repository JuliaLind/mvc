<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockFileSessionStorage;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

use App\Project\Game;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProjectInitControllerTest extends WebTestCase
{
    use SessionTrait;

    /**
     * Tests that the inti route works if everything is in order
     */
    public function testInitOk(): void
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
                'bet' => 199,
            ]
        );

        $this->assertResponseRedirects('/proj/play');
        $this->assertRouteSame('proj-init');

        $userId = $session->get('user');
        $this->assertEquals(1, $userId);

        /**
         * @var Game $game
         */
        $game = $session->get('game');
        $state = $game->currentState();
        $this->assertEquals(199, $state['bet']);
    }

    /**
     * Tests that the init route does not work and that correct flashmessage is generated
     * if the user does not have enough money
     * to cover for the bet
     */
    public function testInitNotOk(): void
    {

        $client = static::createClient();
        $session = $this->createSession($client);
        $container = $client->getContainer();
        $container->set(Session::class, $session);

        $client->request(
            'POST',
            '/proj/login',
            [
                'email' => 'user3@test.se',
                'password' => 'jane'
            ]
        );

        $client->request(
            'POST',
            '/proj/init',
            [
                'bet' => 2000,
            ]
        );

        $this->assertResponseRedirects('/proj/shop');
        $this->assertRouteSame('proj-init');

        $userId = $session->get('user');
        $this->assertEquals(3, $userId);

        $expectedFlashbag = ['warning' => ["You do not have enough coins to place the wanted bet. Purchase more coins in the shop"]];

        /**
         * @var FlashBagInterface $bag
         */
        $bag = $session->getBag('flashes');

        $this->assertEquals($expectedFlashbag, $bag->peekAll());
    }
}
