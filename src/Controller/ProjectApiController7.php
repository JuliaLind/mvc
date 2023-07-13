<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use App\Entity\Score;
use Datetime;

/**
 * Controller class related to the Project. Contains API route that
 * displays the top 10 scores in the database
 */
class ProjectApiController7 extends AbstractController
{
    /**
     * Shows the top ten scores in database
     */
    #[Route('/proj/api/leaderboard', name: "api-leaderboard", methods: ['GET'])]
    public function apiLeaderboard(
        EntityManagerInterface $entityManager,
    ): Response {
        $scores = $entityManager->getRepository(Score::class)->findBy([], ['points' => 'DESC'], 10);
        return $this->json($scores);
    }
}
