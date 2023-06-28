<?php

namespace App\Controller;

use App\Entity\Book;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\BookRepository;



use App\Library\BookNotFoundException;
use App\Library\IsbnAlreadyInUseException;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



use Symfony\Component\HttpFoundation\Request;

/**
 * Class for library routes
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
    ): Response {
        $book=new Book();
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
        try {
            $bookRepository->save($book, true);
            $this->addFlash("notice", "Boken '{$book->getTitle()}' är registrerad. Klicka på kryset till höger för att gå till översikten");
            return $this->redirectToRoute("read_one", array('isbn'=>$isbn));
        } catch (IsbnAlreadyInUseException) {
            $this->addFlash("warning", "En bok med isbn '{$isbn}' finns redan i systemet. ISBN nummer måste vara unik");
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
    ): Response {
        /**
         * @var Book $book
         */
        $book = $bookRepository->findOneByIsbn($isbn);
        $bookRepository->remove($book, true);
        $this->addFlash("warning", "Boken '{$book->getTitle()}' har raderats");
        return $this->redirectToRoute('read_many');
    }
}
