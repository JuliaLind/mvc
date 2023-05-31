<?php

namespace App\Library;

use App\Entity\Book;
use App\Repository\BookRepository;

use Symfony\Component\HttpFoundation\Request;

// use Doctrine\DBAL\Connection;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * Helper class to handle som of the
 * funcitonality in the LibraryController
 */
class BookRemover
{
    /**
     * Removes book
     */
    public function removeBook(BookRepository $bookRepository, Book $book): void
    {
        $bookRepository->remove($book, true);
    }
}