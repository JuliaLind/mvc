<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository;

use App\Repository\IsbnAlreadyInUseException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Controller that contains route where book data is updated, from kmom05
 */
class LibraryUpdateController2 extends AbstractController
{
    /**
     * Saves updated information to database
     */
    #[Route('/library/update_one', name: 'book_update', methods: ['POST'])]
    public function updateBook(
        BookRepository $bookRepository,
        Request $request,
    ): Response {
        $bookId = $request->get('book_id');
        /**
         * @var Book $book
         */
        $book = $bookRepository->find($bookId);
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
            return $this->redirectToRoute('read_one', array('isbn'=>$isbn));
        } catch (IsbnAlreadyInUseException) {
            $this->addFlash("warning", "En annan bok med isbn '{$isbn}' finns redan i systemet");
            return $this->redirectToRoute("update_form", array('isbn'=>$request->get('original_isbn')));
        }
    }
}
