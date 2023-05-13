<?php

namespace App\Controller;

use App\Entity\Book;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\BookRepository;

use App\Library\BookRemover;
use App\Library\BookUpdator;
use App\Library\BookSaver;
use App\Library\SqlFileLoader;
use App\Library\BookNotFoundException;
use App\Library\RemoveFlashGenerator;
use App\Library\NewFlashGenerator;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


use Symfony\Component\HttpFoundation\Request;

use Doctrine\DBAL\Connection;

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
        $data = [
            'url' => 'library',
        ];
        return $this->render('library/index.html.twig', $data);
    }

    /**
     * Form for registering new book
     */
    #[Route('/library/create', name: 'create_form')]
    public function createBookForm(): Response
    {
        $data = [
            'url' => 'library',
        ];
        return $this->render('library/new_book.html.twig', $data);
    }

    /**
     * Saves new book to database
     */
    #[Route('/library/create_new', name: 'book_create', methods: ['POST'])]
    public function createBook(
        BookRepository $bookRepository,
        Request $request,
        BookSaver $saver = new BookSaver(),
        BookUpdator $updator = new BookUpdator(),
        NewFlashGenerator $flashGenerator = new NewFlashGenerator()
    ): Response {
        $book = new Book();
        $updator->updateBook($request, $book);
        $wentWell = $saver->saveBook($bookRepository, $book);
        $flash = $flashGenerator->newFlash($wentWell, $book);
        $this->addFlash(...$flash);
        switch ($wentWell) {
            case true:
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
            $book= $bookRepository
            ->findOneByIsbn($isbn);
        } catch (BookNotFoundException) {
            return $this->redirectToRoute('read_many');
        }


        $data = [
            'url' => 'library',
            'book' => $book,
        ];
        return $this->render('library/show_single.html.twig', $data);
    }

    /**
     * Displays all books
     */
    #[Route('/library/read_many', name: 'read_many')]
    public function showAllBooks(
        BookRepository $bookRepository
    ): Response {
        $books = $bookRepository
            ->findAll();

        $data = [
            'url' => 'library',
            'books' => $books,
        ];
        return $this->render('library/show_many.html.twig', $data);
    }


    /**
     * Deletes a book
     */
    #[Route('/library/delete/{isbn}', name: 'book_delete_by_isbn', methods: ['POST'])]
    public function deleteBookByIsbn(
        string $isbn,
        BookRepository $bookRepository,
        BookRemover $libraryHandler=new BookRemover(),
        RemoveFlashGenerator $flashGenerator = new RemoveFlashGenerator()
    ): Response {
        /**
         * @var Book $book
         */
        $book = $bookRepository->findOneByIsbn($isbn);
        $libraryHandler->removeBook($bookRepository, $book);
        $flash = $flashGenerator->removeFlash($book);
        $this->addFlash(...$flash);
        return $this->redirectToRoute('read_many');
    }

    /**
     * Resets database
     */
    #[Route('/library/reset', name: 'reset_library', methods: ['POST'])]
    public function resetBook(
        ManagerRegistry $doctrine,
    ): Response {
        /**
         * @var Connection $conn
         */
        $conn = $doctrine->getConnection();
        $loader = new SqlFileLoader($conn);
        $loader->load("sql/reset-book.sql");
        $this->addFlash("notice", "Databasen är återställd");
        return $this->redirectToRoute('read_many');
    }
}
