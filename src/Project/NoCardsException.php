<?php

namespace App\Project;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * Exception class thown when there are no cards
 */
class NoCardsException extends GameException
{
}
