<?php

namespace App\Project;

require __DIR__ . "/../../vendor/autoload.php";

use Exception;

/**
 * Exception class thown when there are no cards (will not be thrown under "oridnary" circumstances
 * as the deck is never dealt completely in Poker Squares), from kmom10/Project
 */
class NoCardsException extends Exception
{
}
