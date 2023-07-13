<?php

namespace App\Game;

require __DIR__ . "/../../vendor/autoload.php";

use App\Cards\DeckOfCards;

trait Game21Trait
{
    protected Player21 $player;
    protected Player21 $bank;
    protected bool $bankPlaying=false;
    protected DeckOfCards $deck;

    /**
     * Returns the currently playing party - player or bank
     * @return Player21
     */
    protected function currentPlayer(): Player21
    {
        $currentPlayer = $this->player;
        if ($this->bankPlaying === true) {
            $currentPlayer = $this->bank;
        }
        return $currentPlayer;
    }

    /**
     * Returns the risk of getting "fat" with
     * next card for currently playing party - player or bank
     * @return string
     */
    public function getRisk(): string
    {
        $risk = strval(round($this->currentPlayer()->estimateRisk($this->deck) * 100, 2));
        return $risk . ' %';
    }
}
