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
use App\Project\RegisterFactory;
use Symfony\Component\HttpFoundation\Request;
use App\Project\Game;
use App\ProjectGrid\Grid;

/**
 * Controller related to the Project. Containts routes for
 * purchasing some of the user-cheats
 */
class ProjectController7 extends AbstractController
{
    /**
     * Route for purchasing the cheat for undoing the last move
     */
    #[Route('/proj/undo', name: "undo", methods: ['POST'])]
    public function undo(
        SessionInterface $session,
        EntityManagerInterface $entityManager,
        RegisterFactory $factory = new RegisterFactory()
    ): Response {
        /**
         * @var int $userId
         */
        $userId = $session->get("user");

        $register = $factory->create($entityManager, $userId);
        try {
            $register->debit(10, 'undo last move cheat');
        } catch (NotEnoughCoinsException) {
            $this->addFlash('warning', "You do not have enough coins to use this cheat. Purchase more coins in the shop");
            return $this->redirectToRoute('proj-play');
        }

        /**
         * @var Game $game
         */
        $game = $session->get("game");
        $game->undoLastRound();
        $session->set("game", $game);
        return $this->redirectToRoute('proj-play');
    }

    /**
     * Route for purchasing a calculated suggestion on slot and also seing which
     * rules are possible to achive if placing card in particular slot and also which
     * rules are possible if the card is not placed in particular slot (for all hands)
     */
    #[Route('/proj/purchase-suggestion', name: "purchase-suggestion", methods: ['POST'])]
    public function showSuggestion(
        SessionInterface $session,
        EntityManagerInterface $entityManager,
        RegisterFactory $factory = new RegisterFactory()
    ): Response {
        /**
         * @var int $userId
         */
        $userId = $session->get("user");
        $register = $factory->create($entityManager, $userId);
        try {
            $register->debit(30, 'show-suggestion cheat');
            $session->set("show-suggestion", true);
            return $this->redirectToRoute('proj-play');
        } catch (NotEnoughCoinsException) {
            $this->addFlash('warning', "You do not have enough coins to use this cheat. Purchase more coins in the shop");
            return $this->redirectToRoute('proj-play');
        }
    }
}
