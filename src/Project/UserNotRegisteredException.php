<?php

namespace App\Project;

require __DIR__ . "/../../vendor/autoload.php";

use Exception;

/**
 * Exception class thown when loggin in with an email that is not registered
 * int eh database, from kmom10/Project
 */
class UserNotRegisteredException extends Exception
{
}
