<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Project\Game;

/**
 * Controller related to the Project. Contains route for one game round
 * (one round = player places card + bot places card. If the grids
 * are fully filled also evaluate results and end game)
 */
class ProjectOneRoundController extends AbstractController
{
    #[Route('/proj/one-round/{row<\d+>}/{col<\d+>}', name: "proj-round", methods: ['POST'])]
    public function projRound(
        int $row,
        int $col,
        SessionInterface $session,
        EntityManagerInterface $entityManager
    ): Response {
        $session->set("show-suggestion", false);
        /**
         * @var Game $game
         */
        $game = $session->get("game");
        $finished = $game->oneRound($row, $col);
        if ($finished === true) {
            /**
             * @var int $userId
             */
            $userId = $session->get("user");
            $game->evaluate($entityManager, $userId);
        }
        $session->set("game", $game);
        return $this->redirectToRoute('proj-play');
    }
}
