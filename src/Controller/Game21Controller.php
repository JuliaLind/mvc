<?php

namespace App\Controller;

use App\Game\Game21Med;
use App\Game\Game21Hard;
use App\Game\Game21Easy;

use App\Markdown\MdParser;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Game21Controller extends AbstractController
{
    #[Route('/game', name: "gameMain", methods: ['GET'])]
    public function main(
        SessionInterface $session
    ): Response {
        $filename = "markdown/game21.md";
        $parsedText = new MdParser($filename);
        /**
         * @var Game21Easy|Game21Med|Game21Hard|null $game The current game of 21.
         */
        $game = $session->get("game21") ?? null;
        $finished = true;
        if ($game && $game->finished === false) {
            $finished = $game->finished;
        }
        $data = [
            'about' => $parsedText->getParsedText(),
            'page' => "game",
            'url' => "/game",
            'finished' => $finished,
        ];

        return $this->render('game21/home.html.twig', $data);
    }

    #[Route('/game/doc', name: "gameDoc", methods: ['GET'])]
    public function gameDoc(): Response
    {
        $filename = "markdown/doc.md";
        $parsedText = new MdParser($filename);
        $data = [
            'about' => $parsedText->getParsedText(),
            'page' => "game doc",
            'url' => "/game"
        ];

        return $this->render('game21/doc.html.twig', $data);
    }


    #[Route('/game/init/{level<\d+>}', name: "init", methods: ['POST'])]
    public function init(
        SessionInterface $session,
        int $level=0
    ): Response {
        $game = new Game21Easy();
        switch($level) {
            case 1:
                $game = new Game21Med();
                break;
            case 2:
                $game = new Game21Hard();
                break;
        }
        $session->set("game21", $game);

        return $this->redirectToRoute('selectAmount');
    }

    #[Route('/game/select-amount', name: "selectAmount", methods: ['GET'])]
    public function selectAmount(
        SessionInterface $session
    ): Response {
        /**
         * @var Game21Easy|Game21Med|Game21Hard $game The current game of 21.
         */
        $game = $session->get("game21");
        $game->nextRound();
        $session->set("game21", $game);
        $data = [
            'limit' => $game->getInvestLimit(),
            'money' => $game->playerMoney(),
            'round' => $game->currentRound,
            'page' => "game no-header card",
            'url' => "/game",
        ];
        return $this->render('game21/select-amount.html.twig', $data);
    }

    #[Route('/game/bet/{amount<\d+>}', name: "bet", methods: ['POST'])]
    public function bet(
        SessionInterface $session,
        int $amount
    ): Response {
        /**
         * @var Game21Easy|Game21Med|Game21Hard $game The current game of 21.
         */
        $game = $session->get("game21");
        $game->addToMoneyPot($amount);
        $session->set("game21", $game);
        return $this->redirectToRoute('play');
    }

    #[Route('/game/draw', name: "playerDraw", methods: ['POST'])]
    public function playerDraw(
        SessionInterface $session
    ): Response {
        /**
         * @var Game21Easy|Game21Med|Game21Hard $game The current game of 21.
         */
        $game = $session->get("game21");
        $nextStep = $game->deal();
        // $nextStep = $game->evaluate();
        $session->set("game21", $game);
        $winner = $game->winner;
        switch($nextStep) {
            case 0:
                $this->addFlash(
                    'warning',
                    "Round over, {$winner} won!"
                );
                break;
            case 1:
                $this->addFlash(
                    'warning',
                    "Game over, {$winner} won!"
                );
                break;
        }
        return $this->redirectToRoute('play');
    }

    #[Route('/game/bank-playing', name: "bankPlaying", methods: ['POST'])]
    public function bankPlaying(
        SessionInterface $session
    ): Response {
        /**
         * @var Game21Easy|Game21Med|Game21Hard $game The current game of 21.
         */
        $game = $session->get("game21");
        $game->bankPlaying = true;
        $nextStep = $game->dealBank();
        $session->set("game21", $game);
        $winner = $game->winner;
        switch($nextStep) {
            case 0:
                $this->addFlash(
                    'warning',
                    "Round over, {$winner} won!"
                );
                break;
            case 1:
                $this->addFlash(
                    'warning',
                    "Game over, {$winner} won!"
                );
                break;
        }
        return $this->redirectToRoute('play');
    }


    #[Route('/game/play', name: "play", methods: ['GET'])]
    public function play(
        SessionInterface $session
    ): Response {
        /**
         * @var Game21Easy|Game21Med|Game21Hard $game The current game of 21.
         */
        $game = $session->get("game21");
        $pageData = [
            'page' => "game no-header card",
            'url' => "/game",
            'title' => 'Game 21'
        ];
        $data = array_merge($game->getGameStatus(), $pageData);
        return $this->render('game21/draw.html.twig', $data);
    }
}
