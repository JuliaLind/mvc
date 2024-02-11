<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Test class for MainController
 */
class MainControllerTest extends WebTestCase
{
    public function testHome(): void
    {
        // $helper = $this->createMock(MainControllerHelper::class);
        // $helper->expects($this->once())
        //     ->method('standardData')
        //     ->with($this->equalTo('home'));
        $client = static::createClient();
        $client->request('GET', '/');
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('home');
        // $response = $client->getResponse();
    }

    public function testAbout(): void
    {
        $client = static::createClient();
        $client->request('GET', '/about');
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('about');
    }

    public function testReport(): void
    {
        $client = static::createClient();
        $client->request('GET', '/report');
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('report');
    }

    public function testMetrics(): void
    {
        $client = static::createClient();
        $client->request('GET', '/metrics');
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('metrics');
    }
}
