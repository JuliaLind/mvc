<?php

namespace App\Game;

require __DIR__ . "/../../vendor/autoload.php";

use App\Cards\DeckOfCards;

/**
 * Class representing the hard version of the 21 card game
 */
class Game21Hard extends Game21 implements Game21Interface
{
    use DealBankHardTrait;
    use BanksTurnTrait;

    protected string $level="hard";
}
