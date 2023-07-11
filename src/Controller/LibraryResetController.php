<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\DBAL\Connection;

/**
 * Controller that contains the route for resetting
 * the Book table in the database
 */
class LibraryResetController extends AbstractController
{
    /**
     * Resets the Book table in the database
     */
    #[Route('/library/reset', name: 'reset_library', methods: ['POST'])]
    public function resetBook(
        Connection $connection,
        SqlFileLoader $loader=new SqlFileLoader()
    ): Response {
        $loader->load("sql/reset-book.sql", $connection);

        $this->addFlash("notice", "Biblioteksdatabasen är återställd");
        return $this->redirectToRoute('read_many');
    }
}
