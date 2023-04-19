<?php

namespace App\Game;

class Game21Hard extends Game21Easy
{
    use DealBankTrait;

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
}
