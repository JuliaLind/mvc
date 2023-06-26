<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Helpers\JsonConverter;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use App\Entity\Transaction;
use App\Entity\Score;
use Datetime;

/**
 * Contains API routes for the project
 */
class ProjectApiController7 extends AbstractController
{
    /**
     * Shows the top ten scores in database
     */
    #[Route('/proj/api/leaderboard', name: "api-leaderboard", methods: ['GET'])]
    public function apiLeaderboard(
        EntityManagerInterface $entityManager,
        JsonConverter $converter = new JsonConverter()
    ): Response {
        $scores = $entityManager->getRepository(Score::class)->findBy([], ['points' => 'DESC'], 10);
        $data = [];

        foreach($scores as $score) {
            /**
             * @var User $user
             */
            $user = $score->getUser();
            /**
             * @var DateTime $registered
             */
            $registered = $score->getRegistered();
            $registered = $registered->format('Y-m-d');
            $data[] = [
                'user' => $user->getAcronym(),
                'registered' => $registered,
                'points' => $score->getPoints(),
            ];
        }
        $response = $converter->convert(new JsonResponse($data));
        return $response;
    }
}
