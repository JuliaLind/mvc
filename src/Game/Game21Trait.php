<?php

namespace App\Game;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * Trait to be used in betting games
 * between a player and a bank
 */
trait Game21Trait
{
    /**
     * @var int $GOAL the goal points to reach.
     */
    protected const GOAL = 21;
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

        if ($handValue > self::GOAL) {
            $this->winner = $this->bank;
            return true;
        }
        if ($this->cardsLeft() > 0) {
            if ($handValue === self::GOAL) {
                $this->bankPlaying = true;
            }
            return false;
        }
        return true;
    }

    protected function bankWinsOnEqual(int $bankHandValue, int $playerHandValue): bool
    {
        return $bankHandValue === self::GOAL || $bankHandValue === $playerHandValue;
    }

    protected function hasBankMoreThan21(int $bankHandValue): bool
    {
        return $bankHandValue > self::GOAL;
    }

    protected function hasBankBestScore(int $bankHandValue, int $playerHandValue): bool
    {
        $diffBank = self::GOAL - $bankHandValue;
        $diffPlayer = self::GOAL - $playerHandValue;
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
