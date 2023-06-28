<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";


use App\Game\Game21Interface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Controller class for the 21 card game
 */
class Game21Controller7 extends AbstractController
{
    /**
     * Route where a card is drawn by the player.
     * Redirects to play-route
     */
    #[Route('/game/draw', name: "playerDraw", methods: ['POST'])]
    public function playerDraw(
        SessionInterface $session,
    ): Response {
        /**
         * @var Game21Interface $game The current game of 21.
         */
        $game = $session->get("game21");
        $flash = $game->playersTurn();
        $this->addFlash(...$flash);

        $session->set("game21", $game);
        return $this->redirectToRoute('play');
    }
}
