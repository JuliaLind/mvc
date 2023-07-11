<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockFileSessionStorage;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

use App\Project\Game;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProjectSuggestionControllerTest extends WebTestCase
{
    use SessionTrait;

    public function testProjPurchaseSuggestNotOk(): void
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
                'bet' => 1411,
            ]
        );

        $client->request('POST', "/proj/purchase-suggestion");
        $this->assertRouteSame('purchase-suggestion');
        $this->assertFalse($session->get('show-suggestion'));
        $this->assertResponseRedirects('/proj/play');
        $expectedFlashbag = ['warning' => ["You do not have enough coins to use this cheat. Purchase more coins in the shop"]];

        /**
         * @var FlashBagInterface $bag
         */
        $bag = $session->getBag('flashes');

        $this->assertEquals($expectedFlashbag, $bag->peekAll());
    }

    public function testProjPurchaseSuggestOk(): void
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
                'bet' => 1410,
            ]
        );

        $client->request('POST', "/proj/purchase-suggestion");
        $this->assertRouteSame('purchase-suggestion');
        $this->assertResponseRedirects('/proj/show-suggestion');
        $this->assertTrue($session->get('show-suggestion'));
    }

    public function testProjShowSuggestNotOk(): void
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

        $client->request('POST', "/proj/show-suggestion");
        $this->assertRouteSame('show-suggestion');
        $this->assertResponseRedirects('/proj/play');
    }

    public function testProjShowSuggestOk(): void
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
        $client->request('POST', "/proj/purchase-suggestion");
        $client->request('POST', "/proj/show-suggestion");
        $this->assertRouteSame('show-suggestion');
        $this->assertResponseIsSuccessful();
        /**
         * @var Game $game
         */
        $game = $session->get('game');
        $state = $game->currentState();
        $this->assertNotEquals([], $state['suggestion']);
    }
}
