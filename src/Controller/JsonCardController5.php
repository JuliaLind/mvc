<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Cards\DeckOfCards;

/**
 * Controller contains API route that displays a new, shuffled deck of cards, in Kmom02
 */
class JsonCardController5 extends AbstractController
{
    /**
     * Creates and shuffles a new card deck and shows as json
     */
    #[Route('/api/deck/shuffle', name: "jsonShuffle", methods: ['POST'])]
    public function jsonShuffle(
        SessionInterface $session,
        DeckOfCards $deck = new DeckOfCards()
    ): Response {
        $deck->shuffle();
        $session->set("deck", $deck);
        $data = [
            'cards' => $deck->getAsString(),
        ];
        return $this->json($data);
    }
}
