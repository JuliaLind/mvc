<?php

namespace App\Repository;

use App\Entity\Score;
use App\Entity\Transaction;
use App\Entity\User;
use App\Project\NotEnoughCoinsException;
use App\Project\Register;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class Register2Test extends KernelTestCase
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

        /**
         * @var UserRepository $userRepository
         */
        $userRepository = $this->entityManager
        ->getRepository(User::class);

        /**
         * @var User $user
         */
        $user= new User();

        $email = 'user@bth.se';
        $acronym = 'User1';
        $password = 'user1';
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $user->setEmail($email);
        $user->setAcronym($acronym);
        $user->setHash($hash);
        $userRepository->save($user, true);
    }

    public function testGetBalanceNotOk(): void
    {
        $register = new Register($this->entityManager, 4);
        $register->transaction(70, 'get some money');
        $register->debit(30, 'spend some money');
        $register->debit(40, 'spend rest of the money');
        $balance = $register->getBalance();
        $this->assertEquals(0, $balance);
    }

    public function testGetBalanceOk(): void
    {
        $register = new Register($this->entityManager, 4);
        $register->transaction(930, 'get some money');
        $balance = $register->getBalance();
        $this->assertEquals(930, $balance);

        $register->debit(60, 'spend some money');
        $balance = $register->getBalance();
        $this->assertEquals(870, $balance);
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
