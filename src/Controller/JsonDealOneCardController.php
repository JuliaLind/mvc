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
class JsonDealOneCardController extends AbstractController
{
    /**
     * Route where one card at a time is drawn and displayed
     * from the deck of cards that was created in the 'shuffle' route
     * or in the 'deck' route
     */
    #[Route('/api/deck/draw', name: "jsonDraw", methods: ['POST'])]
    public function jsonDraw(
        SessionInterface $session,
        Player $player=new Player(),
        JsonCardHandler $cardHandler = new JsonCardHandler()
    ): Response {
        /**
         * @var DeckOfCards $deck The deck of cards.
         */
        $deck = $session->get("deck") ?? new DeckOfCards();
        $data = $cardHandler->getDataForDraw($deck, [$player]);
        $session->set("deck", $deck);

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }
}
