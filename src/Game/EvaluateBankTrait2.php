<?php

namespace App\Game;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * part two of the evaluation process after the bank has picked cards in the 21 game
 */
trait EvaluateBankTrait2
{
    protected int $goal=21;

    /**
     * Returns true if bank scored 21 or bank and player
     * scored same amount of points
     */
    protected function bankWinsOnEqual(int $bankHandValue, int $playerHandValue): bool
    {
        return $bankHandValue === $this->goal || $bankHandValue === $playerHandValue;
    }

    /**
     * Returns true if bank got above 21
     */
    protected function hasBankMoreThan21(int $bankHandValue): bool
    {
        return $bankHandValue > $this->goal;
    }

    /**
     * Returns true if both bank and player are below 21
     * and bank is closer to 21 than player
     */
    protected function hasBankBestScore(int $bankHandValue, int $playerHandValue): bool
    {
        $diffBank = $this->goal - $bankHandValue;
        $diffPlayer = $this->goal - $playerHandValue;
        return $diffBank < $diffPlayer;
    }
}
