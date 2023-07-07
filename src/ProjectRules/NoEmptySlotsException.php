<?php

namespace App\ProjectRules;

require __DIR__ . "/../../vendor/autoload.php";

use Exception;

/**
 * Raised when trying to remove a card from an already empty slot
 */
class NoEmptySlotsException extends Exception
{
}
