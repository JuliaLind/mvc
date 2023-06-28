<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";



use App\Game\NextRound;
use App\Game\Game21Easy;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Game21Controller3 extends AbstractController
{
    #[Route('/game/select-amount', name: "selectAmount", methods: ['GET'])]
    public function selectAmount(
        SessionInterface $session,
        NextRound $nextRound = new nextRound()
    ): Response {
        /**
         * @var Game21Easy $game The current game of 21.
         */
        $game = $session->get("game21");
        $nextRoundData = $nextRound->main($game);
        $data = [
            'page' => "game no-header card",
            'url' => "/game",
        ];
        $data = array_merge($nextRoundData, $data);
        $session->set("game21", $game);

        return $this->render('game21/select-amount.html.twig', $data);
    }
}
