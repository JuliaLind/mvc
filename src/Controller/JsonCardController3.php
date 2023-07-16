<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Cards\DeckOfCards;
use App\Cards\Player;

/**
 * Controller contains API route for dealing many cards to one player, in Kmom02
 */
class JsonCardController3 extends AbstractController
{
    /**
     * Route where a number of cards at a time is drawn and displayed
     * from the deck of cards that was created in the 'shuffle' route
     * or in the 'deck' route
     */
    #[Route('/api/deck/draw/{number<\d+>}', name: "jsonDrawMany", methods: ['POST'])]
    public function jsonDrawMany(
        SessionInterface $session,
        int $number,
        Player $player=new Player(),
    ): Response {
        /**
         * @var DeckOfCards $deck The deck of cards.
         */
        $deck = $session->get("deck") ?? new DeckOfCards();

        $player->drawMany($deck, $number);
        $data = [
            'players' => [
                [
                    'playerName' => 'Player 1',
                    'cards' => $player->showHandAsString(),
                ]
            ],
            'cardsLeft' => $deck->getCardCount(),
        ];

        $session->set("deck", $deck);
        return $this->json($data);
    }
}
