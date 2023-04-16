<?php

namespace App\Game;

class Game21Hard extends Game21Easy
{
    /**
     * Returns all current data for game
     *
     * @return array<array<int<0,max>,array<string,array<array<string>>|int|string>>|string|int>
     */
    public function getGameStatus(): array
    {
        $data = parent::getGameStatus();
        $data['level'] = 'hard';
        return $data;
    }

    public function dealBank(): int
    {
        $bank = $this->bank;
        $evaluate = -1;
        $risk = 0;
        while (($risk <= 0.5) && ($this->cardsLeft() > 0)) {
            $bank->draw($this->deck);
            $risk = $this->estimateRisk();
        }
        $evaluate = $this->evaluateBank();
        return $evaluate;
    }
}
