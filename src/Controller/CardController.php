<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";

use App\Cards\CardGraphic;
use App\Cards\CardHand;
use App\Cards\DeckOfCards;
use App\Cards\Player;

use App\Cards\CardLandingHandler;
use App\Cards\CardHandler;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Controller for routes where cards are displayed
 */
class CardController extends AbstractController
{
    #[Route("/card", name: "card")]
    public function card(
        CardLandingHandler $cardHandler=new CardLandingHandler()
    ): Response {
        $data = $cardHandler->getMainData();
        return $this->render('card/home.html.twig', $data);
    }

    /**
     * Route where a new Deck of Cards object is created and
     * displayed in sorted order
     */
    #[Route('/card/deck', name: "deck", methods: ['GET'])]
    public function deck(
        SessionInterface $session,
        CardHandler $cardHandler=new CardHandler(),
        DeckOfCards $deck=new DeckOfCards()
    ): Response {
        $data = $cardHandler->getDeckRouteData($deck);
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
        CardHandler $cardHandler=new CardHandler(),
        DeckOfCards $deck=new DeckOfCards()
    ): Response {
        $deck->shuffle();
        $data = $cardHandler->getDeckRouteData($deck);
        $session->set("deck", $deck);

        return $this->render('card/deck.html.twig', $data);
    }

    /**
     * Route where one card at a time is drawn and displayed
     * from the deck of cards that was created in the 'shuffle' route
     * or in the 'deck' route
     */
    #[Route('/card/deck/draw', name: "draw", methods: ['POST'])]
    public function draw(
        SessionInterface $session,
        CardHandler $cardHandler=new CardHandler(),
        Player $player=new Player()
    ): Response {
        /**
         * @var DeckOfCards $deck The deck of cards.
         */
        $deck = $session->get("deck") ?? new DeckOfCards();
        $data = $cardHandler->getDataForDraw($deck, [$player]);
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
        CardHandler $cardHandler=new CardHandler(),
        Player $player=new Player()
    ): Response {
        /**
         * @var DeckOfCards $deck The deck of cards.
         */
        $deck = $session->get("deck") ?? new DeckOfCards();
        $data = $cardHandler->getDataForDraw($deck, [$player], $number);

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
        CardHandler $cardHandler=new CardHandler(),
    ): Response {
        /**
         * @var DeckOfCards $deck The deck of cards.
         */
        $deck = $session->get("deck") ?? new DeckOfCards();

        /**
         * @var array<Player> $arr with player objects
         */
        $arr = [];
        for ($i = 1; $i <= $players; $i++) {
            $player = new Player("player {$i}");
            $arr[] = $player;
        };
        $data = $cardHandler->getDataForDraw($deck, $arr, $cards);

        $session->set("deck", $deck);

        return $this->render('card/draw.html.twig', $data);
    }
}
