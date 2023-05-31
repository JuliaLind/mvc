<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";


use App\Game\JsonGameHandler;
use App\Game\Game21Interface;
use App\Game\Game21Easy;

use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use App\Helpers\JsonConverter;

/**
 * Controller class for the 21 card game
 */
class JsonGame21Controller extends AbstractController
{
    /**
     * Route displays current game/game-status as json object
     */
    #[Route('/api/game', name: "jsonGame", methods: ['GET'])]
    public function jsonGame(
        SessionInterface $session,
        JsonGameHandler $gameHandler=new JsonGameHandler(),
        JsonConverter $converter = new JsonConverter()
    ): Response {
        /**
         * @var Game21Easy $game The current game of 21.
         */
        $game = $session->get("game21") ?? null;
        $data = $gameHandler->jsonGame($game);
        $response = $converter->convert(new JsonResponse($data));
        return $response;
    }
}
