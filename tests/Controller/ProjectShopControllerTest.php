<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockFileSessionStorage;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProjectShopControllerTest extends WebTestCase
{
    use SessionTrait;

    public function testShopOk(): void
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
        $client->request('POST', '/proj/shop');
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('shop');
        $content = strval($client->getResponse()->getContent());
        $this->assertStringContainsString('1440', $content);
    }

    public function testShopNotOk(): void
    {
        $client = static::createClient();
        $session = $this->createSession($client);
        $container = $client->getContainer();
        $container->set(Session::class, $session);
        $client->request('POST', '/proj/shop');
        $this->assertResponseRedirects('/proj');
    }

    public function testTransactionsOk(): void
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

        $client->request('POST', '/proj/transactions');
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('proj-trans');
        $content = strval($client->getResponse()->getContent());
        $this->assertStringContainsString('<td>-420</td>', $content);
        $this->assertStringContainsString('<td>Return (bet x 2)</td>', $content);
        $this->assertStringContainsString('<td>40</td>', $content);
        $this->assertStringContainsString('<td>840</td>', $content);
    }

    public function testTransactionsNotOk(): void
    {
        $client = static::createClient();
        $session = $this->createSession($client);
        $container = $client->getContainer();
        $container->set(Session::class, $session);
        $client->request('POST', '/proj/transactions');
        $this->assertResponseRedirects('/proj');
    }
}
