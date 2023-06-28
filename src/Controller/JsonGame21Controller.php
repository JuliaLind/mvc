<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";


use App\Game\GameApi;
use App\Game\Game21Interface;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Controller class for the 21 card game json route
 */
class JsonGame21Controller extends AbstractController
{
    /**
     * Route displays current game/game-status as json object
     */
    #[Route('/api/game', name: "jsonGame", methods: ['GET'])]
    public function jsonGame(
        SessionInterface $session,
        GameApi $gameApi=new GameApi(),
    ): Response {
        /**
         * @var Game21Interface $game The current game of 21.
         */
        $game = $session->get("game21") ?? null;
        $data = $gameApi->data($game);
        return $this->json($data);
    }
}
