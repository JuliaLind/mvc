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
use App\Helpers\JsonConverter;

/**
 * Controller for json routes
 */
class JsonCardController extends AbstractController
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
        PlayerCreator $creator = new PlayerCreator(),
        JsonConverter $converter = new JsonConverter()
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
        $response = $converter->convert(new JsonResponse($data));
        return $response;
    }
}
