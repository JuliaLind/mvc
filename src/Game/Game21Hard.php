<?php

namespace App\Game;

class Game21Hard extends Game21Med
{
    public function estimateRisk(): float
    {
        // For player this is no change as player always draws first.
        // In the hard version bank is cheating,
        // bank's statistic is also based  only on cards
        // left in deck even though bank draw's card second and
        // is not aware of player's cards
        $cardsLeft = $this->deck->getCardCount();
        $possibleCards = $this->deck->getValues();
        $badCards = 0;
        $currentPlayer = $this->players[$this->current];
        $currentPoints = $currentPlayer->getMinPoints();
        $risk = 0;

        if ($cardsLeft != 0) {
            foreach ($possibleCards as $value) {
                if ($value === 14) {
                    $value = 1;
                }
                if ($currentPoints + $value > 21) {
                    $badCards += 1;
                }
            }
            $risk = $badCards / $cardsLeft;
        }

        return $risk;
    }

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
}
