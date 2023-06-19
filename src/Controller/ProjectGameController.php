<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

use App\Repository\TransactionRepository;
use App\Repository\UserRepository;
use App\Entity\User;
use App\Entity\Transaction;
use Datetime;

use Symfony\Component\HttpFoundation\Request;

use App\Project\Game;

class ProjectGameController extends AbstractController
{
    #[Route("/proj/play", name: "proj-play")]
    public function projPlay(): Response
    {
        $data = [
            'url' => "proj"
        ];
        return $this->render('proj/index.html.twig', $data);
    }

    #[Route("/proj/init", name: "proj-init")]
    public function projInit(
        Request $request,
        SessionInterface $session,
        TransactionRepository $repo,
        Game $game = new Game()
    ): Response {
        /**
         * @var User $user
         */
        $user = $session->get("user");
        /**
         * @var int $bet
         */
        $bet = $request->get("bet");

        if ($bet > $repo->getUserBalance($user)) {
            $this->addFlash('warning', "You do not have enough coins to place the wanted bet. Purchase more coins in the shop");
            return $this->redirectToRoute('proj-shop');
        }
        date_default_timezone_set('Europe/Stockholm');
        $transaction = new Transaction();
        $transaction->setRegistered(new DateTime());
        $transaction->setDescr('Bet');
        $transaction->setAmount(-$bet);
        $transaction->setUserId($user);
        $repo->save($transaction, true);
        $game->setPot($bet);

        $session->set("game", $game);
        return $this->redirectToRoute('proj-play');
    }
}
