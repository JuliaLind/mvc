<?php

namespace App\Controller;

use App\Repository\BookRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controller that contains route that leads
 * to the route with form for updating a book
 */
class LibraryController2 extends AbstractController
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
}
