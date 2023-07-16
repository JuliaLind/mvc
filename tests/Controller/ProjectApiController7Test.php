<?php

namespace App\Controller;

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
        $this->assertStringContainsString('"id":4,"registered":"2023-06-30T00:00:00+02:00","points":132,"user":{"id":1,"email":"user0@test.se","acronym":"Julia","hash":"$2y$10$x.sVs3CFTtNSrvw3AEUMrufyhdlnU\/S3zqGEY8vgQXVsQS7lySiWy"', $response);

        $this->assertStringContainsString('"id":3,"registered":"2023-06-30T00:00:00+02:00","points":70,"user":{"id":2,"email":"user2@test.se","acronym":"John","hash":"$2y$10$vrj5w\/4doYiH5FyUaZ993uQ1.4EJaW\/kz.ac6KHJVOT6jk3ho\/xLG",', $response);

        $this->assertStringContainsString('"id":2,"registered":"2023-06-29T00:00:00+02:00","points":38,"user":{"id":1,"email":"user0@test.se","acronym":"Julia","hash":"$2y$10$x.sVs3CFTtNSrvw3AEUMrufyhdlnU\/S3zqGEY8vgQXVsQS7lySiWy"', $response);
    }
}
