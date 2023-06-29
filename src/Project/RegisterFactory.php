<?php

namespace App\Project;

require __DIR__ . "/../../vendor/autoload.php";

use Doctrine\ORM\EntityManagerInterface;

class RegisterFactory
{
    public function create(EntityManagerInterface $manager, int $userId): Register
    {
        return new Register($manager, $userId);
    }
}
