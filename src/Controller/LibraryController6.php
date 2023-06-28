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

class LibraryController6 extends AbstractController
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
}
