<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockFileSessionStorage;
use App\Project\ApiGame2;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProjectApiController4Test extends WebTestCase
{
    public function testApiPlaceCard(): void
    {
        $client = static::createClient();
        $client->request('POST', '/proj/api/place-card/3/1');
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('api-place-card');
        $response = strval($client->getResponse()->getContent());
        $this->assertJson($response);
        $this->assertStringContainsString('on row 3 column 1', $response);
    }

    public function testApiPlaceCard2(): void
    {
        $client = static::createClient();
        $container = $client->getContainer();
        $game = $this->createMock(ApiGame2::class);
        $game->expects($this->once())->method('oneRound')
        ->with($this->equalTo(4), $this->equalTo(2));
        $container->set(ApiGame2::class, $game);
        $client->request('POST', '/proj/api/place-card/4/2');
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('api-place-card');
    }

}
