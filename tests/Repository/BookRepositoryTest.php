<?php

namespace App\Repository;

use PHPUnit\Framework\TestCase;

use App\Entity\Book;
use App\Library\IsbnAlreadyInUseException;
use Doctrine\Persistence\ManagerRegistry;

use Doctrine\Persistence\ObjectManager;

/**
 * Test cases for class Book.
 */
class BookRepositoryTest extends TestCase
{
    /**
     * Construct object and check that all setters and getters
     * work as expected
     */
    public function testCreateObject(): void
    {
        $manager = $this->createMock(ManagerRegistry::class);
        $repo = new BookRepository($manager);
        $this->assertInstanceOf("\App\Repository\BookRepository", $repo);
    }


    /**
     * tests that CompareId method throws exception if
     * book and otherBook are not the same book
     */
    public function testCompareIdNotOk(): void
    {
        $manager = $this->createMock(ManagerRegistry::class);
        $repo = new BookRepository($manager);
        $this->expectException(IsbnAlreadyInUseException::class);
        $book = $this->createMock(Book::class);
        $otherBook = $this->createMock(Book::class);
        $book->expects($this->once())
                ->method('getId')
                ->willReturn(1);
        $otherBook->expects($this->once())
                ->method('getId')
                ->willReturn(3);
        $repo->compareId($book, $otherBook);
    }
}
