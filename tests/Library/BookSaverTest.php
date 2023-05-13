<?php

namespace App\Library;

use App\Entity\Book;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\BookRepository;

use Symfony\Component\HttpFoundation\Request;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class BookSaver
 */
class BookSaverTest extends TestCase
{
    /**
     * Construct object and check
     */
    public function testCreateObject(): void
    {
        $saver = new BookSaver();
        $this->assertInstanceOf("\App\Library\BookSaver", $saver);
    }

    /**
     * Tests the updateBook method with ok ISBN
     */
    public function testSaveBookOk(): void
    {
        $saver = new BookSaver();
        $book = $this->createMock(Book::class);
        $bookRepository = $this->createMock(BookRepository::class);
        $bookRepository->expects($this->once())
            ->method('save')
            ->with($book, true);

        $res = $saver->saveBook($bookRepository, $book);
        $this->assertTrue($res);
    }

    /**
     * Tests the updateBook method with ISBN
     * already used for another book
     */
    public function testSaveBookNotOk(): void
    {
        $saver = new BookSaver();
        $book = $this->createMock(Book::class);
        $bookRepository = $this->createMock(BookRepository::class);
        $bookRepository->expects($this->once())
            ->method('save')
            ->with($book, true)
            ->will($this->throwException(new IsbnAlreadyInUseException()));

        $res = $saver->saveBook($bookRepository, $book);
        $this->assertFalse($res);
    }
}
