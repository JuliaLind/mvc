<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository;
use App\Library\BookNotFoundException;
use App\Library\LibraryHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


use Symfony\Component\HttpFoundation\Request;

/**
 * Class for the library controller
 */
class LibraryUpdateBookController extends AbstractController
{
    /**
     * Form for editing details of a book
     */
    #[Route('/library/update/{isbn}', name: 'update_form')]
    public function updateBookForm(
        BookRepository $bookRepository,
        string $isbn
    ): Response {
        $book= $bookRepository->findOneByIsbn($isbn);
        $data = ['url' => 'library', 'book' => $book];
        return $this->render('library/update_book.html.twig', $data);
    }

    /**
     * Saves updated information to database
     */
    #[Route('/library/update_one', name: 'book_update', methods: ['POST'])]
    public function updateBook(
        BookRepository $bookRepository,
        Request $request,
        LibraryHandler $handler = new LibraryHandler()
    ): Response {
        /**
         * @var array<int,Book|array<string>|bool> $data
         */
        $data = $handler->updateOne($request, $bookRepository);
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
                return $this->redirectToRoute('read_one', array('isbn'=>$book->getIsbn()));
            default:
                return $this->redirectToRoute("update_form", array('isbn'=>$request->get('original_isbn')));
        }
    }
}
