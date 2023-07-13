<?php

namespace App\Game;

require __DIR__ . "/../../vendor/autoload.php";

use App\Cards\DeckOfCards;
use App\Cards\CardHand;

/**
 * Trait for calculating the value of a hand in the 21 game
 */
trait Player21Trait3
{
    protected CardHand $hand;

    /**
     * Returns the current hand value.
     * Ace is valued as 14 unless the hand value
     * is above 21, then ace is valued at 1. Each
     * ace is valued separately
     *
     * @return int
     */
    public function handValue(ValueConverter $converter = new ValueConverter()): int
    {
        $values = $this->hand->getValues();
        asort($values);
        $pointSum = 0;
        foreach ($values as $value) {
            $pointSum += $converter->adjAceValue($pointSum, $value);
        }
        return $pointSum;
    }
}
