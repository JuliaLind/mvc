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

class ProjectApiController3 extends AbstractController
{
    #[Route('/proj/api/transactions', name: "api-transactions", methods: ['GET'])]
    public function apiTransactions(
        EntityManagerInterface $entityManager,
        JsonConverter $converter = new JsonConverter()
    ): Response {
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