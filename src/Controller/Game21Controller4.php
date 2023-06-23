<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";



use App\Game\GameInitiator;
use App\Game\Game21Easy;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Controller class for the 21 card game
 */
class Game21Controller4 extends AbstractController
{
    /**
     * Route for initiating the game. Creates an object of class
     * Game21Easy or Game21Hard, samves to session and redirects
     * to route for selecting amount to bet
     */
    #[Route('/game/init/{level<\d+>}', name: "init", methods: ['POST'])]
    public function init(
        SessionInterface $session,
        int $level=0,
        GameInitiator $gameHandler=new GameInitiator()
    ): Response {
        $game = $gameHandler->init($level);
        $session->set("game21", $game);

        return $this->redirectToRoute('selectAmount');
    }
}
