<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\DataFixtures\BookFixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\DBAL\Connection;
use App\Entity\Book;
use App\Repository\BookRepository;
use App\Repository\BookNotFoundException;

class LibraryControllerTest extends WebTestCase
{
    public function testLibrary(): void
    {
        $client = static::createClient();
        $client->request('GET', '/library');
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('library');
        $this->assertSelectorTextContains('h1', 'Biblioteket');
    }

    public function testCreateForm(): void
    {
        $client = static::createClient();
        $client->request('GET', '/library/create');
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('create_form');
        $this->assertSelectorTextContains('h1', 'Registrera ny bok');
    }

    public function testCreateNewOk(): void
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

        $book = new Book();
        $book->setTitle('New Book');
        $book->setIsbn('2345678901234');
        $book->setImg('https://newimglink.com');
        $book->setAuthor('The Author');

        $client->request(
            'POST',
            '/library/create_new',
            [
            'title' => 'New Book',
            'isbn' => '2345678901234',
            'image' => 'https://newimglink.com',
            'author' => 'The Author'
        ]
        );
        $this->assertRouteSame('book_create');
        $this->assertResponseRedirects('/library/read_one/2345678901234');

        $newBook = $repo->findOneByIsbn('2345678901234');
        $this->assertEquals('New Book', $newBook->getTitle());

    }

    public function testCreateNewNotOk(): void
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/library/create_new',
            [
            'title' => 'New Book',
            'isbn' => '0123456789010',
            'image' => 'https://newimglink.com',
            'author' => 'The Author'
        ]
        );
        $this->assertRouteSame('book_create');
        $this->assertResponseRedirects('/library/create');
    }

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

    public function testReset(): void
    {
        $loader = $this->createMock(SqlFileLoader::class);
        $connection = $this->createMock(Connection::class);

        $loader->expects($this->once())
        ->method('load')
        ->with($this->equalTo('sql/reset-book.sql'));
        $client = static::createClient([
            'services' => [
                'connection' => $connection
            ]
        ]);
        $container = $client->getContainer();
        $container->set(SqlFileLoader::class, $loader);


        $client->request('POST', '/library/reset');
        $this->assertRouteSame('reset_library');
        $this->assertResponseRedirects('/library/read_many');
    }
}
