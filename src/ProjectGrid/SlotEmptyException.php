<?php

namespace App\ProjectGrid;

require __DIR__ . "/../../vendor/autoload.php";

use Exception;

/**
 * Raised when a card is added to a slot that already is filled
 */
class SlotEmptyException extends Exception
{
}
