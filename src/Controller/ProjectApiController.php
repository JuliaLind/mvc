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

class ProjectApiController extends AbstractController
{
    #[Route('project/api/game', name: "api-one-round", methods: ['POST'])]
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

    #[Route('project/api/new', name: "api-new", methods: ['POST'])]
    public function apiNew(
        Request $request,
        ApiNew $game = new ApiNew(),
        JsonConverter $converter = new JsonConverter()
    ): Response {

        $data = $game->oneRound($request);
        $response = $converter->convert(new JsonResponse($data));
        return $response;
    }

    #[Route('project/api/results', name: "api-results", methods: ['POST'])]
    public function apiResults(
        ApiResults $game = new ApiResults(),
        JsonConverter $converter = new JsonConverter()
    ): Response {

        $data = $game->results();
        $response = $converter->convert(new JsonResponse($data));
        return $response;
    }
}
