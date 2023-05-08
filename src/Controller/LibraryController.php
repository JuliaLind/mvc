<?php

namespace App\Controller;

use App\Entity\Book;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\BookRepository;

use App\Exceptions\IsbnAlreadyInUseException;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Helpers\SqlFileLoader;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

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
        ManagerRegistry $doctrine,
        Request $request
    ): Response {
        $entityManager = $doctrine->getManager();
        $isbn = strval($request->get('isbn'));
        $check = $entityManager->getRepository(Book::class)->findOneByIsbn($isbn); //@phpstan-ignore-line

        if ($check) {
            $this->addFlash("warning", "En bok med isbn '{$isbn}' finns redan i systemet. ISBN nummer måste vara unik");
            return $this->redirectToRoute("create_form");
        }
        $title = strval($request->get('title'));
        $this->addFlash("notice", "Boken '{$title}' är registrerad. Klicka på kryset till höger för att gå till översikten");

        $book = new Book();
        $book->setTitle($title);
        $book->setIsbn($isbn);
        $book->setAuthor(strval($request->get('author')));
        $book->setImg(strval($request->get('image')));

        // tell Doctrine you want to (eventually) save the Book
        // (no queries yet)
        $entityManager->persist($book);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return $this->redirectToRoute("read_one", array('isbn'=>$isbn));
    }

    /**
     * Form for editing details of a book
     */
    #[Route('/library/update/{isbn}', name: 'update_form')]
    public function updateBookForm(
        BookRepository $bookRepository,
        string $isbn
    ): Response {
        $book= $bookRepository
            ->findOneByIsbn($isbn);

        $data = [
            'url' => 'library',
            'book' => $book,
        ];
        return $this->render('library/update_book.html.twig', $data);
    }

    /**
     * Saves updated information to database
     */
    #[Route('/library/update_one', name: 'book_update', methods: ['POST'])]
    public function updateBook(
        BookRepository $bookRepository,
        Request $request
    ): Response {
        $bookId = $request->get('book_id');
        $isbn = strval($request->get('isbn'));
        /**
         * @var Book $book
         */
        $book = $bookRepository->find($bookId);
        $check = $bookRepository->findOneByIsbn($isbn);


        if ($check && ($check->getId() != $bookId)) {
            $this->addFlash("warning", "Another book with isbn '{$isbn}' already exists in the system");
            return $this->redirectToRoute("update_form", array('isbn'=>$request->get('original_isbn')));
        }

        $book->setTitle(strval($request->get('title')));
        $book->setIsbn($isbn);
        $book->setAuthor(strval($request->get('author')));
        $book->setImg(strval($request->get('image')));

        $bookRepository->save($book, true);

        return $this->redirectToRoute('read_one', array('isbn'=>$isbn));
    }

    /**
     * Shows details for a single book
     */
    #[Route('/library/read_one/{isbn}', name: 'read_one')]
    public function showBookByIsbn(
        BookRepository $bookRepository,
        string $isbn
    ): Response {
        $book= $bookRepository
            ->findOneByIsbn($isbn);

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
        // Request $request,
        string $isbn,
        BookRepository $bookRepository,
    ): Response {
        // $isbn = strval($request->get('isbn'));
        /**
         * @var Book $book
         */
        $book = $bookRepository->findOneByIsbn($isbn);
        $title = $book->getTitle();
        $bookRepository->remove($book, true);

        $this->addFlash("warning", "Boken '{$title}' har raderats");


        return $this->redirectToRoute('read_many');
    }

    /**
     * Resets database
     */
    #[Route('/library/reset', name: 'reset_library', methods: ['POST'])]
    public function resetBook(
        ManagerRegistry $doctrine,
    ): Response {
        $conn = $doctrine->getManager()->getConnection(); //@phpstan-ignore-line
        $loader = new SqlFileLoader($conn);
        $loader->load("sql/reset-book.sql");
        $this->addFlash("notice", "Databasen är återställd");
        return $this->redirectToRoute('read_many');
    }
}
