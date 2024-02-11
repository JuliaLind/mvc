<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockFileSessionStorage;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProjectApiController2Test extends WebTestCase
{
    public function testApiUser(): void
    {
        $client = static::createClient();
        $client->request('GET', '/proj/api/user/user0@test.se');
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('api-user');
        $response = strval($client->getResponse()->getContent());
        $this->assertJson($response);
        // $this->assertStringContainsString('{"user":{"id":1,"email":"user0@test.se","acronym":"Julia","hash":"$2y$10$x.sVs3CFTtNSrvw3AEUMrufyhdlnU\/S3zqGEY8vgQXVsQS7lySiWy"},"balance":1440,"transactions":[{"id":9,"registered":"2023-06-30T00:00:00+02:00","descr":"Return (bet x 2)","amount":40,"user":{"id":1,"email":"user0@test.se","acronym":"Julia","hash":"$2y$10$x.sVs3CFTtNSrvw3AEUMrufyhdlnU\/S3zqGEY8vgQXVsQS7lySiWy"}},{"id":8,"registered":"2023-06-30T00:00:00+02:00","descr":"Bet","amount":-20,"user":{"id":1,"email":"user0@test.se","acronym":"Julia","hash":"$2y$10$x.sVs3CFTtNSrvw3AEUMrufyhdlnU\/S3zqGEY8vgQXVsQS7lySiWy"}},{"id":7,"registered":"2023-06-29T00:00:00+02:00","descr":"Return (bet x 2)","amount":840,"user":{"id":1,"email":"user0@test.se","acronym":"Julia","hash":"$2y$10$x.sVs3CFTtNSrvw3AEUMrufyhdlnU\/S3zqGEY8vgQXVsQS7lySiWy"}},{"id":6,"registered":"2023-06-29T00:00:00+02:00","descr":"Bet","amount":-420,"user":{"id":1,"email":"user0@test.se","acronym":"Julia","hash":"$2y$10$x.sVs3CFTtNSrvw3AEUMrufyhdlnU\/S3zqGEY8vgQXVsQS7lySiWy"}},{"id":3,"registered":"2023-06-27T00:00:00+02:00","descr":"Free registration bonus","amount":1000,"user":{"id":1,"email":"user0@test.se","acronym":"Julia","hash":"$2y$10$x.sVs3CFTtNSrvw3AEUMrufyhdlnU\/S3zqGEY8vgQXVsQS7lySiWy"}}],"scores":[{"id":2,"registered":"2023-06-29T00:00:00+02:00","points":38,"user":{"id":1,"email":"user0@test.se","acronym":"Julia","hash":"$2y$10$x.sVs3CFTtNSrvw3AEUMrufyhdlnU\/S3zqGEY8vgQXVsQS7lySiWy"}},{"id":4,"registered":"2023-06-30T00:00:00+02:00","points":132,"user":{"id":1,"email":"user0@test.se","acronym":"Julia","hash":"$2y$10$x.sVs3CFTtNSrvw3AEUMrufyhdlnU\/S3zqGEY8vgQXVsQS7lySiWy"}}]', $response);
    }
}
