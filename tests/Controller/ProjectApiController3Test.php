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
        $this->assertStringContainsString('"id":11,"user":"John","registered":"2023-06-30","descr":"Return (bet x 2)","amount":20},{"id":10,"user":"John","registered":"2023-06-30","descr":"Bet","amount":-10},{"id":9,"user":"Julia","registered":"2023-06-30","descr":"Return (bet x 2)","amount":40},{"id":8,"user":"Julia","registered":"2023-06-30","descr":"Bet","amount":-20},{"id":7,"user":"Julia","registered":"2023-06-29","descr":"Return (bet x 2)","amount":840},{"id":6,"user":"Julia","registered":"2023-06-29","descr":"Bet","amount":-420},{"id":5,"user":"John","registered":"2023-06-27","descr":"Return (bet x 2)","amount":80},{"id":4,"user":"John","registered":"2023-06-27","descr":"Bet","amount":-40},{"id":3,"user":"Julia","registered":"2023-06-27","descr":"Free registration bonus","amount":1000},{"id":2,"user":"Jane","registered":"2023-06-27","descr":"Free registration bonus","amount":1000},{"id":1,"user":"John","registered":"2023-06-25","descr":"Free registration bonus","amount":1000', $response);
    }
}
