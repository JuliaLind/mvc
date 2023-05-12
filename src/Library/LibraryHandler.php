<?php

namespace App\Library;

use App\Entity\Book;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\BookRepository;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use Doctrine\DBAL\Connection;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * Helper class to handle som of the
 * funcitonality in the LibraryController
 */
class LibraryHandler
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

    /**
     * Removes book
     */
    public function removeBook(BookRepository $bookRepository, Book $book): void
    {
        $bookRepository->remove($book, true);
    }

    /**
     * Generates class and text for flashmessage
     * for the flash message
     * @return array<string>
     */
    public function generateFlash(string $action, Book $book, bool $wentWell): array
    {
        $flash = ["", ""];
        $title = $book->getTitle();
        $isbn = $book->getIsbn();

        switch ($action) {
            case 'new':
                switch ($wentWell) {
                    case true:
                        $flash = [
                            "notice",
                            "Boken '{$title}' är registrerad. Klicka på kryset till höger för att gå till översikten"
                        ];
                        break;
                    case false:
                        $flash = [
                            "warning",
                            "En bok med isbn '{$isbn}' finns redan i systemet. ISBN nummer måste vara unik"
                        ];
                        break;
                }
                break;
            case 'update':
                switch ($wentWell) {
                    case false:
                        $flash = [
                            "warning",
                            "Another book with isbn '{$isbn}' already exists in the system"
                        ];
                        break;
                    case 'remove':
                        $flash = [
                            "warning",
                            "Boken '{$title}' har raderats"
                        ];
                };
        }
        return $flash;
    }
}
