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
use App\Project\RegisterFactory;
use Datetime;

class ProjectApiController2 extends AbstractController
{
    /**
     * Shows data for specific user, combined from all three tables - user, transaction, score
     */
    #[Route('/proj/api/user/{email}', name: "api-user", methods: ['GET'])]
    public function apiUser(
        EntityManagerInterface $entityManager,
        string $email,
        RegisterFactory $factory = new RegisterFactory()
    ): Response {
        /**
         * @var User $user
         */
        $user = $entityManager->getRepository(User::class)->findOneBy(['email' => $email]);
        /**
         * @var int $userId
         */
        $userId = $user->getId();
        $register = $factory->create($entityManager, $userId);
        $balance = $register->getBalance();
        $data = [
            'id' => $userId,
            'acronym' => $user->getAcronym(),
            'email' => $user->getEmail(),
            'hash' => $user->getHash(),
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
