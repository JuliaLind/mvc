<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
// use App\Helpers\MainControllerHelper;
use Symfony\Component\HttpFoundation\Response;

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

    public function testLucky(): void
    {
        $client = static::createClient();
        $client->request('GET', '/lucky');
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('lucky');
        $this->assertSelectorTextContains('h1', 'Move the monkey');
        $content = strval($client->getResponse()->getContent());
        $this->assertStringContainsString('<img class="monkey" id="monkey" src="img/monkey.png" style="margin-left', $content);
    }

    public function testMetrics(): void
    {
        $client = static::createClient();
        $client->request('GET', '/metrics');
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('metrics');
    }
}
