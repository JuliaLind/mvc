<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\BookRepository;
use App\Repository\BookNotFoundException;

use Symfony\Component\HttpFoundation\Request;

/**
 * Controller for API routes related to the libarary
 */
class JsonLibraryController extends AbstractController
{
    /**
     * Displays all books in the library
     */
    #[Route('/api/library/books', name: "books_json")]
    public function showAllBooks(
        BookRepository $bookRepository,
    ): Response {
        $books = $bookRepository->findAll();
        return $this->json($books);
    }

    /**
     * Displays data for one book as Json
     */
    #[Route('/api/library/book/{isbn}', name: 'single_book_json')]
    public function showABookByIsbn(
        BookRepository $bookRepository,
        string $isbn
    ): Response {
        try {
            $book = $bookRepository->findOneByIsbn($isbn);
        } catch (BookNotFoundException) {
            $book = "Book with ISBN {$isbn} was not found.";
        }


        return $this->json($book);
    }
}
