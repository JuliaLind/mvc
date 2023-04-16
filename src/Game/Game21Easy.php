<?php

namespace App\Game;

class Game21Easy extends Game21
{
    public function deal(): int
    {
        $currentPlayer = $this->players[$this->current];
        $evaluate = -1;
        switch($currentPlayer->getType()) {
            case 'player':
                parent::deal();
                break;
            case 'bank':
                $currentPoints = $currentPlayer->getMinPoints();
                while (($currentPoints < 17) && ($this->cardsLeft() > 1)) {
                    parent::deal();
                    $currentPoints = $currentPlayer->getMinPoints();
                    if ($currentPoints >= 17) {
                        break;
                    }
                }
                break;
        }
        $evaluate = $this->evaluate();
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
