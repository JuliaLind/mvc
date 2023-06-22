<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\User;
use App\Repository\TransactionRepository;
use App\Project\Game;
use App\Project\Register;

/**
 * The main controller class
 */
class ProjectController1 extends AbstractController
{
    #[Route("/proj", name: "proj")]
    public function projLanding(
        SessionInterface $session,
        EntityManagerInterface $entityManager,
    ): Response {
        /**
         * @var int $userId
         */
        $userId = $session->get("user") ?? null;
        $data = [
            'url' => "proj",
        ];
        if($userId == null) {
            return $this->render('proj/index.html.twig', $data);
        }
        /**
         * @var User $user
         */
        $user = $entityManager->getRepository(User::class)->find($userId);
        /**
         * @var Game|null $game
         */
        $game = $session->get("game") ?? null;

        $register = new Register($entityManager, $userId);

        $data = [
            ...$data,
            'user' => $user,
            'finished' => true,
            'balance' => $register->getBalance()
        ];
        if ($game) {
            $data['finished'] = $game->currentState()['finished'];
        }
        return $this->render('proj/profile.html.twig', $data);
    }

    #[Route("/proj/shop", name: "shop")]
    public function projShop(
        SessionInterface $session
    ): Response {
        /**
         * @var int $userId
         */
        $userId = $session->get("user") ?? null;
        if($userId == null) {
            return $this->redirectToRoute('proj');
        }
        $data = [
            'url' => "proj"
        ];
        return $this->render('proj/shop.html.twig', $data);
    }

    #[Route("/proj/transactions", name: "proj-trans")]
    public function projTrans(
        SessionInterface $session,
        TransactionRepository $repo,
        EntityManagerInterface $entityManager,
    ): Response {
        /**
         * @var int $userId
         */
        $userId = $session->get("user");
        /**
         * @var User $user
         */
        $user = $entityManager->getRepository(User::class)->find($userId);
        $data = [
            'url' => "",
            'transactions' => $repo->findBy(
                ['userid' => $user],
                ['id' => 'DESC']
            )
        ];
        return $this->render('proj/transactions.html.twig', $data);
    }
}
