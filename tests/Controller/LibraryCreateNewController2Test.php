<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\DataFixtures\BookFixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Book;
use App\Repository\BookRepository;
use App\Repository\BookNotFoundException;

class LibraryCreateNewController2Test extends WebTestCase
{
    public function testCreateForm(): void
    {
        $client = static::createClient();
        $client->request('GET', '/library/create');
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('create_form');
        $this->assertSelectorTextContains('h1', 'Registrera ny bok');
    }
}
