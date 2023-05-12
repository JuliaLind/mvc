<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";


use App\Game\GameHandler;
use App\Game\GameHandlerLanding;
use App\Game\Game21Interface;

use App\Markdown\MdParser;

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
        $filename = "markdown/game21.md";
        $parser = new MdParser($filename);
        /**
         * @var Game21Interface|null $game The current game of 21.
         */
        $game = $session->get("game21") ?? null;
        $data = $gameHandler->main($parser, $game);

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
        $filename = "markdown/doc.md";
        $parser = new MdParser($filename);
        $data = $gameHandler->doc($parser);

        return $this->render('game21/doc.html.twig', $data);
    }

    /**
     * Route for initiating the game. Creates an object of class
     * Game21Easy or Game21Hard, samves to session and redirects
     * to route for selecting amount to bet
     */
    #[Route('/game/init/{level<\d+>}', name: "init", methods: ['POST'])]
    public function init(
        SessionInterface $session,
        int $level=0,
        GameHandler $gameHandler=new GameHandler()
    ): Response {
        $game = $gameHandler->init($level);
        $session->set("game21", $game);

        return $this->redirectToRoute('selectAmount');
    }

    /**
     * Route for selecting amount to bet in the current round.
     * Initiates the current round.
     */
    #[Route('/game/select-amount', name: "selectAmount", methods: ['GET'])]
    public function selectAmount(
        SessionInterface $session,
        GameHandler $gameHandler=new GameHandler()
    ): Response {
        /**
         * @var Game21Interface $game The current game of 21.
         */
        $game = $session->get("game21");
        $data = $gameHandler->selectAmount($game);
        $session->set("game21", $game);

        return $this->render('game21/select-amount.html.twig', $data);
    }

    /**
     * In this route the selected amount is moved from
     * each bank and player to the moneypot. Redirects to the
     * play route
     */
    #[Route('/game/bet/{amount<\d+>}', name: "bet", methods: ['POST'])]
    public function bet(
        SessionInterface $session,
        int $amount,
        GameHandler $gameHandler=new GameHandler()
    ): Response {
        /**
         * @var Game21Interface $game The current game of 21.
         */
        $game = $session->get("game21");
        $gameHandler->bet($amount, $game);
        $session->set("game21", $game);
        return $this->redirectToRoute('play');
    }

    /**
     * Route where a card is drawn by the player.
     * Redirects to play-route
     */
    #[Route('/game/draw', name: "playerDraw", methods: ['POST'])]
    public function playerDraw(
        SessionInterface $session,
        GameHandler $gameHandler=new GameHandler()
    ): Response {
        /**
         * @var Game21Interface $game The current game of 21.
         */
        $game = $session->get("game21");
        $flash = $gameHandler->playerDraw($game);
        $this->addFlash(...$flash);

        $session->set("game21", $game);
        return $this->redirectToRoute('play');
    }

    /**
     * Route where cards are drawn by the bank
     * Redirets to play-route
     */
    #[Route('/game/bank-playing', name: "bankPlaying", methods: ['POST'])]
    public function bankPlaying(
        SessionInterface $session,
        GameHandler $gameHandler=new GameHandler()
    ): Response {
        /**
         * @var Game21Interface $game The current game of 21.
         */
        $game = $session->get("game21");
        $flash = $gameHandler->bankDraw($game);
        $session->set("game21", $game);

        $this->addFlash(...$flash);
        return $this->redirectToRoute('play');
    }

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
         * @var Game21Interface $game The current game of 21.
         */
        $game = $session->get("game21");
        $data = $gameHandler->play($game);
        return $this->render('game21/draw.html.twig', $data);
    }
}
