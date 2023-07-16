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
 * Controller contains API route for dealing one card to one player, in Kmom02
 */
class JsonCardController4 extends AbstractController
{
    /**
     * Route where one card at a time is drawn and displayed
     * from the deck of cards that was created in the 'shuffle' route
     * or in the 'deck' route
     */
    #[Route('/api/deck/draw', name: "jsonDraw", methods: ['POST'])]
    public function jsonDraw(
        SessionInterface $session,
        Player $player=new Player(),
    ): Response {
        /**
         * @var DeckOfCards $deck The deck of cards.
         */
        $deck = $session->get("deck") ?? new DeckOfCards();
        $player->draw($deck);
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
