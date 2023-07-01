<?php

namespace App\DataFixtures;

use PHPUnit\Framework\TestCase;
use App\Entity\User;
use App\Entity\Transaction;
use Datetime;
use Doctrine\Persistence\ObjectManager;

class AddTransactionTraitTest extends TestCase
{
    use AddTransactionTrait;

    public function testAddUser(): void
    {
        $manager = $this->createMock(ObjectManager::class);
        $manager->expects($this->once())->method('persist')->with($this->isInstanceOf(Transaction::class));

        $user = $this->createMock(User::class);
        $this->addTransaction($manager, $user, '2023-06-25', 'Free registration bonus', 1000);
    }

}
