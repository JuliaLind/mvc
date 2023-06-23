<?php

namespace App\Game;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * Trait to be used in betting games
 * between a player and a bank
 */
trait Game21Trait
{
    protected int $goal=21;
    protected Player21 $player;
    protected Player21 $bank;
    protected Player21 $winner;
    protected bool $bankPlaying=false;

    abstract protected function cardsLeft(): int;

    /**
     * Called after the player has picked a card.
     *
     * @return bool true if player lost otherwise
     * false
     */
    public function evaluate(): bool
    {
        $player = $this->player;
        $handValue = $player->handValue();

        if ($handValue > $this->goal) {
            $this->winner = $this->bank;
            return true;
        }
        if ($this->cardsLeft() > 0) {
            if ($handValue === $this->goal) {
                $this->bankPlaying = true;
            }
            return false;
        }
        return true;
    }

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

    /**
     * Called after the bank is finished with drawing cards.
     * Sets the winner of the round.
     *
     * @return void
     */
    public function evaluateBank(): void
    {
        $bank = $this->bank;
        $player = $this->player;

        $bankHandValue = $bank->handValue();
        $playerHandValue = $player->handValue();

        if ($this->hasBankMoreThan21($bankHandValue) === true) {
            $this->winner = $player;
            return;
        }
        if ($this->bankWinsOnEqual($bankHandValue, $playerHandValue) === true) {
            $this->winner = $bank;
            return;
        }
        if ($this->hasBankBestScore($bankHandValue, $playerHandValue) === true) {
            $this->winner = $bank;
            return;
        }
        $this->winner = $player;
        return;
    }
}
