<?php

namespace App\Game;

require __DIR__ . "/../../vendor/autoload.php";

use App\Cards\DeckOfCards;

/**
 * Class representing the easy version of the 21 card game, from kmom03-04
 */
class Game21Easy extends Game21 implements Game21Interface
{
    use DealBankEasyTrait;
    use BanksTurnTrait;

    protected string $level="easy";

}
