<?php

namespace App\ProjectEvaluator;

require __DIR__ . "/../../vendor/autoload.php";

use Exception;

/**
 * Raised when trying to remove a card from an already empty slot,
 * will not be reaised under ordinary use, from kmom10/Project
 */
class NoEmptySlotsException extends Exception
{
}
