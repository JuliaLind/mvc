<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";


use App\Cards\DeckOfCards;
use App\Cards\Player;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Controller for Card routes
 */
class CardController2 extends AbstractController
{
    /**
     * Route where one card at a time is drawn and displayed
     * from the deck of cards that was created in the 'shuffle' route
     * or in the 'deck' route
     */
    #[Route('/card/deck/draw', name: "draw", methods: ['POST'])]
    public function draw(
        SessionInterface $session,
        Player $player=new Player(),
    ): Response {
        /**
         * @var DeckOfCards $deck The deck of cards.
         */
        $deck = $session->get("deck") ?? new DeckOfCards();

        $player->draw($deck);
        $data = [
            'title' => "Draw 1 card for 1 player",
            'players' => [
                [
                    'playerName' => 'Player 1',
                    'cards' => $player->showHandGraphic(),
                ]
            ],
            'cardsLeft' => $deck->getCardCount(),
            'page' => "draw card no-header",
            'url' => "/card",
        ];
        $session->set("deck", $deck);

        return $this->render('card/draw.html.twig', $data);
    }


    /**
     * Route where a number of cards at a time is drawn and displayed
     * from the deck of cards that was created in the 'shuffle' route
     * or in the 'deck' route
     */
    #[Route('/card/deck/draw/{number<\d+>}', name: "drawMany", methods: ['POST'])]
    public function drawMany(
        SessionInterface $session,
        int $number,
        Player $player=new Player()
    ): Response {
        /**
         * @var DeckOfCards $deck The deck of cards.
         */
        $deck = $session->get("deck") ?? new DeckOfCards();
        $player->drawMany($deck, $number);
        $data = [
            'title' => "Draw {$number} cards for 1 player",
            'players' => [
                [
                    'playerName' => 'Player 1',
                    'cards' => $player->showHandGraphic(),
                ]
            ],
            'cardsLeft' => $deck->getCardCount(),
            'page' => "draw card no-header",
            'url' => "/card",
        ];
        $session->set("deck", $deck);

        return $this->render('card/draw.html.twig', $data);
    }

    /**
     * Route where a number of cards is dealt to a number of players
     * from the deck of cards that was created in the 'shuffle' route
     * or in the 'deck' route
     */
    #[Route('/card/deck/deal/{players<\d+>}/{cards<\d+>}', name: "deal", methods: ['POST'])]
    public function deal(
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
                'cards' => $player->showHandGraphic(),
            ];
        };

        $data = [
            'title' => "Draw {$cards} cards for {$players} players",
            'players' => $playerData,
            'cardsLeft' => $deck->getCardCount(),
            'page' => "draw card no-header",
            'url' => "/card",
        ];
        $session->set("deck", $deck);

        return $this->render('card/draw.html.twig', $data);
    }
}
