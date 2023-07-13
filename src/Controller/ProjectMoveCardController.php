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
 * Controller related to the Project. Contains routes for moving
 * a card to a new slot
 */
class ProjectMoveCardController extends AbstractController
{
    /**
     * Route for moving the card to the new slot chosen by user
     */
    #[Route('/proj/move-card/{row<\d+>}/{col<\d+>}', name: "move-card", methods: ['POST'])]
    public function moveCard(
        int $row,
        int $col,
        SessionInterface $session,
        EntityManagerInterface $entityManager,
    ): Response {
        /**
         * @var int $userId
         */
        $userId = $session->get("user");
        $register = new Register($entityManager, $userId);
        try {
            $register->debit(50, 'move-a-card cheat');
        } catch (NotEnoughCoinsException) {
            $this->addFlash('warning', "You do not have enough coins to use this cheat. Purchase more coins in the shop");
            return $this->redirectToRoute('proj-play');
        }
        /**
         * @var Game $game
         */
        $game = $session->get("game");
        $game->moveCard($row, $col);
        $session->set("game", $game);
        // return $this->redirectToRoute('proj-play');
        return $this->redirectToRoute('place-card');
    }

    /**
     * Route that renders the template where placed cards are clickable.
     * If the user does not have enough coins to purchase the cheat the user
     * is redirected back to the main game
     */
    #[Route('/proj/place-card', name: "place-card")]
    public function placeCard(
        SessionInterface $session
    ): Response {
        /**
         * @var Game $game
         */
        $game = $session->get("game") ?? null;
        if ($game == null) {
            return $this->redirectToRoute('proj');
        }
        $state = $game->currentState();
        if ($state['fromSlot'] === []) {
            return $this->redirectToRoute('proj');
        }
        $data = [
            ...$state,
            'url' => ""
        ];

        return $this->render('proj/place-card.html.twig', $data);
    }
}
