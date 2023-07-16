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
class Game21Controller5 extends AbstractController
{
    /**
     * In this route the selected amount is moved from
     * each bank and player to the moneypot. Redirects to the
     * play route
     */
    #[Route('/game/bet/{amount<\d+>}', name: "bet", methods: ['POST'])]
    public function bet(
        SessionInterface $session,
        int $amount,
    ): Response {
        /**
         * @var Game21Interface $game The current game of 21.
         */
        $game = $session->get("game21");
        $game->addToMoneyPot($amount);
        $session->set("game21", $game);
        return $this->redirectToRoute('play');
    }
}
