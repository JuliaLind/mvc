<?php

namespace App\DataFixtures;

use PHPUnit\Framework\Attributes\CodeCoverageIgnore;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

#[CodeCoverageIgnore]
class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
