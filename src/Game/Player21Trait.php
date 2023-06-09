<?php

namespace App\Game;

require __DIR__ . "/../../vendor/autoload.php";

use App\Cards\DeckOfCards;
use App\Cards\CardHand;

trait Player21Trait
{
    /**
     * Adjusts ace-value to 1
     */
    protected function adjAceValueToOne(int $value): int
    {
        if ($value === 14) {
            $value = 1;
        }
        return $value;
    }
}
