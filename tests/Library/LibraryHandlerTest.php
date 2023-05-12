<?php

namespace App\Library;

use App\Entity\Book;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\BookRepository;

use Symfony\Component\HttpFoundation\Request;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class GameHandler.
 */
class LibraryHandlerTest extends TestCase
{
    /**
     * Construct object and check
     */
    public function testCreateObject(): void
    {
        $libraryHandler = new LibraryHandler();
        $this->assertInstanceOf("\App\Library\LibraryHandler", $libraryHandler);
    }

    /**
     * Tests the updateBook method
     */
    public function testUpdateBook(): void
    {
        $libraryHandler = new LibraryHandler();
        $request = $this->createMock('Symfony\Component\HttpFoundation\Request');


        $request->expects($this->exactly(4))
        ->method('get')
        ->will($this->onConsecutiveCalls('bok-titel', '0123456543210', 'Anna Karin', 'https://bildlank.se'));

        $book = $this->createMock(Book::class);

        $book->expects($this->once())
            ->method('setTitle')
            ->with('bok-titel');
        $book->expects($this->once())
            ->method('setIsbn')
            ->with('0123456543210');
        $book->expects($this->once())
            ->method('setAuthor')
            ->with('Anna Karin');
        $book->expects($this->once())
            ->method('setImg')
            ->with('https://bildlank.se');

        $libraryHandler->updateBook($request, $book);
    }

    /**
     * Tests the updateBook method with ok ISBN
     */
    public function testSaveBookOk(): void
    {
        $libraryHandler = new LibraryHandler();
        $book = $this->createMock(Book::class);
        $bookRepository = $this->createMock(BookRepository::class);
        $bookRepository->expects($this->once())
            ->method('save')
            ->with($book, true);

        $res = $libraryHandler->saveBook($bookRepository, $book);
        $this->assertTrue($res);
    }

    /**
     * Tests the updateBook method with ISBN
     * already used for another book
     */
    public function testSaveBookNotOk(): void
    {
        $libraryHandler = new LibraryHandler();
        $book = $this->createMock(Book::class);
        $bookRepository = $this->createMock(BookRepository::class);
        $bookRepository->expects($this->once())
            ->method('save')
            ->with($book, true)
            ->will($this->throwException(new IsbnAlreadyInUseException()));

        $res = $libraryHandler->saveBook($bookRepository, $book);
        $this->assertFalse($res);
    }

    /**
     * Tests the removeBook method
     */
    public function testRemoveBook(): void
    {
        $libraryHandler = new LibraryHandler();
        $book = $this->createMock(Book::class);
        $bookRepository = $this->createMock(BookRepository::class);
        $bookRepository->expects($this->once())
            ->method('remove')
            ->with($book, true);
        $libraryHandler->removeBook($bookRepository, $book);
    }
}
