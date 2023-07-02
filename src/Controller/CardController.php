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
class CardController extends AbstractController
{
    /**
     * Route where a new Deck of Cards object is created and
     * displayed in sorted order
     */
    #[Route('/card/deck', name: "deck", methods: ['GET'])]
    public function deck(
        SessionInterface $session,
        DeckOfCards $deck=new DeckOfCards()
    ): Response {
        $data = [
            'title' => "New deck",
            'cards' => $deck->getImgLinks(),
            'page' => "deck card no-header",
            'url' => "/card",
        ];
        $session->set("deck", $deck);

        return $this->render('card/deck.html.twig', $data);
    }

    /**
     * Route where a new Deck of Cards object is created and
     * displayed in shuffled order
     */
    #[Route('/card/deck/shuffle', name: "shuffle", methods: ['POST'])]
    public function shuffle(
        SessionInterface $session,
        DeckOfCards $deck=new DeckOfCards()
    ): Response {
        $deck->shuffle();
        $data = [
            'title' => "Shuffled deck",
            'cards' => $deck->getImgLinks(),
            'page' => "deck card no-header",
            'url' => "/card",
        ];
        $session->set("deck", $deck);

        return $this->render('card/deck.html.twig', $data);
    }

    /**
     * Route for the card landing page
     */
    #[Route("/card", name: "card")]
    public function card(
    ): Response {
        $data = [
            'page' => "landing",
            'url' => "/card",
            'cardRoutes' => [
                [
                    'link' => "deck",
                    'method' => 'GET',
                    'route' => '/card/deck'
                ],
                [
                    'link' => "shuffle",
                    'method' => 'POST',
                    'route' => '/card/deck/shuffle'
                ],
                [
                    'link' => "draw",
                    'method' => 'POST',
                    'route' => '/card/deck/draw'
                ],
                [
                    'link' => "drawMany",
                    'method' => 'POST',
                    'route' => '/card/deck/draw/5'
                ],
                [
                    'link' => "deal",
                    'method' => 'POST',
                    'route' => '/card/deck/deal/3/5'
                ],
            ],
        ];
        return $this->render('card/home.html.twig', $data);
    }
}
