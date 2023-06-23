<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";


use App\Game\GameHandler;
use App\Game\Game21Easy;
use App\Game\PlayerTurnHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Controller class for the 21 card game
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
        GameHandler $gameHandler=new GameHandler()
    ): Response {
        /**
         * @var Game21Easy $game The current game of 21.
         */
        $game = $session->get("game21");
        $data = $gameHandler->play($game);
        return $this->render('game21/draw.html.twig', $data);
    }
}
