<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use App\Entity\Transaction;
use App\Entity\Score;
use App\Project\Register;
use Datetime;

/**
 * Controller class related to the Project. Contains API route
 * for displaying data for a single user
 */
class ProjectApiController2 extends AbstractController
{
    /**
     * Shows data for specific user, combined from all three tables - user, transaction, score
     */
    #[Route('/proj/api/user/{email}', name: "api-user", methods: ['GET'])]
    public function apiUser(
        EntityManagerInterface $entityManager,
        string $email
    ): Response {
        /**
         * @var User $user
         */
        $user = $entityManager->getRepository(User::class)->findOneBy(['email' => $email]);
        /**
         * @var int $userId
         */
        $userId = $user->getId();

        $register = new Register($entityManager, $userId);
        $balance = $register->getBalance();
        $data = [
            'user' => $user,
            'balance' => $balance,
            'transactions' => $entityManager->getRepository(Transaction::class)->findBy(
                ['user' => $user],
                ['id' => 'DESC']
            ),
            'scores' => $entityManager->getRepository(Score::class)->findBy(
                ['user' => $user],
            )
        ];
        return $this->json($data);
    }
}
