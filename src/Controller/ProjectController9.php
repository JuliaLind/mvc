<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";

use App\Project\Game;
use App\ProjectGrid\Grid;
use App\Project\NotEnoughCoinsException;
use App\Project\RegisterFactory;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controller related to the Project. Contains route for initating a new PokerSquare game
 * and saving the bet
 */
class ProjectController9 extends AbstractController
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
}
