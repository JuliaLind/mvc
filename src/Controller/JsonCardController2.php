<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use App\Cards\JsonCardHandler;
use App\Cards\DeckOfCards;
use App\Helpers\JsonConverter;

/**
 * Controller for json card routes
 */
class JsonCardController2 extends AbstractController
{
    /**
    * Creates and shows json representation of a deck of cards
    * in sorted order
    */
    #[Route('/api/deck', name: "jsonDeck", methods: ['GET'])]
    public function jsonDeck(
        SessionInterface $session,
        JsonCardHandler $cardHandler = new JsonCardHandler(),
        JsonConverter $converter = new JsonConverter()
    ): Response {
        $deck = new DeckOfCards();
        $session->set("deck", $deck);
        $data = $cardHandler->getDeckRouteData($deck);
        $response = $converter->convert(new JsonResponse($data));
        return $response;
    }
}
