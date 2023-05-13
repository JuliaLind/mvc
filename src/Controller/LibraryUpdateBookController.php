<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository;

use App\Library\BookUpdator;
use App\Library\BookSaver;
use App\Library\BookNotFoundException;
use App\Library\UpdateFlashGenerator;

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
        Request $request,
        BookSaver $saver = new BookSaver(),
        BookUpdator $updator = new BookUpdator(),
        UpdateFlashGenerator $flashGenerator = new UpdateFlashGenerator()
    ): Response {
        $bookId = $request->get('book_id');
        /**
         * @var Book $book
         */
        $book = $bookRepository->find($bookId);

        $updator->updateBook($request, $book);
        $wentWell = $saver->saveBook($bookRepository, $book);
        $flash = $flashGenerator->updateFlash($wentWell, $book);
        $this->addFlash(...$flash);

        switch ($wentWell) {
            case true:
                return $this->redirectToRoute('read_one', array('isbn'=>$book->getIsbn()));
            default:
                return $this->redirectToRoute("update_form", array('isbn'=>$request->get('original_isbn')));
        }
    }
}
