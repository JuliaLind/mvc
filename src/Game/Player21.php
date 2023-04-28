<?php

namespace App\Game;

use App\Cards\DeckOfCards;

/**
 * Class representing a Player in the 21 game
 */
class Player21 extends Player
{
    /**
     * @var int $GOAL the goal points to reach.
     */
    protected const GOAL = 21;

    /**
     * Constructor
     * @param string $name - Name of the player, defaults to 'You'
     */
    public function __construct(string $name="You")
    {
        parent::__construct($name);
    }

    /**
     * Returns the current hand value.
     * Ace is valued as 14 unless the hand value
     * is above 21, then ace is valued at 1. Each
     * ace is valued separately
     *
     * @return int
     */
    public function handValue(): int
    {
        $values = $this->hand->getValues();
        asort($values);
        $pointSum = 0;
        foreach ($values as $value) {
            if ($value === 14 && $pointSum + $value > self::GOAL) {
                $value = 1;
            }
            $pointSum += $value;
        }
        return $pointSum;
    }

    /**
     * Returns the current min hand value.
     * Used for calculating risk for getting fat
     * Ace is always valued at 1
     *
     * @return int
     */
    public function minHandValue(): int
    {
        $values = $this->hand->getValues();
        asort($values);
        $pointSum = 0;
        foreach ($values as $value) {
            if ($value === 14) {
                $value = 1;
            }
            $pointSum += $value;
        }
        return $pointSum;
    }

    /**
     * Returns the risk of current player getting
     * above 21 with next drawn card
     * @return float the risk of getting "fat" with next card 0-1
     */
    public function estimateRisk(DeckOfCards $deck): float
    {
        $minHandValue = $this->minHandValue();
        $cardsLeft = $deck->getCardCount();
        $possibleCards = $deck->getValues();
        $badCards = 0;
        $risk = 0;
        if ($cardsLeft != 0) {
            foreach ($possibleCards as $value) {
                if ($value === 14) {
                    $value = 1;
                }
                if ($minHandValue + $value > self::GOAL) {
                    $badCards += 1;
                }
            }
            $risk = $badCards / $cardsLeft;
        }
        return $risk;
    }
}
