<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\Book;
use App\Repository\BookRepository;
use App\Repository\BookNotFoundException;
use Doctrine\Persistence\ObjectManager;

class LibraryUpdateControllerTest extends WebTestCase
{
    public function testUpdateForm(): void
    {
        $client = static::createClient();
        $client->request('GET', '/library/update/0123456789010');
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('update_form');
        $this->assertSelectorTextContains('h1', "Uppdatera bokdetaljer för 'Book 0'");
    }
}
