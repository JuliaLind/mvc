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
 * Controller that contains route for saving a new
 * book to the Library, from kmom05
 */
class LibraryCreateNewController extends AbstractController
{
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
            $this->addFlash("notice", "Boken '{$title}' är registrerad. Klicka på kryset till höger för att gå till översikten");
            return $this->redirectToRoute("read_one", array('isbn'=>$isbn));
        } catch (IsbnAlreadyInUseException) {
            $this->addFlash("warning", "En bok med isbn '{$isbn}' finns redan i systemet. ISBN nummer måste vara unik");
            return $this->redirectToRoute("create_form");
        }
    }
}
