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
 * Controller for API card routes
 */
class JsonCardController2 extends AbstractController
{
    /**
    * Creates a new deck of cards and shows as Json
    */
    #[Route('/api/deck', name: "jsonDeck", methods: ['GET'])]
    public function jsonDeck(
        SessionInterface $session,
        DeckOfCards $deck = new DeckOfCards()
    ): Response {
        $session->set("deck", $deck);
        $data = [
            'cards' => $deck->getAsString(),
        ];
        return $this->json($data);
    }
}
