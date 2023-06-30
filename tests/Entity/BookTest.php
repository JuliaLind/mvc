<?php

namespace App\Entity;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Book.
 */
class BookTest extends TestCase
{
    /**
     * Construct object and check that all setters and getters
     * work as expected
     */
    public function testCreateObject(): void
    {
        $book = new Book();
        $this->assertInstanceOf("\App\Entity\Book", $book);

        /**
         * @var string $title
         */
        $title = "Test titel";
        /**
         * @var string $isbn
         */
        $isbn = "1234567890123";
        /**
         * @var string $author
         */
        $author = "Test Testsson";
        /**
         * @var string $img
         */
        $img = "https://notavalidpath.com";
        $book->setTitle($title);
        $book->setIsbn($isbn);
        $book->setAuthor($author);
        $book->setImg($img);

        $res = $book->getTitle();
        $exp = $title;
        $this->assertEquals($exp, $res);

        $res = $book->getIsbn();
        $exp = $isbn;
        $this->assertEquals($exp, $res);

        $res = $book->getAuthor();
        $exp = $author;
        $this->assertEquals($exp, $res);

        $res = $book->getImg();
        $exp = $img;
        $this->assertEquals($exp, $res);

        $res = $book->getId();
        $this->assertNull($res);
    }
}
