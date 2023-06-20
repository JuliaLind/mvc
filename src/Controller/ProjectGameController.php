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

use Symfony\Component\HttpFoundation\Request;

use App\Project\Game;
use App\ProjectGrid\Grid;

class ProjectGameController extends AbstractController
{
    #[Route("/proj/play", name: "proj-play")]
    public function projPlay(
        SessionInterface $session,
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
            'url' => "proj",
        ];
        if ($state['finished'] === true) {
            return $this->render('proj/results.html.twig', $data);
        }
        return $this->render('proj/game.html.twig', $data);
    }

    #[Route("/proj/init", name: "proj-init")]
    public function projInit(
        Request $request,
        SessionInterface $session,
        EntityManagerInterface $entityManager,
    ): Response {
        /**
         * @var User $user
         */
        $user = $session->get("user");
        // apparently neccessary to get the same object again from database in order
        // for Doctrine not to mistake it to be a new one
        /**
         * @var User $user
         */
        $user = $entityManager->getRepository(User::class)->find($user->getId());

        /**
         * @var int $bet
         */
        $bet = $request->get("bet");
        /**
         * @var TransactionRepository $repo
         */
        $repo = $entityManager->getRepository(Transaction::class);
        $balance = $repo->getUserBalance($user);

        if ($bet > $balance) {
            $this->addFlash('warning', "You do not have enough coins to place the wanted bet. Purchase more coins in the shop");
            return $this->redirectToRoute('proj-shop');
        }
        date_default_timezone_set('Europe/Stockholm');
        $transaction = new Transaction();
        $transaction->setRegistered(new DateTime());
        $transaction->setDescr('Bet');
        $transaction->setAmount(-$bet);
        $transaction->setUserId($user);
        $entityManager->persist($transaction);
        $entityManager->flush();

        // $game = new Game();
        $game = new Game([
            'house' => new Grid(),
            'player' => new Grid()
        ]);
        $game->setPot($bet);

        $session->set("game", $game);
        return $this->redirectToRoute('proj-play');
    }

    #[Route('/proj/one-round/{row<\d+>}/{col<\d+>}', name: "proj-round", methods: ['POST'])]
    public function projRound(
        int $row,
        int $col,
        SessionInterface $session,
        EntityManagerInterface $entityManager
    ): Response {
        /**
         * @var Game $game
         */
        $game = $session->get("game");
        $finished = $game->oneRound($row, $col);
        if ($finished === true) {
            $wonAmount = $game->evaluate();
            if ($wonAmount > 0) {
                /**
                 * @var User $user
                 */
                $user = $session->get("user");
                // apparently neccessary to get the same object again from database in order
                // for Doctrine not to mistake it to be a new one
                /**
                 * @var User $user
                 */
                $user = $entityManager->getRepository(User::class)->find($user->getId());
                date_default_timezone_set('Europe/Stockholm');
                $transaction = new Transaction();
                $transaction->setRegistered(new DateTime());
                $transaction->setDescr('return (bet + profit)');
                $transaction->setAmount($wonAmount);
                $transaction->setUserId($user);
                $entityManager->persist($transaction);
                $entityManager->flush();
            }
        }
        $session->set("game", $game);
        return $this->redirectToRoute('proj-play');
    }
}
