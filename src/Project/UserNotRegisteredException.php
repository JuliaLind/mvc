<?php

namespace App\Project;

require __DIR__ . "/../../vendor/autoload.php";

use Exception;

/**
 * Exception class thown when the suer does not have
 * enough coins to cover for a transaction
 */
class UserNotRegisteredException extends Exception
{
}
