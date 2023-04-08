<?php

namespace App\Controller;

use App\Cards\CardGraphic;
use App\Cards\CardHand;
// use App\Cards\DeckOfCardsExt;
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
        // $deck = new DeckOfCardsExt();
        $deck = new DeckOfCards();
        $session->set("deck", $deck);
        $data = [
            'title' => "Sorted deck",
            'cards' => $deck->getString(),
            'page' => "deck card",
            'url' => "/card",
        ];
        return $this->render('card/deck.html.twig', $data);
    }

    #[Route('/card/deck/shuffle', name: "shuffle", methods: ['POST'])]
    public function shuffle(
        SessionInterface $session
    ): Response {
        // $deck = new DeckOfCardsExt();
        $deck = new DeckOfCards();
        $deck->shuffle();
        $session->set("deck", $deck);
        $data = [
            'title' => "Shuffled deck",
            'cards' => $deck->getString(),
            'page' => "deck card",
            'url' => "/card",
        ];

        return $this->render('card/deck.html.twig', $data);
    }

    #[Route('/card/deck/draw', name: "draw", methods: ['POST'])]
    public function draw(
        SessionInterface $session
    ): Response {
        $deck = $session->get("deck") ?? new DeckOfCardsExt();
        $card = $deck->draw();
        $data = [
            'cards' => [
                $card->getAsString(),
            ],
            'cards left in deck' => $deck->getCardCount(),
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
        $hand = new CardHand();
        $deck = $session->get("deck") ?? new DeckOfCardsExt();
        for ($i = 1; $i <= $number; $i++) {
            $hand->add($deck->draw());
        }
        $data = [
            'cards' => $hand->getString(),
            'cards left in deck' => $deck->getCardCount(),
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
        $deck = $session->get("deck") ?? new DeckOfCardsExt();
        $hands = [];
        for ($i = 1; $i <= $players; $i++) {
            $hand = new CardHand();
            if ($cards > $deck->getCardCount()) {
                $cards = $deck->getCardCount();
            }
            for ($j = 1; $j <= $cards; $j++) {
                $hand->add($deck->draw());
            }
            $hands[] = $hand->getString();
        };
        $data = [
            'players' => $hands,
            'cards left in deck' => $deck->getCardCount(),
            'page' => "draw many card",
            'url' => "/card",
        ];

        return $this->render('card/draw_multiplayer.html.twig', $data);
    }
}
