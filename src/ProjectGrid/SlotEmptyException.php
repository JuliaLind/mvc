<?php

namespace App\ProjectGrid;

require __DIR__ . "/../../vendor/autoload.php";

use Exception;

/**
 * Raised when a card is added to a slot that already is filled,
 * should never be raised under oridnary use. From kmom10/Project
 */
class SlotEmptyException extends Exception
{
}
