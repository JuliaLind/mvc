<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controller contains route that leads to form
 * for adding a new book
 */
class LibraryCreateNewController2 extends AbstractController
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
