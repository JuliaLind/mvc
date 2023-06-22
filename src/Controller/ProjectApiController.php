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

use App\Project\ApiGame;
use App\Project\ApiNew;
use App\Project\ApiResults;
use App\Project\Game;

class ProjectApiController extends AbstractController
{
    #[Route('/proj/api/bot-plays', name: "api-bot-plays", methods: ['POST'])]
    public function apiOneRound(
        SessionInterface $session,
        JsonConverter $converter = new JsonConverter()
    ): Response {
        /**
         * @var ApiGame $game
         */
        $game = $session->get("api-game") ?? new ApiGame();
        $data = $game->oneRound();
        $response = $converter->convert(new JsonResponse($data));
        $session->set("api-game", $game);
        return $response;
    }

    #[Route('/proj/api/place-card/{row<\d+>}/{col<\d+>}', name: "api-place-card", methods: ['POST'])]
    public function apiNew(
        int $row,
        int $col,
        ApiNew $game = new ApiNew(),
        JsonConverter $converter = new JsonConverter()
    ): Response {
        $data = $game->oneRound($row, $col);
        $response = $converter->convert(new JsonResponse($data));
        return $response;
    }

    #[Route('/proj/api/results', name: "api-results", methods: ['POST'])]
    public function apiResults(
        ApiResults $game = new ApiResults(),
        JsonConverter $converter = new JsonConverter()
    ): Response {
        $data = $game->results();
        $response = $converter->convert(new JsonResponse($data));
        return $response;
    }

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
