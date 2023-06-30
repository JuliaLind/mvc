<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Project\Game;

class ProjectController3 extends AbstractController
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


    // GÖR OM DENNA TILL POST SEN
    #[Route('/proj/unset-suggestion', name: "proj-unset-suggest", methods: ['GET'])]
    public function projUnsetSuggest(
        SessionInterface $session,
    ): Response {
        $session->set("show-suggestion", false);
        return $this->redirectToRoute('proj-play');
    }
}
