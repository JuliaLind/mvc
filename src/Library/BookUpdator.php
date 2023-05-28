<?php

namespace App\Library;

use App\Entity\Book;
use App\Repository\BookRepository;

use Symfony\Component\HttpFoundation\Request;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * Helper class to handle som of the
 * funcitonality in the LibraryController
 */
class BookUpdator
{
    /**
     * Updates details of a book object
     */
    public function updateBook(Request $request, Book $book): void
    {
        /**
         * @var string $title
         */
        $title = $request->get('title');
        /**
         * @var string $isbn
         */
        $isbn = $request->get('isbn');
        /**
         * @var string $author
         */
        $author = $request->get('author');
        /**
         * @var string $imgLink
         */
        $imgLink = $request->get('image');

        $book->setTitle($title);
        $book->setIsbn($isbn);
        $book->setAuthor($author);
        $book->setImg($imgLink);
    }
}
