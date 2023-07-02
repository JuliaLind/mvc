<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";

use App\Entity\User;
use App\Project\RegisterFactory;
use App\Repository\TransactionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controller related to the Project. Contains routes
 * for the shop-page and for the page that displays all
 * transactions for a signle user
 */
class ProjectController10 extends AbstractController
{
    /**
     * Leaders to the shop-page where user can purchase coins
     */
    #[Route("/proj/shop", name: "shop")]
    public function projShop(
        SessionInterface $session,
        EntityManagerInterface $entityManager,
        RegisterFactory $factory = new RegisterFactory()
    ): Response {
        /**
         * @var int $userId
         */
        $userId = $session->get("user") ?? null;
        if($userId == null) {
            return $this->redirectToRoute('proj');
        }
        $register = $factory->create($entityManager, $userId);
        $data = [
            'url' => "",
            'balance' => $register->getBalance()
        ];
        return $this->render('proj/shop.html.twig', $data);
    }

    /**
     * Route that leades to page where all user's transactions are displayed
     */
    #[Route("/proj/transactions", name: "proj-trans")]
    public function projTrans(
        SessionInterface $session,
        TransactionRepository $repo,
        EntityManagerInterface $entityManager,
        RegisterFactory $factory = new RegisterFactory()
    ): Response {
        /**
         * @var int $userId
         */
        $userId = $session->get("user");
        /**
         * @var User $user
         */
        $user = $entityManager->getRepository(User::class)->find($userId);
        $register = $factory->create($entityManager, $userId);
        $data = [
            'url' => "",
            'transactions' => $repo->findBy(
                ['user' => $user],
                ['id' => 'DESC']
            ),
            'balance' => $register->getBalance()
        ];
        return $this->render('proj/transactions.html.twig', $data);
    }
}
