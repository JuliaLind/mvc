<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\DataFixtures\BookFixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Book;
use App\Repository\BookRepository;
use App\Repository\BookNotFoundException;

class LibraryControllerTest extends WebTestCase
{
    public function testReadOneOk(): void
    {
        $client = static::createClient();
        $client->request('GET', '/library/read_one/0123456789010');
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('read_one');
        $this->assertSelectorTextContains('h1', "Detaljer för bok 'Book 0'");
    }

    public function testReadOneNotOk(): void
    {
        $client = static::createClient();
        $client->request('GET', '/library/read_one/0123459999010');
        $this->assertRouteSame('read_one');
        $this->assertResponseRedirects('/library/read_many');
    }

    public function testReadMany(): void
    {
        $client = static::createClient();
        $client->request('GET', '/library/read_many');
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('read_many');
        $this->assertSelectorTextContains('h1', "Alla böcker");
    }

    public function testRemoveOne(): void
    {
        $client = static::createClient();

        /**
         * @var ObjectManager $doctrine
         */
        $doctrine = $client->getContainer()
        ->get('doctrine');

        /**
         * @var BookRepository $repo
         */
        $repo = $doctrine->getRepository(Book::class);

        $book = $repo->findOneByIsbn('0123456789010');
        $this->assertEquals('Book 0', $book->getTitle());

        $client->request('POST', '/library/delete/0123456789010');

        $this->assertRouteSame('book_delete_by_isbn');
        $this->assertResponseRedirects('/library/read_many');

        $this->expectException(BookNotFoundException::class);
        $book = $repo->findOneByIsbn('0123456789010');
    }
}
