<?php

namespace App\Repository;

use App\Entity\Score;
use App\Entity\Transaction;
use App\Entity\User;
use App\Project\NotEnoughCoinsException;
use App\Project\Register;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class RegisterTest extends KernelTestCase
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

    public function testTransaction(): void
    {
        $register = new Register($this->entityManager, 2);
        $register->transaction(123456789, 'test-transaction');

        /**
         * @var Transaction $transaction
         */
        $transaction = $this->entityManager->getRepository(Transaction::class)->find(12);
        $this->assertEquals('test-transaction', $transaction->getDescr());
        $this->assertEquals(123456789, $transaction->getAmount());
        /**
        * @var User $user
        */
        $user = $this->entityManager
        ->getRepository(User::class)->find(2);
        $this->assertSame($user, $transaction->getUser());
    }

    public function testDebitOk(): void
    {
        $register = new Register($this->entityManager, 3);
        $register->debit(10, 'test-debit');

        /**
         * @var Transaction $transaction
         */
        $transaction = $this->entityManager->getRepository(Transaction::class)->find(12);
        $this->assertEquals('test-debit', $transaction->getDescr());
        $this->assertEquals(-10, $transaction->getAmount());
        /**
        * @var User $user
        */
        $user = $this->entityManager
        ->getRepository(User::class)->find(3);
        $this->assertSame($user, $transaction->getUser());
    }

    public function testDebitNotOk(): void
    {
        $register = new Register($this->entityManager, 3);
        $this->expectException(NotEnoughCoinsException::class);
        $register->debit(1001, 'test-debit');
    }

    public function testScore(): void
    {
        $register = new Register($this->entityManager, 2);
        $register->score(123456789);

        /**
         * @var Score $score
         */
        $score = $this->entityManager->getRepository(Score::class)->find(5);
        $this->assertEquals(123456789, $score->getPoints());
        /**
        * @var User $user
        */
        $user = $this->entityManager
        ->getRepository(User::class)->find(2);
        $this->assertSame($user, $score->getUser());
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
