<?php

namespace App\Controller;

use App\Entity\Book;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\BookRepository;

use App\Library\LibraryHandler;
use App\Library\SqlFileLoader;
use App\Library\BookNotFoundException;
use App\Library\RemoveFlashGenerator;
use App\Library\NewFlashGenerator;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\DBAL\Connection;


use Symfony\Component\HttpFoundation\Request;

// use Doctrine\DBAL\Connection;

/**
 * Class for the library controller
 */
class LibraryController extends AbstractController
{
    /**
     * Landing page
     */
    #[Route('/library', name: 'library')]
    public function index(): Response
    {
        $data = ['url' => 'library'];
        return $this->render('library/index.html.twig', $data);
    }

    /**
     * Form for registering new book
     */
    #[Route('/library/create', name: 'create_form')]
    public function createBookForm(): Response
    {
        $data = ['url' => 'library'];
        return $this->render('library/new_book.html.twig', $data);
    }

    /**
     * Saves new book to database
     */
    #[Route('/library/create_new', name: 'book_create', methods: ['POST'])]
    public function createBook(
        BookRepository $bookRepository,
        Request $request,
        LibraryHandler $handler = new LibraryHandler()
    ): Response {
        /**
         * @var array<int,Book|array<string>|bool> $data
         */
        $data = $handler->createOne($request, $bookRepository);
        list($flash, $book, $wentWell) = [...$data];

        /**
         * @var array<string,string> $flash
         */
        $this->addFlash(...$flash);

        switch ($wentWell) {
            case true:
                /**
                 * @var Book $book
                 */
                return $this->redirectToRoute("read_one", array('isbn'=>$book->getIsbn()));
            default:
                return $this->redirectToRoute("create_form");
        }
    }

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


    /**
     * Deletes a book
     */
    #[Route('/library/delete/{isbn}', name: 'book_delete_by_isbn', methods: ['POST'])]
    public function deleteBookByIsbn(
        string $isbn,
        BookRepository $bookRepository,
        LibraryHandler $handler = new LibraryHandler()
    ): Response {
        $flash = $handler->removeOne($bookRepository, $isbn);
        $this->addFlash(...$flash);
        return $this->redirectToRoute('read_many');
    }

    /**
     * Resets database
     */
    #[Route('/library/reset', name: 'reset_library', methods: ['POST'])]
    public function resetBook(
        // ManagerRegistry $doctrine,
        Connection $connection,
    ): Response {
        /**
         * @var Connection $connection
         */
        $loader = new SqlFileLoader($connection);
        $loader->load("sql/reset-book.sql");

        $this->addFlash("notice", "Databasen är återställd");
        return $this->redirectToRoute('read_many');
    }
}
