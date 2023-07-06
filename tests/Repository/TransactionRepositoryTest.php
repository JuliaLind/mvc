<?php

namespace App\Repository;

use App\Entity\Transaction;
use App\Entity\User;
use Datetime;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class TransactionRepositoryTest extends KernelTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        /** @phpstan-ignore-next-line */
        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testSave(): void
    {
        /**
         * @var User $user
         */
        $user = $this->entityManager
        ->getRepository(User::class)->find(1);

        $transaction = new Transaction();
        $transaction->setUser($user);
        $date = new DateTime('2023-07-06');
        $transaction->setRegistered($date);
        $transaction->setAmount(123456789);
        $transaction->setDescr("test-transaction");
        /**
         * @var TransactionRepository $repo
         */
        $repo = $this->entityManager->getRepository(Transaction::class);
        $repo->save($transaction, true);

        /**
         * @var Transaction $transaction
         */
        $transaction = $repo->findOneBy(["amount" => 123456789]);

        $this->assertSame($user, $transaction->getUser());
        $this->assertSame(12, $transaction->getId());
        $this->assertSame("test-transaction", $transaction->getDescr());
    }

    public function testRemove(): void
    {

        /**
         * @var TransactionRepository $repo
         */
        $repo = $this->entityManager->getRepository(Transaction::class);
        /**
         * @var Transaction $transaction
         */
        $transaction = $repo->find(6);
        $this->assertEquals(-420, $transaction->getAmount());
        /**
         * @var User $user
         */
        $user = $transaction->getUser();
        $this->assertEquals(1, $user->getId());

        $repo->remove($transaction, true);

        $res = $repo->find(6);
        $this->assertNull($res);
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        // doing this is recommended to avoid memory leaks
        $this->entityManager->close();
        /** @phpstan-ignore-next-line */
        $this->entityManager = null;
    }
}
