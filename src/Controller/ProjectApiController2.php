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
 * Contains API routes for the project
 */
class ProjectApiController2 extends AbstractController
{
    /**
     * Shows data for specific user, combined from all three tables - user, transaction, score
     */
    #[Route('/proj/api/user/{email}', name: "api-user", methods: ['GET'])]
    public function apiUser(
        EntityManagerInterface $entityManager,
        string $email,
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
            'id' => $userId,
            'acronym' => $user->getAcronym(),
            'email' => $user->getEmail(),
            'hash' => $user->getHash(),
            'balance' => $balance,
            'transactions' => [],
            'scores' => []
        ];

        $transactions = $user->getTransactions()->toArray();
        $scores = $user->getScores()->toArray();
        foreach($transactions as $transaction) {
            $transId = $transaction->getId();
            /**
             * @var DateTime $registered
             */
            $registered = $transaction->getRegistered();
            $registered = $registered->format('Y-m-d');
            $descr = $transaction->getDescr();
            $amount = $transaction->getAmount();

            array_push(
                $data['transactions'],
                [
                    'id' => $transId,
                    'registered' => $registered,
                    'descr' => $descr,
                    'amount' => $amount
                ]
            );
        }
        foreach($scores as $score) {
            /**
             * @var DateTime $registered
             */
            $registered = $score->getRegistered();
            $registered = $registered->format('Y-m-d');
            $points = $score->getPoints();

            array_push(
                $data['scores'],
                [
                    'registered' => $registered,
                    'score' => $points,
                ]
            );
        }
        return $this->json($data);
    }
}
