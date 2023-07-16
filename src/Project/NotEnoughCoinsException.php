<?php

namespace App\Project;

require __DIR__ . "/../../vendor/autoload.php";

use Exception;

/**
 * Exception class thown when the User does not have
 * enough coins to cover for a transaction, from kmom10/Project
 */
class NotEnoughCoinsException extends Exception
{
}
