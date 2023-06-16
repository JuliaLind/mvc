<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";

use App\Cards\CardGraphic;
use App\Cards\CardHand;
use App\Cards\DeckOfCards;
use App\Cards\Player;

use App\Cards\CardHandler;
use App\Cards\CardDeckHandler;
use App\Cards\PlayerCreator;

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
    /**
     * Route where a new Deck of Cards object is created and
     * displayed in sorted order
     */
    #[Route('/card/deck', name: "deck", methods: ['GET'])]
    public function deck(
        SessionInterface $session,
        CardDeckHandler $cardHandler=new CardDeckHandler(),
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
        CardDeckHandler $cardHandler=new CardDeckHandler(),
        DeckOfCards $deck=new DeckOfCards()
    ): Response {
        $deck->shuffle();
        $data = $cardHandler->getDeckRouteData($deck);
        $data['title'] = "Shuffled deck";
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
        CardHandler $cardHandler = new CardHandler(),
        PlayerCreator $creator = new PlayerCreator()
    ): Response {
        /**
         * @var DeckOfCards $deck The deck of cards.
         */
        $deck = $session->get("deck") ?? new DeckOfCards();

        /**
         * @var array<Player> $arr with player objects
         */
        $arr = $creator->createPlayers($players);
        $data = $cardHandler->getDataForDraw($deck, $arr, $cards);

        $session->set("deck", $deck);

        return $this->render('card/draw.html.twig', $data);
    }
}
