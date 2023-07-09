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
        /**
         * Add users
         */
        $julia = $this->addUser($manager, "user0@test.se", "Julia", "julia"); // id 1
        $doe = $this->addUser($manager, "user2@test.se", "John", "doe"); // id 2
        $jane = $this->addUser($manager, "user3@test.se", "Jane", "jane"); // id 3

        /**
         * Add scores
         */
        $this->addScore($manager, $doe, '2023-06-27', 43); // id 1
        $this->addScore($manager, $julia, '2023-06-29', 38); // id 2
        $this->addScore($manager, $doe, '2023-06-30', 70); // id 3
        $this->addScore($manager, $julia, '2023-06-30', 132); // id 4

        /**
         * Add transactions
         */
        $this->addTransaction($manager, $doe, '2023-06-25', 'Free registration bonus', 1000); // id 1
        $this->addTransaction($manager, $jane, '2023-06-27', 'Free registration bonus', 1000); // id 2
        $this->addTransaction($manager, $julia, '2023-06-27', 'Free registration bonus', 1000); // id 3
        $this->addTransaction($manager, $doe, '2023-06-27', 'Bet', -40); // id 4
        $this->addTransaction($manager, $doe, '2023-06-27', 'Return (bet x 2)', 80); // id 5
        $this->addTransaction($manager, $julia, '2023-06-29', 'Bet', -420); // id 6
        $this->addTransaction($manager, $julia, '2023-06-29', 'Return (bet x 2)', 840); // id 7
        $this->addTransaction($manager, $julia, '2023-06-30', 'Bet', -20); // id 8
        $this->addTransaction($manager, $julia, '2023-06-30', 'Return (bet x 2)', 40); // id 9
        $this->addTransaction($manager, $doe, '2023-06-30', 'Bet', -10); // id 10
        $this->addTransaction($manager, $doe, '2023-06-30', 'Return (bet x 2)', 20); // id 11

        /**
         * Balance:
         * doe: 1000 - 40 + 80 -10 + 20 = 1050
         * julia: 1000 - 420 + 840 - 20 + 40 = 2440
         * jane: 1000
         */

        $manager->flush();
    }
}
