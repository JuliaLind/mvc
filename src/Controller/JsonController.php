<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
// use Symfony\Component\Validator\Constraints\DateTime;
use Datetime;

use App\Game\Player;
use App\Game\Game21Easy;
use App\Game\Game21Med;
use App\Game\Game21Hard;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use App\Cards\DeckOfCards;
use App\Cards\CardHand;

class JsonController extends AbstractController
{
    #[Route('/api/quote', name: "quote")]
    public function jsonQuote(): Response
    {
        $quotes = [
            <<<EOD
            "Opportunities don't happen, you create them." — Chris Grosser
            EOD,
            <<<EOD
            "It is never too late to be what you might have been." — George Eliot
            EOD,
            <<<EOD
            "Do the best you can. No one can do more than that.” — John Wooden
            EOD,
            <<<EOD
            "Do what you can, with what you have, where you are." — Theodore Roosevelt
            EOD,
            <<<EOD
            "If you can dream it, you can do it." — Walt Disney
            EOD
        ];

        date_default_timezone_set('Europe/Stockholm');


        $number = random_int(0, count($quotes)-1);
        $time = new DateTime();
        $data = [
            'quote' => $quotes[$number],
            'timestamp' => $time->format('Y-m-d H:i:s'),
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    #[Route('/api/deck', name: "jsonDeck", methods: ['GET'])]
    public function jsonDeck(
        SessionInterface $session
    ): Response {
        $deck = new DeckOfCards();
        $session->set("deck", $deck);
        $cards = $deck->getAsString();
        $data = [
            'cards' => $cards,
        ];
        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    #[Route('/api/deck/shuffle', name: "jsonShuffle", methods: ['POST'])]
    public function jsonShuffle(
        SessionInterface $session
    ): Response {
        $deck = new DeckOfCards();
        $deck->shuffle();
        $session->set("deck", $deck);
        $cards = $deck->getAsString();
        $data = [
            'cards' => $cards,
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    #[Route('/api/deck/draw', name: "jsonDraw", methods: ['POST'])]
    public function jsonDraw(
        SessionInterface $session
    ): Response {
        /**
         * @var DeckOfCards $deck The deck of cards.
         */
        $deck = $session->get("deck") ?? new DeckOfCards();
        $player = new Player('');
        $player->draw($deck);
        $session->set("deck", $deck);

        $data = [
            'cards' => $player->showHandAsString(),
            'cardsLeft' => $deck->getCardCount(),
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    #[Route('/api/deck/draw/{number<\d+>}', name: "jsonDrawMany", methods: ['POST'])]
    public function jsonDrawMany(
        SessionInterface $session,
        int $number
    ): Response {
        /**
         * @var DeckOfCards $deck The deck of cards.
         */
        $deck = $session->get("deck") ?? new DeckOfCards();
        $player = new Player('');
        $player->drawMany($deck, $number);

        $session->set("deck", $deck);

        $data = [
            'cards' => $player->showHandAsString(),
            'cards left in deck' => $deck->getCardCount(),
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    #[Route('/api/deck/deal/{players<\d+>}/{cards<\d+>}', name: "jsonDeal", methods: ['POST'])]
    public function jsonDeal(
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
                'playerName' => $player->getName(),
                'cards' => $player->showHandAsString(),
            ];
        };
        $session->set("deck", $deck);
        $data = [
            'players' => $hands,
            'cards left in deck' => $deck->getCardCount(),
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    #[Route('/api/game', name: "jsonGame", methods: ['GET'])]
    public function jsonGame(
        SessionInterface $session
    ): Response {
        $gameStatus = "No game started";
        /**
         * @var game21Easy|Game21Med|Game21Hard $game The current game of 21.
         */
        $game = $session->get("game21") ?? null;
        if ($game != null) {
            $gameStatus = $game->getGameStatus();
        }

        $data = [
            'status' => $gameStatus,
        ];
        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }
}
