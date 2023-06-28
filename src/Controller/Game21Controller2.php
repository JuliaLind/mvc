<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";



use App\Game\BanksTurn;
use App\Game\Game21Easy;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Controller class for the 21 card game
 */
class Game21Controller2 extends AbstractController
{
    /**
     * Route where cards are drawn by the bank
     * Redirets to play-route
     */
    #[Route('/game/bank-playing', name: "bankPlaying", methods: ['POST'])]
    public function bankPlaying(
        SessionInterface $session,
        BanksTurn $banksTurn=new BanksTurn()
    ): Response {
        /**
         * @var Game21Easy $game The current game of 21.
         */
        $game = $session->get("game21");
        $flash = $banksTurn->main($game);
        $session->set("game21", $game);

        $this->addFlash(...$flash);
        return $this->redirectToRoute('play');
    }
}
