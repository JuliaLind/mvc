<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";

use App\Project\Game;
use App\ProjectGrid\Grid;
use App\Project\Register;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Controller related to the Project. Contains the main route
 * for the PokerSquare game.
 */
class ProjectController11 extends AbstractController
{
    /**
     * The main route for the PokerSquare game. The route renders different
     * templates depending on the game's state
     */
    #[Route("/proj/play", name: "proj-play")]
    public function projPlay(
        SessionInterface $session,
        EntityManagerInterface $entityManager,
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

        /**
         * When the move-card cheat is purchased, redirects to route
         * where user clicks on the card they want to move
         */
        if (count($state['fromSlot']) > 0) {
            $this->addFlash('notice', "Click on an empty slot to which you want to move the selected card");
            return $this->render('proj/place-card.html.twig', $data);
        }

        /**
         * @var int $userId
         */
        $userId = $session->get("user");
        $register = new Register($entityManager, $userId);
        $data['balance'] = $register->getBalance();
        return $this->render('proj/game.html.twig', $data);
    }
}
