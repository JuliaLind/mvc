<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";


use App\Game\GameHandler;
use App\Game\GameMoneyHandler;
use App\Game\GameHandlerLanding;
use App\Game\BanksTurnHandler;
use App\Game\GameInitiator;
use App\Game\Game21Easy;
use App\Game\PlayerTurnHandler;
use App\Game\RoundHandler;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Controller class for the 21 card game
 */
class Game21Controller extends AbstractController
{
    /**
     * Main route. Contains description of the game and buttons
     * for starting/resuming the game
     */
    #[Route('/game', name: "gameMain", methods: ['GET'])]
    public function main(
        SessionInterface $session,
        GameHandlerLanding $gameHandler=new GameHandlerLanding()
    ): Response {
        /**
         * @var Game21Easy|null $game The current game of 21.
         */
        $game = $session->get("game21") ?? null;
        $data = $gameHandler->main($game);

        return $this->render('game21/home.html.twig', $data);
    }

    /**
     * Documentation route. Contains docmentation for
     * the initial version of the game
     */
    #[Route('/game/doc', name: "gameDoc", methods: ['GET'])]
    public function gameDoc(
        GameHandlerLanding $gameHandler=new GameHandlerLanding()
    ): Response {
        $data = $gameHandler->doc();

        return $this->render('game21/doc.html.twig', $data);
    }
}
