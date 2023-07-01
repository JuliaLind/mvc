<?php

namespace App\DataFixtures;

use PHPUnit\Framework\TestCase;
use App\Entity\User;
use App\Entity\Score;
use Datetime;
use Doctrine\Persistence\ObjectManager;

class AddScoreTraitTest extends TestCase
{
    use AddScoreTrait;

    public function testAddUser(): void
    {
        $manager = $this->createMock(ObjectManager::class);
        $manager->expects($this->once())->method('persist')->with($this->isInstanceOf(Score::class));

        $user = $this->createMock(User::class);
        $this->addScore($manager, $user, '2023-06-27', 43);
    }

}
