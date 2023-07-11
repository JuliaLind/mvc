<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockFileSessionStorage;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProjectCoinsControllerTest extends WebTestCase
{
    use SessionTrait;

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

    public function testSelectAmountNotOk2(): void
    {
        $client = static::createClient();
        $session = $this->createSession($client);
        $container = $client->getContainer();
        $container->set(Session::class, $session);
        $client->request('GET', '/proj/select-amount');

        $this->assertResponseRedirects('/proj');
    }

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
        $this->assertSelectorTextContains('h1', 'Select amount to bet');
        $response = strval($client->getResponse()->getContent());
        $this->assertStringContainsString('max="1440"', $response);
        $this->assertStringContainsString('min="10"', $response);
        $this->assertStringContainsString('value="10"', $response);
    }
}
