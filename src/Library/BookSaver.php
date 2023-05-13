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
class BookSaver
{
    /**
     * Returns true if everything was ok or false if not
     * @return bool
     */
    public function saveBook(BookRepository $bookRepository, Book $book): bool
    {
        try {
            $bookRepository->save($book, true);
            return true;
        } catch (IsbnAlreadyInUseException) {
            return false;
        }
    }
}
