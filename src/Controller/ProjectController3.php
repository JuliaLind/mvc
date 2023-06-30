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

class ProjectController3 extends AbstractController
{
    #[Route("/proj/init", name: "proj-init")]
    public function projInit(
        Request $request,
        SessionInterface $session,
        EntityManagerInterface $entityManager,
        RegisterFactory $factory = new RegisterFactory()
    ): Response {
        /**
         * @var int $userId
         */
        $userId = $session->get("user");
        /**
         * @var int $bet
         */
        $bet = $request->get("bet");

        $register = $factory->create($entityManager, $userId);

        try {
            $register->debit($bet, 'Bet');
        } catch (NotEnoughCoinsException) {
            $this->addFlash('warning', "You do not have enough coins to place the wanted bet. Purchase more coins in the shop");
            return $this->redirectToRoute('proj-shop');
        }

        $game = new Game([
            'house' => new Grid(),
            'player' => new Grid()
        ]);
        $game->setPot($bet);

        $session->set("game", $game);
        $session->set("show-suggestion", false);
        $session->set("deck-peek", false);
        return $this->redirectToRoute('proj-play');
    }

    #[Route('/proj/one-round/{row<\d+>}/{col<\d+>}', name: "proj-round", methods: ['POST'])]
    public function projRound(
        int $row,
        int $col,
        SessionInterface $session,
        EntityManagerInterface $entityManager
    ): Response {
        $session->set("show-suggestion", false);
        /**
         * @var Game $game
         */
        $game = $session->get("game");
        $finished = $game->oneRound($row, $col);
        if ($finished === true) {
            /**
             * @var int $userId
             */
            $userId = $session->get("user");
            $game->evaluate($entityManager, $userId);
        }
        $session->set("game", $game);
        return $this->redirectToRoute('proj-play');
    }

    #[Route('/proj/unset-suggestion', name: "proj-unset-suggest", methods: ['GET'])]
    public function projUnsetSuggest(
        SessionInterface $session,
    ): Response {
        $session->set("show-suggestion", false);
        return $this->redirectToRoute('proj-play');
    }

    #[Route("/proj/play", name: "proj-play")]
    public function projPlay(
        SessionInterface $session,
        EntityManagerInterface $entityManager,
        RegisterFactory $factory = new RegisterFactory()
    ): Response {
        /**
         * @var Game $game
         */
        $game = $session->get("game") ?? null;
        if ($game == null) {
            return $this->redirectToRoute('proj');
        }
        $state = $game->currentState();
        $data = [
            ...$state,
            'url' => "",
        ];

        if ($state['finished'] === true) {
            $this->addFlash('notice', $data['message']);
            return $this->render('proj/results.html.twig', $data);
        }

        if (count($state['fromSlot']) > 0) {
            $this->addFlash('notice', "Click on an empty slot to which you want to move the selected card");
            return $this->render('proj/place-card.html.twig', $data);
        }

        if ($session->get("show-suggestion")) {
            /**
             * @var array<string,mixed> $suggestion
             */
            $suggestion = $data['suggestion'];
            /**
             * @var string $message
             */
            $message = $suggestion['message'];
            $this->addFlash('notice', $message);
            return $this->render('proj/game-display-suggest.html.twig', $data);
        }
        /**
         * @var int $userId
         */
        $userId = $session->get("user");
        $register = $factory->create($entityManager, $userId);
        $data['balance'] = $register->getBalance();
        return $this->render('proj/game.html.twig', $data);
    }
}
