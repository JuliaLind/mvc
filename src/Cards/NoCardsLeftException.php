<?php

namespace App\Cards;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * Exception class thown when there are no cards
 * left do draw, from kmom02
 */
class NoCardsLeftException extends GameException
{
}
