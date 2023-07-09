<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockFileSessionStorage;

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
        $this->assertStringContainsString('"id":1,"acronym":"Julia","email":"user0@test.se","hash":"$2y$10$x.sVs3CFTtNSrvw3AEUMrufyhdlnU\/S3zqGEY8vgQXVsQS7lySiWy","balance":1440},{"id":2,"acronym":"John","email":"user2@test.se","hash":"$2y$10$vrj5w\/4doYiH5FyUaZ993uQ1.4EJaW\/kz.ac6KHJVOT6jk3ho\/xLG","balance":1050},{"id":3,"acronym":"Jane","email":"user3@test.se","hash":"$2y$10$kQdkfh3TKX4uKxgP\/C8XhO170IonXIfQEGtLwxa4\/XDmYUC8HPW96","balance":1000', $response);
    }
}
