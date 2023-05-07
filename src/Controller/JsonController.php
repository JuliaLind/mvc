<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\BookRepository;

// use Symfony\Component\Validator\Constraints\DateTime;
use Datetime;

use App\Game\Game21Med;
use App\Game\Game21Hard;
use App\Game\Game21Easy;
use App\Game\Game21Interface;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use App\Cards\DeckOfCards;
use App\Cards\CardHand;
use App\Cards\Player;

/**
 * Controller for json routes
 */
class JsonController extends AbstractController
{
    /**
     * Contains links to and descriptions of all json routes
     */
    #[Route("/api", name: "api")]
    public function apis(): Response
    {
        $data = [
            'page' => "landing",
            'url' => "/api",
            'jsonRoutes' => [
                [
                    'link' => "quote",
                    'descr' => "Displays a motivational quote and date and time the site was rendered",
                    'method' => '',
                ],
                [
                    'link' => "jsonDeck",
                    'descr' => "Displays a json-text representation of all cards in deck sorted by color and value",
                    'method' => '',
                ],
                [
                    'link' => "jsonShuffle",
                    'descr' => "Post route that returnes a shuffled json-text representation of all cards in deck",
                    'method' => 'POST',
                ],
                [
                    'link' => "jsonDraw",
                    'descr' => "Post route that 'draws' and displays the top-card from deck and also the count of cards remaining",
                    'method' => 'POST',
                ],
                [
                    'link' => "jsonDrawMany",
                    'descr' => "Post route that 'draws' and displays a number of cards from deck top and also the count of cards remaining",
                    'method' => 'POST',
                ],
                [
                    'link' => "jsonDeal",
                    'descr' => "Post route that 'draws' and displays a number of cards for a number of players and also the count of cards remaining",
                    'method' => 'POST',
                ],
                [
                    'link' => "jsonGame",
                    'descr' => "Shows current status of game 21",
                    'method' => 'GET',
                ],
                [
                    'link' => "books_json",
                    'descr' => "Shows all books in the library",
                    'method' => '',
                ],
                [
                    'link' => "single_book_json",
                    'descr' => "Shows one book in the library",
                    'method' => '',
                ],
            ],
        ];
        return $this->render('landing_json.html.twig', $data);
    }

    /**
     * Displays a randomly selected quote and date+time when the selection
     * took place
     */
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

    /**
     * Creates and shows json representation of a deck of cards
     * in sorted order
     */
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


    /**
     * Creates and shows json representation of a deck of cards
     * in shuffled order
     */
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

    /**
     * Route where one card at a time is drawn and displayed
     * from the deck of cards that was created in the 'shuffle' route
     * or in the 'deck' route
     */
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

    /**
     * Route where a number of cards at a time is drawn and displayed
     * from the deck of cards that was created in the 'shuffle' route
     * or in the 'deck' route
     */
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

    /**
     * Route where a number of cards is dealt to a number of players
     * from the deck of cards that was created in the 'shuffle' route
     * or in the 'deck' route
     */
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

    /**
     * Route displays current game/game-status as json object
     */
    #[Route('/api/game', name: "jsonGame", methods: ['GET'])]
    public function jsonGame(
        SessionInterface $session
    ): Response {
        $gameStatus = "No game started";
        /**
         * @var Game21Interface $game The current game of 21.
         */
        $game = $session->get("game21") ?? null;
        if ($game != null) {
            $gameStatus = $game->getGameStatus();
            $gameStatus['risk'] = $game->getRisk();
        }

        $data = [
            'players' => $game->getPlayerData(),
            'status' => $gameStatus,
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    /**
     * Displays all books in the library
     */
    #[Route('/api/library/books', name: "books_json")]
    public function showAllBooks(
        BookRepository $bookRepository
    ): Response {
        $books = $bookRepository
            ->findAll();

        $response = $this->json($books);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    #[Route('api/library/book/{isbn}', name: 'single_book_json')]
    public function showProductById(
        BookRepository $bookRepository,
        string $isbn
    ): Response {
        $book = $bookRepository
            ->findOneByIsbn($isbn);

        return $this->json($book);
    }
}
