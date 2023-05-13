<?php

namespace App\Library;

use App\Entity\Book;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class FlashGenerator.
 */
class UpdateFlashGeneratorTest extends TestCase
{
    /**
     * Construct object and check
     */
    public function testCreateObject(): void
    {
        $flashGenerator = new UpdateFlashGenerator();
        $this->assertInstanceOf("\App\Library\UpdateFlashGenerator", $flashGenerator);
    }

    /**
     * Tests that correct message is generated
     * when a book is updated and it
     * went ok
     */
    public function testUpdateFlashOk(): void
    {
        $flashgenerator = new UpdateFlashGenerator();
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
        $flashgenerator = new UpdateFlashGenerator();
        $book = $this->createMock(Book::class);
        $book->method('getIsbn')
            ->willReturn("01234567890123");
        $res = $flashgenerator->updateFlash(false, $book);
        $exp = [
            "warning",
            "En annan bok med isbn '01234567890123' finns redan i systemet"
        ];
        $this->assertEquals($exp, $res);
    }
}
