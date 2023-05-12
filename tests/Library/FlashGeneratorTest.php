<?php

namespace App\Library;

use App\Entity\Book;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class FlashGenerator.
 */
class FlashGeneratorTest extends TestCase
{
    /**
     * Construct object and check
     */
    public function testCreateObject(): void
    {
        $flashGenerator = new FlashGenerator();
        $this->assertInstanceOf("\App\Library\FlashGenerator", $flashGenerator);
    }


    /**
     * Tests that correct message is generated
     * when new book is created and it went ok
     */
    public function testNewFlashOk(): void
    {
        $flashGenerator = new FlashGenerator();
        $book = $this->createMock(Book::class);
        $book->method('getTitle')
            ->willReturn("test-titel");
        $res = $flashGenerator->newFlash(true, $book);
        $exp = [
            "notice",
            "Boken 'test-titel' är registrerad. Klicka på kryset till höger för att gå till översikten"
        ];
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests that correct message is generated
     * when new book is created and it
     * did not go ok
     */
    public function testNewFlashNotOk(): void
    {
        $flashGenerator = new FlashGenerator();
        $book = $this->createMock(Book::class);
        $book->method('getIsbn')
            ->willReturn("01234567890123");
        $res = $flashGenerator->newFlash(false, $book);
        $exp = [
            "warning",
            "En bok med isbn '01234567890123' finns redan i systemet. ISBN nummer måste vara unik"
        ];
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests that correct message is generated
     * when a book is updated and it
     * went ok
     */
    public function testUpdateFlashOk(): void
    {
        $flashgenerator = new FlashGenerator();
        $book = $this->createMock(Book::class);
        $res = $flashgenerator->updateFlash(true, $book);
        $exp = ["", ""];
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests that correct message is generated
     * when a book is updated and it
     * did not go ok
     */
    public function testUpdateFlashNotOk(): void
    {
        $flashgenerator = new FlashGenerator();
        $book = $this->createMock(Book::class);
        $book->method('getIsbn')
            ->willReturn("01234567890123");
        $res = $flashgenerator->updateFlash(false, $book);
        $exp = [
            "warning",
            "Another book with isbn '01234567890123' already exists in the system"
        ];
        $this->assertEquals($exp, $res);
    }

    /**
     * Tests that correct message is generated
     * when a book is removed
     */
    public function testRemoveFlash(): void
    {
        $flashgenerator = new FlashGenerator();
        $book = $this->createMock(Book::class);
        $book->method('getTitle')
            ->willReturn("En Titel");
        $res = $flashgenerator->removeFlash($book);
        $exp = [
            "warning",
            "Boken 'En Titel' har raderats"
        ];
        $this->assertEquals($exp, $res);
    }
}
