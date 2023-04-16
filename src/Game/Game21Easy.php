<?php

namespace App\Game;

class Game21Easy extends Game21SinglePlayer
{
    public function dealBank(): int
    {
        $evaluate = -1;
        $bank = $this->bank;
        $currentPoints = $bank->getMinPoints();
        while (($currentPoints < 17) && ($this->cardsLeft() > 0)) {
            $bank->draw($this->deck);
            $currentPoints = $bank->getMinPoints();
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
