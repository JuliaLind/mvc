<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";


use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


use App\Helpers\JsonConverter;

use App\Repository\UserRepository;
use App\Repository\TransactionRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use App\Entity\Transaction;
use App\Entity\Score;
use App\Project\Register;

use Datetime;

class ProjectApiAuthController extends AbstractController
{
    #[Route('/proj/api/user/{email}', name: "api-user", methods: ['GET'])]
    public function apiUser(
        // UserRepository $userRepo,
        EntityManagerInterface $entityManager,
        string $email,
        JsonConverter $converter = new JsonConverter()
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
            // /**
            //  * @var User $user
            //  */
            // $user = $transaction->getUserId();
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
                    // 'user-id' => $user->getId(),
                    'registered' => $registered,
                    'descr' => $descr,
                    'amount' => $amount
                ]
            );
        }
        foreach($scores as $score) {
            // $scoreId = $score->getId();
            // /**
            //  * @var User $user
            //  */
            // $user = $score->getUserId();
            /**
             * @var DateTime $registered
             */
            $registered = $score->getRegistered();
            $registered = $registered->format('Y-m-d');
            $points = $score->getPoints();

            array_push(
                $data['transactions'],
                [
                    // 'id' => $scoreId,
                    // 'player' => $user->getAcronym(),
                    'registered' => $registered,
                    'score' => $points,
                ]
            );
        }
        $response = $converter->convert(new JsonResponse($data));
        return $response;
    }

    #[Route('/proj/api/users', name: "api-users", methods: ['GET'])]
    public function apiUsers(
        EntityManagerInterface $entityManager,
        JsonConverter $converter = new JsonConverter()
    ): Response {
        $users = $entityManager->getRepository(User::class)->findAll();
        $data = [];
        foreach($users as $user) {
            /**
             * @var int $userId
             */
            $userId = $user->getId();
            $register = new Register($entityManager, $userId);
            $balance = $register->getBalance();
            $info = [
                'id' => $userId,
                'acronym' => $user->getAcronym(),
                'email' => $user->getEmail(),
                'hash' => $user->getHash(),
                'balance' => $balance
            ];
            $data[] = $info;
        }
        $response = $converter->convert(new JsonResponse($data));
        return $response;
    }

    #[Route('/proj/api/transactions', name: "api-transactions", methods: ['GET'])]
    public function apiTransactions(
        EntityManagerInterface $entityManager,
        JsonConverter $converter = new JsonConverter()
    ): Response {
        // $transactions = $entityManager->getRepository(Transaction::class)->findAll();
        $transactions = $entityManager->getRepository(Transaction::class)->findBy([], ['id' => 'DESC']);
        $data = [];
        foreach($transactions as $transaction) {
            /**
             * @var DateTime $registered
             */
            $registered = $transaction->getRegistered();
            $registered = $registered->format('Y-m-d');
            /**
             * @var User $user
             */
            $user = $transaction->getUserid();
            $data[] = [
                'id' => $transaction->getId(),
                'user' => $user->getAcronym(),
                'registered' => $registered,
                'descr' => $transaction->getDescr(),
                'amount' => $transaction->getAmount(),
            ];
        }
        $response = $converter->convert(new JsonResponse($data));
        return $response;
    }

    #[Route('/proj/api/leaderboard', name: "api-leaderboard", methods: ['GET'])]
    public function apiLeaderboard(
        EntityManagerInterface $entityManager,
        JsonConverter $converter = new JsonConverter()
    ): Response {
        // $scores = $entityManager->getRepository(Score::class)->findAll();
        $scores = $entityManager->getRepository(Score::class)->findBy([], ['points' => 'DESC'], 10);
        $data = [];

        foreach($scores as $score) {
            /**
             * @var User $user
             */
            $user = $score->getUserid();
            /**
             * @var DateTime $registered
             */
            $registered = $score->getRegistered();
            $registered = $registered->format('Y-m-d');
            $data[] = [
                'user' => $user->getAcronym(),
                'registered' => $registered,
                'points' => $score->getPoints(),
            ];
        }
        $response = $converter->convert(new JsonResponse($data));
        return $response;
    }
}
