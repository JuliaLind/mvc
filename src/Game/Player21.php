<?php

namespace App\Game;

class Player21 extends Player
{
    public function __construct(string $name="You")
    {
        parent::__construct($name);
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
            if ($value === 14 && $pointSum + $value > 21) {
                $value = 1;
            }
            $pointSum += $value;
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
            if ($value === 14) {
                $value = 1;
            }
            $pointSum += $value;
        }
        return $pointSum;
    }
}
