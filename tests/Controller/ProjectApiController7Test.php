<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockFileSessionStorage;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProjectApiController7Test extends WebTestCase
{
    public function testApiUsers(): void
    {
        $client = static::createClient();
        $client->request('GET', '/proj/api/leaderboard');
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('api-leaderboard');
        $response = strval($client->getResponse()->getContent());
        $this->assertJson($response);
        $this->assertStringContainsString('"user":"Julia","registered":"2023-06-30","points":132},{"user":"John","registered":"2023-06-30","points":70},{"user":"John","registered":"2023-06-27","points":43},{"user":"Julia","registered":"2023-06-29","points":38', $response);
    }
}
