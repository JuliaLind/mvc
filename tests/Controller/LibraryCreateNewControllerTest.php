<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\DataFixtures\BookFixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Book;
use App\Repository\BookRepository;
use App\Repository\BookNotFoundException;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\MockFileSessionStorage;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

class LibraryCreateNewControllerTest extends WebTestCase
{
    use SessionTrait;

    public function testCreateNewOk(): void
    {
        $client = static::createClient();
        $session = $this->createSession($client);
        $container = $client->getContainer();
        $container->set(Session::class, $session);
        /**
         * @var ObjectManager $doctrine
         */
        $doctrine = $container->get('doctrine');

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
        $expectedFlashbag = ['notice' => ["Boken 'New Book' är registrerad. Klicka på kryset till höger för att gå till översikten"]];

        /**
         * @var FlashBagInterface $bag
         */
        $bag = $session->getBag('flashes');

        $this->assertEquals($expectedFlashbag, $bag->peekAll());

    }

    public function testCreateNewNotOk(): void
    {
        $client = static::createClient();
        $session = $this->createSession($client);
        $container = $client->getContainer();
        $container->set(Session::class, $session);
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

        $expectedFlashbag = ['warning' => ["En bok med isbn '0123456789010' finns redan i systemet. ISBN nummer måste vara unik"]];

        /**
         * @var FlashBagInterface $bag
         */
        $bag = $session->getBag('flashes');

        $this->assertEquals($expectedFlashbag, $bag->peekAll());
    }
}
