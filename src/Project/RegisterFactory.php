<?php

namespace App\Project;

require __DIR__ . "/../../vendor/autoload.php";

use Doctrine\ORM\EntityManagerInterface;

/**
 * Creates an instance of the Register class for a specific user, from kmom10/Project
 */
class RegisterFactory
{
    /**
     * returns a new instance of a Register object for a specific user
     */
    public function create(EntityManagerInterface $manager, int $userId): Register
    {
        return new Register($manager, $userId);
    }
}
