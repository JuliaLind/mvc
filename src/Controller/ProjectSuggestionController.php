<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use App\Project\NotEnoughCoinsException;
use App\Project\Register;
use App\Project\Game;

/**
 * Controller related to the Project. Contains routes for the suggestion cheat - purchase, show and unset
 */
class ProjectSuggestionController extends AbstractController
{
    /**
     * Route for purchasing a calculated suggestion on slot and also seing which
     * rules are possible to achive if placing card in particular slot and also which
     * rules are possible if the card is not placed in particular slot (for all hands)
     */
    #[Route('/proj/purchase-suggestion', name: "purchase-suggestion", methods: ['POST'])]
    public function projPurchaseSuggest(
        SessionInterface $session,
        EntityManagerInterface $entityManager,
    ): Response {
        /**
         * @var int $userId
         */
        $userId = $session->get("user");
        $register = new Register($entityManager, $userId);
        try {
            $register->debit(30, 'show-suggestion cheat');
            $session->set("show-suggestion", true);
            /**
             * @var Game $game
             */
            $game = $session->get("game");
            $game->playerSuggest();
            $session->set("game", $game);
            return $this->redirectToRoute('show-suggestion');
        } catch (NotEnoughCoinsException) {
            $this->addFlash('warning', "You do not have enough coins to use this cheat. Purchase more coins in the shop");
            return $this->redirectToRoute('proj-play');
        }
    }

    /**
     * Leaders to the page where the user can see best possible rules with card, without card
     * and suggestion where to place the card
     */
    #[Route("/proj/show-suggestion", name: "show-suggestion")]
    public function projShowSuggest(
        SessionInterface $session,
        EntityManagerInterface $entityManager,
    ): Response {
        if(!$session->get("show-suggestion")) {
            return $this->redirectToRoute('proj-play');
        }
        $session->set("show-suggestion", false);
        /**
         * @var Game $game
         */
        $game = $session->get("game");
        $state = $game->currentState();
        /**
         * @var int $userId
         */
        $userId = $session->get("user");
        $register = new Register($entityManager, $userId);
        $data = [
            ...$state,
            'url' => "",
            'balance' => $register->getBalance(),
        ];
        return $this->render('proj/game-display-suggest.html.twig', $data);
    }
}
