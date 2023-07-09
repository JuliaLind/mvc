<?php

namespace App\Game;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * Evaluates if bank won or lost the round
 */
trait EvaluateBankTrait
{
    protected int $goal=21;
    protected Player21 $player;
    protected Player21 $bank;
    protected Player21 $winner;
    protected bool $bankPlaying=false;

    /**
     * Returns true if bank scored 21 or bank and player
     * scored same amount of points
     */
    abstract protected function bankWinsOnEqual(int $bankHandValue, int $playerHandValue): bool;

    /**
     * Returns true if bank got above 21
     */
    abstract protected function hasBankMoreThan21(int $bankHandValue): bool;

    /**
     * Returns true if both bank and player are below 21
     * and bank is closer to 21 than player
     */
    abstract protected function hasBankBestScore(int $bankHandValue, int $playerHandValue): bool;

    /**
     * Called after the bank is finished with drawing cards.
     * Sets the winner of the round.
     */
    protected function evaluateBank(): void
    {
        $bank = $this->bank;
        $player = $this->player;

        $bankHandValue = $bank->handValue();
        $playerHandValue = $player->handValue();

        if ($this->hasBankMoreThan21($bankHandValue) === true) {
            $this->winner = $player;
            return;
        }

        if ($this->bankWinsOnEqual($bankHandValue, $playerHandValue) || $this->hasBankBestScore($bankHandValue, $playerHandValue)) {
            $this->winner = $bank;
            return;
        }
        $this->winner = $player;
        return;
    }
}
