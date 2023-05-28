<?php

namespace App\Library;

use App\Entity\Book;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\BookRepository;

use Symfony\Component\HttpFoundation\Request;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class BookUpdator
 */
class BookUpdatorTest extends TestCase
{
    /**
     * Construct object and check
     */
    public function testCreateObject(): void
    {
        $updator = new BookUpdator();
        $this->assertInstanceOf("\App\Library\BookUpdator", $updator);
    }

    /**
     * Tests the updateBook method
     */
    public function testUpdateBook(): void
    {
        $updator = new BookUpdator();
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

        $updator->updateBook($request, $book);
    }
}
