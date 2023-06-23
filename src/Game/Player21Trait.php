<?php

namespace App\Game;

use App\Cards\DeckOfCards;
use App\Cards\CardHand;

/**
 * Trate for bas methods for a player
 */
trait Player21Trait
{
    /**
     * @var int $GOAL the goal points to reach.
     */
    protected const GOAL = 21;
    protected CardHand $hand;

    /**
     * Adjusts if ace should be valued at 14 or at 1
     */
    protected function adjAceValue(int $pointSum, int $value): int
    {
        if ($value === 14 && $pointSum + $value > self::GOAL) {
            $value = 1;
        }
        return $value;
    }

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

    /**
     * Returns the current hand value.
     * Ace is valued as 14 unless the hand value
     * is above 21, then ace is valued at 1. Each
     * ace is valued separately
     *
     * @return int
     */
    public function handValue(): int
    {
        $values = $this->hand->getValues();
        asort($values);
        $pointSum = 0;
        foreach ($values as $value) {
            $pointSum += $this->adjAceValue($pointSum, $value);
        }
        return $pointSum;
    }

    /**
     * Returns the current min hand value.
     * Used for calculating risk for getting fat
     * Ace is always valued at 1
     *
     * @return int
     */
    public function minHandValue(): int
    {
        $values = $this->hand->getValues();
        asort($values);
        $pointSum = 0;
        foreach ($values as $value) {
            $pointSum += $this->adjAceValueToOne($value);
        }
        return $pointSum;
    }
}
