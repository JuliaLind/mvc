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

class JsonCardController extends AbstractController
{
    /**
     * Route where a number of cards is dealt to a number of players
     * from the deck of cards that was created in the 'shuffle' route
     * or in the 'deck' route
     */
    #[Route('/api/deck/deal/{players<\d+>}/{cards<\d+>}', name: "jsonDeal", methods: ['POST'])]
    public function jsonDeal(
        SessionInterface $session,
        int $players,
        int $cards,
    ): Response {
        /**
         * @var DeckOfCards $deck The deck of cards.
         */
        $deck = $session->get("deck") ?? new DeckOfCards();
        $playerData = [];
        for ($i = 1; $i <= $players; $i++) {
            $player = new Player("player {$i}");
            $player->drawMany($deck, $cards);
            $playerData[] = [
                'playerName' => $player->getName(),
                'cards' => $player->showHandAsString(),
            ];
        };

        $data = [
            'players' => $playerData,
            'cardsLeft' => $deck->getCardCount(),
        ];
        $session->set("deck", $deck);
        return $this->json($data);
    }
}
