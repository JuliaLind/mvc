<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository;
use App\Repository\BookNotFoundException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Controller that contains routes related to the library
 */
class LibraryController5 extends AbstractController
{
    /**
     * Shows details for a single book
     */
    #[Route('/library/read_one/{isbn}', name: 'read_one')]
    public function showBookByIsbn(
        BookRepository $bookRepository,
        string $isbn
    ): Response {
        try {
            $book = $bookRepository->findOneByIsbn($isbn);
        } catch (BookNotFoundException) {
            return $this->redirectToRoute('read_many');
        }
        $data = [ 'url' => 'library', 'book' => $book];
        return $this->render('library/show_single.html.twig', $data);
    }

    /**
     * Deletes a book
     */
    #[Route('/library/delete/{isbn}', name: 'book_delete_by_isbn', methods: ['POST'])]
    public function deleteBookByIsbn(
        string $isbn,
        BookRepository $bookRepository,
    ): Response {
        /**
         * @var Book $book
         */
        $book = $bookRepository->findOneByIsbn($isbn);
        $bookRepository->remove($book, true);
        $this->addFlash("warning", "Boken '{$book->getTitle()}' har raderats");
        return $this->redirectToRoute('read_many');
    }

    /**
     * Displays all books
     */
    #[Route('/library/read_many', name: 'read_many')]
    public function showAllBooks(
        BookRepository $bookRepository
    ): Response {
        $books = $bookRepository->findAll();
        $data = ['url' => 'library', 'books' => $books];
        return $this->render('library/show_many.html.twig', $data);
    }
}
