<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockFileSessionStorage;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

use App\Project\Game;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProjectScoresControllerTest extends WebTestCase
{
    use SessionTrait;

    public function testProjScoresSingleOk(): void
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

        $client->request('GET', '/proj/scores-single');

        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('proj-scores-single');
        $content = strval($client->getResponse()->getContent());
        $this->assertStringContainsString('<td>132</td>', $content);
        $this->assertStringContainsString('<th>Points</th>', $content);
        $this->assertStringContainsString('<td>38</td>', $content);
    }

    public function testScoresSingleNotOk(): void
    {
        $client = static::createClient();
        $session = $this->createSession($client);
        $container = $client->getContainer();
        $container->set(Session::class, $session);
        $client->request('POST', '/proj/scores-single');
        $this->assertResponseRedirects('/proj');
    }

    public function testProjLeaderboard(): void
    {

        $client = static::createClient();
        $client->request('GET', '/proj/leaderboard');

        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('proj-leaderboard');
        $content = strval($client->getResponse()->getContent());
        $this->assertStringContainsString('<td>Julia</td>', $content);
        $this->assertStringContainsString('<td>John</td>', $content);
        $this->assertStringNotContainsString('<td>Jane</td>', $content);
    }
}
