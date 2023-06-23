<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";


use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use App\Helpers\JsonConverter;

use App\Project\Api1;
use App\Project\Api2;
use App\Project\Api3;
use App\Project\Game;

/**
 * Contains API routes for the project
 */
class ProjectApiController1 extends AbstractController
{
    /**
     * House/bot places a card in grid, the grid is saved to session.
     * When grid is full the process restarts with a new grid
     */
    #[Route('/proj/api/bot-plays', name: "api-bot-plays", methods: ['POST'])]
    public function apiOneRound(
        SessionInterface $session,
        JsonConverter $converter = new JsonConverter()
    ): Response {
        /**
         * @var Api1 $game
         */
        $game = $session->get("api-game") ?? new Api1();
        $data = $game->oneRound();
        $response = $converter->convert(new JsonResponse($data));
        $session->set("api-game", $game);
        return $response;
    }

    /**
     * Card is placed in a new grid in slot (row/column) that have been passed as params
     */
    #[Route('/proj/api/place-card/{row<\d+>}/{col<\d+>}', name: "api-place-card", methods: ['POST'])]
    public function apiPlaceCard(
        int $row,
        int $col,
        Api2 $game = new Api2(),
        JsonConverter $converter = new JsonConverter()
    ): Response {
        $data = $game->oneRound($row, $col);
        $response = $converter->convert(new JsonResponse($data));
        return $response;
    }

    /**
     * A grid is fully filled (25 cards) and all hands (vertically and horizontally)
     * are then evaluated for rules/points
     */
    #[Route('/proj/api/results', name: "api-results", methods: ['POST'])]
    public function apiResults(
        Api3 $game = new Api3(),
        JsonConverter $converter = new JsonConverter()
    ): Response {
        $data = $game->results();
        $response = $converter->convert(new JsonResponse($data));
        return $response;
    }

    /**
     * Show the current state data for the ongoing Poker Square game
     */
    #[Route('/proj/api/game-state', name: "api-game-state")]
    public function apiGameState(
        SessionInterface $session,
        JsonConverter $converter = new JsonConverter()
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
        $response = $converter->convert(new JsonResponse($data));
        return $response;
    }
}
