<?php

namespace App\Game;

class Game21Hard extends Game21Easy
{
    /**
     * Returns status data for current game
     *
     * @return array<mixed>
     */
    public function getGameStatus(): array
    {
        $data = parent::getGameStatus();
        $data['level'] = 'hard';
        return $data;
    }

    /**
     * Deals cards to the bank. Stops when risk of bank getting "fat" is
     * at or above 50% or hand value is 21 or above or there are
     * no cards left
     * @return void
     */
    public function dealBank(): void
    {
        $this->bankPlaying = true;
        $bank = $this->bank;
        while (($bank->estimateRisk($this->deck) < 0.5) && ($this->cardsLeft() > 0) && $bank->handValue() < 21) {
            $bank->draw($this->deck);
        }
    }
}
