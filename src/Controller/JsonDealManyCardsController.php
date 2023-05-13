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
use App\Cards\CardHand;
use App\Cards\Player;

/**
 * Controller for json routes
 */
class JsonDealManyCardsController extends AbstractController
{
    /**
     * Route where a number of cards at a time is drawn and displayed
     * from the deck of cards that was created in the 'shuffle' route
     * or in the 'deck' route
     */
    #[Route('/api/deck/draw/{number<\d+>}', name: "jsonDrawMany", methods: ['POST'])]
    public function jsonDrawMany(
        SessionInterface $session,
        int $number,
        Player $player=new Player(),
        JsonCardHandler $cardHandler = new JsonCardHandler()
    ): Response {
        /**
         * @var DeckOfCards $deck The deck of cards.
         */
        $deck = $session->get("deck") ?? new DeckOfCards();
        $session->set("deck", $deck);
        $data = $cardHandler->getDataForDraw($deck, [$player], $number);
        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }
}
