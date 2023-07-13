<?php

namespace App\Game;

use App\Cards\DeckOfCards;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * Trait for handlign evaluation of/after player's move in the 21 game
 */
trait EvaluatePlayerTrait
{
    protected int $goal=21;
    protected Player21 $player;
    protected Player21 $bank;
    protected Player21 $winner;
    protected bool $bankPlaying=false;
    protected DeckOfCards $deck;



    /**
     * Called after the player has picked a card.
     *
     * @return bool true if player lost otherwise
     * false
     */
    protected function evaluate(): bool
    {
        $player = $this->player;
        $handValue = $player->handValue();

        if ($handValue > $this->goal) {
            $this->winner = $this->bank;
            return true;
        }
        if ($this->deck->getCardCount() > 0) {
            $this->bankPlaying = ($handValue === $this->goal);
            return false;
        }
        return true;
    }
}
