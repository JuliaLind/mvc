<?php

namespace App\Entity;

use PHPUnit\Framework\TestCase;

use App\Repository\BookRepository;

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

        $title = "Test titel";
        $isbn = "1234567890123";
        $author = "Test Testsson";
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
