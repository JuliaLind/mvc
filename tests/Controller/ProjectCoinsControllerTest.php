<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProjectCoinsControllerTest extends WebTestCase
{
    use SessionTrait;

    /**
     * Tests that the purchase route is workind and that the transaction is registered
     * (by checking that the balance has increased)
     */
    public function testProjPurchase(): void
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

        $client->request('POST', '/proj/purchase/300');
        $this->assertRouteSame('purchase');
        $this->assertResponseRedirects('/proj/shop');

        $expectedFlashbag = ['notice' => ["You have successfully purchased 300 coins. Your new balance is 1740 coins"]];

        /**
         * @var FlashBagInterface $bag
         */
        $bag = $session->getBag('flashes');

        $this->assertEquals($expectedFlashbag, $bag->peekAll());
    }

    /**
     * Tests that the select amount route is not avaiable if the used has below 10 coints,
     * and that the user is redirected tot eh Shop with correct flashmessage
     */
    public function testSelectAmountNotOk(): void
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

        $client->request('GET', '/proj/select-amount');
        $this->assertRouteSame('select-amount');
        $this->assertResponseRedirects('/proj/shop');
        $expectedFlashbag = ['warning' => ["You do not have enough coins, the minimum amount to bet is 10 coins. Purchase more coins in the shop"]];

        /**
         * @var FlashBagInterface $bag
         */
        $bag = $session->getBag('flashes');

        $this->assertEquals($expectedFlashbag, $bag->peekAll());
    }

    /**
     * Tests that the the select-amount route redirects to the landing page if
     * the route is accessed directly before the user has logged in
     */
    public function testSelectAmountNotOk2(): void
    {
        $client = static::createClient();
        $session = $this->createSession($client);
        $container = $client->getContainer();
        $container->set(Session::class, $session);
        $client->request('GET', '/proj/select-amount');

        $this->assertResponseRedirects('/proj');
    }

    /**
     * Tests that the select amount route is wprking as expected if
     * everything is in order and that correct template is rendered
     */
    public function testSelectAmountOk(): void
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

        $client->request('GET', '/proj/select-amount');
        $this->assertRouteSame('select-amount');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Place your bet');
        $response = strval($client->getResponse()->getContent());
        $this->assertStringContainsString('max="1440"', $response);
        $this->assertStringContainsString('min="10"', $response);
        $this->assertStringContainsString('value="10"', $response);
    }
}
