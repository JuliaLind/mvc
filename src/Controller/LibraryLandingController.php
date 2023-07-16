<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controller contains route for the library landing page, from kmom05
 */
class LibraryLandingController extends AbstractController
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
