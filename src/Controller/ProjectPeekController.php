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
use Symfony\Component\HttpFoundation\Request;
use App\Project\Game;
use App\ProjectGrid\Grid;

/**
 * Controller related to the Project. Containts routes for
 * the deck-peek cheat
 */
class ProjectPeekController extends AbstractController
{
    /**
     * Route for purchasing a peek at all the remaining cards the
     * player is yet to be dealt from the deck
     */
    #[Route('/proj/purchase-peek-cheat', name: "purchase-peek", methods: ['POST'])]
    public function purchasePeekCheat(
        SessionInterface $session,
        EntityManagerInterface $entityManager,
    ): Response {
        /**
         * @var int $userId
         */
        $userId = $session->get("user");
        $register = new Register($entityManager, $userId);

        try {
            $register->debit(120, 'peek in deck cheat');
        } catch (NotEnoughCoinsException) {
            $this->addFlash('warning', "You do not have enough coins to use this cheat. Purchase more coins in the shop");
            return $this->redirectToRoute('proj-play');
        }
        $session->set("deck-peek", true);
        return $this->redirectToRoute('deck-peek');
    }

    /**
     * Route for displaying the cards that the user is yet to be dealt
     * from the deck
     */
    #[Route('/proj/deck-peek', name: "deck-peek", methods: ['GET'])]
    public function deckPeek(
        SessionInterface $session,
    ): Response {
        if($session->get('deck-peek') === false) {
            return $this->redirectToRoute('proj-play');
        }
        /**
         * @var Game $game
         */
        $game = $session->get("game");
        $state = $game->currentState();
        $data = [
            ...$state,
            'url' => ""
        ];
        $session->set("deck-peek", false);
        return $this->render('proj/deck.html.twig', $data);
    }
}
