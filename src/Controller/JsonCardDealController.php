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
use App\Cards\PlayerCreator;

/**
 * Controller for json routes
 */
class JsonCardDealController extends AbstractController
{
    /**
     * Route where a number of cards is dealt to a number of players
     * from the deck of cards that was created in the 'shuffle' route
     * or in the 'deck' route
     */
    #[Route('/api/deck/deal/{players<\d+>}/{cards<\d+>}', name: "jsonDeal", methods: ['POST'])]
    public function jsonDeal(
        SessionInterface $session,
        int $players,
        int $cards,
        JsonCardHandler $cardHandler = new JsonCardHandler(),
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

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }
}
