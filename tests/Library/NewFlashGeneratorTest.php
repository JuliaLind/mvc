<?php

namespace App\Library;

use App\Entity\Book;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class FlashGenerator.
 */
class NewFlashGeneratorTest extends TestCase
{
    /**
     * Construct object and check
     */
    public function testCreateObject(): void
    {
        $flashGenerator = new NewFlashGenerator();
        $this->assertInstanceOf("\App\Library\NewFlashGenerator", $flashGenerator);
    }


    /**
     * Tests that correct message is generated
     * when new book is created and it went ok
     */
    public function testNewFlashOk(): void
    {
        $flashGenerator = new NewFlashGenerator();
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
        $flashGenerator = new NewFlashGenerator();
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
}
