<?php

namespace App\Game;

class Game21Med extends Game21Easy
{
    public function estimateRisk(): float
    {
        // For player this is no change as player always draws first.
        // In the hard version bank is cheating,
        // bank's statistic is also based  only on cards
        // left in deck even though bank draw's card second and
        // is not aware of player's cards
        $badCards = 0;
        $currentPlayer = $this->currentPlayer();
        $currentPoints = $currentPlayer->getMinPoints();
        $cardsLeft = $this->deck->getCardCount();
        $possibleCards = $this->deck->getValues();
        $risk = 0;

        if ($currentPlayer === $this->bank) {
            $otherPlayer = $this->player;
            $cardsLeft += $otherPlayer->getCardCount();
            $possibleCards = array_merge($possibleCards, $otherPlayer->getCardValues());
        }

        if ($cardsLeft != 0) {
            foreach ($possibleCards as $value) {
                if ($value === 14) {
                    $value = 1;
                }
                if ($currentPoints + $value > self::GOAL) {
                    $badCards += 1;
                }
            }
            $risk = $badCards / $cardsLeft;
        }

        return $risk;
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
