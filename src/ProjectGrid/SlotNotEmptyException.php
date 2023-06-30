<?php

namespace App\ProjectGrid;

require __DIR__ . "/../../vendor/autoload.php";

use Exception;

/**
 * Raised when trying to remove a card from an already empty slot
 */
class SlotNotEmptyException extends Exception
{
}
