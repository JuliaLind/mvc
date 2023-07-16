<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";



use App\Game\Game21Interface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Controller for the 21 card game, from kmom03-kmom04
 */
class Game21Controller6 extends AbstractController
{
    /**
     * Route where the current game is displayed.
     * Shows buttons for the user to choose next action
     */
    #[Route('/game/play', name: "play", methods: ['GET'])]
    public function play(
        SessionInterface $session,
    ): Response {
        /**
         * @var Game21Interface $game The current game of 21.
         */
        $game = $session->get("game21");
        $data = [
            'players' => $game->getPlayerData(),
            'risk'=> $game->getRisk(),
            'page' => "game no-header card",
            'url' => "/game",
            'title' => 'Game 21'
        ];

        $data = array_merge($game->getGameStatus(), $data);

        return $this->render('game21/draw.html.twig', $data);
    }
}
