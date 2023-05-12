<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\BookRepository;

use App\Library\BookNotFoundException;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Controller for json routes
 */
class JsonLibraryController extends AbstractController
{
    /**
     * Displays all books in the library
     */
    #[Route('/api/library/books', name: "books_json")]
    public function showAllBooks(
        BookRepository $bookRepository
    ): Response {
        $books = $bookRepository
            ->findAll();

        $response = $this->json($books);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    #[Route('/api/library/book/{isbn}', name: 'single_book_json')]
    public function showABookByIsbn(
        BookRepository $bookRepository,
        string $isbn
    ): Response {
        try {
            $book = $bookRepository
            ->findOneByIsbn($isbn);
        } catch (BookNotFoundException) {
            $book = "Book with ISBN {$isbn} was not found.";
        }


        return $this->json($book);
    }
}
