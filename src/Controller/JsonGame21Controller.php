<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";


use App\Game\GameHandler;
use App\Game\GameHandlerLanding;
use App\Game\Game21Interface;

use Symfony\Component\HttpFoundation\JsonResponse;

use App\Markdown\MdParser;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Controller class for the 21 card game
 */
class JsonGame21Controller extends AbstractController
{
    /**
     * Route where the current game is displayed.
     * Shows buttons for the user to choose next action
     */
    #[Route('/game/play', name: "play", methods: ['GET'])]
    public function play(
        SessionInterface $session,
        GameHandler $gameHandler=new GameHandler()
    ): Response {
        /**
         * @var Game21Interface $game The current game of 21.
         */
        $game = $session->get("game21");
        $data = $gameHandler->play($game);
        return $this->render('game21/draw.html.twig', $data);
    }

    /**
     * Route displays current game/game-status as json object
     */
    #[Route('/api/game', name: "jsonGame", methods: ['GET'])]
    public function jsonGame(
        SessionInterface $session,
        GameHandler $gameHandler=new GameHandler()
    ): Response {
        // $gameStatus = "No game started";
        /**
         * @var Game21Interface $game The current game of 21.
         */
        $game = $session->get("game21") ?? null;
        $data = $gameHandler->jsonGame($game);
        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }
}
