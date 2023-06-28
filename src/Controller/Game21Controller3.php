<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";



use App\Game\RoundHandler2;
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
        RoundHandler2 $helper = new RoundHandler2()
    ): Response {
        /**
         * @var Game21Easy $game The current game of 21.
         */
        $game = $session->get("game21");
        $nextRoundData = $helper->nextRound($game);
        $data = [
            'page' => "game no-header card",
            'url' => "/game",
        ];
        $data = array_merge($nextRoundData, $data);
        $session->set("game21", $game);

        return $this->render('game21/select-amount.html.twig', $data);
    }
}
