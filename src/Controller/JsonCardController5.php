<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

// use App\Cards\JsonCardHandler;
use App\Cards\DeckOfCards;
use App\Helpers\JsonConverter;

/**
 * Controller for json card routes
 */
class JsonCardController5 extends AbstractController
{
    /**
     * Creates and shows json representation of a deck of cards
     * in shuffled order
     */
    #[Route('/api/deck/shuffle', name: "jsonShuffle", methods: ['POST'])]
    public function jsonShuffle(
        SessionInterface $session,
        // JsonCardHandler $cardHandler = new JsonCardHandler(),
        JsonConverter $converter = new JsonConverter()
    ): Response {
        $deck = new DeckOfCards();
        $deck->shuffle();
        $session->set("deck", $deck);
        // $data = $cardHandler->getDeckRouteData($deck);
        $data = [
            'cards' => $deck->getAsString(),
        ];
        $response = $converter->convert(new JsonResponse($data));
        return $response;
    }
}
