<?php

namespace App\Library;

use App\Entity\Book;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class FlashGenerator.
 */
class RemoveFlashGeneratorTest extends TestCase
{
    /**
     * Construct object and check
     */
    public function testCreateObject(): void
    {
        $flashGenerator = new RemoveFlashGenerator();
        $this->assertInstanceOf("\App\Library\RemoveFlashGenerator", $flashGenerator);
    }

    /**
     * Tests that correct message is generated
     * when a book is removed
     */
    public function testRemoveFlash(): void
    {
        $flashgenerator = new RemoveFlashGenerator();
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
