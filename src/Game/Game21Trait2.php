<?php

namespace App\Game;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * Trait to be used in betting games
 * between a player and a bank
 */
trait Game21Trait2
{
    protected int $goal=21;

    protected function bankWinsOnEqual(int $bankHandValue, int $playerHandValue): bool
    {
        return $bankHandValue === $this->goal || $bankHandValue === $playerHandValue;
    }

    protected function hasBankMoreThan21(int $bankHandValue): bool
    {
        return $bankHandValue > $this->goal;
    }

    protected function hasBankBestScore(int $bankHandValue, int $playerHandValue): bool
    {
        $diffBank = $this->goal - $bankHandValue;
        $diffPlayer = $this->goal - $playerHandValue;
        return $diffBank < $diffPlayer;
    }
}
