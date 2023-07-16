<?php

namespace App\DataFixtures;

require __DIR__ . "/../../vendor/autoload.php";

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;

/**
 * Trait used by AppFixtures class, from kmom10/project
 */
trait AddUserTrait
{
    /**
     * Adds a user to the test database
     */
    private function addUser(
        ObjectManager $manager,
        string $email,
        string $acronym,
        string $password
    ): User {
        $user = new User();
        $user->setEmail($email);
        $user->setAcronym($acronym);
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $user->setHash($hash);
        $manager->persist($user);
        return $user;
    }
}
