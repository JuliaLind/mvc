<?php

namespace App\Controller;

use App\Cards\CardGraphic;
use App\Cards\CardHand;
use App\Cards\DeckOfCards;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CardController extends AbstractController
{
    #[Route('/card/deck', name: "deck", methods: ['GET'])]
    public function deck(
        SessionInterface $session
    ): Response {
        $deck = new DeckOfCards();
        $session->set("deck", $deck);
        $data = [
            'title' => "Sorted deck",
            'cards' => $deck->getImgLinks(),
            'page' => "deck card",
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
            'page' => "deck card",
            'url' => "/card",
        ];

        return $this->render('card/deck.html.twig', $data);
    }

    #[Route('/card/deck/draw', name: "draw", methods: ['POST'])]
    public function draw(
        SessionInterface $session
    ): Response {
        $deck = $session->get("deck") ?? new DeckOfCards();
        $players = [];
        $hand = new CardHand($deck, 1, 'Player 1');
        $session->set("deck", $deck);
        $players[] = [
            'cards' => $hand->getImgLinks(),
            'playerName' => $hand->getPlayerName(),
        ];
        $data = [
            'title' => "Draw 1 card",
            'players' => $players,
            'cardsLeft' => $deck->getCardCount(),
            'page' => "draw card",
            'url' => "/card",
        ];

        return $this->render('card/draw.html.twig', $data);
    }

    #[Route('/card/deck/draw/{number<\d+>}', name: "drawMany", methods: ['POST'])]
    public function drawMany(
        SessionInterface $session,
        int $number
    ): Response {
        $deck = $session->get("deck") ?? new DeckOfCards();
        $players = [];
        $hand = new CardHand($deck, $number, 'Player 1');
        $session->set("deck", $deck);
        $players[] = [
            'cards' => $hand->getImgLinks(),
            'playerName' => $hand->getPlayerName(),
        ];

        $data = [
            'title' => "Draw {$number} cards",
            'players' => $players,
            'cardsLeft' => $deck->getCardCount(),
            'page' => "draw card",
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
        $deck = $session->get("deck") ?? new DeckOfCards();
        $hands = [];

        for ($i = 1; $i <= $players; $i++) {
            $hand = new CardHand($deck, $cards, "player {$i}");
            $hands[] = [
                'cards' => $hand->getImgLinks(),
                'playerName' => $hand->getPlayerName(),
            ];
        };
        $session->set("deck", $deck);
        $data = [
            'title' => "Draw {$cards} cards for {$players} players",
            'players' => $hands,
            'cardsLeft' => $deck->getCardCount(),
            'page' => "draw many card",
            'url' => "/card",
        ];

        return $this->render('card/draw.html.twig', $data);
    }
}
