<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Project\ApiGame1;

class ProjectApiController1 extends AbstractController
{
    /**
     * House/bot places a card in grid, the grid is saved to session.
     * When grid is full the process restarts with a new grid
     */
    #[Route('/proj/api/bot-plays', name: "api-bot-plays", methods: ['POST'])]
    public function apiOneRound(
        SessionInterface $session,
    ): Response {
        /**
         * @var ApiGame1 $game
         */
        $game = $session->get("api-game") ?? new ApiGame1();
        $data = $game->oneRound();
        $session->set("api-game", $game);
        return $this->json($data);
    }
}
