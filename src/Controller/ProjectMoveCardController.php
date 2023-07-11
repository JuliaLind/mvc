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
 * a card
 */
class ProjectMoveCardController extends AbstractController
{
    /**
     * Route for saving the slot row and id from which the user wants to remove the card
     */
    #[Route('/proj/set-fromslot/{row<\d+>}/{col<\d+>}', name: "set-fromslot", methods: ['POST'])]
    public function setFromSlot(
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
        $game->setFromSlot($row, $col);
        $session->set("game", $game);
        return $this->redirectToRoute('proj-play');
    }


    /**
     * Route for moving the card to the new slot chosen by user
     */
    #[Route('/proj/move-card/{row<\d+>}/{col<\d+>}', name: "move-card", methods: ['POST'])]
    public function moveCard(
        int $row,
        int $col,
        SessionInterface $session
    ): Response {
        /**
         * @var Game $game
         */
        $game = $session->get("game");
        $game->moveCard($row, $col);
        $session->set("game", $game);
        return $this->redirectToRoute('proj-play');
    }

    /**
     * Route that renders the template where placed cards are clickable.
     * If the user does not have enough coins to purchase the cheat the user
     * is redirected back to the main game
     */
    #[Route('/proj/pick-card/{balance<\d+>}', name: "pick-card")]
    public function pickCard(
        SessionInterface $session,
        int $balance
    ): Response {
        /**
         * @var Game $game
         */
        $game = $session->get("game") ?? null;
        if ($game == null) {
            return $this->redirectToRoute('proj');
        }
        if ($balance < 50) {
            $this->addFlash('warning', "You do not have enough coins to use this cheat. Purchase more coins in the shop");
            return $this->redirectToRoute('proj-play');
        }
        $state = $game->currentState();
        $data = [
            ...$state,
            'url' => ""
        ];

        return $this->render('proj/pick-card.html.twig', $data);
    }
}
