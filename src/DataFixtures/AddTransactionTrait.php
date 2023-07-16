<?php

namespace App\DataFixtures;

require __DIR__ . "/../../vendor/autoload.php";

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Transaction;
use Datetime;

/**
 * Trait used by AppFixtures class, from kmom10/project
 */
trait AddTransactionTrait
{
    /**
     * Adds a transaction to the test database
     */
    private function addTransaction(
        ObjectManager $manager,
        User $user,
        string $date,
        string $descr,
        int $amount
    ): void {
        $transaction = new Transaction();
        $transaction->setRegistered(new DateTime($date));
        $transaction->setDescr($descr);
        $transaction->setAmount($amount);
        $transaction->setUser($user);
        $manager->persist($transaction);
    }
}
