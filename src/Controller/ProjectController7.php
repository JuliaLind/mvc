<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

use Doctrine\ORM\EntityManagerInterface;

use App\Repository\TransactionRepository;
use App\Repository\UserRepository;
use App\Entity\User;
use App\Entity\Transaction;
use Datetime;
use App\Project\NotEnoughCoinsException;
use App\Project\Register;

use Symfony\Component\HttpFoundation\Request;

use App\Project\Game;
use App\ProjectGrid\Grid;

class ProjectController7 extends AbstractController
{
    #[Route('/proj/undo', name: "undo", methods: ['POST'])]
    public function undo(
        SessionInterface $session,
        EntityManagerInterface $entityManager
    ): Response {
        /**
         * @var int $userId
         */
        $userId = $session->get("user");

        $register = new Register($entityManager, $userId);
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

    #[Route('/proj/purchase-suggestion', name: "purchase-suggestion", methods: ['POST'])]
    public function showSuggestion(
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
            return $this->redirectToRoute('proj-play');
        } catch (NotEnoughCoinsException) {
            $this->addFlash('warning', "You do not have enough coins to use this cheat. Purchase more coins in the shop");
            return $this->redirectToRoute('proj-play');
        }
    }

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

    #[Route('/proj/purchase-peek-cheat', name: "purchase-peek", methods: ['POST'])]
    public function purchasePeekCheat(
        SessionInterface $session,
        EntityManagerInterface $entityManager
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
}
