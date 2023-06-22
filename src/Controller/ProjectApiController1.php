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

class ProjectApiController1 extends AbstractController
{
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

    #[Route('/proj/api/results', name: "api-results", methods: ['POST'])]
    public function apiResults(
        Api3 $game = new Api3(),
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
