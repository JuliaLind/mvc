<?php

namespace App\DataFixtures;

use PHPUnit\Framework\TestCase;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;

class AddUserTraitTest extends TestCase
{
    use AddUserTrait;

    public function testAddUser(): void
    {
        $manager = $this->createMock(ObjectManager::class);
        $manager->expects($this->once())->method('persist')->with($this->isInstanceOf(User::class));

        $user = $this->addUser($manager, "julia@bth.se", "Julia", "julia");
        $this->assertEquals("julia@bth.se", $user->getEmail());
        $this->assertEquals("Julia", $user->getAcronym());

        /**
         * @var string $res
         */
        $res = $user->getHash();
        $this->assertTrue(password_verify('julia', $res));
    }

}
