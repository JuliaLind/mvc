<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class JsonControllerTest extends WebTestCase
{
    public function testApi(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api');
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('api');
        $this->assertSelectorTextContains('h1', 'Json routes overview');
    }

    public function testQuote(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/quote');
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('quote');
        $response = strval($client->getResponse()->getContent());
        $this->assertJson($response);
        /**
         * Will always generate same response because random_int function is mocked in QuoteTest in
         * this same (Controller) namespace
         */
        $this->assertStringContainsString("Any fool can write code that a computer can understand.", $response);
    }
}
