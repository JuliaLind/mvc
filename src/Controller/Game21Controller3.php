<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";



use App\Game\GameMoneyHandler;
use App\Game\Game21Easy;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Controller class for the 21 card game
 */
class Game21Controller3 extends AbstractController
{
    /**
     * Route for selecting amount to bet in the current round.
     * Initiates the current round.
     */
    #[Route('/game/select-amount', name: "selectAmount", methods: ['GET'])]
    public function selectAmount(
        SessionInterface $session,
        GameMoneyHandler $gameHandler=new GameMoneyHandler()
    ): Response {
        /**
         * @var Game21Easy $game The current game of 21.
         */
        $game = $session->get("game21");
        $data = $gameHandler->selectAmount($game);
        $session->set("game21", $game);

        return $this->render('game21/select-amount.html.twig', $data);
    }
}
