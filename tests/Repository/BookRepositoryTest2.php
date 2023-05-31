<?php

namespace App\Tests\Repository;

use App\Entity\Book;
use App\Library\BookNotFoundException;
use App\Repository\BookRepository;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class BookRepositoryTest2 extends KernelTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        /** @phpstan-ignore-next-line */
        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    // public function testSearchByName()
    // {
    //     $product = $this->entityManager
    //         ->getRepository(Product::class)
    //         ->findOneBy(['name' => 'Priceless widget'])
    //     ;

    //     $this->assertSame(14.50, $product->getPrice());
    // }

    public function testFindOneByIsbn(): void
    {
        /**
         * @var BookRepository $bookRepository
         */
        $bookRepository = $this->entityManager
        ->getRepository(Book::class);

        /**
         * @var Book $book
         */
        $book = $bookRepository->findOneByIsbn('0123456789010');
        $this->assertSame('Book 0', $book->getTitle());
    }

    public function testSave(): void
    {
        /**
         * @var BookRepository $bookRepository
         */
        $bookRepository = $this->entityManager
        ->getRepository(Book::class);

        /**
         * @var Book $book
         */
        $book = new Book();
        $book->setAuthor('New Author');
        $book->setTitle('New Book');
        $book->setIsbn('0909090909090');
        $book->setImg('https://newbookimg.com');
        $bookRepository->save($book, true);

        $bookRepository->findOneByIsbn('0909090909090');

        $this->assertSame('New Book', $book->getTitle());
    }

    public function testRemove(): void
    {
        /**
         * @var BookRepository $bookRepository
         */
        $bookRepository = $this->entityManager
        ->getRepository(Book::class);

        /**
         * @var Book $book
         */
        $book = $bookRepository->findOneByIsbn('0123456789010');
        $this->assertSame('Book 0', $book->getTitle());

        $bookRepository->remove($book, true);

        $this->expectException(BookNotFoundException::class);
        $bookRepository->findOneByIsbn('0123456789010');
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        // doing this is recommended to avoid memory leaks
        $this->entityManager->close();
        /** @phpstan-ignore-next-line */
        $this->entityManager = null;
    }
}
