<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";




use App\Game\Game21Interface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Controller for the 21 card game
 */
class Game21Controller3 extends AbstractController
{
    /**
     * Route that leads to form where user selects amount to bet
     */
    #[Route('/game/select-amount', name: "selectAmount", methods: ['GET'])]
    public function selectAmount(
        SessionInterface $session,
    ): Response {
        /**
         * @var Game21Interface $game The current game of 21.
         */
        $game = $session->get("game21");
        $nextRoundData = $game->nextRound();
        $data = [
            'page' => "game no-header card",
            'url' => "/game",
        ];
        $data = array_merge($nextRoundData, $data);
        $session->set("game21", $game);

        return $this->render('game21/select-amount.html.twig', $data);
    }
}
