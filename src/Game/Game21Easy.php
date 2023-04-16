<?php

namespace App\Game;

class Game21Easy extends Game21
{
    public function dealBank(): int
    {
        $currentPlayer = $this->bank;
        $evaluate = -1;
        $currentPoints = $currentPlayer->getMinPoints();
        while (($currentPoints < 17) && ($this->cardsLeft() > 0)) {
            $currentPlayer->draw($this->deck);
            $currentPoints = $currentPlayer->getMinPoints();
        }
        $evaluate = $this->evaluateBank();
        return $evaluate;
    }


    /**
     * Returns all current data for game
     *
     * @return array<array<int<0,max>,array<string,array<array<string>>|int|string>>|string|int>
     */
    public function getGameStatus(): array
    {
        $data = parent::getGameStatus();
        $data['level'] = 'easy';
        return $data;
    }
}
