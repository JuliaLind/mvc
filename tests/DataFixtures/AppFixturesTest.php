<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use PHPUnit\Framework\TestCase;

class AppFixturesTest extends TestCase
{
    public function testLoad(): void
    {
        $fixture = new AppFixtures();
        $manager = $this->createMock(ObjectManager::class);
        $manager->expects($this->exactly(18))
                ->method('persist');
        $manager->expects($this->once())
                ->method('flush');
        $fixture->load($manager);
    }
}
