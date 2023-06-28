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
class LibraryController7 extends AbstractController
{
    /**
     * Form for registering new book
     */
    #[Route('/library/create', name: 'create_form')]
    public function createBookForm(): Response
    {
        $data = ['url' => 'library'];
        return $this->render('library/new_book.html.twig', $data);
    }
}
