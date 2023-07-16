<?php

namespace App\DataFixtures;

require __DIR__ . "/../../vendor/autoload.php";

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Score;
use Datetime;

/**
 * Trait used by AppFixtures class, from kmom10/project
 */
trait AddScoreTrait
{
    /**
     * Adds a score to the test-database
     */
    private function addScore(
        ObjectManager $manager,
        User $user,
        string $date,
        int $points
    ): void {
        $score = new Score();
        $score->setRegistered(new DateTime($date));
        $score->setPoints($points);
        $score->setUser($user);
        $manager->persist($score);
    }
}
