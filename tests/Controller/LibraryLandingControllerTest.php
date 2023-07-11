<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\DataFixtures\BookFixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Book;
use App\Repository\BookRepository;
use App\Repository\BookNotFoundException;

class LibraryLandingControllerTest extends WebTestCase
{
    public function testLibrary(): void
    {
        $client = static::createClient();
        $client->request('GET', '/library');
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('library');
        $this->assertSelectorTextContains('h1', 'Biblioteket');
    }
}
