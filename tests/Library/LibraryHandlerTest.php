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

        // $request->method('get')->will($this->onConsecutiveCalls('bok-titel', '0123456543210', 'Anna Karin', 'https://bildlank.se'));

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

}
