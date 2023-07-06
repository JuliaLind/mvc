<?php

namespace App\Project;

require __DIR__ . "/../../vendor/autoload.php";

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Transaction;
use App\Entity\User;
use Datetime;
use App\Repository\TransactionRepository;
use App\Entity\Score;

/**
 * Registers user score and transactions.
 * Gets users balance (sum of transactions)
 */
class Register
{
    private EntityManagerInterface $manager;
    private User $user;

    public function __construct(
        EntityManagerInterface $manager,
        int $userId
    ) {
        $this->manager = $manager;
        /**
         * @var User $user;
         */
        $user = $manager->getRepository(User::class)->find($userId);
        $this->user = $user;
    }

    /**
     * Registers a transaction,
     * the amount is registered in database as is,
     * i.e. positive is registered as positive and negative and negative.
     * Use directly only for positive numbers!
     * For negative numbers use debit() method instead!
     */
    public function transaction(
        int $coins,
        string $text
    ): void {
        $transaction = new Transaction();
        date_default_timezone_set('Europe/Stockholm');
        $transaction->setRegistered(new DateTime());
        $transaction->setDescr($text);
        $transaction->setAmount($coins);

        $transaction->setUser($this->user);
        $this->manager->persist($transaction);
        $this->manager->flush();
    }

    /**
     * Get user's balance (sum of all user's transactions)
     */
    public function getBalance(): int
    {
        /**
         * @var TransactionRepository $repo
         */
        $repo = $this->manager->getRepository(Transaction::class);
        $balance = 0;
        $transactions = $repo->findBy(['user' => $this->user]);
        foreach($transactions as $transaction) {
            $balance += $transaction->getAmount();
        }
        return $balance;
    }

    /**
     * Registers a negative transaction.
     * Note! amount number should be a positive number
     * and represent the amount to be debited.
     * Checks users balance before registering transaction
     * to ensure there are enough coins to cover for the debit
     */
    public function debit(
        int $amount,
        string $text
    ): void {
        $balance = $this->getBalance();
        if ($amount > $balance) {
            throw new NotEnoughCoinsException();
        }
        $this->transaction(-$amount, $text);
    }

    /**
     * Registers a score for the user
     */
    public function score(
        int $points
    ): void {
        $score = new Score();
        date_default_timezone_set('Europe/Stockholm');
        $score->setRegistered(new DateTime());
        $score->setPoints($points);
        $score->setUser($this->user);
        $this->manager->persist($score);
        $this->manager->flush();
    }
}
