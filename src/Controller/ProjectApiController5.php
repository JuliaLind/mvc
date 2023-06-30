<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Project\Game;

class ProjectApiController5 extends AbstractController
{
    /**
     * Show the current state data for the ongoing Poker Square game
     */
    #[Route('/proj/api/game-state', name: "api-game-state")]
    public function apiGameState(
        SessionInterface $session,
    ): Response {
        /**
         * @var Game $game
         */
        $game = $session->get("game") ?? null;
        $data = [
            "status" => "no game initiated"
        ];
        if ($game != null) {
            $state = $game->currentState();
            $data = [
                ...$state
            ];
        }
        return $this->json($data);
    }
}
