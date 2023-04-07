<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use App\Cards\DeckOfCardsExt;
use App\Cards\CardHand;

class ApiController extends AbstractController
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
        $time = new \DateTime();
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
    ): Response
    {
        $deck = new DeckOfCardsExt();
        // $deck->sort();
        $session->set("deck", $deck);
        $cards = $deck->getTextRepresentation();
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
    ): Response
    {
        $deck = new DeckOfCardsExt();
        $deck->shuffle();
        $session->set("deck", $deck);
        $cards = $deck->getTextRepresentation();
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
    ): Response
    {
        $deck = $session->get("deck") ?? new DeckOfCardsExt();
        $card = $deck->draw();
        $card = $card->getAsText();
        $data = [
            'card' => $card,
            'cards left in deck' => $deck->getCardCount(),
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
    ): Response
    {
        $hand = new CardHand();
        $deck = $session->get("deck") ?? new DeckOfCardsExt();
        for ($i = 1; $i <= $number; $i++) {
            $hand->add($deck->draw());
        }
        $data = [
            'cards' => $hand->getTextRepresentation(),
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
    ): Response
    {
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
            $hands[] = $hand->getTextRepresentation();
        };
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
}
