<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";

use App\Entity\User;
use App\Repository\ScoreRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controller related to the Project. Contains routes for displaying
 * top 10 scores for a single user and the leaderscore with the
 * top 10 scores amongst all users
 */
class ProjectController8 extends AbstractController
{
    /**
     * Displays the top 10 scores of a single user
     */
    #[Route("/proj/scores-single", name: "proj-scores-single")]
    public function projScoresSingle(
        SessionInterface $session,
        ScoreRepository $scoreRepo,
        UserRepository $userRepo,
    ): Response {
        /**
         * @var int $userId
         */
        $userId = $session->get("user");
        /**
         * @var User $user
         */
        $user = $userRepo->find($userId);
        $data = [
            'url' => "",
            'scores' => $scoreRepo->findBy(
                ['user' => $user],
                ['points' => 'DESC'],
                10
            )
        ];
        return $this->render('proj/scores-single.html.twig', $data);
    }

    /**
     * Displays the top 10 scores amongst all users
     */
    #[Route("/proj/leaderboard", name: "proj-leaderboard")]
    public function projLeaderboard(
        ScoreRepository $repo
    ): Response {
        $data = [
            'url' => "leaderboard",
            'scores' => $repo->findBy(
                [],
                ['points' => 'DESC'],
                10
            )
        ];
        return $this->render('proj/leaderboard.html.twig', $data);
    }
}
