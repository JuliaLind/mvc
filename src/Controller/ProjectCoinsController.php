<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use App\Project\Register;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;

/**
 * Controller related to the Project. Contains route
 * for allocating purchased coins to used and route
 * that leads to the page where user selects amount to bet
 */
class ProjectCoinsController extends AbstractController
{
    /**
     * Allocates the purchased amount of coins to user by adding
     * a new transaction to the database
     */
    #[Route("/proj/purchase/{coins<\d+>}", name: "purchase", methods: ['POST'])]
    public function projPurchase(
        int $coins,
        EntityManagerInterface $entityManager,
        SessionInterface $session,
    ): Response {
        /**
         * @var int $userId
         */
        $userId = $session->get("user");
        $register = new Register($entityManager, $userId);

        $register->transaction($coins, 'Purchase');
        $balance = $register->getBalance();
        $this->addFlash('notice', "You have successfully purchased {$coins} coins. Your new balance is {$balance} coins");
        return $this->redirectToRoute('shop');
    }

    /**
     * Leads to the page where user can select amount to bet.
     * If the user has less than 10 coins (minium amount to bet)
     * then the user is re-directed to the Shop
     */
    #[Route("/proj/select-amount", name: "select-amount")]
    public function selectAmount(
        SessionInterface $session,
        EntityManagerInterface $entityManager,
    ): Response {
        /**
         * @var int $userId
         */
        $userId = $session->get("user") ?? null;
        if($userId == null) {
            return $this->redirectToRoute('proj');
        }
        $register = new Register($entityManager, $userId);
        $balance = $register->getBalance();

        if ($balance < 10) {
            $this->addFlash('warning', "You do not have enough coins, the minimum amount to bet is 10 coins. Purchase more coins in the shop");
            return $this->redirectToRoute('shop');
        }
        $data = [
            'url' => "proj",
            'balance' => $balance,
        ];
        return $this->render('proj/select-amount.html.twig', $data);
    }
}
