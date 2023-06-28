<?php

namespace App\Game;

require __DIR__ . "/../../vendor/autoload.php";


trait Game21Trait3
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
}
