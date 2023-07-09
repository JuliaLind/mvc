<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\Book;
use App\Repository\BookRepository;
use App\Repository\BookNotFoundException;
use Doctrine\Persistence\ObjectManager;

class LibraryController2Test extends WebTestCase
{
    public function testUpdateForm(): void
    {
        $client = static::createClient();
        $client->request('GET', '/library/update/0123456789010');
        $this->assertResponseIsSuccessful();
        $this->assertRouteSame('update_form');
        $this->assertSelectorTextContains('h1', "Uppdatera bokdetaljer för 'Book 0'");
    }

    public function testUpdateOk(): void
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
        /**
         * @var Book $book
         */
        $book = $repo->find(1);
        $this->assertEquals('Book 0', $book->getTitle());

        $client->request(
            'POST',
            '/library/update_one',
            [
            'book_id' => 1,
            'title' => 'Updated Book',
            'isbn' => '0123456789010',
            'image' => 'https://newimglink.com',
            'author' => 'The Author',
            'original_isbn' => '0123456789010'
            ]
        );
        $this->assertRouteSame('book_update');
        $this->assertResponseRedirects('/library/read_one/0123456789010');
        /**
         * @var Book $bookUpdated
         */
        $bookUpdated = $repo->find(1);
        $this->assertEquals('Updated Book', $bookUpdated->getTitle());
    }

    public function testUpdateAnotherOk(): void
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
        /**
         * @var Book $book
         */
        $book = $repo->find(1);
        $this->assertEquals('0123456789010', $book->getIsbn());
        $client->request(
            'POST',
            '/library/update_one',
            [
            'book_id' => 1,
            'title' => 'Updated Book',
            'isbn' => '0123459999010',
            'image' => 'https://newimglink.com',
            'author' => 'The Author',
            'original_isbn' => '0123456789010'
            ]
        );
        $this->assertRouteSame('book_update');
        $this->assertResponseRedirects('/library/read_one/0123459999010');
        /**
         * @var Book $bookUpdated
         */
        $bookUpdated = $repo->find(1);
        $this->assertEquals('0123459999010', $bookUpdated->getIsbn());
    }

    public function testUpdateNotOk(): void
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
        $client->request(
            'POST',
            '/library/update_one',
            [
            'book_id' => 1,
            'title' => 'Updated Book',
            'isbn' => '0123456789012',
            'image' => 'https://newimglink.com',
            'author' => 'The Author',
            'original_isbn' => '0123456789010'
            ]
        );
        $this->assertRouteSame('book_update');
        $this->assertResponseRedirects('/library/update/0123456789010');
        /**
         * @var Book $bookUpdated
         */
        $bookUpdated = $repo->findOneByIsbn('0123456789012');
        $this->assertEquals(3, $bookUpdated->getId());
        /**
         * @var Book $book
         */
        $book = $repo->findOneByIsbn('0123456789010');
        $this->assertEquals(1, $book->getId());
    }
}
