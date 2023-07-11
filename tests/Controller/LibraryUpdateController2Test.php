<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\Book;
use App\Repository\BookRepository;
// use App\Repository\BookNotFoundException;
use Doctrine\Persistence\ObjectManager;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockFileSessionStorage;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

class LibraryUpdateController2Test extends WebTestCase
{
    use SessionTrait;

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
        $session = $this->createSession($client);
        $container = $client->getContainer();
        /**
         * @var ObjectManager $doctrine
         */
        $doctrine = $container->get('doctrine');

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
        $expectedFlashbag = ['warning' => ["En annan bok med isbn '0123456789012' finns redan i systemet"]];

        /**
         * @var FlashBagInterface $bag
         */
        $bag = $session->getBag('flashes');

        $this->assertEquals($expectedFlashbag, $bag->peekAll());
    }
}
