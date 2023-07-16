<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProjectApiController6Test extends WebTestCase
{
    public function testApiUsers(): void
    {
        $client = static::createClient();
        $client->request('GET', '/proj/api/users');
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('api-users');
        $response = strval($client->getResponse()->getContent());
        $this->assertJson($response);
        $this->assertStringContainsString('"user":{"id":1,"email":"user0@test.se","acronym":"Julia","hash":"$2y$10$x.sVs3CFTtNSrvw3AEUMrufyhdlnU\/S3zqGEY8vgQXVsQS7lySiWy"},"balance":1440', $response);

        $this->assertStringContainsString('"user":{"id":2,"email":"user2@test.se","acronym":"John","hash":"$2y$10$vrj5w\/4doYiH5FyUaZ993uQ1.4EJaW\/kz.ac6KHJVOT6jk3ho\/xLG"},"balance":1050},{"user":{"id":3,"email":"user3@test.se","acronym":"Jane","hash":"$2y$10$kQdkfh3TKX4uKxgP\/C8XhO170IonXIfQEGtLwxa4\/XDmYUC8HPW96"},"balance":1000', $response);

        $this->assertStringContainsString('"id":3,"email":"user3@test.se","acronym":"Jane","hash":"$2y$10$kQdkfh3TKX4uKxgP\/C8XhO170IonXIfQEGtLwxa4\/XDmYUC8HPW96"},"balance":1000', $response);
    }
}
