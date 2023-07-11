<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockFileSessionStorage;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProjectControllerTest extends WebTestCase
{
    public function testProjApiLanding(): void
    {
        $client = static::createClient();
        $client->request('GET', "/proj/api");
        $this->assertRouteSame('proj-api');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Api routes');
    }

    public function testProjAbout(): void
    {
        $client = static::createClient();
        $client->request('GET', "/proj/about");
        $this->assertRouteSame('proj-about');
        $this->assertResponseIsSuccessful();
    }

    public function testProjRules(): void
    {
        $client = static::createClient();
        $client->request('GET', "/proj/rules");
        $this->assertRouteSame('proj-rules');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Rules');
    }

    public function testProjRegisterForm(): void
    {
        $client = static::createClient();
        $client->request('GET', "/proj/register-form");
        $this->assertRouteSame('register-form');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Register and get 1000 free coins');
    }
}
