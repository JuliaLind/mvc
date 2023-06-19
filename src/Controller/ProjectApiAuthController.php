<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";


use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// use Symfony\Component\HttpFoundation\Request;
// use Symfony\Component\HttpFoundation\Session\SessionInterface;

use App\Helpers\JsonConverter;

// use App\Project\ApiGame;
// use App\Project\ApiNew;
// use App\Project\ApiResults;

use App\Repository\UserRepository;
use App\Repository\TransactionRepository;
use App\Entity\User;

use Datetime;

class ProjectApiAuthController extends AbstractController
{
    #[Route('/proj/api/user/{email}', name: "api-user", methods: ['GET'])]
    public function apiUser(
        UserRepository $userRepo,
        TransactionRepository $transRepo,
        string $email,
        JsonConverter $converter = new JsonConverter()
    ): Response {
        /**
         * @var User $user
         */
        $user = $userRepo->findOneBy(['email' => $email]);
        $data = [
            'id' => $user->getId(),
            'acronym' => $user->getAcronym(),
            'email' => $user->getEmail(),
            'hash' => $user->getHash(),
            'balance' => $transRepo->getUserBalance($user),
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
