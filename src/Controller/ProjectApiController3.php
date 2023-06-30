<?php

namespace App\Controller;

require __DIR__ . "/../../vendor/autoload.php";


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\TransactionRepository;
use App\Entity\User;
use App\Entity\Transaction;
use Datetime;

/**
 * Contains API routes for the project
 */
class ProjectApiController3 extends AbstractController
{
    /**
     * Shows all transactions in database
     */
    #[Route('/proj/api/transactions', name: "api-transactions", methods: ['GET'])]
    public function apiTransactions(
        TransactionRepository $repo,
    ): Response {
        $transactions = $repo->findBy([], ['id' => 'DESC']);
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
            $user = $transaction->getUser();
            $data[] = [
                'id' => $transaction->getId(),
                'user' => $user->getAcronym(),
                'registered' => $registered,
                'descr' => $transaction->getDescr(),
                'amount' => $transaction->getAmount(),
            ];
        }
        return $this->json($data);
    }
}
