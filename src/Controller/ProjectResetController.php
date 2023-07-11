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
class ProjectResetController extends AbstractController
{
    /**
     * Resets the Book table in the database
     */
    #[Route('/proj/reset', name: 'reset_project', methods: ['POST'])]
    public function resetProj(
        Connection $connection,
        SqlFileLoader $loader=new SqlFileLoader()
    ): Response {
        $loader->load("sql/reset-proj.sql", $connection);

        $this->addFlash("notice", "Databastabellena relaterade till projektet är återställda");
        return $this->redirectToRoute('proj-about');
    }
}
