<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockFileSessionStorage;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProjectApiController3Test extends WebTestCase
{
    public function testApiTrasactions(): void
    {
        $client = static::createClient();
        $client->request('GET', '/proj/api/transactions');
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('api-transactions');
        $response = strval($client->getResponse()->getContent());
        $this->assertJson($response);
        // $this->assertStringContainsString('"id":11,"user":"John","registered":"2023-06-30","descr":"Return (bet x 2)","amount":20},{"id":10,"user":"John","registered":"2023-06-30","descr":"Bet","amount":-10},{"id":9,"user":"Julia","registered":"2023-06-30","descr":"Return (bet x 2)","amount":40},{"id":8,"user":"Julia","registered":"2023-06-30","descr":"Bet","amount":-20},{"id":7,"user":"Julia","registered":"2023-06-29","descr":"Return (bet x 2)","amount":840},{"id":6,"user":"Julia","registered":"2023-06-29","descr":"Bet","amount":-420},{"id":5,"user":"John","registered":"2023-06-27","descr":"Return (bet x 2)","amount":80},{"id":4,"user":"John","registered":"2023-06-27","descr":"Bet","amount":-40},{"id":3,"user":"Julia","registered":"2023-06-27","descr":"Free registration bonus","amount":1000},{"id":2,"user":"Jane","registered":"2023-06-27","descr":"Free registration bonus","amount":1000},{"id":1,"user":"John","registered":"2023-06-25","descr":"Free registration bonus","amount":1000', $response);

        $this->assertStringContainsString('[{"id":11,"registered":"2023-06-30T00:00:00+02:00","descr":"Return (bet x 2)","amount":20,"user":{"id":2,"email":"user2@test.se","acronym":"John","hash":"$2y$10$vrj5w\/4doYiH5FyUaZ993uQ1.4EJaW\/kz.ac6KHJVOT6jk3ho\/xLG","__initializer__":null,"__cloner__":null,"__isInitialized__":true}},{"id":10,"registered":"2023-06-30T00:00:00+02:00","descr":"Bet","amount":-10,"user":{"id":2,"email":"user2@test.se","acronym":"John","hash":"$2y$10$vrj5w\/4doYiH5FyUaZ993uQ1.4EJaW\/kz.ac6KHJVOT6jk3ho\/xLG","__initializer__":null,"__cloner__":null,"__isInitialized__":true}},{"id":9,"registered":"2023-06-30T00:00:00+02:00","descr":"Return (bet x 2)","amount":40,"user":{"id":1,"email":"user0@test.se","acronym":"Julia","hash":"$2y$10$x.sVs3CFTtNSrvw3AEUMrufyhdlnU\/S3zqGEY8vgQXVsQS7lySiWy","__initializer__":null,"__cloner__":null,"__isInitialized__":true}},{"id":8,"registered":"2023-06-30T00:00:00+02:00","descr":"Bet","amount":-20,"user":{"id":1,"email":"user0@test.se","acronym":"Julia","hash":"$2y$10$x.sVs3CFTtNSrvw3AEUMrufyhdlnU\/S3zqGEY8vgQXVsQS7lySiWy","__initializer__":null,"__cloner__":null,"__isInitialized__":true}},{"id":7,"registered":"2023-06-29T00:00:00+02:00","descr":"Return (bet x 2)","amount":840,"user":{"id":1,"email":"user0@test.se","acronym":"Julia","hash":"$2y$10$x.sVs3CFTtNSrvw3AEUMrufyhdlnU\/S3zqGEY8vgQXVsQS7lySiWy","__initializer__":null,"__cloner__":null,"__isInitialized__":true}},{"id":6,"registered":"2023-06-29T00:00:00+02:00","descr":"Bet","amount":-420,"user":{"id":1,"email":"user0@test.se","acronym":"Julia","hash":"$2y$10$x.sVs3CFTtNSrvw3AEUMrufyhdlnU\/S3zqGEY8vgQXVsQS7lySiWy","__initializer__":null,"__cloner__":null,"__isInitialized__":true}},{"id":5,"registered":"2023-06-27T00:00:00+02:00","descr":"Return (bet x 2)","amount":80,"user":{"id":2,"email":"user2@test.se","acronym":"John","hash":"$2y$10$vrj5w\/4doYiH5FyUaZ993uQ1.4EJaW\/kz.ac6KHJVOT6jk3ho\/xLG","__initializer__":null,"__cloner__":null,"__isInitialized__":true}},{"id":4,"registered":"2023-06-27T00:00:00+02:00","descr":"Bet","amount":-40,"user":{"id":2,"email":"user2@test.se","acronym":"John","hash":"$2y$10$vrj5w\/4doYiH5FyUaZ993uQ1.4EJaW\/kz.ac6KHJVOT6jk3ho\/xLG","__initializer__":null,"__cloner__":null,"__isInitialized__":true}},{"id":3,"registered":"2023-06-27T00:00:00+02:00","descr":"Free registration bonus","amount":1000,"user":{"id":1,"email":"user0@test.se","acronym":"Julia","hash":"$2y$10$x.sVs3CFTtNSrvw3AEUMrufyhdlnU\/S3zqGEY8vgQXVsQS7lySiWy","__initializer__":null,"__cloner__":null,"__isInitialized__":true}},{"id":2,"registered":"2023-06-27T00:00:00+02:00","descr":"Free registration bonus","amount":1000,"user":{"id":3,"email":"user3@test.se","acronym":"Jane","hash":"$2y$10$kQdkfh3TKX4uKxgP\/C8XhO170IonXIfQEGtLwxa4\/XDmYUC8HPW96","__initializer__":null,"__cloner__":null,"__isInitialized__":true}},{"id":1,"registered":"2023-06-25T00:00:00+02:00","descr":"Free registration bonus","amount":1000,"user":{"id":2,"email":"user2@test.se","acronym":"John","hash":"$2y$10$vrj5w\/4doYiH5FyUaZ993uQ1.4EJaW\/kz.ac6KHJVOT6jk3ho\/xLG","__initializer__":null,"__cloner__":null,"__isInitialized__":true}}]', $response);
    }
}
