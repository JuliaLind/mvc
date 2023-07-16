<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use App\Project\Game;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProjectSuggestionControllerTest extends WebTestCase
{
    use SessionTrait;

    /**
     * Tests that user is redirected vak to play if
     * they do not have enough money to purchase the cheat
     */
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

    /**
     * Tests that user is redirected to the show-suggestion route if they have enough money
     * to make the transaction
     */
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
        /**
         * @var Game $game
         */
        $game = $session->get('game');
        $state = $game->currentState();

        $this->assertNotEquals([], $state['suggestion']);
    }

    /**
     * Tests that user is redirected back to play if the show-suggestion route is accessed directly without paying for the cheat first
     */
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

        /**
         * @var Game $game
         */
        $game = $session->get('game');
        $state = $game->currentState();

        $this->assertEquals([], $state['suggestion']);
    }

    /**
     * Tests that the show-suggestion route works as intended
     * when the suggestion cheat has been paid for
     */
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
