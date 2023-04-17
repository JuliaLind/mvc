<?php

namespace App\Controller;

use App\Cards\CardGraphic;
use App\Cards\CardHand;
use App\Cards\DeckOfCards;

use App\Cards\Player;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CardController extends AbstractController
{
    #[Route("/card", name: "card")]
    public function card(): Response
    {
        $data = [
            'page' => "landing",
            'url' => "/card",
            'cardRoutes' => [
                [
                    'link' => "deck",
                    'method' => 'GET',
                ],
                [
                    'link' => "shuffle",
                    'method' => 'POST',
                ],
                [
                    'link' => "draw",
                    'method' => 'POST',
                ],
                [
                    'link' => "drawMany",
                    'method' => 'POST',
                ],
                [
                    'link' => "deal",
                    'method' => 'POST',
                ],
            ],
        ];
        return $this->render('card/home.html.twig', $data);
    }

    #[Route('/card/deck', name: "deck", methods: ['GET'])]
    public function deck(
        SessionInterface $session
    ): Response {
        $deck = new DeckOfCards();
        $session->set("deck", $deck);
        $data = [
            'title' => "Sorted deck",
            'cards' => $deck->getImgLinks(),
            'page' => "deck card no-header",
            'url' => "/card",
        ];
        return $this->render('card/deck.html.twig', $data);
    }

    #[Route('/card/deck/shuffle', name: "shuffle", methods: ['POST'])]
    public function shuffle(
        SessionInterface $session
    ): Response {
        $deck = new DeckOfCards();
        $deck->shuffle();
        $session->set("deck", $deck);
        $data = [
            'title' => "Shuffled deck",
            'cards' => $deck->getImgLinks(),
            'page' => "deck card no-header",
            'url' => "/card",
        ];

        return $this->render('card/deck.html.twig', $data);
    }

    #[Route('/card/deck/draw', name: "draw", methods: ['POST'])]
    public function draw(
        SessionInterface $session
    ): Response {
        /**
         * @var DeckOfCards $deck The deck of cards.
         */
        $deck = $session->get("deck") ?? new DeckOfCards();
        $players = [];

        $player = new Player('Player 1');
        $player->draw($deck);

        $session->set("deck", $deck);
        $players[] = [
            'playerName' => $player->name,
            'cards' => $player->showHandGraphic(),
        ];
        $data = [
            'title' => "Draw 1 card",
            'players' => $players,
            'cardsLeft' => $deck->getCardCount(),
            'page' => "draw card no-header",
            'url' => "/card",
        ];

        return $this->render('card/draw.html.twig', $data);
    }

    #[Route('/card/deck/draw/{number<\d+>}', name: "drawMany", methods: ['POST'])]
    public function drawMany(
        SessionInterface $session,
        int $number
    ): Response {
        /**
         * @var DeckOfCards $deck The deck of cards.
         */
        $deck = $session->get("deck") ?? new DeckOfCards();
        $players = [];
        $player = new Player('Player 1');
        $player->drawMany($deck, $number);

        $session->set("deck", $deck);
        $players[] = [
            'playerName' => $player->name,
            'cards' => $player->showHandGraphic(),
        ];

        $data = [
            'title' => "Draw {$number} cards",
            'players' => $players,
            'cardsLeft' => $deck->getCardCount(),
            'page' => "draw card no-header",
            'url' => "/card",
        ];

        return $this->render('card/draw.html.twig', $data);
    }

    #[Route('/card/deck/deal/{players<\d+>}/{cards<\d+>}', name: "deal", methods: ['POST'])]
    public function deal(
        SessionInterface $session,
        int $players,
        int $cards
    ): Response {
        /**
         * @var DeckOfCards $deck The deck of cards.
         */
        $deck = $session->get("deck") ?? new DeckOfCards();
        $hands = [];

        for ($i = 1; $i <= $players; $i++) {
            $player = new Player("player {$i}");
            $player->drawMany($deck, $cards);
            $hands[] = [
                'playerName' => $player->name,
                'cards' => $player->showHandGraphic(),
            ];
        };
        $session->set("deck", $deck);
        $data = [
            'title' => "Draw {$cards} cards for {$players} players",
            'players' => $hands,
            'cardsLeft' => $deck->getCardCount(),
            'page' => "draw card no-header",
            'url' => "/card",
        ];

        return $this->render('card/draw.html.twig', $data);
    }
}
