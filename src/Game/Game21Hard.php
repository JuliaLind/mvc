<?php

namespace App\Game;

class Game21Hard extends Game21Easy
{
    /**
     * Returns all data for current game
     *
     * @return array<array<int<0,max>,array<string,array<array<string>>|int|string>>|string|int>
     */
    public function getGameStatus(): array
    {
        $data = parent::getGameStatus();
        $data['level'] = 'hard';
        return $data;
    }

    /**
     * Deals cards to the bank
     *
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
