<?php

namespace App\Game;

class Game21Med extends Game21
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
                $risk = 0;
                while (($risk < 0.5) && ($this->cardsLeft() > 1)) {
                    parent::deal();
                    $risk = $this->estimateRisk();
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
        $data['level'] = 'medium';
        return $data;
    }
}
