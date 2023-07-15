<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockFileSessionStorage;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

use App\Project\Game;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProjectLandingControllerTest extends WebTestCase
{
    use SessionTrait;

    /**
     * Tests that correct template is rendered when the user has logged id
     */
    public function testProjLanding(): void
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
        $client->request('POST', '/proj');

        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('proj');

        $this->assertSelectorTextContains('h1', 'Welcome Julia!');

        $content = strval($client->getResponse()->getContent());
        $this->assertStringNotContainsString('Resume Game', $content);
    }

    /**
     * Tests that the rendered template contains a button for resuming
     * game if a game has been initiated
     */
    public function testProjLanding2(): void
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

        $client->request('POST', '/proj');



        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('proj');

        $this->assertSelectorTextContains('h1', 'Welcome Julia!');

        $content = strval($client->getResponse()->getContent());
        $this->assertStringContainsString('Resume Game', $content);
        /**
         * 1440 - 199 = 1241
         */
        $this->assertStringContainsString('1241', $content);
    }
}
