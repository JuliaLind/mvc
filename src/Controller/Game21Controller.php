<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";


use App\Game\Game21Interface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

// use App\Markdown\MdParser;

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
        MdParser $parser = new MdParser()
    ): Response {
        /**
         * @var Game21Interface $game The current game of 21.
         */
        $game = $session->get("game21") ?? null;
        $finished = true;
        if ($game != null) {
            $finished = $game->gameOver();
        }

        $data = [
            'about' => $parser->getParsedText("markdown/game21.md"),
            'page' => "game",
            'url' => "/game",
            'finished' => $finished,
        ];

        return $this->render('game21/home.html.twig', $data);
    }

    /**
     * Documentation route. Contains docmentation for
     * the initial version of the game
     */
    #[Route('/game/doc', name: "gameDoc", methods: ['GET'])]
    public function gameDoc(
        MdParser $parser = new MdParser()
    ): Response {
        $data = [
            'about' => $parser->getParsedText("markdown/doc.md"),
            'page' => "landing doc",
            'url' => "/game"
        ];

        return $this->render('game21/doc.html.twig', $data);
    }
}
