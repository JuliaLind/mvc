<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

/**
 * Class for loading fixtures for the database-tables
 * User, Score and Transaction
 */
class AppFixtures extends Fixture
{
    use AddUserTrait;
    use AddScoreTrait;
    use AddTransactionTrait;

    /**
     * Fixtures for testing database
     * classes related to the project.
     * Loads 3 enities of class User,
     * 4 entities of class Score and
     * 11 entities of class Transaction
     * to the test database
     */
    public function load(ObjectManager $manager): void
    {
        $julia = $this->addUser($manager, "julia@bth.se", "Julia", "julia");
        $doe = $this->addUser($manager, "doe@bth.se", "John Doe", "doe");
        $jane = $this->addUser($manager, "jane@bth.se", "Jane Doe", "jane");

        $this->addScore($manager, $doe, '2023-06-27', 43);
        $this->addScore($manager, $julia, '2023-06-29', 38);
        $this->addScore($manager, $doe, '2023-06-30', 70);
        $this->addScore($manager, $julia, '2023-06-30', 132);

        $this->addTransaction($manager, $doe, '2023-06-25', 'Free registration bonus', 1000);
        $this->addTransaction($manager, $jane, '2023-06-27', 'Free registration bonus', 1000);
        $this->addTransaction($manager, $julia, '2023-06-27', 'Free registration bonus', 1000);
        $this->addTransaction($manager, $doe, '2023-06-27', 'Bet', -40);
        $this->addTransaction($manager, $doe, '2023-06-27', 'Return (bet x 2)', 80);
        $this->addTransaction($manager, $julia, '2023-06-29', 'Bet', -420);
        $this->addTransaction($manager, $julia, '2023-06-29', 'Return (bet x 2)', 840);
        $this->addTransaction($manager, $julia, '2023-06-30', 'Bet', -20);
        $this->addTransaction($manager, $julia, '2023-06-30', 'Return (bet x 2)', 40);
        $this->addTransaction($manager, $doe, '2023-06-30', 'Bet', -10);
        $this->addTransaction($manager, $doe, '2023-06-30', 'Return (bet x 2)', 20);

        $manager->flush();
    }
}
