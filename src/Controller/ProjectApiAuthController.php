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
use App\Project\Register;

use Datetime;

class ProjectApiAuthController extends AbstractController
{
    #[Route('/proj/api/user/{email}', name: "api-user", methods: ['GET'])]
    public function apiUser(
        UserRepository $userRepo,
        EntityManagerInterface $entityManager,
        string $email,
        JsonConverter $converter = new JsonConverter()
    ): Response {
        /**
         * @var User $user
         */
        $user = $userRepo->findOneBy(['email' => $email]);
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
             * @var User $user
             */
            $user = $transaction->getUserId();
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
                    'user-id' => $user->getId(),
                    'registered' => $registered,
                    'descr' => $descr,
                    'amount' => $amount
                ]
            );
        }
        foreach($scores as $score) {
            $scoreId = $score->getId();
            /**
             * @var User $user
             */
            $user = $score->getUserId();
            /**
             * @var DateTime $registered
             */
            $registered = $score->getRegistered();
            $registered = $registered->format('Y-m-d');
            $points = $score->getPoints();

            array_push(
                $data['transactions'],
                [
                    'id' => $scoreId,
                    'player' => $user->getAcronym(),
                    'registered' => $registered,
                    'score' => $points,
                ]
            );
        }
        $response = $converter->convert(new JsonResponse($data));
        return $response;
    }


    // #[Route('/project/api/register', name: "api-register", methods: ['POST'])]
    // public function apiRegister(
    //     Request $request,
    //     JsonConverter $converter = new JsonConverter()
    // ): Response {
    //     $username = $request->get('username');
    //     $password = $request->get('password');
    //     $hash = password_hash($password, PASSWORD_DEFAULT);
    //     $data = [
    //         'username' => $username,
    //         'password' => $password,
    //         'hash' => $hash,
    //         'password verify' => password_verify($password, $hash)
    //     ];
    //     $response = $converter->convert(new JsonResponse($data));
    //     return $response;
    // }
}
