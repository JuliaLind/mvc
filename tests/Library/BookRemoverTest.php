<?php

namespace App\Library;

use App\Entity\Book;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\BookRepository;

use Symfony\Component\HttpFoundation\Request;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Bookremover.
 */
class BookRemoverTest extends TestCase
{
    /**
     * Construct object and check
     */
    public function testCreateObject(): void
    {
        $remover = new BookRemover();
        $this->assertInstanceOf("\App\Library\BookRemover", $remover);
    }

    /**
     * Tests the removeBook method
     */
    public function testRemoveBook(): void
    {
        $remover = new BookRemover();
        $book = $this->createMock(Book::class);
        $bookRepository = $this->createMock(BookRepository::class);
        $bookRepository->expects($this->once())
            ->method('remove')
            ->with($book, true);
        $remover->removeBook($bookRepository, $book);
    }
}
