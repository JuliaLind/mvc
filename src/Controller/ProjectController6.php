<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use App\Project\RegisterFactory;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;

class ProjectController6 extends AbstractController
{
    #[Route("/proj/purchase/{coins<\d+>}", name: "purchase", methods: ['POST'])]
    public function projPurchase(
        int $coins,
        EntityManagerInterface $entityManager,
        SessionInterface $session,
        RegisterFactory $factory = new RegisterFactory()
    ): Response {
        /**
         * @var int $userId
         */
        $userId = $session->get("user") ?? null;
        $register = $factory->create($entityManager, $userId);
        $register->transaction($coins, 'Purchase');
        $balance = $register->getBalance();
        $this->addFlash('notice', "You have successfully purchsed {$coins} coins. Your new balance is {$balance} coins");
        return $this->redirectToRoute('shop');
    }

    #[Route("/proj/select-amount", name: "select-amount")]
    public function selectAmount(
        SessionInterface $session,
        EntityManagerInterface $entityManager,
        RegisterFactory $factory = new RegisterFactory()
    ): Response {
        /**
         * @var int $userId
         */
        $userId = $session->get("user");

        $register = $factory->create($entityManager, $userId);
        $balance = $register->getBalance();

        if ($balance < 10) {
            $this->addFlash('warning', "You do not have enough coins, the minimum amount to bet is 10 coins. Purchase more coins in the shop");
            return $this->redirectToRoute('proj-shop');
        }
        $data = [
            'url' => "proj",
            'balance' => $balance,
        ];
        return $this->render('proj/select-amount.html.twig', $data);
    }
}
