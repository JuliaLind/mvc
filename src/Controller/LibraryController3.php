<?php

namespace App\Controller;

// use App\Helpers\SqlFileLoader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\DBAL\Connection;


use Symfony\Component\HttpFoundation\Request;

/**
 * Class for library routes
 */
class LibraryController3 extends AbstractController
{
    /**
     * Resets database
     */
    #[Route('/library/reset', name: 'reset_library', methods: ['POST'])]
    public function resetBook(
        Connection $connection,
        SqlFileLoader $loader=new SqlFileLoader()
    ): Response {
        $loader->load("sql/reset-book.sql", $connection);

        $this->addFlash("notice", "Databasen är återställd");
        return $this->redirectToRoute('read_many');
    }
}
